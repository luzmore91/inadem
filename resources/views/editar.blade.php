<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>convocatoria INADEM</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/format.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/ie.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css">
</head>
        <div class="container">
            @include('header')
        </div>

<body>
<h1 align="center">Editar Proyecto</h1>
    <!-- Aquí se manda a llamar el el .blade.php en donde se tienen que cargar el query de los proyectos para
    poder actualizarlos en caso de ser necesario. -->
        <div class="container">
            @include('modificar')
        </div>


    <div align="center">
        <input class="btn btn-primary" type="submit" value="ACTUALIZAR">
        <button type="button" class="btn btn-secondary">VOLVER</button>
        <br>
        <br>
    </div>

        <div class="container">
            @include('footer')
        </div>
</body>
</html>
