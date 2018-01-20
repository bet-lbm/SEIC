<?php

namespace App\Http\Controllers;

use App\Nota;
use DB;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nota'=>'required',
            'descripcion'=>'required',
            'fecha'=>'required',
            'matricula_id'=>'required',
        ]);
        $create=Nota::create($request->all());
        return response()->json($create);
    }
    public function combo($dni){
        $matriculas=DB::table('matriculas')
                        ->join('alumnos','matriculas.alumno_id','=','alumnos.id')
                        ->join('horarios','matriculas.horario_id','=','horarios.id')
                        ->join('cursos','horarios.curso_id','=','cursos.id')
                        ->select('matriculas.code','alumnos.dni','alumnos.nombres','alumnos.apellidos','horarios.dia','horarios.hora_inicio','cursos.nombre')
                        ->where('alumnos.dni','=',$dni)->get();
        return response()->json($matriculas);
    }
    public function getReporte(){
        return view('notas.reporte');
    }

    public function notas_curso($id){
        $notas=DB::table('notas')
                  ->join('matriculas','notas.matricula_id','=','matriculas.code')
                  ->join('alumnos','matriculas.alumno_id','=','alumnos.id')
                  ->join('horarios','matriculas.horario_id','=','horarios.id')
                  ->join('cursos','horarios.curso_id','=','cursos.id')
                  ->select('cursos.id','matriculas.code','alumnos.dni','alumnos.apellidos','alumnos.nombres','notas.nota','horarios.hora_inicio','horarios.dia','cursos.nombre','cursos.duracion')
                  ->where('cursos.id','=',$id)->get();
        return response()->json($notas);
    }

}
