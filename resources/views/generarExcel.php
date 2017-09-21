<?php

Excel::create('Proyectos INADEM 2017', function($excel) {

        $excel->sheet('Sheet 1', function($sheet) {

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
	    $cell->setValue('Descripcion de la invencion');

	});	

        $sheet->cell('G1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Estado de desarrollo');

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
	    $cell->setValue('Colaboracion');

	});
        $sheet->cell('L1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Analisis del Entorno');

	});
        $sheet->cell('M1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Humanos');

	});
        $sheet->cell('N1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Tecnologicos');

	});
        $sheet->cell('O1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Recursos Financieros');

	});
        $sheet->cell('P1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Uso/Aplicacion');

	});
        $sheet->cell('Q1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Viabilidad');

	});
        $sheet->cell('R1', function($cell) {
	    // manipulate the cell
	    $cell->setFontWeight('bold');
	    $cell->setValue('Beneficios');

	});


            $products=DB::table('proyecto')
            ->join("tecnologiaproyecto","proyecto.fk_idTecnologiaProyecto","=","tecnologiaproyecto.idTecnologiaProyecto")
            ->join("institucion","tecnologiaproyecto.fk_idInstitucion","=","institucion.idInstitucion")
            ->join("tipoinvencion","tecnologiaproyecto.fk_idTipoInvencion","=","tipoinvencion.idTipoInvencion")
            ->join("trl","proyecto.fk_idTRL","=","trl.idTRL")
            ->join("tiposector","tecnologiaproyecto.fk_idSector","=","tiposector.idSector")
            ->join("tipopropiedadintelectual","proyecto.fk_idPropiedadIntelectual","=","tipopropiedadintelectual.idTipoPropiedadIntelectual")
            ->join("objetivoproyecto","proyecto.fk_idObjetivoProyecto","=","objetivoproyecto.idObjetivoProyecto")
            ->join("tipoobjetivoproyecto","objetivoproyecto.fk_idTipoObjetivoProyecto","=","tipoobjetivoproyecto.idtipoObjetivoProyecto")
            ->join("colaboracion","proyecto.fk_idColaboracion","=","colaboracion.idColaboracion")
            ->join("analisisentorno","proyecto.fk_idAnalisisEntorno","=","analisisentorno.idAnalisisEntorno")
            //->join("securities","securities.id","=","log_patrols.id_securities")
            ->select("tecnologiaproyecto.titulo","tecnologiaproyecto.tituloComercial","tecnologiaproyecto.problematica","tecnologiaproyecto.descripcion","institucion.nombreInstitucion","tipoinvencion.descripcion AS descripcionInvencion","trl.descripcion as estadoDesarrollo","tiposector.descripcion AS sector","tipopropiedadintelectual.descripcion as propiedad_Intelectual","tipoobjetivoproyecto.descripcion as Objetivo","colaboracion.descripcion AS colaboracion","analisisentorno.descripcionAnalisisEntorno","analisisentorno.recursosHumanos","analisisentorno.recursosTecnologicos","analisisentorno.recursosFinancieros","usoAplicacion","viabilidad", "beneficios")
            ->get();
                foreach($products as $product) {
                 $data[] = array(
                 	
                    $product->titulo,
                    $product->tituloComercial,
                    $product->problematica,
                    $product->descripcion,
                    $product->nombreInstitucion,
                    $product->descripcionInvencion,
                    $product->estadoDesarrollo,
                    $product->sector,
                    $product->propiedad_Intelectual,
                    $product->Objetivo,
                    $product->colaboracion,
                    $product->descripcionAnalisisEntorno,
                    $product->recursosHumanos,
                    $product->recursosTecnologicos,
                    $product->recursosFinancieros,
                    $product->usoAplicacion,
                    $product->viabilidad,
                    $product->beneficios,
  
                );
            }
             $sheet->fromArray($data, null, 'A2', false, false);
        });
    })->export('xls');

?>