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

class InventoriesController extends Controller
{
    public function create(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        $inventory->fill($request->all());
        $inventory->repository()->associate($repository);
        $inventory->save();

        return $this->response->item($inventory, new InventoryTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Repository $repository,Inventory $inventory)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $inventory->delete();
        return $this->response->noContent();
    }

    public function update(Repository $repository,Inventory $inventory,InventoryRequest $request)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $inventory->update($request->all());
        return $this->response->item($inventory,new InventoryTransformer());
    }

    public function repositoryIndex(Repository $repository)
    {
        $inventorys = $repository->inventories()->recent()->paginate(20);

        return $this->response->paginator($inventorys,new InventoryTransformer());
    }

    public function inventoryIndex(Repository $repository,Inventory $inventory)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $inventory->bills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function addBill(Repository $repository,Inventory $inventory,Bill $bill)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bill->inventory()->associate($inventory);
        $bill->save();
        return $this->response->item($bill,new BillTransformer());
    }

    public function deleteBill(Repository $repository,Inventory $inventory,Bill $bill)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bill->inventory()->associate(null);
        $bill->save();
        return $this->response->item($bill,new BillTransformer());
    }
}
