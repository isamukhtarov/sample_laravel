<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\WithJWTAuth;

class AuthTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithJWTAuth;

    /** @test */
    public function can_login()
    {
        $adminUser = $this->getCreatedUser();
        $userData = $adminUser->toArray();

        $data = [
            'username' => $userData['email'],
            'password' => '1234rewq',
        ];

        $response = $this->json('POST','api/login', $data);

        $response->assertStatus(200)
                 ->assertJson($response->getOriginalContent());
    }

    /** @test  */
    public function can_logout()
    {
        $this->signIn();

        $response = $this->json('POST', 'api/logout', []);
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Log out and user tokens revoked'
            ]);
    }

    /** @test  */
    public function can_reset_password()
    {
        $this->signIn();

        $data = ['old' => '1234rewq', 'password' => 'example29', 'password_confirmation' => 'example29'];

        $response = $this->json('POST', 'api/reset-password', $data);

        $response->assertStatus(202);
    }
}
