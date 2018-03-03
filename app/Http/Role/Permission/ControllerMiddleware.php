<?

namespace App\Http\Role\Permission;


use App\Http\Controllers\Controller;

class ControllerMiddleware
{
    protected $middleware;

    function __construct($middleware)
    {
        $this->middleware = $middleware;
    }

    public function handle(Controller &$controller)
    {
        $controller->middleware($this->middleware);
    }

}