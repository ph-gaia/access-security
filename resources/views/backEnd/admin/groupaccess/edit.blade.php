@extends('backLayout.default')
@section('title')
Editar grupo de acesso
@stop

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulário de edição de grupo de acesso </h3>
                    </div>
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                        {!! Form::model($result, [
                            'method' => 'PATCH',
                            'url' => ['admin/groupaccess', $result->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => "Informe o nome do grupo de acesso"]) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('permission', 'Permissão: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                <select class="form-control select2"
                                        multiple="multiple"
                                        name="permission[]"
                                        data-placeholder="Selecione as permissões para esse grupo">
                                        @foreach($permission as $value)
                                        <option value="{{$value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Atualizar o registro', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        </div>
                    </div>
                    <!-- form end -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permissão </h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Permissão.</th>
                                    <th>Aplicação</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupaccess as $value)
                                <tr>
                                    <td><a href="{{ url('admin/permission', $value->permission_id) }}">{{ $value->permission }}</a></td>
                                    <td><a href="{{ url('admin/application', $value->app_id) }}"> {{ $value->application }}</a> </td>
                                    <td>
                                        <a href="{{ url('admin/groupaccess/delete/gpPermission/' . $value->group_access_id . '/' . $value->permission_id ) }}" class="remove btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
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