<?php

namespace App\Http\Controllers\User;

use App\Entity\User;
use App\Http\Controllers\RestRelationController;
use App\Transformers\PermissionTransformer;
use App\Entity\Role;
use App\Transformers\RoleTransformer;

class UserRolesController extends RestRelationController
{
    function __construct(User $modelClass, RoleTransformer $transformerClass, $attaches = 'roles')
    {
        parent::__construct($modelClass, $transformerClass, $attaches);
    }
}
