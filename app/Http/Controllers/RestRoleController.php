<?php

namespace App\Http\Controllers;

use App\Http\Role\Permission\ControllerMiddleware;
use App\StatusCode\CreateCode;
use App\StatusCode\DeleteCode;
use App\StatusCode\UpdateCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\TransformerAbstract;
use Spatie\Fractal\Fractal;


/**
 * Class RestController
 */
abstract class RestRoleController extends RestController
{

    /**
     * RestRoleController constructor.
     * @param Model $modelClass
     * @param TransformerAbstract $transformerClass
     * @param ControllerMiddleware[] $ControllerPermissions
     */
    function __construct(Model $modelClass, TransformerAbstract $transformerClass, ControllerMiddleware ...$ControllerPermissions)
    {
        parent::__construct($modelClass, $transformerClass);

        foreach ($ControllerPermissions as $ControllerPermission){
            $ControllerPermission->handle($this);
        }
    }
}
