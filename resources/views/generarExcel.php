<?php

//Se generan las variables necesarias para poder nombrar el archivo excel con la fecha actual y ademas asignarle un ID
$dia = date("d");
$mes = date("m");
$identificador = rand(1, 999);

Excel::create('Proyectos INADEM 2017 dia:'.$dia.' mes:'.$mes.'- ID:'.$identificador.'', function($excel) {

        $excel->sheet('Proyectos INADEM 2017', function($sheet) {

    $sheet->cell('A1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Clave de Proyecto');
	});
        $sheet->cell('B1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre del Proyecto');

	});	
        $sheet->cell('C1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre Público');

	});	
        $sheet->cell('D1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Problema');

	});	
        $sheet->cell('E1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Detalles');

	});
    $sheet->cell('F1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Escuela de procedencia');

	});	
        $sheet->cell('G1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nivel TRL');

	});	
        $sheet->cell('H1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Sector');

	});
    $sheet->cell('I1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Propiedad Intelectual');

	});	
        $sheet->cell('J1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Objetivo');
	});	
        $sheet->cell('K1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Entorno Actualmente');
	});
        $sheet->cell('L1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Humanos');
	});
        $sheet->cell('M1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Tecnologicos');
	});
        $sheet->cell('N1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Financieros');

	});
        $sheet->cell('O1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Aplicaciones y/o Usos');
	});
        $sheet->cell('P1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Viabilidad del Proyecto');

	});
        $sheet->cell('Q1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Ventajas de realizacion');
	});





