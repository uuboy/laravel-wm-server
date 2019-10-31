<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HistoryRequest;

class HistoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$histories = History::paginate();
		return view('histories.index', compact('histories'));
	}

    public function show(History $history)
    {
        return view('histories.show', compact('history'));
    }

	public function create(History $history)
	{
		return view('histories.create_and_edit', compact('history'));
	}

	public function store(HistoryRequest $request)
	{
		$history = History::create($request->all());
		return redirect()->route('histories.show', $history->id)->with('message', 'Created successfully.');
	}

	public function edit(History $history)
	{
        $this->authorize('update', $history);
		return view('histories.create_and_edit', compact('history'));
	}

	public function update(HistoryRequest $request, History $history)
	{
		$this->authorize('update', $history);
		$history->update($request->all());

		return redirect()->route('histories.show', $history->id)->with('message', 'Updated successfully.');
	}

	public function destroy(History $history)
	{
		$this->authorize('destroy', $history);
		$history->delete();

		return redirect()->route('histories.index')->with('message', 'Deleted successfully.');
	}
}