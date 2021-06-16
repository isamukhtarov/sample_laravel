<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     type="integer",
     *     example=1
     * )
     */
    private int $id;


    /**
     * @OA\Property(
     *      title="Email",
     *      description="User email",
     *      type="string",
     *      example="admin91@mail.ru"
     * )
     */
    private string $email;

    /**
     * @OA\Property(
     *      title="Full Name",
     *      description="User full name",
     *      type="string",
     *      example="Amin Mamedov"
     * )
     */
    private string $full_name;

    /**
     * @OA\Property(
     *      title="Username",
     *      description="User username",
     *      type="string",
     *      example="admin91"
     * )
     */
    private string $username;

    /**
     * @OA\Property(
     *      title="Phone",
     *      description="User phone",
     *      type="string",
     *      example="994709007886"
     * )
     */
    private string $phone;

    /**
     * @OA\Property(
     *      title="Roles",
     *      description="User Roles",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Role")
     * )
     */
    private array $roles;

    /**
     * @OA\Property(
     *      title="Permissions",
     *      description="User Permissions",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Permission")
     * )
     */
    private array $permissions;
}
