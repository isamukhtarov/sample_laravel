<?php

declare(strict_types=1);

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {

        return [
            'full_name' => 'Isa Muxtarov',
            'email' => $this->faker->safeEmail,
            'username' => $this->faker->userName,
            'phone' => '+994508889176',
            'password' => bcrypt('1234rewq')
        ];
    }
}
