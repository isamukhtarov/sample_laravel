<?php

declare(strict_types=1);

namespace Modules\User\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'display_name' => ['az' => 'Administrator', 'ru' => 'Администратор'],
            'name' => 'admin',
            'color' => '#000000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
