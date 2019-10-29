@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Factory /
          @if($factory->id)
            Edit #{{ $factory->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($factory->id)
          <form action="{{ route('factories.update', $factory->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('factories.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="form-group">
                    <label for="name-field">Name</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $factory->name ) }}" />
                </div> 
                <div class="form-group">
                    <label for="code-field">Code</label>
                    <input class="form-control" type="text" name="code" id="code-field" value="{{ old('code', $factory->code ) }}" />
                </div> 
                <div class="form-group">
                    <label for="tel-field">Tel</label>
                    <input class="form-control" type="text" name="tel" id="tel-field" value="{{ old('tel', $factory->tel ) }}" />
                </div> 
                <div class="form-group">
                    <label for="bank-field">Bank</label>
                    <input class="form-control" type="text" name="bank" id="bank-field" value="{{ old('bank', $factory->bank ) }}" />
                </div> 
                <div class="form-group">
                    <label for="account-field">Account</label>
                    <input class="form-control" type="text" name="account" id="account-field" value="{{ old('account', $factory->account ) }}" />
                </div> 
                <div class="form-group">
                    <label for="address-field">Address</label>
                    <input class="form-control" type="text" name="address" id="address-field" value="{{ old('address', $factory->address ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('factories.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
