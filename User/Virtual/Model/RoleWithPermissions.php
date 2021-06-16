<?php

declare(strict_types=1);

namespace Modules\User\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Role with Permissions",
 *     description="Role with Permissions model",
 *     @OA\Xml(
 *         name="Role with Permissions"
 *     )
 * )
 */
class RoleWithPermissions extends Role
{
    /**
     * @OA\Property(
     *      title="Permissions",
     *      description="Role Permissions",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Permission")
     * )
     */
    private array $permissions;
}
