<?php

namespace App;

use App\Matricula;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table='notas';
    protected $fillable=['nota','descripcion','fecha','matricula_id'];

    public function matricula(){
    	return $this->belongsTo(Matricula::class);
    }
}
