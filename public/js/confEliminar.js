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


    //enviar a un metodo del controlador para almacenar en la BD

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
