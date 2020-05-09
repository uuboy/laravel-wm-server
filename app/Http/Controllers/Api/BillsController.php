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
use App\Notifications\BillDeleted;
use App\Notifications\BillForceDeleted;
use App\Notifications\BillRestored;

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
        $bill->user_id = $this->user()->id;
        $bill->last_updater_id = $this->user()->id;
        $this->authorize('create', $bill);
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

        $attributes = $request->only('num');
        $attributes['last_updater_id'] = $this->user()->id;

        $bill->update($attributes);


        return $this->response->item($bill, new BillTransformer());
    }

    public function show(Repository $repository,Inventory $inventory,Good $good, Bill $bill)
    {

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

        $bill->inventory->repository->user->notify(new BillDeleted($bill));

        return $this->response->noContent();
    }

    public function forceDestroy(Repository $repository,Inventory $inventory,Good $good, Request $request)
    {
        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id) {
            return $this->response->errorBadRequest();
        }
        $bill = Bill::onlyTrashed()
            ->where('id', (int)$request['bill_id'])
            ->firstOrFail();
        $bill->forceDelete();

        $bill->inventory->repository->user->notify(new BillForceDeleted($bill));

        return $this->response->noContent();
    }

     public function restore(Repository $repository,Inventory $inventory, Good $good, Request $request)
    {
        $this->authorize('destroy', $inventory);
        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id) {
            return $this->response->errorBadRequest();
        }
        $bill = Bill::onlyTrashed()
            ->where('id', (int)$request['bill_id'])
            ->firstOrFail();

        $bill->restore();
        $bill->inventory->repository->user->notify(new BillRestored($bill));

        return $this->response->item($bill, new BillTransformer());
    }

    public function inventoryIndex(Repository $repository, Inventory $inventory, BillRequest $request)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $inventory->bills()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function inventoryTrashedIndex(Repository $repository, Inventory $inventory, BillRequest $request)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $inventory->bills()
                    ->onlyTrashed()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function inventoryTrashedIndexForceDestroy(Repository $repository, Inventory $inventory, BillRequest $request)
    {
        if($inventory->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $inventory->bills()
                    ->onlyTrashed()
                    ->search($request->keyword, null, true)
                    ->filter($request->all())
                    ->get();

        foreach ($bills as $bill) {
            $bill->forceDelete();
            $bill->inventory->repository->user->notify(new BillForceDeleted($bill));
        }
        return $this->response->noContent();
    }

    public function goodIndex(Repository $repository, Good $good, BillRequest $request)
    {
        if($good->repository_id != $repository->id){
            return $this->response->errorBadRequest();
        }
        $bills = $good->bills()->filter($request->all())->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }



}
