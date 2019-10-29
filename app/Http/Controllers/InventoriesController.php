<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;

class InventoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$inventories = Inventory::paginate();
		return view('inventories.index', compact('inventories'));
	}

    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

	public function create(Inventory $inventory)
	{
		return view('inventories.create_and_edit', compact('inventory'));
	}

	public function store(InventoryRequest $request)
	{
		$inventory = Inventory::create($request->all());
		return redirect()->route('inventories.show', $inventory->id)->with('message', 'Created successfully.');
	}

	public function edit(Inventory $inventory)
	{
        $this->authorize('update', $inventory);
		return view('inventories.create_and_edit', compact('inventory'));
	}

	public function update(InventoryRequest $request, Inventory $inventory)
	{
		$this->authorize('update', $inventory);
		$inventory->update($request->all());

		return redirect()->route('inventories.show', $inventory->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Inventory $inventory)
	{
		$this->authorize('destroy', $inventory);
		$inventory->delete();

		return redirect()->route('inventories.index')->with('message', 'Deleted successfully.');
	}
}