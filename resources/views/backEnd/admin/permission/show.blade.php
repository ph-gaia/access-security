@extends('backLayout.default')
@section('title')
Detalhes de permissões
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalhes de permissões</h3>
                <div class="form-group pull-right">
                    <a href="{{ url('admin/module/' . $permission->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a> 
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
                            <th>Uri</th>
                            <th>Aplicação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td> {{ $permission->name }} </td>
                            <td> {{ $permission->uri }} </td>
                            <td> {{ $permission->app }} </td>
                        </tr>
                    </tbody>    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection