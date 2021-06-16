<?php

declare(strict_types=1);

namespace Modules\User\Handlers\User;

use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Modules\User\Commands\User\UpdateUserCommand;

class UpdateUserHandler
{
    public function handle(UpdateUserCommand $command)
    {
        /** @var User $user */
        $user = User::find($command->getId());

        $user
            ->setFullName($command->full_name)
            ->setEmail($command->email)
            ->setUsername($command->username)
            ->setPhone($command->phone);

        if ($command->password) {
            $user->setPassword(Hash::make($command->password));
        }

        $user->save();

        $user->syncRoles($command->roles);

        $user->syncPermissions($command->permissions);

        $command->user = $user;
    }
}
