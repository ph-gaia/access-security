@extends('backLayout.default')
@section('title')
Detalhes de usuários
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Detalhes do usuário</h3>
            <div class="form-group pull-right">
                <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a> 
                <a href="{{ url('admin/users') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Area</th>
                            <th>Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td> {{ $user->name }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $user->area }}</td>
                            <td> {{ $user->phone }} </td>
                        </tr>
                    </tbody>    
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permissões </h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Permissão</th>
                                <th>Aplicação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $value)
                            <tr>
                                <td><a href="{{ url('admin/permission', $value->permission_id) }}">{{ $value->permission }}</a></td>
                                <td><a href="{{ url('admin/application', $value->app_id) }}"> {{ $value->application }}</a> </td>
                            </tr>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection