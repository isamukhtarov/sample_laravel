<?php

declare(strict_types=1);

namespace Modules\User\Commands\User;

class CreateUserCommand extends UserCommand
{
    public int $id;
    public string $password;
}
