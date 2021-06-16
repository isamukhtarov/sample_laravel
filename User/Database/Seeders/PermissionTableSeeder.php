<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Traits\PreparedPermissions;
use Modules\User\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permissions = PreparedPermissions::getPermissions();

        foreach ($permissions as $name => $displayNameWithLng) {
            $data = ['name' => $name, 'display_name' => $displayNameWithLng];
            Permission::create($data);
        }
    }

}
