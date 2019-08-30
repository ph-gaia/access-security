@extends('backLayout.default')
@section('title')
Criar novo módulo
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulário de Cadastro </h3>
                    <div class="form-group pull-right">
                        <a href="{{ url('admin/module') }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Voltar</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        {!! Form::open(['url' => 'admin/module', 'class' => 'form-horizontal']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'Nome: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Informe o nome do módulo, exemplo: Controle de Processo']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('initials') ? 'has-error' : ''}}">
                            {!! Form::label('initials', 'Sigla: ', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-6">
                                {!! Form::text('initials', null, ['class' => 'form-control', 'placeholder' => 'Informe a sigla do módulo, exemplo:CPR ']) !!}
                                {!! $errors->first('initials', '<p class="help-block">:message</p>') !!}
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
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                            {!! Form::label('status', 'Status: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>{!! Form::radio('status', '1') !!} Ativo</label>
                            </div>
                            <div class="checkbox">
                                <label>{!! Form::radio('status', '0', true) !!} Inativo</label>
                                </div>
                                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                                </div>
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