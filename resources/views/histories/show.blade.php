@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>History / Show #{{ $history->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('histories.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('histories.edit', $history->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>User_id</label>
<p>
	{{ $history->user_id }}
</p> <label>Repository_id</label>
<p>
	{{ $history->repository_id }}
</p> <label>Method</label>
<p>
	{{ $history->method }}
</p> <label>Model</label>
<p>
	{{ $history->model }}
</p> <label>Model_name</label>
<p>
	{{ $history->model_name }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
