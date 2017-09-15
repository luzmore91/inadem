var count_tr = 0;
var count_tr1 = 0;
var ParArreglo = [];
var RiesArreglo = [];
function obtenerDatosEquipo()
{
    var nombreMiembro = document.getElementById("nomPart").value;

    var comboGradoEstudio = document.getElementById("gradoEstP");
    var gradoEstudio = comboGradoEstudio.options[comboGradoEstudio.selectedIndex].text;

    var comboAreaConocimiento = document.getElementById("areaConocimiento");
    var areaConocimiento = comboAreaConocimiento.options[comboAreaConocimiento.selectedIndex].text;

    var correo = document.getElementById("correoPart").value;

    var telefonoMovil = document.getElementById("telPart").value;

    var comboInstitucion = document.getElementById("instPart");
    var institucion = comboInstitucion.options[comboInstitucion.selectedIndex].text;



    var nom = getNombreBien(nombreMiembro);

    ParArreglo.push({fk_institucion:parseInt(comboInstitucion.options[comboInstitucion.selectedIndex].value),
                     fk_idGradoEstudios:parseInt(comboGradoEstudio.options[comboGradoEstudio.selectedIndex].value),
                     fk_idAreaConocimientos:parseInt(comboAreaConocimiento.options[comboAreaConocimiento.selectedIndex].value),
                     //fk_direccion:NULL,
                     correoElectronico:correo,
                     nombre:nom[0],
                     apellidoPaterno:nom[1],
                     apellidoMaterno:nom[2],
                     numeroMovil:telefonoMovil,
                     //fechaNacimiento:'0000-00-00',
                     curp:'',
                     genero:0,
                     telefonoFijo:0,
                     numeroControl:'',
                     correoInstitucional:correo,
                     bajaLogica:1
                    });


  limpiarComponentesParticipate();
  enviarParticipante();


}

function getIDEliminar(validandoId){
     var numeroID = validandoId.split("_");
    console.log("id",numeroID);
         return numeroID;
}
function getNombreBien(nombre){
    var nombreC = nombre.split(" ");
    var nombresArray = new Array(2);
    console.log("numero de valores "+nombreC.length);

    //obtener apellidos
        nombresArray[2] = nombreC[nombreC.length-1];
            nombresArray[1] = nombreC[nombreC.length-2];

    //obtener nombres
    numeroNombres = nombreC.length-2;
      console.log(numeroNombres);

    switch(numeroNombres){
        case 1:
              nombresArray[0] =nombreC[nombreC.length-3];
            break;
        case 2:
              nombresArray[0] =nombreC[nombreC.length-4]+" "+nombreC[nombreC.length-3];
            break;

        case 3:
              nombresArray[0] =nombreC[nombreC.length-5]+" "+nombreC[nombreC.length-4]+" "+nombreC[nombreC.length-3];
            break;
                        }

     console.log(nombresArray);
     return nombresArray;

}
function obtenerDatosRiesgos()
{

    var comboTipoRiesgo = document.getElementById("tipoRiesgo");
    var tipoRiesgo = comboTipoRiesgo.options[comboTipoRiesgo.selectedIndex].text;

    var descripcion = document.getElementById("descRiesgo").value;

    var estrategiaMitigacion = document.getElementById("estMitigacion").value;



    var tbody = document.getElementById("contenidoTablaRiesgos");
    var tr = document.createElement('tr');
    count_tr1++;



    RiesArreglo.push({fk_idTipoRiesgo:parseInt(comboTipoRiesgo.options[comboTipoRiesgo.selectedIndex].value),
                      estrategiaMitigacion:estrategiaMitigacion ,
                      descripcion:descripcion,
                      bajaLogica:1});


    tr.id= "riesgo_" + count_tr1;

    var info="<td classs='' id='nombreRiesgo_"+ count_tr1+"' name='nombreRiesgo_"+ count_tr1 +"'>"+ tipoRiesgo+"</td>";

	info+="<td classs='' id='descripcionRiesgo_"+ count_tr1+"' name='descripcionRiesgo_"+ count_tr1+"'>"+descripcion+"</td>";
    info+="<td classs='' id='estrategiaMitigacion_"+ count_tr1+"' name='estrategiaMitigacion_"+ count_tr1+"'>"+ estrategiaMitigacion+"</td>";

	info += "<td classs='' id='botonRiesgo_"+ count_tr1 +"' name='botonRiesgo_"+  count_tr1 +"'>"
            +"<button type='submit' class='btn btn-red' onclick='eliminarRiesgo("+tr.id+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

  tr.innerHTML = info;
  tbody.appendChild(tr);
  limpiarComponentesRiesgo();
  enviarRiesgos();
}


