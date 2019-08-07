<?php

namespace App\Http\Controllers\Api;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Transformers\RepositoryTransformer;
use App\Http\Requests\Api\RepositoryRequest;

class RepositoriesController extends Controller
{
    public function store(RepositoryRequest $request, Repository $repository)
    {
        $repository->fill($request->all());
        $repository->user_id = $this->user()->id;
        $repository->save();

        return $this->response->item($repository, new RepositoryTransformer())
            ->setStatusCode(201);
    }

    public function update(RepositoryRequest $request, Repository $repository)
    {
        // $this->authorize('update', $repository);

        $repository->update($request->all());
        return $this->response->item($repository, new RepositoryTransformer());
    }

    public function destroy(Repository $repository)
    {
        // $this->authorize('destroy', $repository);

        $repository->delete();
        return $this->response->noContent();
    }

    public function index(RepositoryRequest $request, Repository $repository)
    {
        $query = $repository->query();

        // if ($categoryId = $request->category_id) {
        //     $query->where('category_id', $categoryId);
        // }

        switch ($request->order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentUpdated();
                break;
        }

        $repositories = $query->paginate(20);

        return $this->response->paginator($repositories, new RepositoryTransformer());
    }
}
