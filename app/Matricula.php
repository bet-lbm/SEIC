<?php

namespace App;

use App\Alumno;
use App\Horario;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';

    protected $filltable = ['code','alumno_id','horario_id','precioCurso','pago','fecha','estado','habilitado'];

    public function alumno()
    {
    	return $this->belongsTo(Alumno::class);
    }

    public function horario()
    {
    	return $this->belongsTo(Horario::class);
    }
}