<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Request\Role;

/**
 * @OA\Schema(
 *      title="Role request",
 *      description="Role request body data",
 *      type="object",
 *      required={"display_name", "name", "color"}
 * )
 */
class RoleRequest
{
    /**
     * @OA\Property(
     *      title="display_name",
     *      description="Role display Name",
     *       @OA\Property (type="string", property="az", example="New"),
     *       @OA\Property (type="string", property="ru", example="Новый"),
     * )
     *
     * @var array
     */
    public array $display_name;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Role name",
     *      example="new-role"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="color",
     *      description="Role color",
     *      example="#000000"
     * )
     *
     * @var string
     */
    public string $color;

    /**
     * @OA\Property(
     *      title="permissions",
     *      description="Role pemissions",
     *       @OA\Property (type="integer", property="0", example=1),
     *       @OA\Property (type="integer", property="1", example=5),
     * )
     *
     * @var array
     */
    public array $permissions;

}
