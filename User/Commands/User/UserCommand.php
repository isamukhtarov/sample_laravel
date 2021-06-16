<?php

declare(strict_types=1);

namespace Modules\User\Commands\User;


use Modules\Core\CommandBus\Command;

class UserCommand extends Command
{
    public string $username;
    public string $full_name;
    public string $email;
    public ?string $phone = null;
    public array $roles;
    public array $permissions = [];
}
