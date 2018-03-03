<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Add Roles
         *
         */
        if (($role = Role::where('slug', '=', 'admin')->first()) !== null
            && ($user = User::orderBy('id', 'asc')->first()) !== null
        ) {
            $user->attachRole($role);
        }


    }

}