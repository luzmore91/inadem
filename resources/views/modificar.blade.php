<h1>1.- Tecnología/Proyecto</h1>
<br>
<h4>*<i>Haga doble click encima de un campo para editarlo.</i></h4>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Título comercial</th>
                        <th>Problemática a resolver</th>
                        <th>Descripción/Resumen</th>
                        <th>Institución</th>
                        <th>Tipo de invención</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td contenteditable='true'>{{ $proyecto->titulo }}</td>
                        <td contenteditable='true'>{{ $proyecto->tituloComercial}}</td>
                        <td contenteditable='true'>{{ $proyecto->problematica}}</td>
                        <td contenteditable='true'>{{ $proyecto->descripcion}}</td>
                        <td>
                            <select id="intitucion" required class="form-control selectpicker" data-style="btn-green" name="instEq">
                            <option>Seleccione una opción</option>
                            @foreach ($instituciones as $institucion)
                            <option value="{{$institucion->idInstitucion}}" {{$institucion->idInstitucion==$proyecto->fk_idInstitucion? 'selected="selected"': '' }}> {{ $institucion->nombreInstitucion }}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                            <select required id="tipoInvension" class="form-control selectpicker" data-style="btn-green" name="tipoInv">
                                <option>Seleccione una opción</option>
                                @foreach ($invenciones as $invencion)
                                <option value="{{$invencion->idTipoInvencion}}" {{$invencion->idTipoInvencion==$proyecto->fk_idTipoInvencion? 'selected="selected"': '' }}> {{ $invencion->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
<h1>2-. Equipo emprendedor/Inventor</h1>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Último grado de estudios</th>
                        <th>Área de Conocimiento</th>
                        <th>Correo Electrónico</th>
                        <th>Número Celular</th>
                        <th>Institución</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participantes as $participante)
                    <tr>
                        <td contenteditable='true'>{{ $participante->nombre }}</td>
                        <td>
                            <select id="gradoestudios" required class="form-control selectpicker" data-style="btn-green" name="Grado">
                                <option>Seleccione una opción</option>
                                @if($participantes == null)
                                @foreach ($gradosestudios as $gradoestudio)
                                <option value="{{$gradoestudio->idGradoEstudios}}">{{ $gradoestudio->nivel }}</option>
                                @endforeach
                                @else
                                @foreach ($gradosestudios as $gradoestudio)
                                <option value="{{$gradoestudio->idGradoEstudios}}" {{ $gradoestudio->idGradoEstudios==$participante->fk_idGradoEstudios? 'selected="selected"': '' }}>{{ $gradoestudio->nivel }}</option>
                                @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select>
                                @foreach ($areasconocimiento as $areaconocimiento)
                                <option value="{{$areaconocimiento->idAreaConocimiento}}" {{ $areaconocimiento->idAreaConocimiento==$participante->fk_idAreaConocimientos? 'selected="selected"': '' }}>{{ $areaconocimiento->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td contenteditable='true'>{{ $participante->correoElectronico }}</td>
                        <td contenteditable='true'>{{ $participante->numeroMovil }}</td>
                        <td>
                            <select id="intitucion" required class="form-control selectpicker" data-style="btn-green" name="instEq">
                                <option>Seleccione una opción</option>
                                @foreach ($instituciones as $institucion)
                                <option value="{{$institucion->idInstitucion}}" {{$institucion->idInstitucion==$participante->fk_idInstitucion? 'selected="selected"': '' }}> {{ $institucion->nombreInstitucion }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
<br>
<h1>3.- Descripción del Proyecto</h1>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Estado de Desarollo/Madurez (TLR)</th>
                        <th>Sector estratégico</th>
                        <th>Propiedad intelectual</th>
                        <th>Lo que persigue el Proyecto/Tecnología</th>
                        <th>Tipo de protección <i>(Sólo si aplica)</i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select id="tlr" required class="form-control selectpicker" data-style="btn-green" name="tlr">
                                <option>Seleccione una opción</option>
                                @foreach ($trls as $trl)
                                <option value="{{$trl->idTRL}}"> {{ $trl->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="sector" required class="form-control selectpicker" data-style="btn-green" name="sector">
                                <option>Seleccione una opción</option>
                                @foreach ($sectores as $sector)
                                <option value="{{$sector->idSector}}"> {{ $sector->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="propiedadIntelectual" required class="form-control selectpicker" data-style="btn-green" name="propiedadIntelectual">
                                <option>Seleccione una opción</option>
                                @foreach ($propiedadIntelectual as $propIntelectual)
                                <option value="{{$propIntelectual->tipopropiedadintelectual}}"> {{ $propIntelectual->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="objetivoProyecto" required class="form-control selectpicker" data-style="btn-green" name="objetivoProyecto">
                                <option>Seleccione una opción</option>
                                @foreach ($objetivosProyecto as $objetivoProyecto)
                                <option value="{{$objetivoProyecto->idObjetivoProyecto}}"> {{ $objetivoProyecto->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="tipoProteccion" required class="form-control selectpicker" data-style="btn-green" name="tipoProteccion">
                                <option>Seleccione una opción</option>
                                @foreach ($tiposProteccion as $tipoProteccion)
                                <option value="{{$tipoProteccion->idTipoProteccion}}"> {{ $tipoProteccion->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Usos/Aplicaciones</th>
                        <th>Vabilidad</th>
                        <th>Beneficios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td contenteditable='true'>Elemento1</td>
                        <td contenteditable='true'>Elemento2</td>
                        <td contenteditable='true'>Elemento3</td>
                    </tr>
                </tbody>
            </table>
<br>
<h1>4.- Colaboración con otras IES</h1>
<textarea style="resize: vertical" class="form-control" rows="6" placeholder="Colaboración con otras IES
" title="Descripción IES y tipo de colaboración" name="desIES" required=""></textarea>
<br>
<h1>5.- Riesgos</h1>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Tipo de Riesgo</th>
                        <th>Descripción</th>
                        <th>Estrategia de mitigación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td contenteditable='true'>Elemento1</td>
                        <td contenteditable='true'>Elemento2</td>
                        <td contenteditable='true'>Elemento3</td>
                    </tr>
                </tbody>
            </table>
            <br>
<h1>6.- Análisis del Entorno</h1>
<textarea style="resize: vertical" class="form-control" rows="6" placeholder="Análisis del entorno
" title="Descripción IES y tipo de colaboración" name="desIES" required=""></textarea>
<br>
<h1>7.- Recursos</h1>
            <table id="datos" class="table table-hover table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Humanos</th>
                        <th>Tecnológicos</th>
                        <th>Financieros</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td contenteditable='true'>Elemento1</td>
                        <td contenteditable='true'>Elemento2</td>
                        <td contenteditable='true'>Elemento3</td>
                    </tr>
                </tbody>
            </table>
