<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Region\Entities\City;
use Modules\User\Entities\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->getCustomersData() as $data) {
            Customer::create($data);
        }
    }

    private function getCustomersData(): array
    {
        return [
            [
                'full_name' => 'Shamil Mamedov',
                'phone' => '994706638946',
                'email' => 'shamil@gmail.com',
                'password' => \Hash::make('1234rewq'),
                'email_notify_info' => [
                    'mailing' => 1,
                    'sms' => 1,
                    'comments' => 1
                ],
                'sms_notify_info' => [
                    'sms' => 1,
                    'comments' => 1
                ]
            ],
            [
                'full_name' => 'Zamir Mahmudov',
                'phone' => '994556060678',
                'email' => 'zamir@gmail.com',
                'password' => \Hash::make('1234rewq'),
                'email_notify_info' => [
                    'mailing' => 1,
                    'sms' => 1,
                    'comments' => 0
                ],
                'sms_notify_info' => [
                    'sms' => 0,
                    'comments' => 1
                ]
            ]
        ];
    }
}
