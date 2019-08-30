@extends('backLayout.app')
@section('title')
Criar novo Logging
@stop

@section('content')

    <h1>Adicionar Logging</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/logging', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('ip') ? 'has-error' : ''}}">
                {!! Form::label('ip', 'Ip: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('ip', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ip', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('users_id') ? 'has-error' : ''}}">
                {!! Form::label('users_id', 'Users Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('users_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('users_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : ''}}">
                {!! Form::label('permission_id', 'Permission Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('permission_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('permission_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('created_at') ? 'has-error' : ''}}">
                {!! Form::label('created_at', 'Created At: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::input('datetime-local', 'created_at', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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

@endsection