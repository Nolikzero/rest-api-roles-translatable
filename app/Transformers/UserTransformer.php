<?php

namespace App\Transformers;
use App\Entity\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'roles',
        'permissions'
    ];
    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'locale' => $user->locale,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Item
     */
    public function includePermissions(User $user)
    {
        return fractal()
            ->collection($user->permissions)
            ->transformWith(PermissionTransformer::class)
            ->getResource();
    }



    /**
     * @param User $user
     * @return \League\Fractal\Resource\ResourceInterface
     */
    public function includeRoles(User $user)
    {
        return fractal()
            ->collection($user->roles)
            ->transformWith(RoleTransformer::class)
            ->getResource();
    }

}
