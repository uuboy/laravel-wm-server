@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Inventory / Show #{{ $inventory->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('inventories.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('inventories.edit', $inventory->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Repository_id</label>
<p>
	{{ $inventory->repository_id }}
</p> <label>Name</label>
<p>
	{{ $inventory->name }}
</p> <label>Sort</label>
<p>
	{{ $inventory->sort }}
</p> <label>Receiver_id</label>
<p>
	{{ $inventory->receiver_id }}
</p> <label>Owner_id</label>
<p>
	{{ $inventory->owner_id }}
</p> <label>Bill_count</label>
<p>
	{{ $inventory->bill_count }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
