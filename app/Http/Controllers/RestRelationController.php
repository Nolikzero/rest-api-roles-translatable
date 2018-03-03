<?php

namespace App\Http\Controllers;

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
abstract class RestRelationController extends Controller
{

    /**
     * @var Model
     */
    private $modelClass;


    private $transformerClass;

    private $attaches;


    /**
     * RestController constructor.
     * @param Model $modelClass
     */
    function __construct(Model $modelClass, TransformerAbstract $transformerClass, $attaches)
    {
        $this->modelClass = $modelClass;
        $this->transformerClass = $transformerClass;
        $this->attaches = $attaches;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request, $id)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($id);

        $fractal = Fractal::create();
        $fractal->transformWith($this->transformerClass);

        if ($request->exists('per_page')) {
            $per_page = $request->input('per_page');
            $paginator = $model->{$this->attaches}()->paginate($per_page);
            $paginator = $paginator->appends('per_page', $per_page);
            $models = $paginator->items();
            $fractal->paginateWith(new IlluminatePaginatorAdapter($paginator));
        } else {
            $models = $model->{$this->attaches}()->get();
        }

        $fractal->collection($models);
        return $fractal
            ->toArray();
    }


    public function sync(Request $request, $id)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($id);

        $permissions = array_filter($request->json()->get($this->attaches), 'is_int');
        $response = $model->{$this->attaches}()->sync($permissions);
        return fractal($model->{$this->attaches}()->get(), $this->transformerClass)
            ->respond(CreateCode::get($response));
    }
}
