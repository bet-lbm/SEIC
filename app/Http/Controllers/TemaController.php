<?php

namespace App\Http\Controllers;

use App\Tema;
use Illuminate\Http\Request;
use DB;
class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        return view('temas.index');
    }
    public function index()
    {
        $temas = Tema::orderBy('created_at', 'desc')->paginate(5);
        $response = [
            'pagination' => [
                'total' => $temas->total(),
                'per_page' => $temas->perPage(),
                'current_page' => $temas->currentPage(),
                'last_page' => $temas->lastPage(),
                'from' => $temas->firstItem(),
                'to' => $temas->lastItem(),
            ],
            'data' => $temas  ];
        return response()->json($response);
    }

    public function search(Request $request){
        $queryString=$request->input('queryString');
        $temas = Tema::where('tema','like','%'.$queryString.'%')
                      ->orWhere('fecha', 'like','%'.$queryString.'%')
                      ->latest()->paginate(10);
        $response = [
            'pagination' => [
                'total' => $temas->total(),
                'per_page' => $temas->perPage(),
                'current_page' => $temas->currentPage(),
                'last_page' => $temas->lastPage(),
                'from' => $temas->firstItem(),
                'to' => $temas->lastItem(),
            ],
            'data' => $temas 
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
        return view('temas.create');
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
            'tema'=>'required',
            'fecha'=>'required',
            'descripcion'=>'required',
            'horario_id'=>'required',
        ]);
        $create=Tema::create($request->all());
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tema::find($id)->delete();
        return response()->json(['done']);
    }
    public function combo(){
        $horarios=DB::table('horarios')
                     ->join('aulas','horarios.aula_id','=','aulas.id')
                     ->join('cursos','horarios.curso_id','=','cursos.id')
                     ->select('horarios.id','horarios.dia','horarios.hora_inicio','horarios.hora_fin','aulas.numero_aula','cursos.nombre')
                     ->get();
        return response()->json($horarios);
    }
    public function getTema($id){
        $temas = DB::table('temas')
                    ->join('horarios','temas.horario_id','=','horarios.id')
                    ->join('cursos','horarios.curso_id','=','cursos.id')
                    ->join('aulas','horarios.aula_id','=','aulas.id')
                    ->select('temas.id','temas.tema','temas.fecha','temas.descripcion','horarios.dia','horarios.hora_inicio','cursos.nombre','aulas.numero_aula')
                    ->where('temas.id','=',$id)->first();
        return response()->json($temas);
    }
}
