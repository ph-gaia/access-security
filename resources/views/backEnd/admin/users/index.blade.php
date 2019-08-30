@extends('backLayout.default')
@section('title')
Usuários
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Administração de Usuários</h3>
            </div>
            <div class="col-md-12">
                <div class="pull-left">                
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Adicionar novo usuário</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tbladmin/users">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ url('admin/users', $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ url('admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a> 
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['admin/users', $item->id],
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
        $('#tbladmin/users').DataTable({
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