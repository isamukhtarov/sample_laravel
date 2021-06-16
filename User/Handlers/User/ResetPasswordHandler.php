<?php

declare(strict_types=1);

namespace Modules\User\Handlers\User;

use Illuminate\Support\Facades\Hash;
use Modules\User\Commands\User\ResetPasswordCommand;
use Modules\User\Entities\User;

class ResetPasswordHandler
{
    public function handle(ResetPasswordCommand $command)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->setPassword(Hash::make($command->password))->save();
        auth()->invalidate();
    }
}
