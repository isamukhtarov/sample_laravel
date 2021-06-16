<?php

declare(strict_types=1);

namespace Modules\User\Handlers\User;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Commands\User\CreateUserCommand;

class CreateUserHandler
{
    public function handle(CreateUserCommand $command)
    {
        $user = (new User())
            ->setFullName($command->full_name)
            ->setEmail($command->email)
            ->setUsername($command->username)
            ->setPhone($command->phone)
            ->setPassword(Hash::make($command->password));

        $user->save();

        $user->assignRole($command->roles);

        if (!empty($command->permissions)) {
            $user->givePermissionTo($command->permissions);
        }

        $command->id = $user->getId();
    }
}
