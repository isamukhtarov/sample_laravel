<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Traits\PreparedPermissions;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

class RoleTableSeeder extends Seeder
{
    use PreparedPermissions;

    public function run()
    {
        Model::unguard();

        $rolesData = $this->getRolesData();


        foreach ($rolesData as $data)
        {
            Role::create($data);
        }

        $role = Role::query()->select()->where('name', '=', 'admin')->first();

        $permissions = Permission::query()->select('id')->get()->toArray();

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

    }


    private function getRolesData(): array
    {
        return [
            [
                'display_name' => ['az' => 'Administrator', 'ru' => 'Администратор'],
                'name' => 'admin',
                'color' => '#000000'
            ],
            [
                'display_name' => ['az' => 'Moderator', 'ru' => 'Модератор'],
                'name' => 'moderator',
                'color' => '#D8062D'
            ],
            [
                'display_name' => ['az' => 'SEO-Mütəxəssis', 'ru' => 'СЕО-Специалист'],
                'name' => 'seo',
                'color' => '#d76f00'
            ],
        ];

    }
}
