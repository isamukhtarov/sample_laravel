<?php

declare(strict_types=1);

namespace Modules\User\Commands\Role;

use Modules\User\Entities\Role;

class UpdateRoleCommand extends RoleCommand
{
    public Role $role;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
