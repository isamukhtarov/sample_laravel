<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Customer;

use Modules\Settings\Entities\BlockReason;
use Modules\User\Commands\Customer\BlockCustomerCommand;
use Modules\User\Entities\Customer;

class BlockCustomerHandler
{
    public function handle(BlockCustomerCommand $command)
    {
        $customer = Customer::find($command->getId());
        $customer->is_blocked = 1;
        $customer->save();

        $blockReason = BlockReason::find($command->reason_id);

        if ($blockReason) {
            $blockData = ['reason_id' => $blockReason->id];

            if ($command->description)
                $blockData['description'] = $command->description;

            if (empty($customer->block)) {
                $customer->block()->create($blockData);
            }else{
                $customer->block()->update($blockData);
            }
        }


    }
}
