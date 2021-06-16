<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Role;

use Modules\User\Commands\Role\UpdateRoleCommand;
use Modules\User\Entities\Role;
use Modules\User\Handlers\Traits\PreparePermissions;

class UpdateRoleHandler
{
    public function handle(UpdateRoleCommand $command)
    {
        /** @var Role $role */
        $role = Role::find($command->id);

        $role
            ->setName($command->name)
            ->setDisplayName($command->display_name);

        if ($command->color) {
            $role->setColor($command->color);
        }

        $role->save();

        $role->syncPermissions($command->permissions);

        $command->role = $role;
    }
}
