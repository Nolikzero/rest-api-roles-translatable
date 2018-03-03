<?

namespace App\Http\Role\Permission;


use App\Http\Controllers\Controller;

class ControllerMiddlewareActionExcept extends ControllerMiddlewareAction
{
    public function handle(Controller &$controller)
    {
        $controller->middleware($this->middleware)->except($this->action);
    }
}