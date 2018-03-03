<?php

namespace App\Http\Controllers\User;

use App\Entity\User;
use App\Http\Controllers\RestRelationController;
use App\Transformers\PermissionTransformer;
use App\Entity\Role;

class UserPermissionsController extends RestRelationController
{
    function __construct(User $modelClass, PermissionTransformer $transformerClass, $attaches = 'permissions')
    {
        parent::__construct($modelClass, $transformerClass, $attaches);
    }
}
