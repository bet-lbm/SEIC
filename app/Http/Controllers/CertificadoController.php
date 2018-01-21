<?php

namespace App\Http\Controllers;

use App\Certificado;
use DB;
use Illuminate\Http\Request;

class CertificadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        return view('certificados.index');
    }
    public function index()
    {
       $certificados = DB::table('certificados')
                          ->join('notas','certificados.nota_id','=','notas.id')
                          ->join('matriculas','notas.matricula_id','=','matriculas.code')
                          ->join('alumnos','matriculas.alumno_id','=','alumnos.id')
                          ->join('horarios','matriculas.horario_id','=','horarios.id')
                          ->join('cursos','horarios.curso_id','=','cursos.id')
                          ->select('certificados.id','certificados.fecha','matriculas.code','notas.nota','alumnos.nombres','alumnos.apellidos','horarios.dia','cursos.nombre')
                          ->get();
        
        return response()->json($certificados);

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
            'nota_id'=>'required',
            'fecha'=>'required',
        ]);
        $create=Certificado::create($request->all());
        return response()->json($create);   
    }

    public function combo($dni){
        $certificados = DB::table('notas')
                          ->join('matriculas','notas.matricula_id','=','matriculas.code')
                          ->join('alumnos','matriculas.alumno_id','=','alumnos.id')
                          ->join('horarios','matriculas.horario_id','=','horarios.id')
                          ->join('cursos','horarios.curso_id','=','cursos.id')
                          ->select('notas.id','matriculas.code','notas.nota','alumnos.dni','alumnos.nombres','alumnos.apellidos','cursos.nombre')
                          ->where('alumnos.dni','=',$dni)->get();
        
        return response()->json($certificados);
    }
  
}
