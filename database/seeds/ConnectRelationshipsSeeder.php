<?php

use App\User;
use App\Entity\Role;
use App\Entity\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    /**
	     * Get Available Permissions
	     *
	     */
		$permissions = Permission::all();

	    /**
	     * Attach Permissions to Roles
	     *
	     */
        $roleAdmin = Role::whereHas('translations', function ($query) {
            $query->where('name', '=', 'Admin');
        })->first();
		foreach ($permissions as $permission) {
			$roleAdmin->attachPermission($permission);
		}

    }

}