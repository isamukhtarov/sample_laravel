<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

use Modules\Core\CommandBus\Command;

class UnblockCustomerCommand extends Command
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
