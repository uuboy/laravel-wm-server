<?php

namespace App\Http\Controllers\Api;

use App\Models\Parter;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\ParterTransformer;
use App\Transformers\RepositoryTransformer;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\ParterRequest;

class PartersController extends Controller
{
    public function create(Repository $repository,Parter $parter,ParterRequest $request)
    {
        $attributes = $request->only('user_id');
        $parter->fill($attributes);
        $parter->repository()->associate($repository);
        $parter->save();

        return $this->response->item($parter, new ParterTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Repository $repository,Parter $parter)
    {
        $this->authorize('destroy', $parter);
        if($parter->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $parter->delete();
        return $this->response->noContent();
    }

    public function forceDestroy(Repository $repository,Request $request)
    {

        $parter = Parter::onlyTrashed()
            ->where('id', (int)$request['parter_id'])
            ->firstOrFail();
        $parter->forceDelete();
        return $this->response->noContent();
    }

    public function restore(Repository $repository,Request $request)
    {

        $parter = Parter::onlyTrashed()
            ->where('id', (int)$request['parter_id'])
            ->firstOrFail();
        $parter->restore();
        return $this->response->item($parter, new ParterTransformer());
    }

    public function repositoryIndex(Repository $repository, Request $request)
    {
        $parters = $repository->parters()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }

    public function repositoryTrashedIndex(Repository $repository, Request $request)
    {
        $parters = $repository->parters()
                    ->onlyTrashed()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }

    public function userIndex(User $user, Request $request)
    {
        $parters = $user->parters()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }

    public function userTrashedIndex(User $user, Request $request)
    {
        $parters = $user->parters()
                    ->onlyTrashed()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }
}
