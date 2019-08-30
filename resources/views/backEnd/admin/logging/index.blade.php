@extends('backLayout.app')
@section('title')
Logging
@stop

@section('content')

    <h1>Logging <a href="{{ url('admin/logging/create') }}" class="btn btn-primary pull-right btn-sm">Adicionar Logging</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbladmin/logging">
            <thead>
                <tr>
                    <th>ID</th><th>Ip</th><th>Description</th><th>Users Id</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($logging as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('admin/logging', $item->id) }}">{{ $item->ip }}</a></td><td>{{ $item->description }}</td><td>{{ $item->users_id }}</td>
                    <td>
                        <a href="{{ url('admin/logging/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/logging', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tbladmin/logging').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection