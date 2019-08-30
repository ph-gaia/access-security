@extends('backLayout.default')
@section('title')
Aplicações
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Administração de Aplicação</h3>
        </div>
        <div class="col-md-12">
            <div class="pull-left">                
                <a href="{{ url('admin/application/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Adicionar nova aplicação</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-hover" id="tbladmin/application">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($application as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><a href="{{ url('admin/application', $item->id) }}">{{ $item->name }}</a></td>
                            <td>
                                <a href="{{ url('admin/application/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a> 
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['admin/application', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::submit('Excluir', ['class' => 'btn btn-danger btn-xs']) !!}
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
        $('#tbladmin/application').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: true
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection