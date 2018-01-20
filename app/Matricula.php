<?php

namespace App;

use App\Alumno;
use App\Asistencia;
use App\Horario;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matriculas';

    protected $fillable = ['code','alumno_id','horario_id','precioCurso','pago','fecha','estado','habilitado'];

    public function alumno()
    {
    	return $this->belongsTo(Alumno::class);
    }

    public function horario()
    {
    	return $this->belongsTo(Horario::class);
    }
    public function asistencia()
    {
        return $this->hasMany(Asistencia::class);
    }
}
