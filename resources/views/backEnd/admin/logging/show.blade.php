@extends('backLayout.app')
@section('title')
Logging
@stop

@section('content')

    <h1>Logging</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Ip</th><th>Description</th><th>Users Id</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $logging->id }}</td> <td> {{ $logging->ip }} </td><td> {{ $logging->description }} </td><td> {{ $logging->users_id }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection