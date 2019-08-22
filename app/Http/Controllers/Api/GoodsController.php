<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use App\Models\Repository;
use Illuminate\Http\Request;
use App\Transformers\GoodTransformer;
use App\Http\Requests\Api\GoodRequest;

class GoodsController extends Controller
{
    public function store(Repository $repository ,GoodRequest $request, Good $good)
    {
        $good->fill($request->all());
        $good->repository()->associate($repository);
        $good->num = 0;
        $good->save();

        return $this->response->item($good, new GoodTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository, Good $good, GoodRequest $request)
    {
        // $this->authorize('update', $good);

        if ($good->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }
        $good->update($request->all());
        return $this->response->item($good, new GoodTransformer());
    }

    public function destroy(Repository $repository, Good $good)
    {
        // $this->authorize('destroy', $good);
        if ($good->repository_id != $repository->id) {
            return $this->response->errorBadRequest();
        }
        $good->delete();
        return $this->response->noContent();
    }

    // public function index(GoodRequest $request, Good $good)
    // {
    //     $query = $good->query();

    //     // if ($categoryId = $request->category_id) {
    //     //     $query->where('category_id', $categoryId);
    //     // }

    //     switch ($request->order) {
    //         case 'recent':
    //             $query->recent();
    //             break;

    //         default:
    //             $query->recentUpdated();
    //             break;
    //     }

    //     $goods = $query->paginate(20);

    //     return $this->response->paginator($goods, new GoodTransformer());
    // }

    public function repositoryIndex(Repository $repository, GoodRequest $request)
    {
        $goods = $repository->goods()->recent()->paginate(20);

        return $this->response->paginator($goods, new GoodTransformer());
    }
}
