<?php

namespace App;

use App\Aula;
use App\Curso;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table ='horarios';
    protected $fillable =['dia','hora_inicio','hora_fin','aula_id','curso_id'];

    public function aula(){
    	return $this->belongsTo(Aula::class);
    }
    public function curso(){
    	return $this->belongsTo(Curso::class);
    }
}
