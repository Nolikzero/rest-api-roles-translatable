<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            [
                'name:en' => 'Admin',
                'name:ru' => 'Админ',
                'slug' => 'admin',
                'level' => 5,
            ],
            [
                'name:en' => 'User',
                'name:ru' => 'Пользователь',
                'slug' => 'user',
                'level' => 1,
            ]
        ];
        /**
         * Add Roles
         *
         */

        foreach ($roles as $role) {
            $roleModel = new Role();
            $roleModel
                ->fill($role)
                ->save();
        }

    }

}