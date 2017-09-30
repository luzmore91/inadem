//Ventana de confirmacion para elimnar un proyecto.

	function eliminarProyecto()
{
  /*  var txt;
    if (confirm("Eliminar proyecto?") == true) {
        txt = "Precione OK!";
        alert(txt);
    } else {
        //Si el proyecto no se elimina se procede a realizar nada.
    }
    document.getElementById("demo").innerHTML = txt;
    */

  //  $("#ModalDeleteConf").modal('show');
}

function guardarCambios(){

     //obtener los valores de cada elemento HTML , como input , select y textarea
     var proyecto = [];
     //obtener los valores de tecnologia proyecto
     proyecto.titulo = $("#tituloProy").val();
     proyecto.tituloComercial = $("#tituloComercial").val();
     proyecto.problematica = $("#problematica").val();
     proyecto.descripcion = $("#descripcion").val();
     proyecto.idInstitucion = parseInt($("#institucion").val());
     proyecto.idTipoInvencion = parseInt($("#tipoInvencion").val());

    //obtener valores de participantes
    var participantes = [];
    $('#datosEmprendedor tr').each(function() {
     participantes.idGradoEstudios = parseInt($("#gradoestudios").val());
     participantes.idAreaConocimiento =parseInt($("#areaCon").val());
     participantes.correo =$("#correo").val();
     participantes.numeroMovil =$("#numeroMovil").val();
     participantes.idInstitucion = parseInt($("#institucion").val());
    });

    proyecto.participantes = participantes;
    //obtener los valores de descripcion del proyecto

    proyecto.TRL = parseInt($("#trl").val());
    proyecto.sector = parseInt($("#sector").val());
    proyecto.propiedadIntelectual = parseInt($("#propiedadInt").val());
    proyecto.objetivoProyecto =  parseInt($("#objProy").val());
    proyecto.tipoProteccion =  parseInt($("#tipoProteccion").val());

    //obtener los valores de datos analisis

    proyecto.usoAplicacion = $("#usoAplicacion").val();
    proyecto.viabilidad = $("#viabilidad").val();
    proyecto.beneficios = $("#beneficios").val();

    //obtener colaboracion con otras IES
    proyecto.colaboracionIES = $("#desIES").val();

    //obtener valores de Riesgos

     var riesgos = [];
    $('#datosRiesgos tr').each(function() {
     riesgos.idTipoRiegos = parseInt($("#tipoRiesgo").val());
     riesgos.descripcionRiesgo = parseInt($("#descripcionRiesgo").val());
     riesgos.estrategiaMitigacion = parseInt($("#estrategiaMitigacion").val());
    });

    proyecto.riesgos = riesgos;

    ///obtener valor de analisis del entorno

    proyecto.analisisEntorno = $("#analisisEntorno").val();

    //obtener valores de recursos
    proyecto.recursosHumanos = $("#recursosHumanos").val();
    proyecto.recursosFinancieros = $("#recursosFinancieros").val();
    proyecto.recursosTecnologicos = $("#recursosTecnologicos").val();

    //enviar a un metodo del controlador para almacenar en la BD
     console.log("valor del arreglo a enviar ::::::::: ",proyecto);
     $.ajax({
        url:'actualizarProyecto',
        type: 'POST',
        dataType: 'json',
        data:{proyecto:proyecto},  //envio del objeto que tendra guardado todos los valores del proyecto editado
        success: function(success) {
            console.log("Retorno  "+success);
            $("#ModalProyActualizado").modal("show");
        },
         error: function(response){
          $("#ModalProyNoActualizado").modal("show");
        }
        } );




}
