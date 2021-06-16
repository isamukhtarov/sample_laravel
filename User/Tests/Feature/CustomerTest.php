<?php

namespace Modules\User\Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Region\Entities\City;
use Modules\Settings\Entities\Block;
use Modules\Settings\Entities\BlockReason;
use Modules\User\Entities\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\WithJWTAuth;

class CustomerTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, WithJWTAuth;

    /** @test */
    public function can_create_customer()
    {
        $this->withExceptionHandling();

        $this->signIn();
        $faker=Factory::create();
        $insertData = [
            'full_name' => 'Nazim Sadiyev',
            'phone' => '+994706654345',
            'password' => '1234rewq',
            'password_confirmation' => '1234rewq',
            'email' => $faker->safeEmail,
            'address' => 'C.Cabbarli street',
            'city' => $faker->randomElement(City::factory(10)->create())->id,
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

        $response = $this->json('POST', 'api/customer/create', $insertData);

        return $response->assertStatus(201);
    }

    /** @test */
    public function can_customer_update()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $customer = $this->actionCreateAndGetCustomer();
        $faker=Factory::create();
        $updateData = [
            'full_name' => 'Rasim Awurovvvv',
            'phone' => '+994706654341',
            'email' => 'rasim@mail.ru',
            'address' => 'M.Muwfiq',
            'city' => $faker->randomElement(City::factory(10)->create())->id,
            'contacts' => [
                'phone' => '+994556788918',
                'whatsapp' => '+994706712134'
            ],
            'email_notify_info' => [
                'mailing' => 1,
                'sms' => 0,
                'comments' => 1
            ],
            'sms_notify_info' => [
                'sms' => 1,
                'comments' => 0
            ]
        ];

        $response = $this->json('PUT', "api/customer/{$customer->toArray()['id']}/edit", $updateData);

        return $response
            ->assertStatus(202);
    }

    /** @test  */
    public function can_block_customer()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $customer = $this->actionCreateAndGetCustomer();

        $blockReason = BlockReason::factory()->create()->toArray();

        $data = [
            'reason_id' => $blockReason['id'],
            'description' => 'Additional description'
        ];

        $response = $this->json('POST', "api/customer/{$customer->toArray()['id']}/block", $data);

        return $response
            ->assertStatus(200);

    }

    /** @test  */
    public function can_unblock_customer()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $customer = $this->actionCreateAndGetCustomer();

        $blockReason = BlockReason::factory()->create()->toArray();

        $customer->is_blocked = 1;
        $customer->save();

        $blockData = [
            'blockable_type' => Customer::class,
            'blockable_id' => $customer->id,
            'reason_id' => $blockReason['id']
        ];

        Block::create($blockData);

        $response = $this->json('POST', "api/customer/{$customer->toArray()['id']}/unblock");

        return $response
            ->assertStatus(200);
    }

    private function actionCreateAndGetCustomer()
    {
        $data = [
            'full_name' => 'Rasim Awurov',
            'phone' => '+994706654341',
            'password' => '1234rewq',
            'password_confirmation' => '1234rewq',
            'email' => 'rasim@mail.ru',
            'address' => 'M.Muwfiq street',
            'contacts' => [
                'phone' => '+994556788918',
                'whatsapp' => '+994706712134'
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

        return Customer::create($data);
    }
}