function eliminarRegistroParticipante(objP)
{
     if(objP.eliminado = 1){
     $('#miembro_'+objP.idParticipante).remove();
     }
}

function eliminarRiesgo(idRegistroRiesgo)
{
    var registroEliminarRiesgo = idRegistroRiesgo.id;
    var campoEliminarRiesgo = document.getElementById(registroEliminarRiesgo);
    campoEliminarRiesgo.remove();

    console.log(idRegistroRiesgo);
    console.log(campoEliminarRiesgo);
  RiesArreglo.splice(getIDEliminar(registroEliminarRiesgo), 1);
}


function limpiarComponentesParticipate() {
    document.getElementById("nomPart").value="";
    document.getElementById("correoPart").value="";
    document.getElementById("telPart").value="";

}

function limpiarComponentesRiesgo() {
    document.getElementById("descRiesgo").value="";
    document.getElementById("estMitigacion").value="";

}


function enviarRiesgos(){

      console.log("entrar a la funcion enviar riesgos  "+JSON.stringify(ParArreglo));
   // var token = $("#token").val();
    $.ajax({
        url:'insertarRiesgo',
        type: 'POST',
        dataType: 'json',
        data:{riesgo:RiesArreglo},
        success: function(success) {
            console.log("Sent values "+success);

      },
error: function(response){
    console.log('Error'+JSON.stringify(response));
    }
    });
}

function enviarParticipante() {

    console.log("entrar a la funcion enviar participante "+JSON.stringify(ParArreglo));
   // var token = $("#token").val();
    $.ajax({
        url:'insertarParticipante',
        type: 'POST',
        dataType: 'json',
        data:{participante:ParArreglo},
        success: function(success) {
            console.log("Sent values "+JSON.stringify(success));
            //reiniciar el arreglo
            ParArreglo = [];
            crearTablaParticipante(success);

      },
error: function(response){
    console.log('Error'+JSON.stringify(response));
    }
    });
   event.preventDefault();
}


function crearTablaParticipante(tabla){

    var tbodyPart = document.getElementById("cuerpoTabla");
    var trPart = document.createElement('tr');


    jQuery.each(tabla, function(i,val) {
         trPart.id= "miembro_" + val.idParticipante;

    var infoPart = "<td classs='' id='nombreParticipante_"+val.idParticipante +"' name='nombreParticipante_"+ val.idParticipante +"'>"+ val.nombre+' '+val.apellidoPaterno+' '+val.apellidoMaterno+"</td>";

	infoPart += "<td classs='' id='gradoEstudioParticipante_"+val.idParticipante +"' name='gradoEstudioParticipante_"+ val.idParticipante +"'>"+val.nivel+"</td>";

    infoPart += "<td classs='' id='areaConocimientoParticipante_"+ val.idParticipante +"' name='areaConocimientoParticipante_"+ val.idParticipante +"'>"+val.descripcion+"</td>";

    infoPart += "<td classs='' id='correoParticipante_"+val.idParticipante+"' name='correoParticipante_"+val.idParticipante+"'>"+val.correoElectronico+"&nbsp&nbsp"+"</td>";

    infoPart += "<td classs='' id='telefonoMovilParticipante_"+ val.idParticipante +"' name='telefonoMovilParticipante_"+ val.idParticipante+"'>"+ val.numeroMovil+"</td>";

    infoPart += "<td classs='' id='institucionParticipante_"+ val.idParticipante+"' name='institucionParticipante_"+ val.idParticipante +"'>"+ val.nombreInstitucion+"</td>";

	infoPart += "<td classs='' id='botonParticipante_"+ val.idParticipante +"' name='botonParticipante_"+ val.idParticipante +"'>"
            +"<button type='submit' class='btn btn-red' onclick='eliminarParticipante("+val.idParticipante+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

          trPart.innerHTML = infoPart;
  tbodyPart.appendChild(trPart);
     });

}

function eliminarParticipante(idP){
 console.log("vamos a eliminar a "+idP);
    $.ajax({
        url:'eliminarParticipante',
        type: 'POST',
        dataType: 'json',
        data:{idParticipante:parseInt(idP)},
        success: function(success) {
            console.log("Retorno  "+success);
            eliminarRegistroParticipante(success);


      },
error: function(response){
    console.log('Error Ajax');
    }
    });
}

