@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Inventory
          <a class="btn btn-success float-xs-right" href="{{ route('inventories.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($inventories->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Repository_id</th> <th>Name</th> <th>Sort</th> <th>Receiver_id</th> <th>Owner_id</th> <th>Bill_count</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($inventories as $inventory)
              <tr>
                <td class="text-xs-center"><strong>{{$inventory->id}}</strong></td>

                <td>{{$inventory->repository_id}}</td> <td>{{$inventory->name}}</td> <td>{{$inventory->sort}}</td> <td>{{$inventory->receiver_id}}</td> <td>{{$inventory->owner_id}}</td> <td>{{$inventory->bill_count}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('inventories.show', $inventory->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('inventories.edit', $inventory->id) }}">
                    E
                  </a>

                  <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $inventories->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
