<?php

namespace App\Http\Controllers\User;

use App\Entity\User;
use App\Http\Controllers\RestController;
use App\Http\Controllers\RestRoleController;
use App\Http\Role\Permission\ControllerMiddlewareActionOnly;
use App\Transformers\PermissionTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;
use App\Entity\Permission;

class UserController extends RestRoleController
{
    function __construct(User $modelClass, UserTransformer $transformerClass)
    {
        parent::__construct($modelClass, $transformerClass,
            new ControllerMiddlewareActionOnly('permission:users.write.create', 'store'),
            new ControllerMiddlewareActionOnly('permission:users.write.edit', 'update'),
            new ControllerMiddlewareActionOnly('permission:users.write.delete', 'destroy')
        );
    }


}
