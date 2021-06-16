<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Role;

use Modules\User\Commands\Role\DeleteRoleCommand;
use Modules\User\Entities\Role;

class DeleteRoleHandler
{
    public function handle(DeleteRoleCommand $command)
    {
        Role::find($command->getId())->delete();
    }
}
