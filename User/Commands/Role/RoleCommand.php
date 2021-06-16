<?php

declare(strict_types=1);

namespace Modules\User\Commands\Role;

use Modules\Core\CommandBus\Command;

class RoleCommand extends Command
{
    public int $id;
    public array $display_name;
    public string $name;
    public ?string $color = null;
    public array $permissions = [];
}
