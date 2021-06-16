<?php

declare(strict_types=1);

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Core\CommandBus\CommandBusInterface;
use Modules\Core\Http\Controllers\ApiController;
use Modules\User\Commands\User\CreateUserCommand;
use Modules\User\Commands\User\ToggleBlockUserCommand;
use Modules\User\Commands\User\UpdateUserCommand;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\User\UserStoreRequest;
use Modules\User\Http\Requests\User\UserUpdateRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\Resource\UserResource;

class UserController extends ApiController
{
    private CommandBusInterface $bus;

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @OA\Get (
     *      tags={"User"},
     *      path="/api/users/",
     *      summary="Users data",
     *      description="Get admin users data",
     *      @OA\Parameter(
     *          name="perPage",
     *          description="per page value",
     *          in="query",
     *          example="10"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     * )
     * @param Request $request
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = !empty($request->perPage) ? (int)$request->perPage : 20;
        $users = UserRepository::getUsersWithRoles($perPage);
        return UserResource::collection($users);
    }

    public function create(): Renderable
    {
        $roles = Role::select('id', 'display_name')->get()->toArray();
        return view('user::users.create', compact('roles'));
    }

    /**
     * @OA\Post(
     *      tags={"User"},
     *      path="/api/user/create",
     *      operationId="user-create",
     *      summary="User Create",
     *      description="Create admin user and return user response data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserStoreRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param UserStoreRequest $request
     * @return JsonResponse|UserResource
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $command = new CreateUserCommand();
        $this->bus->dispatch($command, $request->all());
        $user = User::find($command->id);
        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      path="/api/user/{id}/edit",
     *      summary="Get user information",
     *      description="Returns user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Role wit given id not found"
     *       )
     * )
     * @param int $id
     * @return UserResource|JsonResponse
     */
    public function edit(int $id)
    {
        $user = User::with('permissions')->with('roles')->find($id);
        if (empty($user))
            return $this->notFountObjectRespond('User', $id);

        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *      tags={"User"},
     *      path="/api/user/{id}/edit",
     *      operationId="user-edit",
     *      summary="User Edit",
     *      description="Edit admin user data and return user response data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param UserUpdateRequest $request
     * @param int $id
     * @return JsonResponse|UserResource
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $command = new UpdateUserCommand($id);

        if (!($user = User::find($id)))
            return $this->notFountObjectRespond('User', $id);

        $this->bus->dispatch($command, $request->all());
        return (new UserResource($command->user))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Post(
     *      tags={"User"},
     *      path="/api/user/{id}/toggleBlock",
     *      operationId="user-block-unblock",
     *      summary="User block or unblock",
     *      description="Block or Unblock user and return result message",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     * @param int $id
     */
    public function toggleBlock(int $id): JsonResponse
    {
        $command = new ToggleBlockUserCommand($id);

        if (!User::find($id))
            return $this->notFountObjectRespond('User', $id);

        $this->bus->dispatch($command);
        return response()->json([
            'message' => "User with id {$id}, {$command->status} successfully"
        ]);
    }
}
