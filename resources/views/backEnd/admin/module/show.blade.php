@extends('backLayout.default')
@section('title')
Detalhe de Módulo
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalhes de permissões</h3>
                <div class="form-group pull-right">
                <a href="{{ url('admin/module/' . $module->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a> 
                <a href="{{ url('admin/module') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $module->id }}</td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->initials }}</td>
                            <td>{{ ($module->status == 1) ? "ATIVO" : "INATIVO" }} </td>
                        </tr>
                    </tbody>    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Permissões do módulo <b> {{ $module->name }}</b></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Permissão.</th>
                            <th>Aplicação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permission as $value)
                        <tr>
                            <td><a href="{{ url('admin/permission', $value->permission_id) }}">{{ $value->permission }}</a></td>
                            <td><a href="{{ url('admin/application', $value->app_id) }}"> {{ $value->application }}</a> </td>
                        </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection