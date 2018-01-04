<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table='alumnos';
    protected $fillable=['dni','nombres','apellidos','sexo','direccion','telefono','email'];
}
