@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Good
          <a class="btn btn-success float-xs-right" href="{{ route('goods.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($goods->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Name</th> <th>Type</th> <th>Sort</th> <th>Factory</th> <th>Price</th> <th>Unit</th> <th>Repository_id</th> <th>Num</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($goods as $good)
              <tr>
                <td class="text-xs-center"><strong>{{$good->id}}</strong></td>

                <td>{{$good->name}}</td> <td>{{$good->type}}</td> <td>{{$good->sort}}</td> <td>{{$good->factory}}</td> <td>{{$good->price}}</td> <td>{{$good->unit}}</td> <td>{{$good->repository_id}}</td> <td>{{$good->num}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('goods.show', $good->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('goods.edit', $good->id) }}">
                    E
                  </a>

                  <form action="{{ route('goods.destroy', $good->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $goods->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
