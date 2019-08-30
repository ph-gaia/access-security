<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Montreal">
        <title> @yield('title') </title>
        @include('backLayout.Common.styles')

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="Dashboard" class="logo">
                    <span class="logo-mini"><b>Access Security</b></span>

                    <span class="logo-lg"><b>Access Security</b></span>
                </a>

                @include('backLayout.Partials.menu_horizontal_top')
            </header>

            @include('backLayout.Partials.menu_vertical')

            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('backLayout.Partials.footer')

        </div>

        @include('backLayout.Common.scripts')
        @yield('scripts')
    </body>

</html>