/*
Consulta en formato SQL. La consulta debe ser implementada en sintaxis de php:

SELECT tecnologiaproyecto.titulo, tecnologiaproyecto.tituloComercial, tecnologiaproyecto.problematica, tecnologiaproyecto.descripcion, institucion.nombreInstitucion, trl.descripcion as madurezProyecto, tiposector.descripcion AS tipoSector,tipopropiedadintelectual.descripcion AS propiedadIntelectual, tipoobjetivoproyecto.descripcion AS objetivoProyecto, analisisentorno.descripcionAnalisisEntorno AS analisisEntorno, analisisentorno.recursosHumanos, analisisentorno.recursosTecnologicos, analisisentorno.recursosFinancieros, analisisentorno.usoAplicacion, analisisentorno.viabilidad, analisisentorno.beneficios
FROM proyecto
INNER JOIN tecnologiaproyecto ON proyecto.fk_idTecnologiaProyecto = tecnologiaproyecto.idTecnologiaProyecto
INNER JOIN institucion ON tecnologiaproyecto.fk_idInstitucion = institucion.idInstitucion
INNER JOIN trl ON proyecto.fk_idTRL = trl.idTRL
INNER JOIN tiposector ON tecnologiaproyecto.fk_idSector = tiposector.idSector
INNER JOIN propiedadintelectual ON proyecto.fk_idPropiedadIntelectual = propiedadintelectual.idPropiedadIntelectual
INNER JOIN tipopropiedadintelectual ON propiedadintelectual.fk_idTipoRegistro = tipopropiedadintelectual.idTipoPropiedadIntelectual
INNER JOIN objetivoproyecto ON proyecto.fk_idObjetivoProyecto = objetivoproyecto.idObjetivoProyecto
INNER JOIN tipoobjetivoproyecto ON objetivoproyecto.fk_idTipoObjetivoProyecto = tipoobjetivoproyecto.idtipoObjetivoProyecto
INNER JOIN analisisentorno ON proyecto.fk_idAnalisisEntorno = analisisentorno.idAnalisisEntorno

*/
            $products=DB::table('proyecto')
            
            ->join("tecnologiaproyecto","proyecto.fk_idTecnologiaProyecto","=","tecnologiaproyecto.idTecnologiaProyecto")
            ->join("institucion","tecnologiaproyecto.fk_idInstitucion","=","institucion.idInstitucion")
            ->join("trl","proyecto.fk_idTRL","=","trl.idTRL")
            ->join("tiposector","tecnologiaproyecto.fk_idSector","=","tiposector.idSector")
            ->join("propiedadintelectual","proyecto.fk_idPropiedadIntelectual","=","propiedadintelectual.idPropiedadIntelectual")
            ->join("tipopropiedadintelectual","propiedadintelectual.fk_idTipoRegistro","=","tipopropiedadintelectual.idTipoPropiedadIntelectual")
            ->join("objetivoproyecto","proyecto.fk_idObjetivoProyecto","=","objetivoproyecto.idObjetivoProyecto")
            ->join("tipoobjetivoproyecto","objetivoproyecto.fk_idTipoObjetivoProyecto","=","tipoobjetivoproyecto.idtipoObjetivoProyecto")
            ->join("analisisentorno","proyecto.fk_idAnalisisEntorno","=","analisisentorno.idAnalisisEntorno")
            
            ->select("tecnologiaproyecto.titulo","tecnologiaproyecto.tituloComercial","tecnologiaproyecto.problematica","tecnologiaproyecto.descripcion","institucion.nombreInstitucion","trl.descripcion as madurezProyecto","tiposector.descripcion AS tipoSector","tipopropiedadintelectual.descripcion AS propiedadIntelectual","tipoobjetivoproyecto.descripcion AS objetivoProyecto","analisisentorno.descripcionAnalisisEntorno AS analisisEntorno","analisisentorno.recursosHumanos","analisisentorno.recursosTecnologicos","analisisentorno.recursosFinancieros","analisisentorno.usoAplicacion","analisisentorno.viabilidad","analisisentorno.beneficios","proyecto.idProyecto")
            ->get();
                foreach($products as $product) {
                 $data[] = array(

                 	$product->idProyecto,
                 	$product->titulo,
                 	$product->tituloComercial,
                 	$product->problematica,
                 	$product->descripcion,
                 	$product->nombreInstitucion,
                 	$product->madurezProyecto,
                 	$product->tipoSector,
                 	$product->propiedadIntelectual,
                 	$product->objetivoProyecto,
                 	$product->analisisEntorno,
                 	$product->recursosHumanos,
                 	$product->recursosTecnologicos,
                 	$product->recursosFinancieros,
                 	$product->usoAplicacion,
                 	$product->viabilidad,
                 	$product->beneficios,
                );
            }

             $sheet->fromArray($data, null, 'A2', false, false);
        


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        });
$excel->sheet('Equipos Emprendedores', function($sheet) {
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // En esta hoja se llena la informacion de los equipos emprendedores, este query me lo regalo la joven Luz Arely <3.
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $sheet->cell('A1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Clave de Proyecto');

	});	
        $sheet->cell('B1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre del Proyecto');

	});	
        $sheet->cell('C1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre Público');

	});	
        $sheet->cell('D1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Integrantes: Nombre');

	});
    $sheet->cell('E1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Apellidos: Parterno');

	});	
        $sheet->cell('F1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Materno');

	});	
        $sheet->cell('G1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('EMAIL');

	});	
     	$sheet->cell('H1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Celular');

	});	
        $sheet->cell('I1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nivel');

	});	
        $sheet->cell('J1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Area de Conocimiento');

	});	

