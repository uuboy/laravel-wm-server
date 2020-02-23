<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Transformers\GoodTransformer;
use App\Http\Requests\Api\GoodRequest;
use App\Notifications\GoodForceDeleted;
use App\Notifications\GoodDeleted;
use App\Notifications\GoodRestored;

class GoodsController extends Controller
{
    public function store(Repository $repository ,GoodRequest $request, Good $good)
    {
        $attributes = $request->only('name','type','sort','factory','price','unit');
        $good->fill($attributes);
        $good->repository()->associate($repository);
        $good->num = 0;
        $good->user_id = $this->user()->id;
        $good->last_updater_id = $this->user()->id;
        $this->authorize('create', $good);
        $good->save();

        return $this->response->item($good, new GoodTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository, Good $good, GoodRequest $request)
    {
        $this->authorize('update', $good);
        if ($good->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }
        $attributes = $request->only('name','type','sort','factory','price','unit');
        $good->update($attributes);
        $good->last_updater_id = $this->user()->id;
        $good->save();

        return $this->response->item($good, new GoodTransformer());
    }

    public function show(Repository $repository, Good $good)
    {
        if ($good->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }
        return $this->response->item($good, new GoodTransformer());
    }


    public function destroy(Repository $repository, Good $good)
    {
        $this->authorize('destroy', $good);
        if ($good->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }

        $good->delete();

        $good->repository->user->notify(new GoodDeleted($good));

        return $this->response->noContent();
    }

     public function forceDestroy(Repository $repository, Request $request)
    {
        $good = Good::onlyTrashed()
            ->where('id', (int)$request['good_id'])
            ->firstOrFail();
        $good->forceDelete();

        $good->repository->user->notify(new GoodForceDeleted($good));

        return $this->response->noContent();
    }

     public function restore(Repository $repository,Request $request)
    {
        $good = Good::onlyTrashed()
            ->where('id', (int)$request['good_id'])
            ->firstOrFail();
        $good->restore();

        $good->repository->user->notify(new GoodRestored($good));

        return $this->response->item($good,new GoodTransformer());
    }


    public function repositoryIndex(Repository $repository, GoodRequest $request)
    {
        $goods = $repository->goods()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($goods, new GoodTransformer());
    }

    public function repositoryTrashedIndex(Repository $repository, GoodRequest $request)
    {
        $goods = $repository->goods()
                    ->onlyTrashed()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($goods, new GoodTransformer());
    }
}
