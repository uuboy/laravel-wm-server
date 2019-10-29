@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Factory / Show #{{ $factory->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('factories.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('factories.edit', $factory->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Name</label>
<p>
	{{ $factory->name }}
</p> <label>Code</label>
<p>
	{{ $factory->code }}
</p> <label>Tel</label>
<p>
	{{ $factory->tel }}
</p> <label>Bank</label>
<p>
	{{ $factory->bank }}
</p> <label>Account</label>
<p>
	{{ $factory->account }}
</p> <label>Address</label>
<p>
	{{ $factory->address }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
