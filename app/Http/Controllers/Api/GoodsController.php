<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use App\Models\History;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Transformers\GoodTransformer;
use App\Http\Requests\Api\GoodRequest;
use App\Notifications\GoodUpdated;
use App\Notifications\GoodDeleted;
use App\Notifications\GoodCreated;

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
        History::create([
            'last_updater_id' => $good->last_updater_id,
            'user_id' => $good->repository->user->id,
            'repository_id' => $good->repository->id,
            'method' => 'create',
            'model' => 'good',
            'model_name' => $good->name,
        ]);

        $good->repository->user->notify(new GoodCreated($good));

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
         History::create([
            'last_updater_id' => $good->last_updater_id,
            'user_id' => $good->repository->user->id,
            'repository_id' => $good->repository->id,
            'method' => 'update',
            'model' => 'good',
            'model_name' => $good->name,
        ]);

        $good->repository->user->notify(new GoodUpdated($good));

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
        History::create([
            'last_updater_id' => $good->last_updater_id,
            'user_id' => $good->repository->user->id,
            'repository_id' => $good->repository->id,
            'method' => 'delete',
            'model' => 'good',
            'model_name' => $good->name,
        ]);

        $good->repository->user->notify(new GoodDeleted($good));

        return $this->response->noContent();
    }


    public function repositoryIndex(Repository $repository, GoodRequest $request)
    {
        $goods = $repository->goods()->recent()->paginate(20);

        return $this->response->paginator($goods, new GoodTransformer());
    }
}
