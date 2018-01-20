<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table='temas';
    protected $fillable=['tema','fecha','descripcion','horario_id'];

    public function horario()
    {
    	return $this->hasMany(Horario::class);
    }
}
