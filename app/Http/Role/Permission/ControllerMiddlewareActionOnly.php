<?

namespace App\Http\Role\Permission;


use App\Http\Controllers\Controller;

class ControllerMiddlewareActionOnly extends ControllerMiddlewareAction
{
    public function handle(Controller &$controller)
    {
        $controller->middleware($this->middleware)->only($this->action);
    }
}