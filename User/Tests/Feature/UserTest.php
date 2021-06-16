<?php

namespace Modules\User\Tests\Feature;

use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\WithJWTAuth;

class UserTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithJWTAuth;

    /** @test */
    public function can_create_user()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $insertData = [
            'full_name' => 'amin aminli',
            'email' => 'amin@mail.ru',
            'username' => 'amin',
            'phone' => '+994558889975',
            'password' => '1234rewq',
            'password_confirmation' => '1234rewq',
            'roles' => [
                $this->actionCreateAndGetRoles()[0]->toArray()['id']
            ]
        ];

        $response = $this->json('POST','api/user/create', $insertData);

        $response
            ->assertStatus(201);
    }

    /** @test */
    public function can_update_user()
    {
        $this->signIn();
        $this->actionCreateUser();
        $user = User::all()->toArray()[1];

        $roles = $this->actionCreateAndGetRoles();

        $updateData = [
            'full_name' => $user['full_name'],
            'email' => 'amin26@mail.ru',
            'username' => 'amin26',
            'phone' => $user['phone'],
            'password' => '',
            'password_confirmation' => '',
            'roles' => [
                $roles[0]->toArray()['id'],
            ]
        ];

        $response = $this->json('PUT',"api/user/{$user['id']}/edit", $updateData);

        return $response
            ->assertStatus(202);
    }

    /**
     * @test
     */
    public function can_blocked_and_unblock()
    {
        $this->signIn();

        $this->actionCreateUser();

        $user = User::all()->toArray()[1];

        $response = $this->json('POST', "api/user/{$user['id']}/toggleBlock", []);

        $response->assertJson($response->getOriginalContent());
    }

    private function actionCreateUser()
    {
        $data = [
            'full_name' => 'amin aminli',
            'email' => 'amin@mail.ru',
            'username' => 'amin',
            'phone' => '+994558889975',
            'password' => '1234rewq',
            'password_confirmation' => '1234rewq'
        ];

        return User::create($data);
    }

    private function actionCreateAndGetRoles(): array
    {
        $rolesData = [
            [
                'display_name' => ['az' => 'Moderator', 'ru' => 'Модертор'],
                'name' => 'moderator',
                'color' => '#D8062D'
            ],
            [
                'display_name' => ['az' => 'SEO', 'ru' => 'СЕО-Специалист'],
                'name' => 'seo',
                'color' => '#d76f00'
            ]
        ];

        foreach ($rolesData as $data) {
            $roles[] = Role::create($data);
        }

        return $roles;
    }
}
