@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Parter
          <a class="btn btn-success float-xs-right" href="{{ route('parters.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($parters->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>User_id</th> <th>Repository_id</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($parters as $parter)
              <tr>
                <td class="text-xs-center"><strong>{{$parter->id}}</strong></td>

                <td>{{$parter->user_id}}</td> <td>{{$parter->repository_id}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('parters.show', $parter->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('parters.edit', $parter->id) }}">
                    E
                  </a>

                  <form action="{{ route('parters.destroy', $parter->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $parters->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
