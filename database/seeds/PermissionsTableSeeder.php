<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            [
                'name:en' => 'Can view roles',
                'name:ru' => 'Может просматривать роли',
                'slug' => 'roles.view',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can create roles',
                'name:ru' => 'Может создавать роли',
                'slug' => 'roles.write.create',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can edit roles',
                'name:ru' => 'Может редактировать роли',
                'slug' => 'roles.write.edit',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can delete roles',
                'name:ru' => 'Может удалять роли',
                'slug' => 'roles.write.delete',
                'model' => 'Permission',
            ],

            [
                'name:en' => 'Can view users',
                'name:ru' => 'Может просматривать пользователей',
                'slug' => 'users.view',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can create users',
                'name:ru' => 'Может создавать пользователей',
                'slug' => 'users.write.create',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can edit users',
                'name:ru' => 'Может редактировать пользователей',
                'slug' => 'users.write.edit',
                'model' => 'Permission',
            ],
            [
                'name:en' => 'Can delete users',
                'name:ru' => 'Может удалять пользователей',
                'slug' => 'users.write.delete',
                'model' => 'Permission',
            ],
        ];

        foreach ($permissions as $permission){
            $permissionModel = new Permission();
            $permissionModel->setLocale('en')
                ->fill($permission)
                ->save();
        }

    }
}
