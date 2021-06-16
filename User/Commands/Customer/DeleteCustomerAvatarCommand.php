<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

use Modules\Core\CommandBus\Command;

class DeleteCustomerAvatarCommand extends Command
{
    private int $id;
    public string $avatar;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
