<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Factory;
use App\Models\Repository;
use App\Http\Requests\Api\FactoryRequest;
use App\Transformers\FactoryTransformer;

class FactoriesController extends Controller
{
    public function create(Repository $repository, Factory $factory, FactoryRequest $request)
    {
        $attributes = $request->only(['name','code','tel','bank','account','address']);
        $factory->fill($attributes);
        $factory->repository()->associate($repository);
        $factory->save();

        return $this->response->item($factory, new FactoryTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository, Factory $factory, FactoryRequest $request)
    {
        if($factory->repository_id != $repository->id)
        {
            return $this->response->errorBadRequest();
        }

        $attributes = $request->only(['name','code','tel','bank','account','address']);
        $factory->update($attributes);

        return $this->response->item($factory, new FactoryTransformer());
    }

    public function destroy(Repository $repository, Factory $factory)
    {
        if($factory->repository_id != $repository->id)
        {
            return $this->response->errorBadRequest();
        }

        $factory->delete();
        return $this->response->noContent();
    }

    public function index(Repository $repository)
    {
        $factories = $repository->factories()->orderBy('id','desc')->paginate(20);

        return $this->response->paginator($factories, new FactoryTransformer());
    }
}
