<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuarios;
use DB;
use App\Sce;

use Illuminate\Support\Facades\Session;
use App\Listas;

class UsuariosController extends Controller
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


    /*    print_r($input['email']);

        print_r($input['contrasenia_show']);
        print_r($input['telefono_show']);
        print_r($input['direccion_show']);

      */  $email=$input['email_show'];

        //print_r($input['submitbutton']);
        if($input['submitbutton']==='calificaciones')
        {

            $email=$input->email;
  //          print_r($email);

//            die();
  //          print_r($input->input());

    //        die();
//            $query="select l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from usuarios u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua where u.email ='$email'";
  //          $data=DB::select($query);

//return redirect('/Listas/'.$email);
        }else
        {
            if($input['submitbutton']==='add')
            {
                dd($input['email_show']);
            }else
            {
                if($input['submitbutton']==='kardex')
                {


                }else
                {
                    if($input['submitbutton']==='horario')
                    {
                        dd($input['email_show']);
                    }else
                    {

                        try {

                        DB::table('serviciosocial')->insert(
                            array(
                                'institucion'     =>   $request->institucion,
                                'fechainicio'   =>   $request->fechainicio,
                                'fechafinal'     =>   $request->fechafinal,
                                'direccion'     =>   $request->direccion,
                                'horassemana'     =>   $request->horassemana,
                                'descripcion'     =>   $request->descripcion,
                                'encargado'     =>   $request->encargado,
                                'nua'     =>   $nua,
                                'semestre'=> $semestre,
                                'cvesubprograma'=>$request->cvesubprograma

                            )
                        );
                        DB::commit();
                        $email=Session::get('usuario');
                        return redirect('/UsuariosPage/'.$email)->with('servicio','Ya has registrado tu servicio social de este semestre ');


                        } catch (\Exception $e) {
                            DB::rollback();
                            $email=Session::get('usuario');
                            return redirect('/UsuariosPage/'.$email)->with('error servicio','Ya has registrado tu servicio social de este semestre ');
                        }
                    }
                }

            }

            }
    }

    public function updateTres( Request $input)
    {

        $email=$input['email_show'];

        $contrasenia= $input['contrasenia_show'];
        if($input['submitbutton']==='Login')
        {

            $query="select * from usuarios where email ='$email'";
            $data=DB::select($query);
            echo "<pre>";
            print_r($data);

            /*session(['key' => 'value']);

            session(['store_id' => 'hola']);

            print_r(session('store_id'));
              */  $web = new Sce;
            $web->login($email, $contrasenia);


            print_r('si se regreso ');


       //     print_r($_SESSION['credenciales']['rol'][0]);

//            print_r($_SESSION);

            if ($_SESSION['credenciales']['rol'][0]=='Alumno')
            {

                print_r('es alumno');
    //    return redirect('/UsuariosPage');

                $email=Session::get('usuario');
                $query="SELECT nua,semestre FROM alumnos where email='$email'";
                $nua=DB::select($query);
                print_r($nua);

                Session::put('nua',$nua[0]->nua);
                Session::put('semestre',$nua[0]->semestre);

//                $NUA=Session::get('nua');
  //              print_r( $NUA[0]->nua);

//                print_r(Session::all());
                        return redirect('/UsuariosPage/'.$email);

            }else
            {
                if ($_SESSION['credenciales']['rol'][0]='Maestro')
                {
                    print_r('es maestro');


                    print_r(Session::all());
                    $email=Session::get('usuario');
                    $query="SELECT cvemae FROM maestros where email='$email'";

                    print_r($query);
                    $data=DB::select($query);

                    Session::put('cvemae',$data[0]->cvemae);

//                    print_r($data[0]->cvemae);

                    return redirect('/UsuariosMaestro/'.$email);

                }else
                {
                    if ($_SESSION['credenciales']['rol'][0]='Administrador')
                    {

                    }else
                    {

                    }
                }


            }


//return redirect('/List');
        }else
        {
            print_r($input['email_show']);

        }



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



