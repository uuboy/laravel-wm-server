<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use App\Models\Repository;
use App\Models\User;
use App\Models\Bill;
use App\Models\History;
use Illuminate\Http\Request;
use App\Transformers\InventoryTransformer;
use App\Transformers\BillTransformer;
use App\Http\Requests\Api\InventoryRequest;

class InventoriesController extends Controller
{
    public function create(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        $attributes = $request->only(['name','sort']);
        $inventory->fill($attributes);
        $inventory->repository()->associate($repository);
        if($inventory->sort == 1){
            $inventory->owner_id = $this->user()->id;
        }elseif ($inventory->sort == 2) {
            $inventory->receiver_id = $this->user()->id;
        }else{
            return $this->response->errorBadRequest();
        }
        $inventory->last_updater_id = $this->user()->id;
        $this->authorize('create', $inventory);
        $inventory->save();
        History::create([
            'user_id' => $inventory->repository->user->id,
            'repository_id' => $inventory->repository->id,
            'method' => 'create',
            'model' => 'inventory',
            'model_name' => $inventory->name,
        ]);

        return $this->response->item($inventory, new InventoryTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Repository $repository,Inventory $inventory)
    {
        $this->authorize('destroy', $inventory);
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $inventory->delete();
         History::create([
            'user_id' => $inventory->repository->user->id,
            'repository_id' => $inventory->repository->id,
            'method' => 'delete',
            'model' => 'inventory',
            'model_name' => $inventory->name,
        ]);
        return $this->response->noContent();
    }

    public function update(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        $this->authorize('update', $inventory);
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }

        $attributes = $request->only(['name', 'receiver_id','owner_id']);
        $inventory->update($attributes);
        $inventory->last_updater_id = $this->user()->id;
        $inventory->save();
        History::create([
            'user_id' => $inventory->repository->user->id,
            'repository_id' => $inventory->repository->id,
            'method' => 'update',
            'model' => 'inventory',
            'model_name' => $inventory->name,
        ]);

        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function show(Repository $repository,Inventory $inventory)
    {
        $this->authorize('show', $inventory);
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }

        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function repositoryIndex(Repository $repository)
    {
        $inventorys = $repository->inventories()->recent()->paginate(20);

        return $this->response->paginator($inventorys,new InventoryTransformer());
    }

     public function ownerIndex(User $user)
    {
        $inventories = $user->ownerInventories()->recent()->paginate(20);

        return $this->response->paginator($inventories, new InventoryTransformer());
    }

    public function receiverIndex(User $user)
    {
        $inventories = $user->receiverInventories()->recent()->paginate(20);

        return $this->response->paginator($inventories, new InventoryTransformer());
    }

}
