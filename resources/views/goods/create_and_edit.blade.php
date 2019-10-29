@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Good /
          @if($good->id)
            Edit #{{ $good->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($good->id)
          <form action="{{ route('goods.update', $good->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('goods.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="form-group">
                    <label for="name-field">Name</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $good->name ) }}" />
                </div> 
                <div class="form-group">
                    <label for="type-field">Type</label>
                    <input class="form-control" type="text" name="type" id="type-field" value="{{ old('type', $good->type ) }}" />
                </div> 
                <div class="form-group">
                    <label for="sort-field">Sort</label>
                    <input class="form-control" type="text" name="sort" id="sort-field" value="{{ old('sort', $good->sort ) }}" />
                </div> 
                <div class="form-group">
                    <label for="factory-field">Factory</label>
                    <input class="form-control" type="text" name="factory" id="factory-field" value="{{ old('factory', $good->factory ) }}" />
                </div> 
                <div class="form-group">
                    <label for="price-field">Price</label>
                    <input class="form-control" type="text" name="price" id="price-field" value="{{ old('price', $good->price ) }}" />
                </div> 
                <div class="form-group">
                    <label for="unit-field">Unit</label>
                    <input class="form-control" type="text" name="unit" id="unit-field" value="{{ old('unit', $good->unit ) }}" />
                </div> 
                <div class="form-group">
                    <label for="repository_id-field">Repository_id</label>
                    <input class="form-control" type="text" name="repository_id" id="repository_id-field" value="{{ old('repository_id', $good->repository_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="num-field">Num</label>
                    <input class="form-control" type="text" name="num" id="num-field" value="{{ old('num', $good->num ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('goods.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
