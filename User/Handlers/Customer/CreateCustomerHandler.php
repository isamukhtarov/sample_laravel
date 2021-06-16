<?php

declare(strict_types=1);

namespace Modules\User\Handlers\Customer;

use Illuminate\Support\Facades\Hash;
use Modules\User\Commands\Customer\CreateCustomerCommand;
use Modules\User\Entities\Customer;
use Modules\Image\Service\ImageManipulatorInterface;

class CreateCustomerHandler
{
    private ImageManipulatorInterface $avatarManipulator;

    public function __construct(ImageManipulatorInterface $avatarManipulator)
    {
        $this->avatarManipulator = $avatarManipulator;
    }

    public function handle(CreateCustomerCommand $command)
    {
        $customer = (new Customer())
                   ->setEmail($command->email)
                   ->setPhone($command->phone)
                   ->setFullName($command->full_name)
                   ->setPassword(Hash::make($command->password))
                   ->setCityId($command->city)
                   ->setAddress($command->address)
                   ->setNote($command->note)
                   ->setContacts($command->contacts)
                   ->setEmailNotifyInfo($command->email_notify_info)
                   ->setSmsNotifyInfo($command->sms_notify_info);

        if (!empty($command->avatar)) {
            $avatarName = $this->avatarManipulator->upload($command->avatar, 'avatars');
            $customer->setAvatar($avatarName);
        }

        $customer->save();

        $command->id = $customer->getId();
    }
}
