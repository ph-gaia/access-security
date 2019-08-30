@extends('backLayout.default')
@section('title')
Editar usuário
@stop

@section('content')

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulário de edição </h3>
                    <div class="form-group pull-right">
                        <a href="{{ url('admin/users') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>
                </div>
                <!-- form start -->
                <div class="box-body">
                    {!! Form::model($user, [
                        'method' => 'PATCH',
                        'url' => ['admin/users', $user->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'E-mail: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                        {!! Form::label('phone', 'Telefone: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('area') ? 'has-error' : ''}}">
                        {!! Form::label('area', 'Area: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('area', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('group_access', 'Grupo de acesso: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            <select class="form-control select2"
                                    multiple="multiple"
                                    name="group_access[]"
                                    data-placeholder="Selecione os grupos de acesso para esse usuário">
                                    @foreach($groupAccess as $value)
                                    <option value="{{$value->id}}">{{ $value->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('module', 'Módulo: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            <select class="form-control select2"
                                    multiple="multiple"
                                    name="module[]"
                                    data-placeholder="Selecione os módulos para esse usuário">
                                    @foreach($module as $value)
                                    <option value="{{$value->id}}">{{ $value->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('permission', 'Permissão: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            <select class="form-control select2"
                                    multiple="multiple"
                                    name="permission[]"
                                    data-placeholder="Selecione as permissões para esse usuário">
                                    @foreach($permission as $value)
                                    <option value="{{$value->id}}">{{ $value->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Atualizar registro', ['class' => 'btn btn-primary form-control']) !!}
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
                <!-- form end -->
            </div>
            <!-- /.box -->
        </div>
    </div>
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
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $value)
                            <tr>
                                <td><a href="{{ url('admin/permission', $value->permission_id) }}">{{ $value->permission }}</a></td>
                                <td><a href="{{ url('admin/application', $value->app_id) }}"> {{ $value->application }}</a> </td>
                                <td>
                                    <a href="{{ url('admin/users/delete/userPermission/' . $value->users_id . '/' . $value->permission_id ) }}" class="remove btn btn-danger btn-sm">
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