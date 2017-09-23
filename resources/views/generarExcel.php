<?php

$dia = date("d");
$mes = date("m");
$identificador = rand(1, 999);

Excel::create('Proyectos INADEM 2017 dia:'.$dia.' mes:'.$mes.'- ID:'.$identificador.'', function($excel) {

        $excel->sheet('Proyectos INADEM 2017', function($sheet) {

        $sheet->cell('A1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Titulo');

	});	
        $sheet->cell('B1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Titulo Comercial');

	});	
        $sheet->cell('C1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Problematica');

	});	
        $sheet->cell('D1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Descripcion');

	});
    $sheet->cell('E1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Institucion');

	});	
        $sheet->cell('F1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Madurez Proyecto');

	});	
        $sheet->cell('G1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Sector');

	});
    $sheet->cell('H1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Propiedad Intelectual');

	});	
        $sheet->cell('I1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Objetivo Proyecto');
	});	
        $sheet->cell('J1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Analisis Entorno');
	});
        $sheet->cell('K1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Humanos');
	});
        $sheet->cell('L1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Tecnologicos');
	});
        $sheet->cell('M1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Financieros');

	});
        $sheet->cell('N1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Usos/Aplicacion');
	});
        $sheet->cell('O1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Viabilidad');

	});
        $sheet->cell('P1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Beneficios');
	});


/*
/////////////////////////////////////////////
Aqui va el query que va a llenar el excel con
los proyectos existentes, este query aun se 
encuentra I-N-C-O-M-P-L-E-T-O, va a ser necesario 
terminar de hacerlo para que se muestre toda
la información completa en el Excel
/////////////////////////////////////////////
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
            
            ->select("tecnologiaproyecto.titulo","tecnologiaproyecto.tituloComercial","tecnologiaproyecto.problematica","tecnologiaproyecto.descripcion","institucion.nombreInstitucion","trl.descripcion as madurezProyecto","tiposector.descripcion AS tipoSector","tipopropiedadintelectual.descripcion AS propiedadIntelectual","tipoobjetivoproyecto.descripcion AS objetivoProyecto","analisisentorno.descripcionAnalisisEntorno AS analisisEntorno","analisisentorno.recursosHumanos","analisisentorno.recursosTecnologicos","analisisentorno.recursosFinancieros","analisisentorno.usoAplicacion","analisisentorno.viabilidad","analisisentorno.beneficios")
            ->get();
                foreach($products as $product) {
                 $data[] = array(

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
	    $cell->setValue('Numero de control');

	});	
        $sheet->cell('B1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Email');

	});	
        $sheet->cell('C1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Nombre');

	});	
        $sheet->cell('D1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Apellido paterno');

	});
    $sheet->cell('E1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Apellido materno');

	});	
        $sheet->cell('F1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Celular');

	});	
        $sheet->cell('G1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Fecha Nacimiento');

	});
    $sheet->cell('H1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Curp');

	});	
        $sheet->cell('I1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Genero');
	});	
        $sheet->cell('J1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Telefono fijo');
	});
        
            $products=DB::table('equipoemprendedor')
            ->join("participante","equipoemprendedor.fk_participante","=","participante.idParticipante")
            
            ->select("*")
            ->get();
                foreach($products as $product) {
                 $data[] = array(

                 	$product->numeroControl,
                 	$product->correoElectronico,
                 	$product->nombre,
                 	$product->apellidoPaterno,
                 	$product->apellidoMaterno,
                 	$product->numeroMovil,
                 	$product->fechaNacimiento,
                 	$product->curp,
                 	$product->genero,
                 	$product->telefonoFijo,
                 	
                );
            }

             $sheet->fromArray($data, null, 'A2', false, false);	
		
    });

    })->export('xls');

?>