<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Matricula;
use Illuminate\Http\Request;
use DB;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matriculas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'alumno_id' => 'required',
            'horario_id' => 'required',
            'precioCurso' => 'required',
            'pago' => 'required',
            'fecha' => 'required',
            'estado' => 'required',
            'habilitado' => 'required',  
        ]);
        $create = Matricula::create($request->all());
        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matricula $matricula)
    {
        //
    }

    public function code(){
        $max = Matricula::count();
        if ($max > 0) {
            $row = explode('-',Matricula::max('code'), 3);
            $cod = $row[1];
            $sig = $cod+1;
            $Strsig = (string)$sig;
            $formato = "MC-".str_pad($Strsig, "7", "0", STR_PAD_LEFT);
        } 
        else {
            $sig = 1;
            $Strsig = (string)$sig;
            $formato = "MC-".str_pad($Strsig,"7","0",STR_PAD_LEFT);
        }
        return $formato;
    }
    
    public function getAlumno($dni){
        $alumno=DB::table('matriculas')
                    ->join('alumnos','matriculas.alumno_id','=','alumnos.id')
                    ->join('horarios','horarios.id','=','matriculas.horario_id')
                    ->join('cursos','horarios.curso_id','=','cursos.id')
                    ->select('matriculas.code','matriculas.estado','alumnos.dni','alumnos.nombres','alumnos.apellidos','alumnos.sexo','cursos.nombre')
                    ->where('alumnos.dni','=',$dni)
                    ->get();
        return response()->json($alumno);
    }
}
