@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Good / Show #{{ $good->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('goods.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('goods.edit', $good->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Name</label>
<p>
	{{ $good->name }}
</p> <label>Type</label>
<p>
	{{ $good->type }}
</p> <label>Sort</label>
<p>
	{{ $good->sort }}
</p> <label>Factory</label>
<p>
	{{ $good->factory }}
</p> <label>Price</label>
<p>
	{{ $good->price }}
</p> <label>Unit</label>
<p>
	{{ $good->unit }}
</p> <label>Repository_id</label>
<p>
	{{ $good->repository_id }}
</p> <label>Num</label>
<p>
	{{ $good->num }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
