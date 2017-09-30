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
                        <td><textarea id="tituloProy">{{ $proyecto[0]->titulo }}</textarea></td>
                        <td><textarea id="tituloComercial">{{ $proyecto[0]->tituloComercial}}</textarea></td>
                        <td><textarea id="problematica">{{ $proyecto[0]->problematica}}</textarea></td>
                        <td><textarea id="descripcion">{{ $proyecto[0]->descripcion}}</textarea></td>
                        <td>
                            <select id="institucion" required class="form-control selectpicker" data-style="btn-green" name="instEq">
                            <option>Seleccione una opción</option>
                            @foreach ($instituciones as $institucion)
                            <option value="{{$institucion->idInstitucion}}" {{$institucion->idInstitucion==$proyecto[0]->fk_idInstitucion? 'selected="selected"': '' }}> {{ $institucion->nombreInstitucion }}</option>
                            @endforeach
                        </select>
                        </td>
                        <td>
                            <select required id="tipoInvencion" class="form-control selectpicker" data-style="btn-green" name="tipoInv">
                                <option>Seleccione una opción</option>
                                @foreach ($invenciones as $invencion)
                                <option value="{{$invencion->idTipoInvencion}}" {{$invencion->idTipoInvencion==$proyecto[0]->fk_idTipoInvencion? 'selected="selected"': '' }}> {{ $invencion->descripcion }}</option>
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
                        <td><input id="nombrePart" type="text" value="{{ $participante->nombre }}"/></td>
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
                        <td><input type="text" id="correo" value="{{ $participante->correoElectronico }}" /></td>
                        <td><input type="text" id="numeroMovil" value="{{ $participante->numeroMovil }}" /></td>
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
                            <select>
                                @foreach ($trls as $trl)
                                <option value="{{$trl->idTRL}}"> {{ $trl->descripcion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select id="sector" required class="form-control selectpicker" data-style="btn-green" name="sector">
                                <option>Seleccione una opción</option>
                                @foreach ($sectores as $sector)
                                <option value="{{$sector->idSector}}" {{$sector->idSector==$proyecto[0]->fk_idSector? 'selected="selected"': '' }}> {{ $sector->descripcion }}</option>
                                @endforeach

                            
                            </select>

                            
                        </td>
                        <td>
                            <select>
                                @foreach ($propiedadIntelectual as $propiedadintelectual)
                                <option value="{{$propiedadintelectual->idPropiedadIntelectual}}" {{ $propiedadintelectual->idPropiedadIntelectual==$proyecto[0]->fk_idPropiedadIntelectual? 'selected="selected"': '' }}>{{ $propiedadintelectual->descripcion }}</option>
                                 @endforeach
                            </select>
                        </td>
                        <td>
                            <select>
                                @foreach ($objetivosProyecto as $tipoobjetivoproyecto)
                                <option value="{{$tipoobjetivoproyecto->idtipoObjetivoProyecto}}" {{ $tipoobjetivoproyecto->idtipoObjetivoProyecto==$proyecto[0]->fk_idObjetivoProyecto? 'selected="selected"': '' }}>{{ $tipoobjetivoproyecto->descripcion }}</option>
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
                        <td><textarea id="usoAplicacion">{{ $analisisentorno[0]->usoAplicacion }}</textarea></td>
                        <td><textarea id="viabilidad">{{ $analisisentorno[0]->viabilidad }}</textarea></td>
                        <td><textarea id="beneficios">{{ $analisisentorno[0]->beneficios }}</textarea></td>
                    </tr>
                </tbody>
            </table>
<br>
<h1>4.- Colaboración con otras IES</h1>
<textarea style="resize: vertical" class="form-control" rows="6" placeholder="Colaboración con otras IES
" title="Descripción IES y tipo de colaboración" name="desIES" required="">{{ $colaboracion[0]->descripcion}}</textarea>
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
                    @foreach($riesgos as $riesgo)
                        <tr>
                            <td>
                            <select>
                                @foreach ($tiporiesgos as $tiporiesgo)
                                <option value="{{$tiporiesgo->idTipoRiesgo}}"  {{ $tiporiesgo->idTipoRiesgo==$riesgo->fk_idTipoRiesgo? 'selected="selected"': '' }}> {{ $tiporiesgo->descripcion }}</option>
                                @endforeach
                            </select>
                            </td>

                        <td><textarea id="descripcionRiesgo">{{ $riesgo->descripcionRiesgo}}</textarea></td>
                        <td><textarea id="estrategiaMitigacion">{{ $riesgo->estrategiaMitigacion}}</textarea></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
<h1>6.- Análisis del Entorno</h1>
<textarea style="resize: vertical" class="form-control" rows="6" placeholder="Análisis del entorno
" title="Descripción IES y tipo de colaboración" name="desIES" required="">
    {{ $analisisentorno[0]->descripcionAnalisisEntorno}}
</textarea>

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
                        <td><textarea id="recursosHumanos">{{ $analisisentorno[0]->recursosHumanos}}</textarea></td>
                        <td><textarea id="recursosTecnologicos">{{ $analisisentorno[0]->recursosTecnologicos}}</textarea></td>
                        <td><textarea id="recursosFinancieros">{{ $analisisentorno[0]->recursosFinancieros}}</textarea></td>
                    </tr>
                </tbody>
            </table>
 <div align="center">
        <input class="btn btn-primary" type="submit" value="ACTUALIZAR" onclick="guardarCambios();">
        <button type="button" class="btn btn-secondary" onclick=" window.history.back();">VOLVER</button>
        <br>
        <br>
    </div>

