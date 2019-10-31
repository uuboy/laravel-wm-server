@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          History /
          @if($history->id)
            Edit #{{ $history->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($history->id)
          <form action="{{ route('histories.update', $history->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('histories.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $history->user_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="repository_id-field">Repository_id</label>
                    <input class="form-control" type="text" name="repository_id" id="repository_id-field" value="{{ old('repository_id', $history->repository_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="method-field">Method</label>
                    <input class="form-control" type="text" name="method" id="method-field" value="{{ old('method', $history->method ) }}" />
                </div> 
                <div class="form-group">
                    <label for="model-field">Model</label>
                    <input class="form-control" type="text" name="model" id="model-field" value="{{ old('model', $history->model ) }}" />
                </div> 
                <div class="form-group">
                    <label for="model_name-field">Model_name</label>
                    <input class="form-control" type="text" name="model_name" id="model_name-field" value="{{ old('model_name', $history->model_name ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('histories.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
