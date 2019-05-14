<?php

namespace App\Http\Controllers;

use App\Reticula;
use Illuminate\Http\Request;

use App\Usuarios;
use DB;
use App\Sce;

use Illuminate\Support\Facades\Session;
use App\Materias;
use App\Especialidades;

class MateriasController extends Controller
{
    public function index() {
        $data = Materias::all ();
        $data2=Especialidades::pluck('cveesp','descripcion');

        return view ( 'Materias', compact('data2'))->withData ( $data );
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

            $data = new  Materias;

            $data->cvemat= ($request->cvemat_show);
            $data->nombre = ($request->nombre_show);
            $data->creditos = ($request->creditos_show);
            $data->horasprofesor = ($request->horasprofesor_show);
            $data->horasautonomo = ($request->horasautonomo_show);
            $data->semestre = ($request->semestre_show);
            $data->save ();
            DB::commit();

                $data2 = new  Reticula();
                $data2->cvemat= ($request->cvemat_show);
                $data2->cveesp = ($request->cveesp);
                $data2->save ();
                DB::commit();

                return redirect('/Materias');

                } catch (\Exception $e) {
        DB::rollback();

        return redirect('/Materias')->with('servicio','Ya has registrado esta Materia-> '.$request->nombre_show);
            }
        }

    }


    public function updateTres( Request $input)
    {

    }


    public function delete(Request $request)
    {
        Materias::find ( $request->id )->delete ();
        return response ()->json ();

    }





    public function search(Request $request)
    {

    }


    public function serviceWeb()
    {
    }


    public function serviceWebid( int $id)
    {
    }

}
