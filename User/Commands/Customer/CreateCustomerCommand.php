<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

class CreateCustomerCommand extends CustomerCommand
{
    public string $password;
}
