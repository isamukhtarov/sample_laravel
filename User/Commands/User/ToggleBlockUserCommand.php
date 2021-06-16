<?php

declare(strict_types=1);

namespace Modules\User\Commands\User;

use Modules\Core\CommandBus\Command;

class ToggleBlockUserCommand extends Command
{
    private int $id;
    public string $status;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
