<?php

declare(strict_types=1);

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\Region\Entities\City;
use Modules\User\Entities\Customer;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'full_name' => 'Nazim Sadiyev',
            'phone' => '+994706654345',
            'password' => Hash::make('1234rewq'),
            'email' => $this->faker->safeEmail,
            'address' => 'C.Cabbarli street',
            'contacts' => [
                'phone' => '+994556788998',
                'whatsapp' => '+994706752134'
            ],
            'email_notify_info' => [
                'mailing' => 1,
                'sms' => 1,
                'comments' => 1
            ],
            'sms_notify_info' => [
                'sms' => 1,
                'comments' => 1
            ]
        ];
    }
}

