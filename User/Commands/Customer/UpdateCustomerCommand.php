<?php

declare(strict_types=1);

namespace Modules\User\Commands\Customer;

use Modules\User\Entities\Customer;

class UpdateCustomerCommand extends CustomerCommand
{
    public Customer $customer;
    public ?string $password = null;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
