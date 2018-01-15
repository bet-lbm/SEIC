<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        return view('horarios.index');
    }

    public function index()
    {
        $horarios = Horario::orderBy('created_at', 'desc')->paginate(5);
        $response = [
            'pagination' => [
                'total' => $horarios->total(),
                'per_page' => $horarios->perPage(),
                'current_page' => $horarios->currentPage(),
                'last_page' => $horarios->lastPage(),
                'from' => $horarios->firstItem(),
                'to' => $horarios->lastItem(),
            ],
            'data' => $horarios  ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horarios.create');
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
            'dia'=> 'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required',
            'aula_id'=>'required',
            'curso_id'=>'required',
        ]);
        $create=Horario::create($request->all());
        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horario=Horario::find($id);
        return response()->json($horario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request,[
            'dia'=>'required',
            'hora_inicio'=>'required',
            'hora_fin'=>'required',
            'aula_id'=>'required',
            'curso_id'=>'required',
        ]);
        $edit=Horario::find($id)->update($request->all());
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
        Horario::find($id)->delete();
        return response()->json(['done']);
    }
    public function findHorario($curso)
    {
        $horario = Horario::where('curso_id','=',$curso)->orderBy('hora_inicio','asc')->get();
        return response()->json($horario);
    }
}
