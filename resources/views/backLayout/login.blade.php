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

    <body>
        <div class="login-box">

            @yield('content')

        </div>

        @include('backLayout.Common.scripts')

    </body>

</html>