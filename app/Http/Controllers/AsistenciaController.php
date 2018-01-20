<?php

namespace App\Http\Controllers;

use App\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    
    public function getIndexAlumno()
    {
        return view('asistencias.alumno');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asistencias.create');
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
            'matricula_id' => 'required',
        ]);
        $create = Asistencia::create($request->all());
        return response()->json($create);
    }

    public function search($code)
    {
        $asistencias = Asistencia::where('matricula_id','=',$code)
                       ->orderBy('created_at', 'asc')->get();
        return response()->json($asistencias);
    }
}
