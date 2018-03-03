<?php

namespace App\Http\Controllers\User\Role;

use App\Http\Controllers\RestRelationController;
use App\Transformers\PermissionTransformer;
use App\Transformers\RoleTransformer;
use App\Entity\Permission;
use App\Entity\Role;

class PermissionRolesController extends RestRelationController
{
    function __construct(Permission $modelClass, RoleTransformer $transformerClass, $attaches = 'roles')
    {
        parent::__construct($modelClass, $transformerClass, $attaches);
    }
}
