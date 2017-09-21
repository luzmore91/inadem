//Ventana de confirmacion para elimnar un proyecto.

	function eliminarProyecto()
{
    var txt;
    if (confirm("Eliminar proyecto?") == true) {
        txt = "Precione OK!";
        alert(txt);
    } else {
        //Si el proyecto no se elimina se procede a realizar nada.
    }
    document.getElementById("demo").innerHTML = txt;
}
