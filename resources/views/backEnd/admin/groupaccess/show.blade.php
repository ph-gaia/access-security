@extends('backLayout.default')
@section('title')
Detalhes de grupo de acesso
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalhes do grupo de acesso</h3>
                <div class="form-group pull-right">
                    <a href="{{ url('admin/groupaccess/' . $groupaccess->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a> 
                    <a href="{{ url('admin/groupaccess') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $groupaccess->id }}</td>
                            <td> {{ $groupaccess->name }}</td>
                        </tr>
                    </tbody>    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Permissões do grupo <b> {{ $groupaccess->name }}</b></h3>
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