<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/25/19
 * Time: 10:17 AM
 */

namespace App\Http\Controllers;

use App\Usuarios;
use DB;
use App\Listas;

class LoginController
{
    public function index() {
        $data = Usuarios::all ();
        return view ( 'Oportunidades        ' )->withData ( $data );
    }
    public function store(Request $request)
    {


    }
    public function create(Request $request)
    {
        /*        DB::table('usuarios')->insert(
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
        */

//        return redirect('/UsuariosPage');

    }
    public function crea($request)
    {
        /*        DB::table('usuarios')->insert(
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
        *///

        print_r('hojl');
        print_r($request);


        $query4="select * from usuarios u inner join alumnos a on a.email=u.email ";
        $rol4=DB::select($query4);
        echo "<pre>";
        print_r($rol4);

        print_r($_SESSION);
//        return redirect('/UsuariosPage');

    }

    public function Listas(Request $request)
    {
//        print_r($request);
        /*        DB::table('usuarios')->insert(
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
        *///

//        dd($request);
        print_r('que poe');
        /*

        print_r('hojl');
        print_r($request);
*/
        //      $query="select l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from usuarios u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua where u.email ='$request'";

//        $query4="select * from usuarios u inner join alumnos a on a.email=u.email ";
        //    $data=DB::select($query);
        echo "<pre>";
        //      print_r($data);
        //    $data = Listas::all ();

//        print_r($_SESSION);
///        return redirect('/UsuariosPage');
        //  return view ( 'Listas' )->withData ( $data);
    }
    public function edit($id)
    {
    }
    public function update(Request $request)
    {

    }
    public function updateDos( Request $input)
    {
//        $input = Input::all();

        /*    print_r($input['email']);

            print_r($input['contrasenia_show']);
            print_r($input['telefono_show']);
            print_r($input['direccion_show']);

          */  $email=$input['email'];

        //print_r($input['submitbutton']);
        if($input['submitbutton']==='login')
        {

            $query="select l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from usuarios u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua where u.email ='$email'";
            //         print_r($query);
            $data=DB::select($query);
            echo "<pre>";
            print_r($data);

    ////        $data = Listas::all ();
            //         $data =Listas::where('nua','1235')->get();

//            return redirect()->route('/UsuariosPage');
            //          return view ( 'Listas' );

            //  return view ( '/Listas' )->withData ( $data );

////            return redirect('/Listas/'.$email);
//            return view ( 'Listas' )->withData ( $data );

//            return view('/UsuariosPage');

//            return redirect('/Listas',$data);
            //          $user='hola';

//            return redirect()->route('/Listas', $email   );
        }else
        {
            print_r($input['email_show']);

        }

        //        $input->all();

//        dd($input->all());




    }

    public function delete(Request $request)
    {
        Usuarios::find ( $request->id )->delete ();
        return response ()->json ();

    }





    public function search(Request $request)
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

        return view('UsuariosPage');

    }


    public function serviceWeb()
    {
    }


    public function serviceWebid( int $id)
    {
    }


}