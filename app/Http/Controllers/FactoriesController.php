<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FactoryRequest;

class FactoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$factories = Factory::paginate();
		return view('factories.index', compact('factories'));
	}

    public function show(Factory $factory)
    {
        return view('factories.show', compact('factory'));
    }

	public function create(Factory $factory)
	{
		return view('factories.create_and_edit', compact('factory'));
	}

	public function store(FactoryRequest $request)
	{
		$factory = Factory::create($request->all());
		return redirect()->route('factories.show', $factory->id)->with('message', 'Created successfully.');
	}

	public function edit(Factory $factory)
	{
        $this->authorize('update', $factory);
		return view('factories.create_and_edit', compact('factory'));
	}

	public function update(FactoryRequest $request, Factory $factory)
	{
		$this->authorize('update', $factory);
		$factory->update($request->all());

		return redirect()->route('factories.show', $factory->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Factory $factory)
	{
		$this->authorize('destroy', $factory);
		$factory->delete();

		return redirect()->route('factories.index')->with('message', 'Deleted successfully.');
	}
}