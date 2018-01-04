<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function getIndex()
    {
        return view('alumnos.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::latest()->paginate(10);
        $response = [
            'pagination' => [
                'total' => $alumnos->total(),
                'per_page' => $alumnos->perPage(),
                'current_page' => $alumnos->currentPage(),
                'last_page' => $alumnos->lastPage(),
                'from' => $alumnos->firstItem(),
                'to' => $alumnos->lastItem(),
            ],
            'data' => $alumnos
        ];
        return response()->json($response);
    }

    public function search(Request $request)
    {
        $queryString=$request->input('queryString');
        $alumnos = Alumno::where('nombres','like','%'.$queryString.'%')
                        ->orWhere('apellidos', 'like','%'.$queryString.'%')
                        ->latest()->paginate(10);
        $response=[
            'pagination'=>[
                'total'=>$alumnos->total(),
                'per_page'=>$alumnos->perPage(),
                'current_page'=>$alumnos->currentPage(),
                'last_page'=>$alumnos->lastPage(),
                'from'=>$alumnos->firstItem(),
                'to'=>$alumnos->lastItem(),
            ],
            'data'=>$alumnos
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
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
            'dni' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);
        $create = Alumno::create($request->all());
        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);
        return response()->json($alumno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dni' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'sexo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);
        $edit = Alumno::find($id)->update($request->all());
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumno::find($id)->delete();
        return response()->json(['done']);
    }
}
