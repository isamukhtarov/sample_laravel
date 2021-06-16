<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Customer;

use Modules\Settings\Repository\BlockRepository;
use Modules\User\Commands\Customer\UnblockCustomerCommand;
use Modules\User\Entities\Customer;

class UnblockCustomerHandler
{
    public function handle(UnblockCustomerCommand $command)
    {
        $customer = Customer::find($command->getId());

        if ($customer && $customer->is_blocked && $customer->block){
            $customer->is_blocked = 0;
            $customer->save();

            $customer->block->delete();
        }
    }
}
