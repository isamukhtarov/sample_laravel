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
use Modules\User\Commands\Role\CreateRoleCommand;
use Modules\User\Commands\Role\DeleteRoleCommand;
use Modules\User\Commands\Role\UpdateRoleCommand;
use Modules\User\Entities\Role;
use Modules\User\Http\Requests\Role\StoreRoleRequest;
use Modules\User\Http\Requests\Role\UpdateRoleRequest;
use Modules\User\Transformers\Resource\RoleResource;

class RoleController extends ApiController
{
    private CommandBusInterface $bus;

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @OA\Get(
     *      tags={"Role"},
     *      path="/api/roles",
     *      summary="Get list of dynamic properties",
     *      description="Returns list of roles",
     *      @OA\Parameter(
     *          name="perPage",
     *          description="per page value",
     *          in="query",
     *          example="10"
     *      ),
     *      @OA\Response(response=200, description="Successful operation"),
     *     )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = !empty($request->perPage) ? (int)$request->perPage : 20;
        $roles = Role::with('permissions')->orderBy('id')->paginate($perPage);
        return RoleResource::collection($roles);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * @OA\Post(
     *      tags={"Role"},
     *      path="/api/role/create",
     *      operationId="role-create",
     *      summary="Role Create",
     *      description="Create role and return role response data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RoleRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful created operation", @OA\JsonContent(ref="#/components/schemas/RoleWithPermissions")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param StoreRoleRequest
     * @return JsonResponse|RoleResource
     */
    public function store(StoreRoleRequest $request)
    {
        $command = new CreateRoleCommand();
        $this->bus->dispatch($command, $request->all());
        $role = Role::findOrFail($command->id);

        return  (new RoleResource($role))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      tags={"Role"},
     *      path="/api/role/{id}/edit",
     *      summary="Get role information",
     *      description="Returns role data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation", @OA\JsonContent(ref="#/components/schemas/RoleWithPermissions")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Role wit given id not found"
     *       )
     * )
     * @param int $id
     * @return RoleResource|JsonResponse
     */
    public function edit(int $id)
    {
        $role = Role::with('permissions')->find($id);
        if (empty($role))
            return $this->notFountObjectRespond('Role', $id);

        return new RoleResource($role);
    }

    /**
     * @OA\Put(
     *      tags={"Role"},
     *      path="/api/role/{id}/edit",
     *      operationId="role-edit",
     *      summary="Role Edit",
     *      description="Edit role and return role response data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RoleRequest")
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful updated operation", @OA\JsonContent(ref="#/components/schemas/RoleWithPermissions")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param $id
     * @return RoleResource|JsonResponse
     * @param UpdateRoleRequest $request
     * @param int $id
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
        $command = new UpdateRoleCommand($id);

        if (!($role = Role::find($id)))
            return $this->notFountObjectRespond('Role', $id);

        $this->bus->dispatch($command, $request->all());

        return (new RoleResource($command->role))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete (
     *      tags={"Role"},
     *      path="/api/role/{id}/delete",
     *      summary="Delete role with given id",
     *      description="Returns message about result",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Role wit given id not found"
     *       )
     * )
     * @param int $id
     */
    public function destroy(int $id): JsonResponse
    {
        if (!Role::find($id))
            return $this->notFountObjectRespond('Role', $id);

        $this->bus->dispatch(new DeleteRoleCommand($id));
        return response()->json([
            'message' => 'Role has been deleted successfully'
        ]);
    }
}
