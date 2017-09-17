var count_tr = 0;
var count_tr1 = 0;
var ParArreglo = [];
var RiesArreglo = [];
var banderaTablaParticipate = false;
var banderaTablaRiesgos = false;
var idEquipo = numeroEquipo();

function numeroEquipo()
{
  var caracteres = "1243";
  var contraseña = "";
  for (i=0; i<5; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  return contraseña;
}

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

    
    var bandera=validaParticipantes(nombreMiembro, comboGradoEstudio.value, comboAreaConocimiento.value, correo, telefonoMovil, comboInstitucion.value);
    
    
    var tbodyPart = document.getElementById("cuerpoTabla");
    var trPart = document.createElement('tr');
    count_tr++;

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
  banderaTablaParticipate = true;
    
  if(banderaTablaParticipate){
      console.log("Si entra a quitar atributo");
        quitarAtributoParticipantes();
  }
 if(bandera)    
 enviarParticipante();

}


function getNombreBien(nombre){
    var nombreC = nombre.split(" ");
    var nombresArray = new Array(2);
    //console.log("numero de valores "+nombreC.length);

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
    
    var insertarRiesgos =  validaRiesgos(comboTipoRiesgo.value, descripcion, estrategiaMitigacion);
    
    console.log("obtenerDatosRiesgos "+insertarRiesgos);

    RiesArreglo.push({fk_idTipoRiesgo:parseInt(comboTipoRiesgo.options[comboTipoRiesgo.selectedIndex].value),
                      estrategiaMitigacion:estrategiaMitigacion,
                      descripcionRiesgo:descripcion,
                      bajaLogica:1});


  
  limpiarComponentesRiesgo();
  banderaTablaRiesgos = true;

  if(banderaTablaRiesgos){
      console.log("Si entra a quitar atributo");
        quitarAtributoRiesgos();
  }
    if(insertarRiesgos)
      enviarRiesgos();
}


function eliminarRegistroParticipante(objP)
{
     if(objP.eliminado = 1){
     $('#miembro_'+objP.idParticipante).remove();
     }
}

