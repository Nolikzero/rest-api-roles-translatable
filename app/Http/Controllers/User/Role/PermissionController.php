<?php

namespace App\Http\Controllers\User\Role;

use App\Http\Controllers\RestController;
use App\Http\Controllers\RestRoleController;
use App\Http\Role\Permission\ControllerMiddleware;
use App\Http\Role\Permission\ControllerMiddlewareAction;
use App\Http\Role\Permission\ControllerMiddlewareActionOnly;
use App\Transformers\PermissionTransformer;
use Illuminate\Database\Eloquent\Model;
use App\Entity\Permission;

class PermissionController extends RestRoleController
{
    function __construct(Permission $modelClass, PermissionTransformer $transformerClass)
    {
        parent::__construct($modelClass, $transformerClass,
            new ControllerMiddlewareActionOnly('permission:permissions.write.create', 'store'),
            new ControllerMiddlewareActionOnly('permission:permissions.write.edit', 'update'),
            new ControllerMiddlewareActionOnly('permission:permissions.write.delete', 'destroy')
        );
    }

}
