<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;

use App\Oportunidades;

class OportunidadesController extends Controller
{
    public function index() {
        $data = Oportunidades::all ();
        return view ( 'Oportunidades        ' )->withData ( $data );
     }
    public function store(Request $request)
    {


    }
    public function create()
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request)
    {
        DB::table('usuarios')->insert(
            array(
                'email'     =>   '1',
                'contrasenia'   =>   'Dayle',
                'direccion'     =>   '1',
                'telefono'     =>   '1',
                'sexo'     =>   '1',
                'nombre'     =>   '1',
                'curp'     =>   '1'
            )
        );

    }
    public function delete(Request $request)
    {
//        Usuarios::find ( $request->id )->delete ();
        DB::table('usuarios')->insert(
            array(
                'email'     =>   '1',
                'contrasenia'   =>   'Dayle',
                'direccion'     =>   '1',
                'telefono'     =>   '1',
                'sexo'     =>   '1',
                'nombre'     =>   '1',
                'curp'     =>   '1'
            )
        );

//        return view('/UsuariosPage');
//        return response ()->json ();

        return redirect('/UsuariosPage')->back();
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


/*
 *      $('#email').val($(this).data('email'));
        $('#contrasenia').val($(this).data('contrasenia'));
        $('#direccion').val($(this).data('direccion'));
        $('#telefono').val($(this).data('telefono'));
        $('#nombre').val($(this).data('nombre'));
        $('#sexo').val($(this).data('sexo'));
        $('#curp').val($(this).data('curp'));

 */
/*                            data-id="{{$item->email}}"
                            data-title="{{$item->contreasenia}}"
                            data-content="{{$item->direccion}}"
                            data-telefono="{{$item->telefono}}"
                            data-sexo="{{$item->sexo}}"
                            data-nombre="{{$item->nombre}}"
                            data-curp="{{$item->curp}}"
*/