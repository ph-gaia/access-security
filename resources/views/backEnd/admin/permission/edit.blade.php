@extends('backLayout.default')
@section('title')
Edit Permission
@stop

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Formulário de edição de Permissões </h3>
                    </div>
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                        {!! Form::model($permission, [
                            'method' => 'PATCH',
                            'url' => ['admin/permission', $permission->id],
                            'class' => 'form-horizontal'
                        ]) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('uri') ? 'has-error' : ''}}">
                            {!! Form::label('uri', 'Uri: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('uri', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('uri', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('application_id') ? 'has-error' : ''}}">
                            {!! Form::label('application_id', 'Aplicação: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                <select class="form-control"
                                        name="application_id">
                                        @foreach($application as $value)
                                        @if ($permission->application_id == $value->id)
                                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endif
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
                    </div>
                    <!-- form end -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection