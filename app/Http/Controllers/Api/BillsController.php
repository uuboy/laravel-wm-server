<?php

namespace App\Http\Controllers\Api;
use App\Models\Repository;
use App\Models\Inventory;
use App\Models\Bill;
use App\Models\Good;
use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\BillTransformer;
use App\Http\Requests\Api\BillRequest;

class BillsController extends Controller
{
    public function store(Repository $repository,Inventory $inventory,Good $good, Bill $bill,BillRequest $request)
    {
        if ($inventory->repository_id != $repository->id || $good->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $attributes = $request->only('num');
        $bill->fill($attributes);
        $bill->good()->associate($good);
        $bill->inventory()->associate($inventory);
        $bill->last_updater_id = $this->user()->id;
        $bill->save();
        return $this->response->item($bill, new BillTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository,Inventory $inventory,Good $good, Bill $bill, BillRequest $request)
    {
        $this->authorize('update', $bill);

        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id || $bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }
        if($bill->inventory->sort == 1){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }else{
            if($bill->inventory->sort == 2){
                $bill->good->num -= $bill->num;
                $bill->good->save();
            }
            else{

                return $this->response->errorBadRequest();
            }
        }
        $attributes = $request->only('num');

        $bill->update($attributes);
        $bill->last_updater_id = $this->user()->id;
        $bill->save();

        return $this->response->item($bill, new BillTransformer());
    }

    public function show(Repository $repository,Inventory $inventory,Good $good, Bill $bill)
    {
        $this->authorize('show', $bill);

        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id || $bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }

        return $this->response->item($bill, new BillTransformer());
    }

    public function destroy(Repository $repository,Inventory $inventory,Good $good, Bill $bill)
    {
        $this->authorize('destroy', $bill);
        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id || $bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }
        $bill->delete();
        return $this->response->noContent();
    }

    public function inventoryIndex(Repository $repository,Inventory $inventory)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $inventory->bills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function goodIndex(Repository $repository,Good $good)
    {
        if($good->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $good->bills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }



}
