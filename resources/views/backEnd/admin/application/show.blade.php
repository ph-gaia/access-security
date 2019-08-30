@extends('backLayout.default')
@section('title')
Detalhes de aplicações
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Detalhes de aplicações</h3>
                <div class="form-group pull-right">
                    <a href="{{ url('admin/application/' . $application->id . '/edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a> 
                    <a href="{{ url('admin/application') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
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
                            <td>{{ $application->id }}</td>
                            <td> {{ $application->name }}</td>
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