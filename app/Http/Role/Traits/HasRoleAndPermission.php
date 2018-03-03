<?php

namespace App\Http\Role\Traits;
use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;

trait HasRoleAndPermission
{
    use \jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

    /**
     * Get all permissions from roles.
     *
     * @return Builder
     */
    public function rolePermissions()
    {
        $permissionModel = app(config('roles.models.permission'));

        if (!$permissionModel instanceof Model) {
            throw new InvalidArgumentException('[roles.models.permission] must be an instance of \Illuminate\Database\Eloquent\Model');
        }

        return $permissionModel::whereHas('translations', function ($query) {
            $query->select(['permissions.*', 'permission_role.created_at as pivot_created_at', 'permission_role.updated_at as pivot_updated_at'])
                ->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                ->join('roles', 'roles.id', '=', 'permission_role.role_id')
                ->whereIn('roles.id', $this->getRoles()->pluck('id')->toArray())
                ->orWhere('roles.level', '<', $this->level())
                ->groupBy(['permissions.id', 'permissions', 'permissions.slug', 'permissions', 'permissions.model', 'permissions.created_at', 'permissions.updated_at', 'pivot_created_at', 'pivot_updated_at']);
        });
    }

    public function permissions(){
        return $this->userPermissions();
    }
}
