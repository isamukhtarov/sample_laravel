<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

         $this->call(RoleTableSeeder::class);
         $this->call(PermissionTableSeeder::class);
         $this->call(AdminUserTableSeeder::class);
         $this->call(CustomerTableSeeder::class);
    }
}
