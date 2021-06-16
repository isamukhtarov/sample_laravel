<?php

declare(strict_types=1);

namespace Modules\User\Handlers\User;

use Modules\User\Commands\User\ToggleBlockUserCommand;
use Modules\User\Entities\User;

class ToggleBlockUserHandler
{
    public function handle(ToggleBlockUserCommand $command)
    {
        $user = User::find($command->getId());

        $user->is_blocked = ($user->is_blocked) ? 0 : 1;
        $user->save();

        $command->status = $user->is_blocked ? 'blocked' : 'unblocked';
    }
}
