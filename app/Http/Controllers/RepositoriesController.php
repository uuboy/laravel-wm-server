<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RepositoryRequest;

class RepositoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$repositories = Repository::paginate();
		return view('repositories.index', compact('repositories'));
	}

    public function show(Repository $repository)
    {
        return view('repositories.show', compact('repository'));
    }

	public function create(Repository $repository)
	{
		return view('repositories.create_and_edit', compact('repository'));
	}

	public function store(RepositoryRequest $request)
	{
		$repository = Repository::create($request->all());
		return redirect()->route('repositories.show', $repository->id)->with('message', 'Created successfully.');
	}

	public function edit(Repository $repository)
	{
        $this->authorize('update', $repository);
		return view('repositories.create_and_edit', compact('repository'));
	}

	public function update(RepositoryRequest $request, Repository $repository)
	{
		$this->authorize('update', $repository);
		$repository->update($request->all());

		return redirect()->route('repositories.show', $repository->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Repository $repository)
	{
		$this->authorize('destroy', $repository);
		$repository->delete();

		return redirect()->route('repositories.index')->with('message', 'Deleted successfully.');
	}
}