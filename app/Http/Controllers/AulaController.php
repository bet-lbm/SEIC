<?php

namespace App\Http\Controllers;

use App\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('aulas.index');
    }
    public function index() {
        $aulas = Aula::latest()->paginate(10);
        $response = [
            'pagination' => [
                'total' => $aulas->total(),
                'per_page' => $aulas->perPage(),
                'current_page' => $aulas->currentPage(),
                'last_page' => $aulas->lastPage(),
                'from' => $aulas->firstItem(),
                'to' => $aulas->lastItem(),
            ],
            'data' => $aulas
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aula = Aula::find($id);
        return response()->json($aula);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'numero_aula' => 'required',
            'descripcion' => 'required',
        ]);
        $edit = Aula::find($id)->update($request->all());
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
