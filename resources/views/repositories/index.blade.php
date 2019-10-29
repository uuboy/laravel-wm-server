@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Repository
          <a class="btn btn-success float-xs-right" href="{{ route('repositories.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($repositories->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Name</th> <th>User_id</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($repositories as $repository)
              <tr>
                <td class="text-xs-center"><strong>{{$repository->id}}</strong></td>

                <td>{{$repository->name}}</td> <td>{{$repository->user_id}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('repositories.show', $repository->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('repositories.edit', $repository->id) }}">
                    E
                  </a>

                  <form action="{{ route('repositories.destroy', $repository->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $repositories->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
