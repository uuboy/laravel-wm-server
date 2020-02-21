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
use App\Notifications\InventoryDeleted;
use App\Notifications\InventoryRestored;
use App\Notifications\InventoryForceDeleted;

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

    public function restore(Repository $repository,Request $request)
    {
        $inventory = Inventory::onlyTrashed()
            ->where('id', (int)$request['inventory_id'])
            ->firstOrFail();
        $inventory->restore();

        $inventory->repository->user->notify(new InventoryRestored($inventory));

        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function forceDestroy(Repository $repository,Request $request)
    {
        $inventory = Inventory::onlyTrashed()
            ->where('id', (int)$request['inventory_id'])
            ->firstOrFail();
        $inventory->forceDelete();

        $inventory->repository->user->notify(new InventoryForceDeleted($inventory));

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


        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function show(Repository $repository,Inventory $inventory)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }

        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function repositoryIndex(Repository $repository,InventoryRequest $request)
    {
        $inventories = $repository->inventories()
                        ->search($request->keyword, null, true)
                        ->filter($request->all())
                        ->paginate(20);

        return $this->response->paginator($inventories,new InventoryTransformer());
    }

    public function repositoryTrashedIndex(Repository $repository,InventoryRequest $request)
    {
        $inventories = $repository->inventories()
                        ->onlyTrashed()
                        ->search($request->keyword, null, true)
                        ->filter($request->all())
                        ->paginate(20);

        return $this->response->paginator($inventories,new InventoryTransformer());
    }

     public function ownerIndex(User $user,InventoryRequest $request)
    {
        $inventories = $user->ownerInventories()
                        ->search($request->keyword, null, true)
                        ->filter($request->all())
                        ->paginate(20);

        return $this->response->paginator($inventories, new InventoryTransformer());
    }

    public function receiverIndex(User $user,InventoryRequest $request)
    {
        $inventories = $user->receiverInventories()
                        ->search($request->keyword, null, true)
                        ->filter($request->all())
                        ->paginate(20);

        return $this->response->paginator($inventories, new InventoryTransformer());
    }

}
