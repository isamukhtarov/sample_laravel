<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Request\Auth;

/**
 * @OA\Schema(
 *      title="User Log In request",
 *      description="User Login request body data",
 *      type="object",
 *      required={"username", "password"}
 * )
 */
class UserLoginRequest
{
    /**
     * @OA\Property(
     *      title="username",
     *      description="Username",
     *      example="admin"
     * )
     *
     * @var string
     */
    public string $username;

    /**
     * @OA\Property(
     *      title="password",
     *      description="User password",
     *      example="1234rewq"
     * )
     *
     * @var string
     */
    public string $password;
}
