<!DOCTYPE html>
<html>


    <head>
         <title>Convocatoria INADEM</title>
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet" type="text/css">
         <link href="{{ asset('/css/format.css') }}" rel="stylesheet" type="text/css">
         <link href="{{ asset('/css/ie.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css">

        <!--link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css"-->
        <link href="{{ asset('/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/datatable/jquery.js') }}"></script>

        <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{asset('/js/bootstrap.js')}}"></script>

        <!-- datatable español -->
        <script src="{{ asset('/json/Spanish.json') }}"></script>

        <!-- Confirmacion de eliminacion de registros -->
        <script type="text/javascript" src="{{ URL::asset('js/confEliminar.js') }}"></script>

    </head>
        <div class="container">
            @include('header')
        </div>
    <body>

        <div class="container">

            <table id="users" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Institución</th>
                        <th>Tipo Invencion</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{ $proyecto->titulo }}</td>
                        <td>{{ $proyecto->nombreInstitucion }}</td>
                        <td>{{ $proyecto->descripcion }}</td>
                        <td center="center">

                        {{ Form::open(array('action' => array('InademController@editar', $proyecto->idTecnologiaProyecto), 'method' => 'get')) }}
                            {{ Form::submit('Editar', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                            </td>
                        <td center="center">
                        <a href="#" onclick="eliminarProyecto()">
                        {{ Form::open(array('action' => array('AdminController@eliminar', $proyecto->idTecnologiaProyecto))) }}
                            {{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </a>

                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal HTML Markup -->
<div id="ModalEliminadoConf" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Registro Eliminado</h1>
            </div>
            <div class="modal-body">
               Se ha eliminado con exito el registro seleccionado.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="ModalDeleteConf" class="modal fade">
    <div class="modal-dialog" role="alertdialog" style="left:0%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Eliminar registro</h1>
            </div>
            <div class="modal-body">
               Por el momento no se ha podido eliminar el registro seleccionado, intente de nuevo por favor.
            </div>
             <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@if(!empty(Session::get('delete_code')) && Session::get('delete_code') == 5)
<script>
           $('#ModalEliminadoConf').modal('show');
</script>
@endif
@if(!empty(Session::get('nodelete_code')) && Session::get('nodelete_code') == 5)
<script>
           $('#ModalDeleteConf').modal('show');
</script>
@endif
             <script type="text/javascript">

            $(document).ready(function() {
                oTable = $('#users').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },
                    //Obtener datos para llenar la tabla

                });

            });

        </script>

            <div class="container">
            @include('excel')
        </div>

    </body>
            <div class="container">
            @include('footer')
        </div>




</html>
