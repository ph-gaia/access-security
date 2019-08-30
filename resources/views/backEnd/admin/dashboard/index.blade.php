@extends('backLayout.default')
@section('title')
Dashboard
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <!-- Application buttons -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Aplicações disponíveis</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        @foreach ($apps as $item)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3>{{ $item->name }}</h3>
                                    <p>
                                        <a href="{{ $item->url_base }}" class="btn btn-primary" role="button" target="__blank">Acessar</a>                                
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->

@endsection