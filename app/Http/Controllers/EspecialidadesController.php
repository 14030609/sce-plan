<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuarios;
use DB;
use App\Sce;

use Illuminate\Support\Facades\Session;
use App\Especialidades;

class EspecialidadesController extends Controller
{
    public function index() {
        $data = Especialidades::all ();
        return view ( 'Especialidades' )->withData ( $data );
    }
    public function store(Request $request)
    {
    }
    public function create(Request $request)
    {

    }
    public function crea($request)
    {

    }

    public function Listas(Request $request)
    {
    }
    public function edi(Request $request)
    {
    }
    public function update(Request $request)
    {


        $rules = array (
            'nombre' => 'required',
            'creditos' => 'required',
            'horasprofesor' => 'required',
            'horasautonomo' => 'required',
            'semestre' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (

                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $data = Materias::find ( $request->id );

            $data->nombre = ($request->nombre);
            $data->creditos = ($request->creditos);
            $data->horasprofesor = ($request->horasprofesor);
            $data->horasautonomo = ($request->horasautonomo);
            $data->semestre = ($request->semestre);
            $data->save ();

            $data->refresh();
            return response ()->json ( $data );

        }

    }
    public function updateDos( Request $request)
    {
        if($request['submitbutton']==='add')
        {
            try {

                $data = new  Especialidades();

                $data->cveesp= ($request->cveesp);
                $data->descripcion = ($request->descripcion);
                $data->save ();
                DB::commit();
                return redirect('/Especialidades');

            } catch (\Exception $e) {
                DB::rollback();

                return redirect('/Especialidades')->with('servicio','Ya has registrado este taller -> '.$request->nombre);
            }
        }

    }


    public function updateTres( Request $input)
    {

    }


    public function delete(Request $request)
    {
        Especialidades::find ( $request->id )->delete ();
        return response ()->json ();
    }



    public function search(Request $request){
//        $movies = Movie::where('name','like','%'.$request->name.'%')->get();
        //      return \View::make('list', compact('movies'));


//dd($request);
        //      print_r($request->name);

        $data = Talleres::where('cvetaller','like','%'.$request->name.'%')->get();

        echo "<pre>";
//       print_r($data);
        //      return view ( 'Talleres' )->withData ( $data );

        return \View::make('Talleres')->withData ( $data );

    }

    public function serviceWeb()
    {
    }


    public function serviceWebid( int $id)
    {
    }

}
