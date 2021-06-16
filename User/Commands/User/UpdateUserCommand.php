<?php

declare(strict_types=1);

namespace Modules\User\Commands\User;

use Modules\User\Entities\User;

class UpdateUserCommand extends UserCommand
{
    public User $user;
    private int $id;
    public ?string $password = null;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
