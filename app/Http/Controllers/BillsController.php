<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;

class BillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$bills = Bill::paginate();
		return view('bills.index', compact('bills'));
	}

    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

	public function create(Bill $bill)
	{
		return view('bills.create_and_edit', compact('bill'));
	}

	public function store(BillRequest $request)
	{
		$bill = Bill::create($request->all());
		return redirect()->route('bills.show', $bill->id)->with('message', 'Created successfully.');
	}

	public function edit(Bill $bill)
	{
        $this->authorize('update', $bill);
		return view('bills.create_and_edit', compact('bill'));
	}

	public function update(BillRequest $request, Bill $bill)
	{
		$this->authorize('update', $bill);
		$bill->update($request->all());

		return redirect()->route('bills.show', $bill->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Bill $bill)
	{
		$this->authorize('destroy', $bill);
		$bill->delete();

		return redirect()->route('bills.index')->with('message', 'Deleted successfully.');
	}
}