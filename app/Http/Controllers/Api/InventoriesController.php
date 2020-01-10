<?php

namespace App\Http\Controllers\Api;

use App\Models\Inventory;
use App\Models\Repository;
use App\Models\User;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Transformers\InventoryTransformer;
use App\Transformers\BillTransformer;
use App\Http\Requests\Api\InventoryRequest;
use App\Notifications\InventoryUpdated;
use App\Notifications\InventoryDeleted;
use App\Notifications\InventoryCreated;

class InventoriesController extends Controller
{
    public function create(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        $attributes = $request->only(['name','sort','deal_date','factory_id']);
        $inventory->fill($attributes);
        $inventory->repository()->associate($repository);
        if($inventory->sort == 0){
            $inventory->owner_id = $this->user()->id;
        }elseif ($inventory->sort == 1) {
            $inventory->receiver_id = $this->user()->id;
        }else{
            return $this->response->errorBadRequest();
        }
        $inventory->user_id = $this->user()->id;
        $inventory->last_updater_id = $this->user()->id;
        $this->authorize('create', $inventory);
        $inventory->save();

        $inventory->repository->user->notify(new InventoryCreated($inventory));

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

        $inventory->repository->user->notify(new InventoryDeleted($inventory));

        return $this->response->noContent();
    }

    public function update(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        $this->authorize('update', $inventory);
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }

        $attributes = $request->only(['name', 'receiver_id','owner_id','deal_date','factory_id']);
        $inventory->update($attributes);
        $inventory->last_updater_id = $this->user()->id;
        $inventory->save();

        $inventory->repository->user->notify(new InventoryUpdated($inventory));

        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function show(Repository $repository,Inventory $inventory)
    {
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
