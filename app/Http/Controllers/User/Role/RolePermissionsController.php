<?php

namespace App\Http\Controllers\User\Role;

use App\Http\Controllers\RestRelationController;
use App\Transformers\PermissionTransformer;
use App\Entity\Role;

class RolePermissionsController extends RestRelationController
{
    function __construct(Role $modelClass, PermissionTransformer $transformerClass, $attaches = 'permissions')
    {
        parent::__construct($modelClass, $transformerClass, $attaches);
    }
}
