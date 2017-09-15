<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    //tabla a utilizar
    protected $table = 'institucion';
    public $timestamps = false;

    public function tecnologia()
    {
        return $this->belongsTo('fk_idInstitucion'); // links this->course_id to courses.id
    }

}
