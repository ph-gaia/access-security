@extends('backLayout.default')
@section('title')
Criar novo Usuário
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulário de Cadastro </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        {!! Form::open(['url' => 'admin/users', 'class' => 'form-horizontal']) !!}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required','placeholder' => "Informe o nome do usuário responsável"]) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email', 'E-mail: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required','placeholder' => "Informe o e-mail do usuário responsável"]) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                            {!! Form::label('phone', 'Telefone: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('phone', null, ['class' => 'form-control','placeholder' => "Informe o telefone do usuário responsável"]) !!}
                                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('area') ? 'has-error' : ''}}">
                            {!! Form::label('area', 'Area: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('area', null, ['class' => 'form-control', 'placeholder' => "Informe a area do usuário responsável"]) !!}
                                {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                            {!! Form::label('username', 'Usuário: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('username', null, ['class' => 'form-control','placeholder' => "Informe o usuário"]) !!}
                                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            {!! Form::label('password', 'Senha: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Informe a senha" name="password" type="password" id="password">
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-3">
                                {!! Form::submit('Registrar', ['class' => 'btn btn-primary form-control']) !!}
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
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection