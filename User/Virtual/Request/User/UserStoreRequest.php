<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Request\User;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"full_name", "username", "email", "roles", "password", "password_confirmation"}
 * )
 */
class UserStoreRequest
{
    /**
     * @OA\Property(
     *      title="full_name",
     *      description="Full Name",
     *      example="Elman Nasirov"
     * )
     *
     * @var string
     */
    public string $full_name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="User email",
     *      example="elman@mail.ru"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="username",
     *      description="User username",
     *      example="elman91"
     * )
     *
     * @var string
     */
    public string $username;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="User phone",
     *      example="994505567090"
     * )
     *
     * @var string
     */
    public string $phone;

    /**
     * @OA\Property(
     *      title="roles",
     *      description="User Roles",
     *      @OA\Property (type="integer", property="0", example=1),
     *      @OA\Property (type="integer", property="1", example=4),
     * )
     *
     * @var array
     */
    public array $roles;

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

    /**
     * @OA\Property(
     *      title="password confirmation",
     *      description="Password Confirmation",
     *      example="1234rewq"
     * )
     *
     * @var string
     */
    public string $password_confirmation;

    /**
     * @OA\Property(
     *      title="permissions",
     *      description="User Permissions",
     *      @OA\Property (type="integer", property="0", example=2),
     *      @OA\Property (type="integer", property="1", example=3),
     * )
     *
     * @var array
     */
    public array $permissions;
}
