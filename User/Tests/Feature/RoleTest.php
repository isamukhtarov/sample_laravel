<?php

declare(strict_types=1);

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\User\Entities\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\User\Entities\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\WithJWTAuth;

class RoleTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithJWTAuth;

    /** @test */
    public function can_create_role()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $insertData = [
            'display_name' => ['az' => 'Moderator', 'ru' => 'Модератор'],
            'name' => 'c60',
            'color' => 'gray',
        ];

        $response = $this->json('POST', '/api/role/create', $insertData);

        $response
            ->assertStatus(201);
    }

    /** @test */
    public function can_update_role()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $role = $this->actionCreateAndGetRole();

        $updateData = [
            'display_name' => ['az' => 'SEO', 'ru' => 'СЕО-Специалист'],
            'name' => 'seo',
            'color' => '#00056',
        ];

        $response = $this->json('PUT', "/api/role/{$role->id}/edit", $updateData);


        return $response
                    ->assertStatus(202);
    }

    /** @test */
    public function can_delete_role()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $role = $this->actionCreateAndGetRole();

        $response = $this->json('DELETE', "/api/role/{$role->id}/delete", []);

        return $response
            ->assertStatus(200);
    }

    private function actionCreateAndGetRole(): Role
    {
        $data = [
            'display_name' => ['az' => 'SEO-Mütəxəssis', 'ru' => 'СЕО-Специалист'],
            'name' => 'seo',
            'color' => '#d76f00'
        ];

        return Role::create($data);
    }
}
