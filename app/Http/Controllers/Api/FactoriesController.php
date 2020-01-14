<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Factory;
use App\Models\Repository;
use App\Http\Requests\Api\FactoryRequest;
use App\Transformers\FactoryTransformer;
use App\Notifications\FactoryCreated;
use App\Notifications\FactoryUpdated;
use App\Notifications\FactoryDeleted;

class FactoriesController extends Controller
{
    public function create(Repository $repository, Factory $factory, FactoryRequest $request)
    {
        $attributes = $request->only(['name','code','tel','bank','account','address']);
        $factory->fill($attributes);
        $factory->repository()->associate($repository);
        $factory->user_id = $this->user()->id;
        $factory->last_updater_id = $this->user()->id;
        $this->authorize('create', $factory);
        $factory->save();
        $factory->repository->user->notify(new FactoryCreated($factory));

        return $this->response->item($factory, new FactoryTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository, Factory $factory, FactoryRequest $request)
    {
        $this->authorize('update', $factory);
        if($factory->repository_id != $repository->id)
        {
            return $this->response->errorBadRequest();
        }

        $attributes = $request->only(['name','code','tel','bank','account','address']);
        $factory->update($attributes);
        $factory->last_updater_id = $this->user()->id;
        $factory->save();
        $factory->repository->user->notify(new FactoryUpdated($factory));

        return $this->response->item($factory, new FactoryTransformer());
    }

    public function destroy(Repository $repository, Factory $factory)
    {
        $this->authorize('destroy', $factory);
        if($factory->repository_id != $repository->id)
        {
            return $this->response->errorBadRequest();
        }
        if ($factory->inventories->isNotEmpty()) {
            return $this->response->errorMethodNotAllowed();
        }
        $factory->delete();
        $factory->repository->user->notify(new FactoryDeleted($factory));
        return $this->response->noContent();
    }

     public function show(Repository $repository, Factory $factory)
    {
        if ($factory->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }
        return $this->response->item($factory, new FactoryTransformer());
    }

    public function index(Repository $repository, FactoryRequest $request)
    {
        $factories = $repository->factories()
                        ->search($request->keyword, null, true)
                        ->filter($request->all())
                        ->paginate(20);

        return $this->response->paginator($factories, new FactoryTransformer());
    }
}
