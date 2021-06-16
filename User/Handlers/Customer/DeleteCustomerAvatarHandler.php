<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Customer;

use Modules\User\Commands\Customer\DeleteCustomerAvatarCommand;
use Modules\User\Entities\Customer;
use Modules\Image\Service\ImageManipulatorInterface;

class DeleteCustomerAvatarHandler
{
    private ImageManipulatorInterface $avatarManipulator;

    public function __construct(ImageManipulatorInterface $avatarManipulator)
    {
        $this->avatarManipulator = $avatarManipulator;
    }

    public function handle(DeleteCustomerAvatarCommand $command)
    {
        /** @var Customer $customer */
        $customer = Customer::find($command->getId());
        $this->avatarManipulator->delete($customer->getAvatar(), 'avatars');
        $customer->setAvatar('default.png');
        $customer->save();
    }
}
