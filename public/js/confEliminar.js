$(document).ready(function(){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
});

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
     var proyecto = {};
     //obtener los valores de tecnologia proyecto
     proyecto.idProyecto = $("#idProyecto").text();
     proyecto.titulo = $("#tituloProy").val();
     proyecto.tituloComercial = $("#tituloComercial").val();
     proyecto.problematica = $("#problematica").val();
     proyecto.descripcion = $("#descripcion").val();
     proyecto.idInstitucion = parseInt($("#institucion").val());
     proyecto.idTipoInvencion = parseInt($("#tipoInvencion").val());

    //obtener valores de participantes
    var participantes = [];
    $('#datosEmprendedor tr.item').each(function() {
        $actual = $(this);
        var participante = {};
        participante.nombre = $actual.find("#nombrePart").val()
        participante.idGradoEstudios = parseInt($actual.find("#gradoestudios").val());
        participante.idAreaConocimiento =parseInt($actual.find("#areaCon").val());
        participante.correo =$actual.find("#correo").val();
        participante.numeroMovil = $actual.find("#numeroMovil").val();
        participante.idInstitucion = parseInt($actual.find("#institucion").val());
        participantes.push(participante);
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
    $('#datosRiesgos tr.item').each(function() {
        $actual = $(this);
        var riesgo = {};
        riesgo.idTipoRiesgo = parseInt($actual.find("#tipoRiesgo").val());
        riesgo.descripcionRiesgo = $actual.find("#descripcionRiesgo").val();
        riesgo.estrategiaMitigacion = $actual.find("#estrategiaMitigacion").val();
        riesgos.push(riesgo);
    });

    proyecto.riesgos = riesgos;

    ///obtener valor de analisis del entorno

    proyecto.analisisEntorno = $("#analisisEntorno").val();

    //obtener valores de recursos
    proyecto.recursosHumanos = $("#recursosHumanos").val();
    proyecto.recursosFinancieros = $("#recursosFinancieros").val();
    proyecto.recursosTecnologicos = $("#recursosTecnologicos").val();
    var proyectoJson = JSON.stringify(proyecto);
    //console.log("valor del arreglo a enviar ::::::::: ",proyectoJson);
    //enviar a un metodo del controlador para almacenar en la BD
     $.ajax({
        url:'actualizarProyecto',
        type: 'POST',
        dataType: 'json',
        data:{proyecto:proyectoJson},  //envio del objeto que tendra guardado todos los valores del proyecto editado
        success: function(success) {
            console.log("Retorno: " + success);
            $("#ModalProyActualizado").modal("show");
        },
         error: function(response){
            console.log("Retorno: " + response);
          $("#ModalProyNoActualizado").modal("show");
        }
        } );




}
