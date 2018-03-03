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
abstract class RestController extends Controller
{

    /**
     * @var Model
     */
    private $modelClass;

    /**
     * @var TransformerAbstract
     */
    private $transformerClass;


    /**
     * RestController constructor.
     * @param Model $modelClass
     * @param TransformerAbstract $transformerClass
     */
    function __construct(Model $modelClass, TransformerAbstract $transformerClass)
    {
        $this->modelClass = $modelClass;
        $this->transformerClass = $transformerClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $model = $this->modelClass;

        $fractal = Fractal::create();
        $fractal->transformWith($this->transformerClass);

        if ($request->exists('per_page')) {
            $per_page = $request->input('per_page');
            $paginator = $model::paginate($per_page);
            $paginator = $paginator->appends('per_page', $per_page);
            $models = $paginator->items();
            $fractal->paginateWith(new IlluminatePaginatorAdapter($paginator));
        } else {
            $models = $model::all();
        }

        $fractal->collection($models);
        return $fractal
            ->toArray();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $model = $this->modelClass;

        $model = $model::create($request->all());

        $this->transformerClass->setAvailableIncludes([]);

        return fractal($model, $this->transformerClass)
            ->respond(CreateCode::get($model));
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return array
     */
    public function show($id)
    {
        $model = $this->modelClass;
        return fractal($model::find($id), $this->transformerClass)
            ->toArray();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($id);
        $this->transformerClass->setAvailableIncludes([]);
        $response = $model->update($request->all());
        return fractal($model, $this->transformerClass)
            ->respond(UpdateCode::get($response));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelClass = $this->modelClass;
        $model = $modelClass::find($id);

        return response()->json(null, DeleteCode::get($model->delete()));
    }
}
