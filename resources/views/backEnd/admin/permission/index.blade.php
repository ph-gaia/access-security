@extends('backLayout.default')
@section('title')
Permission
@stop

@section('content')

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Administração de permissões</h3>
        </div>
        <div class="col-md-12">
            <div class="pull-left">                
                <a href="{{ url('admin/permission/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Adicionar nova permissão</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tbladmin/permission">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Uri</th>
                            <th>Aplicação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($permission as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ url('admin/permission', $item->id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->uri }}</td>
                            <td><a href="{{ url('admin/application', $item->application_id) }}">{{ $item->app }}</a></td>
                            <td>
                                <a href="{{ url('admin/permission/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['admin/permission', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::submit("Excluir", ['class' => 'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tbladmin/permission').DataTable({
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