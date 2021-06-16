<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Customer;

use Illuminate\Support\Facades\Hash;
use Modules\User\Commands\Customer\UpdateCustomerCommand;
use Modules\User\Entities\Customer;
use Modules\Image\Service\ImageManipulatorInterface;

class UpdateCustomerHandler
{
    private ImageManipulatorInterface $avatarManipulator;

    public function __construct(ImageManipulatorInterface $avatarManipulator)
    {
        $this->avatarManipulator = $avatarManipulator;
    }

    public function handle(UpdateCustomerCommand $command)
    {
        /** @var Customer $customer */
        $customer = Customer::with('block')->find($command->id);

        $customer
            ->setEmail($command->email)
            ->setPhone($command->phone)
            ->setFullName($command->full_name)
            ->setCityId($command->city)
            ->setAddress($command->address)
            ->setNote($command->note)
            ->setContacts($command->contacts)
            ->setEmailNotifyInfo($command->email_notify_info)
            ->setSmsNotifyInfo($command->sms_notify_info);

        if ($command->password)
            $customer->setPassword(Hash::make($command->password));

        if (!empty($command->avatar)) {
            if (!empty($customer->getAvatar()) && $customer->getAvatar() !== 'default.png') {
                $this->avatarManipulator->delete($customer->getAvatar(), 'avatars');
            }

            $avatarName = $this->avatarManipulator->upload($command->avatar, 'avatars');
            $customer->setAvatar($avatarName);
        }

        $customer->save();

        $command->customer = $customer;
    }
}
