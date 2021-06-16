<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Role;

use Modules\User\Commands\Role\CreateRoleCommand;
use Modules\User\Entities\Role;
use Modules\User\Handlers\Traits\PreparePermissions;

class CreateRoleHandler
{
    public function handle(CreateRoleCommand $command)
    {
        $role = (new Role())
               ->setName($command->name)
               ->setDisplayName($command->display_name);

        if ($command->color)
            $role->setColor($command->color);

        $role->save();

        if (!empty($command->permissions)) {
            $role->givePermissionTo($command->permissions);
        }
        $command->id = $role->getId();
    }
}
