<?php

namespace App\Http\Controllers\Api;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\RepositoryTransformer;
use App\Http\Requests\Api\RepositoryRequest;

class RepositoriesController extends Controller
{
    public function create(Repository $repository, RepositoryRequest $request)
    {
        $attributes = $request->only(['name']);
        $repository->fill($attributes);
        $repository->user_id = $this->user()->id;
        $repository->last_updater_id = $this->user()->id;
        $repository->save();

        return $this->response->item($repository, new RepositoryTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository, RepositoryRequest $request)
    {
        $this->authorize('update', $repository);
        $attributes = $request->only(['name']);
        $repository->update($attributes);
        $repository->last_updater_id = $this->user()->id;
        $repository->save();
        return $this->response->item($repository, new RepositoryTransformer());
    }

    public function destroy(Repository $repository)
    {
        $this->authorize('destroy', $repository);
        $repository->delete();
        return $this->response->noContent();
    }

    public function show(Repository $repository)
    {
        $this->authorize('show', $repository);
        return $this->response->item($repository,new RepositoryTransformer());
    }

    public function userIndex(RepositoryRequest $request)
    {
        $repositories = $this->user()->repositories()->filter($request->all())
            ->paginate(5);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }

    public function parterIndex()
    {
        $repositories = $this->user()->parterRepositories()->recent()
            ->paginate(20);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }

}
