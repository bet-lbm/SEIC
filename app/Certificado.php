<?php

namespace App;

use App\Nota;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    protected $table='certificados';
    protected $fillable=['nota_id','fecha',];

    public function nota(){
    	return $this->belongsTo(Nota::class);
    }
}
