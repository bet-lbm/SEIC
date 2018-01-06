<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function getIndex()
    {
        return view('cursos.index');
    }    
    public function index() {
		$cursos = Curso::latest()->paginate(10);
        $response = [
            'pagination' => [
                'total' => $cursos->total(),
                'per_page' => $cursos->perPage(),
                'current_page' => $cursos->currentPage(),
                'last_page' => $cursos->lastPage(),
                'from' => $cursos->firstItem(),
                'to' => $cursos->lastItem(),
            ],
            'data' => $cursos
        ];
        return response()->json($response);
	}
    public function create()
    {
        return view('cursos.create');
    }
    public function store(Request $request) 
    {
        $this->validate($request, [
            'nombre' => 'required',
            'duracion' => 'required',
            'max_alumnos' => 'required',
        ]);
        $create = Curso::create($request->all());
        return response()->json($create);
    }
    public function show($id)
    {
        $curso = Curso::find($id);
        return response()->json($curso);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'duracion' => 'required',
            'max_alumnos' => 'required',
        ]);
        $edit = Curso::find($id)->update($request->all());
        return response()->json($edit);
    }
    public function destroy($id)
    {
        Curso::find($id)->delete();
        return response()->json(['done']);
    }
    public function combo(){
        $curso=Curso::orderBy('nombre','asc')->get();
        return response()->json($curso);
    }
}
