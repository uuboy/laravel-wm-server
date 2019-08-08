<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Transformers\BillTransformer;
use App\Http\Requests\Api\BillRequest;

class BillsController extends Controller
{
    public function store(Good $good,BillRequest $request, Bill $bill)
    {
        $bill->fill($request->all());
        $bill->good()->associate($good);
        $bill->owner_id = $this->user()->id;
        $bill->save();

        return $this->response->item($bill, new BillTransformer())
            ->setStatusCode(201);
    }

    public function update(Good $good, Bill $bill, BillRequest $request)
    {
        // $this->authorize('update', $bill);

        if ($bill->good_id != $good->id) {
            return $this->response->errorBadRequest();
        }
        $bill->update($request->all());
        return $this->response->item($bill, new BillTransformer());
    }

    public function destroy(Good $good, Bill $bill)
    {
        // $this->authorize('destroy', $bill);
        if ($bill->good_id != $good->id) {
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

    public function goodIndex(Good $good, BillRequest $request)
    {
        $bills = $good->bills()->recent()->paginate(20);

        return $this->response->paginator($bills, new BillTransformer());
    }
}
