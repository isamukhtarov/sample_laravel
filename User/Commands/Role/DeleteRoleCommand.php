<?php

declare(strict_types=1);

namespace Modules\User\Commands\Role;

use Modules\Core\CommandBus\Command;

class DeleteRoleCommand extends Command
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