/*
Consulta en formato SQL. La consulta debe ser implementada en sintaxis de php:

SELECT tecnologiaproyecto.titulo AS tituloProyecto, tecnologiaproyecto.tituloComercial, participante.nombre, participante.apellidoPaterno, participante.apellidoMaterno, participante.correoElectronico, participante.numeroMovil, proyecto.fk_idTecnologiaProyecto AS idTP, tipogradoestudios.nivel, areaconocimiento.descripcion
FROM equipoemprendedor
INNER JOIN participante ON equipoemprendedor.fk_participante = participante.idParticipante
INNER JOIN proyecto ON equipoemprendedor.numeroEquipo = proyecto.fk_numeroEquipoEmprendedor
INNER JOIN tecnologiaproyecto ON proyecto.fk_idTecnologiaProyecto = proyecto.fk_idTecnologiaProyecto  
INNER JOIN tipogradoestudios ON participante.fk_idGradoEstudios = tipogradoestudios.idGradoEstudios
INNER JOIN areaconocimiento ON participante.fk_idAreaConocimientos = areaconocimiento.idAreaConocimiento

*/
            $products=DB::table('equipoemprendedor')
            
            ->join("participante","equipoemprendedor.fk_participante","=","participante.idParticipante")
            ->join("proyecto","equipoemprendedor.numeroEquipo","=","proyecto.fk_numeroEquipoEmprendedor")
            ->join("tecnologiaproyecto","proyecto.fk_idTecnologiaProyecto","=","tecnologiaproyecto.idTecnologiaProyecto")
            ->join("tipogradoestudios","participante.fk_idGradoEstudios","=","tipogradoestudios.idGradoEstudios")
            ->join("areaconocimiento","participante.fk_idAreaConocimientos","=","areaconocimiento.idAreaConocimiento")
            ->select("tecnologiaproyecto.titulo AS tituloProyecto","tecnologiaproyecto.tituloComercial","participante.nombre","participante.apellidoPaterno","participante.apellidoMaterno","participante.correoElectronico","participante.numeroMovil","proyecto.fk_idTecnologiaProyecto AS idTP","tipogradoestudios.nivel","areaconocimiento.descripcion","idProyecto")
            ->get();
                foreach($products as $product) {
                 $data[] = array(

                 	$product->idProyecto,
                 	$product->tituloProyecto,
                 	$product->tituloComercial,
                 	$product->nombre,
                 	$product->apellidoPaterno,
                 	$product->apellidoMaterno,
                 	$product->correoElectronico,
                 	$product->numeroMovil,
                 	$product->nivel,
                 	$product->descripcion,
                 	
                 	);
            }

             $sheet->fromArray($data, null, 'A2', false, false);

    });


    $excel->sheet('Riesgos', function($sheet) {
       
        $sheet->cell('A1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Clave de Proyecto');

	});
        // Sheet manipulation
        $sheet->cell('B1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre del Proyecto');

	});	
        $sheet->cell('C1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre Público');

	});	
        $sheet->cell('D1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Estrategia de Mitigación');

	});	
        $sheet->cell('E1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Descripción del Riesgo');

	});	


/*
Consulta en formato SQL. La consulta debe ser implementada en sintaxis de php:

SELECT * FROM
riesgo
INNER JOIN tiporiesgo ON riesgo.fk_idTipoRiesgo = tiporiesgo.idTipoRiesgo
INNER JOIN proyecto ON riesgo.fk_idProyecto = proyecto.idProyecto
INNER JOIN tecnologiaproyecto ON proyecto.fk_idTecnologiaProyecto = tecnologiaproyecto.idTecnologiaProyecto

*/	
            $products=DB::table('riesgo')
            
            ->join("tiporiesgo","riesgo.fk_idTipoRiesgo","=","tiporiesgo.idTipoRiesgo")
            ->join("proyecto","riesgo.fk_idProyecto","=","proyecto.idProyecto")
            ->join("tecnologiaproyecto","proyecto.fk_idTecnologiaProyecto","=","tecnologiaproyecto.idTecnologiaProyecto")
            
            ->select("tecnologiaproyecto.titulo","tecnologiaproyecto.tituloComercial","estrategiaMitigacion","descripcionRiesgo","fk_idProyecto")
            ->get();
                foreach($products as $product) {
                 $data[] = array(

                 	$product->fk_idProyecto,
                 	$product->titulo,
                 	$product->tituloComercial,
                 	$product->estrategiaMitigacion,
                 	$product->descripcionRiesgo,
                 	
                 	);
            }

             $sheet->fromArray($data, null, 'A2', false, false);

    });


    })->export('xls');

?>