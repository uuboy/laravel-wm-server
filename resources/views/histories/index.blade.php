@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          History
          <a class="btn btn-success float-xs-right" href="{{ route('histories.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($histories->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>User_id</th> <th>Repository_id</th> <th>Method</th> <th>Model</th> <th>Model_name</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($histories as $history)
              <tr>
                <td class="text-xs-center"><strong>{{$history->id}}</strong></td>

                <td>{{$history->user_id}}</td> <td>{{$history->repository_id}}</td> <td>{{$history->method}}</td> <td>{{$history->model}}</td> <td>{{$history->model_name}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('histories.show', $history->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('histories.edit', $history->id) }}">
                    E
                  </a>

                  <form action="{{ route('histories.destroy', $history->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $histories->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
