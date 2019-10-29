@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>
          Bill
          <a class="btn btn-success float-xs-right" href="{{ route('bills.create') }}">Create</a>
        </h1>
      </div>

      <div class="card-body">
        @if($bills->count())
          <table class="table table-sm table-striped">
            <thead>
              <tr>
                <th class="text-xs-center">#</th>
                <th>Num</th> <th>Good_id</th> <th>Inventory_id</th> <th>Last_updater_id</th>
                <th class="text-xs-right">OPTIONS</th>
              </tr>
            </thead>

            <tbody>
              @foreach($bills as $bill)
              <tr>
                <td class="text-xs-center"><strong>{{$bill->id}}</strong></td>

                <td>{{$bill->num}}</td> <td>{{$bill->good_id}}</td> <td>{{$bill->inventory_id}}</td> <td>{{$bill->last_updater_id}}</td>

                <td class="text-xs-right">
                  <a class="btn btn-sm btn-primary" href="{{ route('bills.show', $bill->id) }}">
                    V
                  </a>

                  <a class="btn btn-sm btn-warning" href="{{ route('bills.edit', $bill->id) }}">
                    E
                  </a>

                  <form action="{{ route('bills.destroy', $bill->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <button type="submit" class="btn btn-sm btn-danger">D </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $bills->render() !!}
        @else
          <h3 class="text-xs-center alert alert-info">Empty!</h3>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection
