<?php

namespace Modules\User\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Core\Database\Traits\PreparedPermissions;
use Modules\User\Entities\Permission;
use Spatie\Permission\Models\Role;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Laravel\Facades\Activation;


class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $user = User::create([
            'full_name' => 'Administration',
            'username' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('1234rewq'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role = Role::where('name', '=', 'admin')->get()->toArray();

        $user->assignRole($role[0]['id']);
    }

}
