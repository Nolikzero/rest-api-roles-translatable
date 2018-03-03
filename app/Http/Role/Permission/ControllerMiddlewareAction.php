<?

namespace App\Http\Role\Permission;


use App\Http\Controllers\Controller;

abstract class ControllerMiddlewareAction extends ControllerMiddleware
{
    protected $action;

    function __construct($middleware , $action)
    {
        parent::__construct($middleware);
        $this->action = $action;
    }

}