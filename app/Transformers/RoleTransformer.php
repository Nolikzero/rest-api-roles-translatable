<?php

namespace App\Transformers;

use App\Entity\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'permissions',
        'users'
    ];
    /**
     * A Fractal transformer.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role)
    {
        return $role->toArray();
    }

    /**
     * @param Role $role
     * @return \League\Fractal\Resource\Item
     */
    public function includePermissions(Role $role)
    {
        return fractal()
            ->collection($role->permissions)
            ->transformWith(PermissionTransformer::class)
            ->getResource();
    }

    /**
     * @param Role $role
     * @return \League\Fractal\Resource\Item
     */
    public function includeUsers(Role $role)
    {
        return fractal()
            ->collection($role->users)
            ->transformWith(UserTransformer::class)
            ->getResource();
    }

}
