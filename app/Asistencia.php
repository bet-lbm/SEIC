<?php

namespace App;

use App\Matricula;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
	protected $table='asistencias';

    protected $fillable=['matricula_id'];
    
    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }
}
