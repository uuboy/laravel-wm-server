@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Bill /
          @if($bill->id)
            Edit #{{ $bill->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($bill->id)
          <form action="{{ route('bills.update', $bill->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('bills.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="form-group">
                    <label for="num-field">Num</label>
                    <input class="form-control" type="text" name="num" id="num-field" value="{{ old('num', $bill->num ) }}" />
                </div> 
                <div class="form-group">
                    <label for="good_id-field">Good_id</label>
                    <input class="form-control" type="text" name="good_id" id="good_id-field" value="{{ old('good_id', $bill->good_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="inventory_id-field">Inventory_id</label>
                    <input class="form-control" type="text" name="inventory_id" id="inventory_id-field" value="{{ old('inventory_id', $bill->inventory_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="last_updater_id-field">Last_updater_id</label>
                    <input class="form-control" type="text" name="last_updater_id" id="last_updater_id-field" value="{{ old('last_updater_id', $bill->last_updater_id ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('bills.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
