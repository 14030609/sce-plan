<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Maestros;
use DB;
use App\Listas;

class MaestrosController extends Controller
{
    public function index() {
        $data = Maestros::all ();
        return view ( 'Maestros' )->withData ( $data );
    }
    public function store(Request $request)
    {


    }
    public function create(Request $request)
    {
/*        DB::table('Maestros')->insert(
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

//        return redirect('/MaestrosPage');

    }
    public function crea($request)
    {
        /*        DB::table('Maestros')->insert(
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

//            print_r($_SESSION);
//        return redirect('/MaestrosPage');

    }

    public function Listas(Request $request)
    {
//        print_r($request);
        /*        DB::table('Maestros')->insert(
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
  //      $query="select l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from Maestros u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua where u.email ='$request'";

//        $query4="select * from Maestros u inner join alumnos a on a.email=u.email ";
    //    $data=DB::select($query);
        echo "<pre>";
  //      print_r($data);
    //    $data = Listas::all ();

//        print_r($_SESSION);
///        return redirect('/MaestrosPage');
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

      */




    $email=$input['email'];
    print_r($email);

//dd($input['submitbutton']);

        //print_r($input['submitbutton']);
        if($input['submitbutton']==='calificaciones')
        {

            $query="select * from usuarios u inner join maestros a on a.email=u.email where u.email ='$email'";
  //         print_r($query);
            $data=DB::select($query);
                echo "<pre>";
                print_r($data);

           $data = Listas::all ();
   //         $data =Listas::where('nua','1235')->get();

//            return redirect()->route('/MaestrosPage');
  //          return view ( 'Listas' );

 //  return view ( '/Listas' )->withData ( $data );

return redirect('/Listas/'.$email);
//            return view ( 'Listas' )->withData ( $data );

//            return view('/MaestrosPage');

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
        Maestros::find ( $request->id )->delete ();
        return response ()->json ();

    }





    public function search(Request $request)
    {
        DB::table('maestros')->insert(
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

        return view('MaestrosPage');

    }


    public function serviceWeb()
    {
    }


    public function serviceWebid( int $id)
    {
    }

}
