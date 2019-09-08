<?php

namespace App\Http\Controllers\Api;

use App\Models\Parter;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\ParterTransformer;
use App\Http\Requests\Api\ParterRequest;

class PartersController extends Controller
{
    public function create(Repository $repository,Parter $parter)
    {
        $parter->user_id = $this->user()->id;
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

    public function repositoryIndex(Repository $repository)
    {
        $parters = $repository->parters()->recent()->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }

    public function userIndex(User $user)
    {
        $parters = $user->parters()->recent()->paginate(20);

        return $this->response->paginator($parters,new ParterTransformer());
    }
}
