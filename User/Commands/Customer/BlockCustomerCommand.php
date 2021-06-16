<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

use Modules\Core\CommandBus\Command;

class BlockCustomerCommand extends Command
{
    private int $id;
    public int $reason_id;
    public ?string $description = null;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
