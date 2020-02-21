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

    public function forceDestroy(Request $request)
    {
        $repository = Repository::onlyTrashed()
            ->where('id', (int)$request['repository_id'])
            ->firstOrFail();
        $repository->forceDelete();

        return $this->response->noContent();
    }

    public function restore(Request $request)
    {
        $repository = Repository::onlyTrashed()
            ->where('id', (int)$request['repository_id'])
            ->firstOrFail();
        $repository->restore();
        return $this->response->item($repository,new RepositoryTransformer());
    }
    public function show(Repository $repository)
    {
        $this->authorize('show', $repository);
        return $this->response->item($repository,new RepositoryTransformer());
    }

    public function userTrashedIndex(User $user, RepositoryRequest $request)
    {
        $repositories = $user->repositories()
                            ->onlyTrashed()
                            ->search($request->keyword, null, true)
                            ->filter($request->all())
                            ->paginate(5);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }

    public function userIndex(User $user, RepositoryRequest $request)
    {
        $repositories = $user->repositories()
                            ->search($request->keyword, null, true)
                            ->filter($request->all())
                            ->paginate(5);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }

    public function parterIndex(User $user, RepositoryRequest $request)
    {
        $repositories = $user->parterRepositories()
                            ->search($request->keyword, null, true)
                            ->filter($request->all())
                            ->paginate(20);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }

}
