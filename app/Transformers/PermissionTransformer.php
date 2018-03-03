<?php

namespace App\Transformers;

use App\Entity\Permission;
use App\Entity\Role;
use League\Fractal\TransformerAbstract;

/**
 * Class PermissionTransformer
 * @package App\Transformers
 */
class PermissionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'roles',
        'users'
    ];
    /**
     * A Fractal transformer.
     *
     * @param Permission $permission
     * @return array
     */
    public function transform(Permission $permission)
    {
        return $permission->toArray();
    }


    /**
     * @param Permission $permission
     * @return \League\Fractal\Resource\ResourceInterface
     */
    public function includeRoles(Permission $permission)
    {
        return fractal()
            ->collection($permission->roles)
            ->transformWith(RoleTransformer::class)
            ->getResource();
    }

    /**
     * @param Permission $permission
     * @return \League\Fractal\Resource\ResourceInterface
     */
    public function includeUsers(Permission $permission)
    {
        return fractal()
            ->collection($permission->users)
            ->transformWith(UserTransformer::class)
            ->getResource();
    }

}
