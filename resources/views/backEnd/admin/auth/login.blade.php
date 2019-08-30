@extends('backLayout.login')
@section('content')
<div class="login-logo">
    <img src="{{ asset('assets/img/logo_seduc.png') }}">
</div>
<!-- /.login-logo -->
<div class="login-container">
    <p class="login-box-msg">Controle de acesso Seduc</p>
    <div id="resultado"></div>
    {!! Form::open(['url' => 'admin/autentica', 'id' => 'form']) !!}
    <div class="form-group has-feedback">
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuário">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="senha" id="password" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
                <i class="fa fa-sign-in"></i> Entrar
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<style>
    body {
        background-color: #333;
        background-image: url('{{ asset("assets/img/bg_security.jpg") }}');
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }
    .login-container {
        background: #ececec8c;
        padding: 20px; 
    }
</style>
@endsection