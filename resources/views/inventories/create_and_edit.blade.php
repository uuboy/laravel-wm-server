@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Inventory /
          @if($inventory->id)
            Edit #{{ $inventory->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($inventory->id)
          <form action="{{ route('inventories.update', $inventory->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('inventories.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                    <label for="repository_id-field">Repository_id</label>
                    <input class="form-control" type="text" name="repository_id" id="repository_id-field" value="{{ old('repository_id', $inventory->repository_id ) }}" />
                </div>
                <div class="form-group">
                	<label for="name-field">Name</label>
                	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $inventory->name ) }}" />
                </div>
                <div class="form-group">
                    <label for="sort-field">Sort</label>
                    <input class="form-control" type="text" name="sort" id="sort-field" value="{{ old('sort', $inventory->sort ) }}" />
                </div>
                <div class="form-group">
                    <label for="receiver_id-field">Receiver_id</label>
                    <input class="form-control" type="text" name="receiver_id" id="receiver_id-field" value="{{ old('receiver_id', $inventory->receiver_id ) }}" />
                </div>
                <div class="form-group">
                    <label for="owner_id-field">Owner_id</label>
                    <input class="form-control" type="text" name="owner_id" id="owner_id-field" value="{{ old('owner_id', $inventory->owner_id ) }}" />
                </div>
                <div class="form-group">
                    <label for="bill_count-field">Bill_count</label>
                    <input class="form-control" type="text" name="bill_count" id="bill_count-field" value="{{ old('bill_count', $inventory->bill_count ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('inventories.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
