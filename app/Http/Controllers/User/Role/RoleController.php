<?php

namespace App\Http\Controllers\User\Role;

use App\Http\Controllers\RestController;
use App\Http\Controllers\RestRoleController;
use App\Http\Role\Permission\ControllerMiddlewareActionOnly;
use App\Transformers\RoleTransformer;
use Illuminate\Database\Eloquent\Model;
use App\Entity\Role;


class RoleController extends RestRoleController
{
    function __construct(Role $modelClass, RoleTransformer $transformerClass)
    {
        parent::__construct($modelClass, $transformerClass,
            new ControllerMiddlewareActionOnly('permission:roles.write.create', 'store'),
            new ControllerMiddlewareActionOnly('permission:roles.write.edit', 'update'),
            new ControllerMiddlewareActionOnly('permission:role.write.delete', 'destroy')
        );
    }

}
