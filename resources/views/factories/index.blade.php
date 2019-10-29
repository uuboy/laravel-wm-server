@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Factory
          <a class="btn btn-success float-xs-right" href="{{ route('factories.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($factories->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Name</th> <th>Code</th> <th>Tel</th> <th>Bank</th> <th>Account</th> <th>Address</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($factories as $factory)
              <tr>
                <td class="text-xs-center"><strong>{{$factory->id}}</strong></td>

                <td>{{$factory->name}}</td> <td>{{$factory->code}}</td> <td>{{$factory->tel}}</td> <td>{{$factory->bank}}</td> <td>{{$factory->account}}</td> <td>{{$factory->address}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('factories.show', $factory->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('factories.edit', $factory->id) }}">
                    E
                  </a>

                  <form action="{{ route('factories.destroy', $factory->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $factories->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
