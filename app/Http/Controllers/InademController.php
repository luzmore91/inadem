<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Tecnologia;
use App\Institucion;
use App\Proyecto;
use App\PropiedadIntelectual;
use App\AnalisisEntorno;
use App\ObjetivoProyecto;
use App\Colaboracion;
use App\EquipoEmprendedor;
use App\Participante;
use App\Riesgos;
use App\TokenIna;
use Log;



class InademController extends Controller
{

    public function tokenInademApp(Request $request){
        if($request->ajax()){
          $dato =$request->llave;
          $llavecita = new TokenIna;
          $llavecita->llave=$dato;
          $llavecita->save();

            return response()->json('almacenado');
        }

    }

    public function insertarParticipante(Request $request){


     //modelo de la tabla Participante
  if($request->ajax()){

    $dato =$request->participante; // This will get all the request data.
    $dato2 =$request->equipo;

            $participante = new Participante;
            $equipo = new EquipoEmprendedor;

         //consulta a la tabla tecnologiaProyecto, el ultimo ID integrado
       $idTec = DB::select('select idToken from tokeninadem ORDER BY idToken DESC LIMIT 1 ');
       $result = json_decode(json_encode($idTec), true);


       foreach($dato as $d){
               $participante->fk_idInstitucion = $d["fk_institucion"];//$request->input('fk_institucion');
               $participante->fk_idGradoEstudios = $d['fk_idGradoEstudios'];
               $participante->fk_idAreaConocimientos = $d['fk_idAreaConocimientos'];
               //$participante->fk_idDireccion = $d['fk_idDireccion'];
               $participante->correoElectronico =$d['correoElectronico'];
               $participante->nombre = $d['nombre'];
               $participante->apellidoPaterno = $d['apellidoPaterno'];
               $participante->apellidoMaterno = $d['apellidoMaterno'];
               $participante->numeroMovil = $d['numeroMovil'];
               //$participante->fechaNacimiento = $d['fechaNacimiento'];
               $participante->curp = $d['curp'];
               $participante->genero = $d['genero'];
               $participante->telefonoFijo = $d['telefonoFijo'];
               $participante->numeroControl =$d['numeroControl'];
               $participante->correoInstitucional = $d['correoInstitucional'];
               $participante->bajaLogica = $d['bajaLogica'];
              // $participante->fk_idTecnologiaProyecto = $idTec;
          // $participante->fk_idTokenAppIn = $result;


       }
      foreach($result as $i){
         $participante->fk_idTokenAppIn = $i['idToken'];

          $idT = $i['idToken'];
      }

         $saved = $participante->save();
        if($saved){
            
            //ingresar al equipo emprendedor
             //Tabla equipo emprendedor
        $EquipoQuery = DB::select('select idParticipante from participante WHERE participante.fk_idTokenAppIn='.$idT);
    
       $resultEquipo = json_decode(json_encode($EquipoQuery), true);
       foreach($resultEquipo as $i){
         $equipo->fk_participante = $i['idParticipante'];
         $equipo->bajaLogica =1;
         $equipo->numeroEquipo = $dato2;
       }
       $savedEq = $equipo->save();
       if($savedEq){
            //consultar los valores insertados.
            $participanteQuery = DB::select('select participante.idParticipante,participante.nombre,participante.apellidoPaterno,participante.apellidoMaterno,participante.correoElectronico,participante.numeroMovil,
tipogradoestudios.nivel,areaconocimiento.descripcion,institucion.nombreInstitucion from participante INNER JOIN tipogradoestudios
ON participante.fk_idGradoEstudios=tipogradoestudios.idGradoEstudios
INNER JOIN institucion
 ON institucion.idInstitucion=participante.fk_idInstitucion
INNER JOIN areaconocimiento
ON areaconocimiento.idAreaConocimiento=participante.fk_idAreaConocimientos
WHERE
participante.fk_idTokenAppIn  = '.$idT);
            $insertados = $participanteQuery;
       }else{
           $insertados = 0;
       }
  }else {
    // Whooops
        $insertados = 0;
            }
         return response()->json($insertados);

     }

    }
    public function insertarRiesgo(Request $request){
          //modelo de la tabla Riesgo

  if($request->ajax()){
     $dato = $request->riesgo;

           $riesgo = new Riesgos;
           $token = DB::select('select idToken from tokeninadem ORDER BY idToken DESC LIMIT 1 ');
           $result = json_decode(json_encode($token), true);
      foreach($dato as $d){

               $riesgo->fk_idTipoRiesgo = $d["fk_idTipoRiesgo"];//$request->input('fk_institucion');
               $riesgo->estrategiaMitigacion = $d['estrategiaMitigacion'];
               $riesgo->descripcionRiesgo = $d['descripcionRiesgo'];
               $riesgo->bajaLogica=$d['bajaLogica'];


      }
       foreach($result as $i){
         $riesgo->fk_idTokenAppIn = $i['idToken'];

          $idT = $i['idToken'];
      }

       $saved = $riesgo->save();

    if($saved){
    //consultar los valores insertados
      $insertados = DB::select('select riesgo.idRiesgo,riesgo.descripcionRiesgo, riesgo.estrategiaMitigacion,tiporiesgo.descripcion from riesgo INNER JOIN tiporiesgo on tiporiesgo.idTipoRiesgo = riesgo.fk_idTipoRiesgo INNER JOIN tokeninadem ON riesgo.fk_idTokenAppIn = tokeninadem.idToken where riesgo.fk_idTokenAppIn ='.$idT);

         }
    else {
    // Whooops
        $insertados = 0;
            }
         return response()->json($insertados);
    }

    }
    public function eliminarParticipante(Request $request){
    if($request->ajax()){
    $dato =$request->idParticipante;

    $saved = DB::select("DELETE FROM participante WHERE idParticipante = ".$dato);

    if($saved){
        $envio = 1;
        //eliminar participante del equipo
         $actualizarRiesgos = DB::select('DELETE FROM equipoemprendedor WHERE fk_idParticipante = '.$dato);

    }else{
        $envio = 0;
    }
    return response()->json(['eliminado'=>$envio,'idParticipante'=>$dato]);
}
    }
    public function eliminarRiesgo(Request $request){
       if($request->ajax()){
    $dato =$request->idRiesgo;

    $saved = DB::select("DELETE FROM riesgo WHERE idRiesgo = ".$dato);

    if($saved){
        $envio = 1;
    }else{
        $envio = 0;
    }
    return response()->json(['eliminado'=>$envio,'idRiesgo'=>$dato]);
}
    }

    ///desplegar vista desde el controlador 
    public function ver()
    { /// Consulta los catalogos de la BD 

        
      ///////////PARTE 0///////////
        //--- catalogo Institucion---//
        $institucion = DB::select('select * from institucion');
        //--- catalogo TipoInvencion---//
        $inv = DB::select('select * from tipoinvencion');

       ///////////PARTE 1///////////
        //--- catalogo gradoEstudios---//
        $gradoEstudios = DB::select('select * from tipogradoestudios');
        //--- catalogo areaConocimiento---//
        $areaConocimiento = DB::select('select * from areaconocimiento');
        
          ///////////PARTE 2 y 3///////////
        //--- catalogo TRL---//
        $TRL = DB::select('select * from trl');
        //--- catalogo Sector---//
        $sector = DB::select('select * from tiposector');
        
         ///////////PARTE 4 y 5///////////
        //--- catalogo propiedad intelectual---//
        $propInt = DB::select('select * from tipopropiedadintelectual');
        //--- catalogo propiedad intelectual 2 pendiente ---//
         $prot = DB::select('select * from tipoproteccion');
        
         ///////////PARTE 6///////////
        //--- catalogo objetivo proyecto ---//
        $objProy = DB::select('select * from tipoobjetivoproyecto');
        
        
          
         ///////////PARTE 7///////////
        //--- catalogo riesgos---//
        $riesgos = DB::select('select * from tiporiesgo');
        
    
        
        //mostrar vista y catalogos 
        return view('index',['institucion' => $institucion,'inv' => $inv,"gradoEstudios" => $gradoEstudios,"areaConocimiento" => $areaConocimiento,"TRL" => $TRL,"sector" => $sector,"propInt" =>  $propInt,"objProy" => $objProy,"prot" =>  $prot,"riesgos" => $riesgos]);
    }

    //validando formularios en laravel
 public function insertar(Request $request)
 {
     //recuperar valores escritos en los campos
    //Objetos para los inserts
     $tecnologia = new Tecnologia;
     $proyecto = new Proyecto;
     $propInt = new PropiedadIntelectual;
     $anEnt = new AnalisisEntorno;
     $objP= new ObjetivoProyecto;
     $col = new Colaboracion;



     /*TOKEN DE LA SESION DEL FORMULARIO */
     $token = DB::select('select idToken from tokeninadem ORDER BY idToken DESC LIMIT 1 ');
     $result = json_decode(json_encode($token), true);
      foreach($result as $i){
          $idToken = $i['idToken'];
      }
    
          
    /* Tabla tecnologia  */
    $tecnologia->titulo = Input::get('titulo');
    $tecnologia->tituloComercial = Input::get('tituloComercial');
    $tecnologia->problematica = Input::get('problematica');
    $tecnologia->descripcion =  Input::get('descripcion');
    //llave foranea
    $tecnologia->fk_idInstitucion = Input::get('instEq');
    $tecnologia->fk_idTipoInvencion = Input::get('tipoInv');
    $tecnologia->fk_idSector = Input::get("sectorEst");
    $tecnologia->bajaLogica = 1;


     //Tabla propiedad intelectual
      $propInt->fk_idTipoRegistro =  Input::get("estadoAct");
      $propInt->fk_idTipoProteccion = Input::get("tipoProt");
      $propInt->numeroRegistro = Input::get("numeroRegistro");
      $propInt->bajaLogica =1;

     //Tabla analisisEntorno
     $anEnt->descripcionAnalisisEntorno=Input::get('analisisEnt');
     $anEnt->usoAplicacion=Input::get('usoApp');
     $anEnt->viabilidad=Input::get('viabilidad');
     $anEnt->beneficios=Input::get('beneficios');
     $anEnt->bajaLogica=1;
     $anEnt->recursosHumanos=Input::get('recursosHumanos');
     $anEnt->recursosTecnologicos=Input::get('recursosTec');
     $anEnt->recursosFinancieros=Input::get('recursosFin');

     //Tabla objetivoProyecto
     $objP->fk_idTipoObjetivoProyecto=Input::get('perProy');
     $objP->otraDescripcion=Input::get('otro_ObjetivoProyecto');
     $objP->bajaLogica=1;



    //Tabla colaboracion
     //obtener el id del ultimo equipo emprendedor que se registro
     $fkEquipoQuery = DB::select('select idEquipoEmprendedor from equipoemprendedor ORDER BY idEquipoEmprendedor DESC LIMIT 1 ');
     $resultIdEq = json_decode(json_encode($fkEquipoQuery), true);
      
     //obtener la primera escuela registrada de los participantes del equipo emprendedor
     $fkEqInstQuery = DB::select('SELECT participante.fk_idInstitucion FROM `participante` WHERE participante.fk_idTokenAppIn ='.$idToken.' ORDER BY  participante.fk_idInstitucion desc limit 1');
     $resultInP = json_decode(json_encode($fkEqInstQuery), true);
      foreach($resultInP as $i){
          foreach($resultIdEq as $k){
          $idEqEmp = $k['idEquipoEmprendedor'];
               $idIPrimerInst= $i['fk_idInstitucion'];
               $col->fk_idInstitucion=$idIPrimerInst;
     $col->descripcion = Input::get('desIES');
     $col->fk_idEquipoEmprendedor = $idEqEmp;
     $col->bajaLogica = 1;

      }
         
      }

      $saved=  $tecnologia->save();
      $saved1= $anEnt->save();
      $saved3= $propInt->save();
      $saved4= $objP->save();
      $saved5= $col->save();

      //Tabla proyecto
     if($saved && $saved1  && $saved3 && $saved4 && $saved5){
       //obtener el ultimo id de la tabla colaboracion
     $idColaboracionQuery = DB::select('SELECT colaboracion.idColaboracion FROM `colaboracion` ORDER BY  idColaboracion desc limit 1');
     $resultQC = json_decode(json_encode($idColaboracionQuery), true);
      foreach($resultQC as $i){
          $idC= $i['idColaboracion'];
      }
     //obtener el ultimo id de la tabla propiedad intelectual
       $idPIQuery = DB::select('SELECT propiedadintelectual.idPropiedadIntelectual FROM `propiedadintelectual` ORDER BY idPropiedadIntelectual  desc limit 1');
     $resultQPI = json_decode(json_encode($idPIQuery), true);
      foreach($resultQPI as $i){
          $idPi= $i['idPropiedadIntelectual'];
      }
     //obtener el ultimo id de la tabla objetivo proyecto
      $idOPQuery = DB::select('SELECT objetivoproyecto.idObjetivoProyecto FROM `objetivoproyecto` ORDER BY idObjetivoProyecto  desc limit 1');
     $resultQOP = json_decode(json_encode($idOPQuery), true);
      foreach($resultQOP as $i){
          $idOp= $i['idObjetivoProyecto'];
      }

        //obtener el ultimo id de la tabla analisis del entorno
      $idAeQuery = DB::select('SELECT analisisentorno.idAnalisisEntorno FROM `analisisentorno` ORDER BY idAnalisisEntorno  desc limit 1');
     $resultQAE = json_decode(json_encode($idAeQuery), true);
      foreach($resultQAE as $i){
          $idAe= $i['idAnalisisEntorno'];
      }

     //obtener el ultimo id de la tabla tecnologia proyecto
      $idTpQuery = DB::select('SELECT tecnologiaproyecto.idTecnologiaProyecto FROM `tecnologiaproyecto` ORDER BY idTecnologiaProyecto desc limit 1');
     $resultQTP = json_decode(json_encode($idTpQuery), true);
      foreach($resultQTP as $i){
          $idTp= $i['idTecnologiaProyecto'];
      }
     //obtener el numero de equipo
       $idNumEqQuery = DB::select('SELECT equipoemprendedor.numeroEquipo FROM `equipoemprendedor`WHERE equipoemprendedor.idEquipoEmprendedor = '.$idEqEmp.' ORDER BY numeroEquipo desc limit 1');
     $resultQIDEQ = json_decode(json_encode($idNumEqQuery), true);
      foreach($resultQIDEQ as $i){
          $idNumEQ= $i['numeroEquipo'];
      }

     //$proyecto->fk_idEquipoEmprendedor=$idEqEmp;
      $proyecto->fk_numeroEquipoEmprendedor = $idNumEQ;
     $proyecto->fk_idColaboracion = $idC;
     $proyecto->fk_idPropiedadIntelectual=$idPi;
     $proyecto->fk_idObjetivoProyecto =$idOp;
     $proyecto->fk_idAnalisisEntorno=$idAe;
     $proyecto->fk_idTRL = Input::get('madurezProy');
     $proyecto->fk_idTecnologiaProyecto=$idTp;
     $proyecto->bajaLogica = 1;

     $savedProyecto = $proyecto->save();
     if($savedProyecto){
              //obtener el id de proyecto
    $idProyectoQuery = DB::select('select idProyecto from proyecto order by idProyecto desc limit 1');
     $resultIdProy = json_decode(json_encode($idProyectoQuery), true);
     foreach($resultIdProy as $i){
          $idProy= $i['idProyecto'];
      }

     ///actualizar tabla riesgos para saber a que proyecto pertenecen
     $actualizarRiesgos = DB::select('UPDATE riesgo SET riesgo.fk_idProyecto ='.$idProy.' where riesgo.fk_idTokenAppIn = '.$idToken);
      //return redirect()->back();
         return redirect()->back()->with('success_code', 5);
     }


     
     }else{
         return redirect()->back()->with('error_code', 5);

     }


    }
}
