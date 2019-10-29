<?php

namespace App\Http\Controllers;

use App\Models\Parter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParterRequest;

class PartersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$parters = Parter::paginate();
		return view('parters.index', compact('parters'));
	}

    public function show(Parter $parter)
    {
        return view('parters.show', compact('parter'));
    }

	public function create(Parter $parter)
	{
		return view('parters.create_and_edit', compact('parter'));
	}

	public function store(ParterRequest $request)
	{
		$parter = Parter::create($request->all());
		return redirect()->route('parters.show', $parter->id)->with('message', 'Created successfully.');
	}

	public function edit(Parter $parter)
	{
        $this->authorize('update', $parter);
		return view('parters.create_and_edit', compact('parter'));
	}

	public function update(ParterRequest $request, Parter $parter)
	{
		$this->authorize('update', $parter);
		$parter->update($request->all());

		return redirect()->route('parters.show', $parter->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Parter $parter)
	{
		$this->authorize('destroy', $parter);
		$parter->delete();

		return redirect()->route('parters.index')->with('message', 'Deleted successfully.');
	}
}