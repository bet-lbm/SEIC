<?php

namespace App;

use App\Matricula;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
	protected $table='asitencias';
    protected $fillable=['matricula_id'];
    
    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }
}
