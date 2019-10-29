@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Bill / Show #{{ $bill->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('bills.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('bills.edit', $bill->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Num</label>
<p>
	{{ $bill->num }}
</p> <label>Good_id</label>
<p>
	{{ $bill->good_id }}
</p> <label>Inventory_id</label>
<p>
	{{ $bill->inventory_id }}
</p> <label>Last_updater_id</label>
<p>
	{{ $bill->last_updater_id }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
