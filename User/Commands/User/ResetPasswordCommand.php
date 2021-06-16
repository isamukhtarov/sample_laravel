<?php

declare(strict_types=1);

namespace Modules\User\Commands\User;

use Modules\Core\CommandBus\Command;

class ResetPasswordCommand extends Command
{
    public string $password;
}
