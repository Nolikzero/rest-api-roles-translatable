<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class Truncate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            'role_translations',
            'permission_translations',
            'role_user',
            'permission_role',
            'permissions',
            'roles',
            'users',
        ];

        foreach ($tables as $table) {
            DB::statement('TRUNCATE TABLE ' . $table . ' CASCADE;');
            DB::statement('ALTER SEQUENCE ' . $table . '_id_seq RESTART WITH 1;');
        }

    }

}