function eliminarRegistroRiesgo(objR)
{
     if(objR.eliminado = 1){
     $('#riesgo_'+objR.idRiesgo).remove();
     }
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

      console.log("entrar a la funcion enviar riesgos  "+JSON.stringify(RiesArreglo));
   // var token = $("#token").val();
    $.ajax({
        url:'insertarRiesgo',
        type: 'POST',
        dataType: 'json',
        data:{riesgo:RiesArreglo},
        success: function(success) {
            console.log("Sent values "+success);
            RiesArreglo = [];
            crearTablaRiesgos(success);

      },
error: function(response){
    console.log('Error'+JSON.stringify(response));
     RiesArreglo = [];
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
        data:{participante:ParArreglo,equipo:parseInt(idEquipo)},
        success: function(success) {
            console.log("Sent values "+JSON.stringify(success));
            //reiniciar el arreglo
            ParArreglo = [];
            crearTablaParticipante(success);

      },
error: function(response){
    console.log('Error'+JSON.stringify(response));
     ParArreglo = [];
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
            +"<button type='button' class='btn btn-red' onclick='eliminarParticipante("+val.idParticipante+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

          trPart.innerHTML = infoPart;
  tbodyPart.appendChild(trPart);
     });

}

function crearTablaRiesgos(tabla){

    var tbody = document.getElementById("contenidoTablaRiesgos");
    var tr = document.createElement('tr');

    jQuery.each(tabla, function(i,val) {
      tr.id= "riesgo_" +val.idRiesgo;

    var info="<td classs='' id='nombreRiesgo_"+ val.idRiesgo+"' name='nombreRiesgo_"+val.idRiesgo +"'>"+ val.descripcion+"</td>";

	info+="<td classs='' id='descripcionRiesgo_"+ val.idRiesgo+"' name='descripcionRiesgo_"+ val.idRiesgo+"'>"+val.descripcionRiesgo+"</td>";
    info+="<td classs='' id='estrategiaMitigacion_"+ val.idRiesgo+"' name='estrategiaMitigacion_"+ val.idRiesgo+"'>"+ val.estrategiaMitigacion+"</td>";

	info += "<td classs='' id='botonRiesgo_"+val.idRiesgo +"' name='botonRiesgo_"+ val.idRiesgo +"'>"
            +"<button type='button' class='btn btn-red' onclick='eliminarRiesgo("+val.idRiesgo+")'>"
            +"<span class='glyphicon glyphicon-remove'></span>"
            +"</button></td>";

  tr.innerHTML = info;
  tbody.appendChild(tr);

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

function eliminarRiesgo(idR){
    console.log("id del riesgo ",idR);
   $.ajax({
        url:'eliminarRiesgo',
        type: 'POST',
        dataType: 'json',
        data:{idRiesgo:idR},
        success: function(success) {
            console.log("Retorno  "+success);
              eliminarRegistroRiesgo(success);

      },
error: function(response){
    console.log('Error Ajax');
    }
    });

}

function quitarAtributoParticipantes() { 
    
    document.getElementById("nomPart").removeAttribute("required"); 
    document.getElementById("gradoEstP").removeAttribute("required"); 
    document.getElementById("areaConocimiento").removeAttribute("required"); 
    document.getElementById("correoPart").removeAttribute("required"); 
    document.getElementById("telPart").removeAttribute("required"); 
    document.getElementById("instPart").removeAttribute("required"); 
}

function quitarAtributoRiesgos() { 
    document.getElementById("tipoRiesgo").removeAttribute("required"); 
    document.getElementById("descRiesgo").removeAttribute("required"); 
    document.getElementById("estMitigacion").removeAttribute("required"); 
}

function validaParticipantes(nombre, gradoEstudios, areaConocimiento, correo, noCelular, institucion) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var validaPartci = true;
    
    
    //console.log(nombre+" "+gradoEstudios+" "+areaConocimiento+" "+correo+" "+noCelular+" "+institucion);
    
    if(gradoEstudios<0 || areaConocimiento<0 || institucion<0){
        validaPartci=false;
        //console.log("Entro al if....");
        divTexto.innerHTML = "¡Seleccione una opción valida!";
        modal.style.display='block';
    }
    
    if(nombre == null || nombre.length == 0 || correo == null || correo.length == 0|| noCelular == null || noCelular.length==0){
      validaPartci=false;    
      divTexto.innerHTML = "¡Verifique la información ingresada!";
      modal.style.display='block';
    }
    
    return validaPartci;
}

function validaRiesgos(tipoRiesgo, descripcion, estrategiaMitigacion) 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    var validaRiesgo = true;
    
    
    //console.log(tipoRiesgo+" "+descripcion+" "+estrategiaMitigacion);
    
    if(tipoRiesgo<0){
        //console.log("selects " + validaRiesgo);
        
        validaRiesgo=false;
        divTexto.innerHTML = "¡Seleccione una opción valida!";
        modal.style.display='block';
    }
    
    
    if(descripcion == null || descripcion.length == 0 || estrategiaMitigacion == null || estrategiaMitigacion.length == 0 ){
    //console.log("inputs " + validaRiesgo);

      validaRiesgo=false;    
      divTexto.innerHTML = "¡Verifique la información ingresada!";
      modal.style.display='block';
    }
    
    console.log(validaRiesgo);
    return validaRiesgo;
}

function validaSelects() 
{ 
    var modal = document.getElementById("myModal");
    var divTexto = document.getElementById("setTexto");
    
    var institucion = document.getElementById("institucion").value;
    var tipoInvension = document.getElementById("tipoInvension").value;
    
    var trl = document.getElementById("madurezProy").value;
    var sectorEstrategico = document.getElementById("sectorEst").value;
    var estadoActual = document.getElementById("estadoAct").value;
    var tipoProteccion = document.getElementById("tipoProt").value;
    var objetivoProyeecto = document.getElementById("perProy").value;

    console.log(institucion+" "+tipoInvension+" "+trl+" "+sectorEstrategico+" "+estadoActual+" "+tipoProteccion+" "+objetivoProyeecto);
    
    if(institucion<0 || tipoInvension<0 || trl<0 || sectorEstrategico<0 || estadoActual<0 || tipoProteccion<0 || objetivoProyeecto<0){
        console.log("Entra al if ");
        
        divTexto.innerHTML = "¡Seleccione una opción valida!";
        modal.style.display='block';
    }
    
}


function cerrarModal(){
        var modal = document.getElementById("myModal");
        modal.style.display='none';
}


