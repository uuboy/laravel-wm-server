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
        $bill->fill($request->all());
        $bill->good()->associate($good);
        $bill->inventory()->associate($inventory);
        if($bill->sort == 1){
            $bill->owner_id = $this->user()->id;
        }elseif ($bill->sort == 2) {
            $bill->receiver_id = $this->user()->id;
        }else{
            return $this->response->errorBadRequest();
        }
        $bill->save();
        return $this->response->item($bill, new BillTransformer())
            ->setStatusCode(201);
    }

    public function update(Repository $repository,Inventory $inventory,Good $good, Bill $bill, BillRequest $request)
    {
        // $this->authorize('update', $bill);

        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id || $bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }
        if($bill->sort == 1){
            $bill->good->num += $bill->num;
            $bill->good->save();
        }else{
            if($bill->sort == 2){
                $bill->good->num -= $bill->num;
                $bill->good->save();
            }
            else{

                return $this->response->errorBadRequest();
            }
        }

        $bill->update($request->all());

        return $this->response->item($bill, new BillTransformer());
    }

    public function destroy(Repository $repository,Inventory $inventory,Good $good, Bill $bill)
    {
        // $this->authorize('destroy', $bill);
        if ($inventory->repository_id != $repository->id || $good->repository_id !=$repository->id || $bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }
        $bill->delete();
        return $this->response->noContent();
    }

    // public function index(BillRequest $request, Bill $bill)
    // {
    //     $query = $bill->query();

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

    //     $bills = $query->paginate(20);

    //     return $this->response->paginator($bills, new BillTransformer());
    // }

    public function goodIndex(Repository $repository,Inventory $inventory,Good $good, BillRequest $request)
    {
        $bills = $good->bills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function ownerIndex(Repository $repository,Inventory $inventory,User $user, BillRequest $request)
    {
        $bills = $user->ownerBills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function receiverIndex(Repository $repository,Inventory $inventory,User $user, BillRequest $request)
    {
        $bills = $user->receiverBills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }

    public function billDeal(Repository $repository,Inventory $inventory,Bill $bill)
    {
        if($bill->sort == 1 && is_null($bill->receiver_id) && !is_null($bill->owner_id)){
            $bill->receiver()->associate($this->user());
            $bill->save();
        }else{

            if($bill->sort == 2 && is_null($bill->owner_id) && !is_null($bill->receiver_id)){
                $bill->owner()->associate($this->user());
                $bill->save();
            }else{
                   return $this->response->errorBadRequest();
                 }
        }

        return $this->response->item($bill, new BillTransformer());
    }
}
