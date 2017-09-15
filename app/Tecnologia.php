<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    //tabla a utilizar
    protected $table = 'tecnologiaProyecto';

    protected $primaryKey = 'idTecnologiaProyecto';

    public $timestamps = false;

    public function institucion()
    {
        return $this->hasOne('idInstitucion'); // links this->id to events.course_id
    }
}
