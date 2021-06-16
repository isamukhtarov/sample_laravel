<?php

declare(strict_types=1);

namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Core\CommandBus\CommandBusInterface;
use Modules\Core\Http\Controllers\ApiController;
use Modules\Core\Http\Traits\AuthAttemptCredential;
use Modules\User\Commands\User\ResetPasswordCommand;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\User\LoginRequest;
use Modules\User\Http\Requests\User\ResetPasswordRequest;

class AuthController extends ApiController
{
    use AuthAttemptCredential;

    private CommandBusInterface $bus;

    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function loginPage()
    {
        return view('user::users.login');
    }

    public function mainPage()
    {
        return view('core::partials.main');
    }

    /**
     * @OA\Post(
     *      tags={"Auth"},
     *      path="/api/login",
     *      operationId="login",
     *      summary="Login",
     *      description="User log In and return generated token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema (ref="#/components/schemas/UserLoginRequest")
     *          ),
     *          @OA\JsonContent(ref="#/components/schemas/UserLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     * )
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only($this->findUsername($request, $request->username), 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Incorrect username or password'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *      tags={"Auth"},
     *      path="/api/logout",
     *      operationId="logout",
     *      summary="Log Out",
     *      description="User log out and return message response",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *      ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json([
            'message' => 'Log out and user tokens revoked'
        ]);
    }

    /**
     * @OA\Post(
     *      tags={"Auth"},
     *      path="/api/reset-password",
     *      operationId="reset-password",
     *      summary="Reset Password",
     *      description="REset password and return response message",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ResetPasswordRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $command = new ResetPasswordCommand();
        $this->bus->dispatch($command, $request->validated());
        return response()->json([
            'message' => 'Password has been updated successfully'
        ], Response::HTTP_ACCEPTED);
    }

    protected function respondWithToken($token): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory('abstract')->getTTL() * 60,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'username' => $user->username
            ]
        ]);
    }
}
