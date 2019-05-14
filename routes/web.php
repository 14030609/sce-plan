<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | This file is where you may define all of the routes that are handled
 * | by your application. Just tell Laravel the URIs it should respond
 * | to using a Closure or controller method. Build something great!
 * |
 */
use App\Datos;
use App\Materias;
use App\Talleres;
use App\Usuarios;
use App\Oportunidades;
use App\Especialidades;
use App\Alumnos;
use App\Reticula;
use App\Maestros;
use App\Kardex;
use App\Eventos;
use App\Horario;
use App\Listas;
use App\InscribirTaller;
use App\Servicio;
use App\SubprogramasServicio ;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


Route:: get('/page','UsuariosController@crea')->name('Usuarios.createDos');

Route::post ( '/List','UsuariosController@updateDos');

Route::post ( '/SSocial','ServicioSocialController@create');

Route::post ( '/LoginU','LoginController@updateDos');

Route::post ( '/List3','UsuariosController@updateTres');

//--------------------------------------------------------------------//
//--------------------------Login ------------------------------------//
Route::get('/login', function () {
    return view('login');
});
//--------------------------end Login -------------------------------//
//-------------------------------------------------------------------//

Route::get('/admin', function () {
    return view('welcome');
})->middleware('auth');;



Route::post ( '/editUs', function (Request $request) {
    return view ( 'UsuariosPage' );

} )->middleware('auth');;


Route::get('/page/{email}', ['as' => '/page', 'uses'=>'UsuariosController@crea']);


Route::get ( '/UsuariosPage/{email}', function ( $email) {
    $query="				SELECT * FROM usuarios u inner join alumnos a on u.email=a.email inner join especialidad e on a.cveesp=e.cveesp  where u.email ='$email'";
    $query2="select ma.nombre, l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 
from usuarios u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua  inner join materias ma on ma.cvemat=l.cvemat  where u.email ='efrain@gmail.com'";

    $query3="SELECT  distinct  h.id_grupo, d.dia,m.nombre as materia, h.horainicia, h.horatermina, (SELECT nombre FROM usuarios where email=(SELECT email FROM  maestros where cvemae=ma.cvemae)) as maestro
FROM usuarios u inner join alumnos a on a.email=u.email 
inner join listas l on l.nua=a.nua 
inner join grupos g on g.nogpo=l.nogpo 
inner join grupo gr on gr.id_grupo=g.nogpo 
inner join horario h on h.id_grupo=gr.id_grupo
inner join dia d on d.id_dia=h.id_dia
inner join materias m on m.cvemat=h.cvemat
inner join maestros ma on ma.cvemae=g.cvemae";


    $query4="SELECT * FROM inscripciontaller i inner join talleres t on i.cvetaller=t.cvetaller inner join alumnos a on a.nua=i.nua where a.email ='$email'";

    $query5="SELECT * FROM serviciosocial s inner join alumnos a on a.nua=s.nua where a.email ='$email'";
    $query6="SELECT * FROM eventos where email ='$email'";

    $data=DB::select($query);
    $data2=DB::select($query2);
    $data3=DB::select($query3);
    $data4=DB::select($query4);
    $data5=DB::select($query5);
    $data6=DB::select($query6);

    return view ( 'UsuariosPage',compact('data2','data', 'data3','data4','data5','data6'));
} );






Route::get ( '/UsuariosMaestro/{email}', function ( $email) {
    $query="SELECT * FROM usuarios u  where u.email ='$email'";
    $query2="select ma.nombre, l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from usuarios u 
inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua  inner join materias ma on ma.cvemat=l.cvemat  where u.email ='efrain@gmail.com'";

    $data=DB::select($query);
//    $data2=DB::select($query2);

//echo "<pre>";


//        print_r(                   Session::get('email'));

    return view ( 'UsuariosMaestro',compact('data'));
} );


Route::get ( '/AlumnosCalificar', function () {


    $cvemae= Session::get('cvemae');

    $query="SELECT  a.nua, u.nombre, g.nogpo,ma.cvemat, ma.nombre as materia, l.parcial1,l.parcial2,l.parcial3
FROM usuarios u inner join alumnos a on u.email=a.email
  inner join listas l on  l.nua=a.nua 
inner join grupos g on g.nogpo= l.nogpo and g.cvemat= l.cvemat 
inner join maestros m on m.cvemae=g.cvemae
inner join materias ma on ma.cvemat=l.cvemat
where m.cvemae='$cvemae'";
    $data=DB::select($query);

           return view ( 'AlumnosCalificar' )->withData ( $data );
} );




Route::resource('Usuarios','UsuariosController') ;
Route::post ( '/editOportunidad','OportunidadesController@update');

Route::post ( '/deleteOportunidad','OportunidadesController@delete');


Route::post ( '/Page', function (Request $request) {
  $data = Usuarios::find ( $request->id )  ;

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
      //return redirect()->route('/UsuariosPage');
    redirect ( '/UsuariosPage' );

} );




Route::get ( '/principal', function () {
    return view ( 'welcome' );
} );


Route::get ( '/dat/datos', function () {
    $data = Datos::all();

//    $data=DB::select("select * from datatables_data");

    return view ( 'welcomeDatos' )->withData ( $data );
} );


Route::post ( '/editItem', function (Request $request) {




    $rules = array (
        'data2' => 'required',
        'data3' => 'required');
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Datos::find ( $request->id );

        $data->data2 = ($request->data2);
        $data->data3 = ($request->data3);
        $data->save ();
        return response ()->json ( $data );
    }
} );
Route::post ( '/deleteItem', function (Request $request) {
    Datos::find ( $request->id )->delete ();
    return response ()->json ();
} );


//-------------------------------------------------------------------------------
//---------------------------Materias--------------------------------------------
//-------------------------------------------------------------------------------
Route::post ( '/Materiasadd','MateriasController@updateDos');

Route::get ( '/Materias','MateriasController@index');

Route::post ( '/editMateria', function (Request $request) {

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

);
Route::post ( '/deleteMateria','MateriasController@delete' );

Route::post ( '/Materia', function (Request $request) {
//    Materias::find ( $request->id )->delete ();

    $data = Materias::where('cvemat',$request->id)->update(
        ['nombre'=>$request->nombre,
            'creditos'=>$request->creditos,
            'horasprofesor'=>$request->horasprofesor,
            'horasautonomo'=>$request->horasautonomo,
            'semestre'=>$request->semestre]);


    return response ()->json ();
} );


//-------------------------------------------------------------------------------
//-------------------------------------Talleres----------------------------------
//-------------------------------------------------------------------------------
Route::post ( '/addMaterias','TalleresController@updateDos');
Route::get ( '/Talleres','TalleresController@index');
Route::post( '/Talleres', ['as' => 'talleres/search', 'uses'=>'TalleresController@search']);
Route::get ( '/Talleres/{email}', function ( $email) {
    $data = Talleres::all ();
    return view ( 'InscribirTaller' )->withData ( $data );
} );

Route::post ( '/inscribirTaller', function (Request $request) {
    $email=Session::get('emaill');
    $nua=Session::get('nua');
    $semestre=Session::get('semestre');

    DB::table('inscripciontaller')->insert(
        ['cvetaller' => $request->id, 'nua' => $nua,'semestre'=>$semestre]);


    return response ()->json ();
   return redirect('/UsuariosPage/'.$email.'');

} );

Route::post ( '/editTaller', function (Request $request) {

    $rules = array (
        'nombre' => 'required',
        'instructor' => 'required',
        'horario' => 'required',
        'lugar' => 'required',
        'cupo' => 'required',
        'requisitos' => 'required'

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Talleres::find ( $request->id );

        $data->nombre = ($request->nombre);
        $data->instructor = ($request->instructor);
        $data->horario = ($request->horario);
        $data->lugar = ($request->lugar);
        $data->cupo = ($request->cupo);
        $data->requisitos = ($request->requisitos);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteTaller', 'TalleresController@delete');

//-------------------------------------------------------------------------------
//-------------------------------------Usuarios----------------------------------
//-------------------------------------------------------------------------------
Route::get ( '/Usuarios', function () {
    $data = Usuarios::all ();
    return view ( 'Usuarios' )->withData ( $data );
} );


Route::post ( '/editUsuario', function (Request $request) {

    $rules = array (
        'contrasenia' => 'required',
        'direccion' => 'required',
        'telefono' => 'required',
        'sexo' => 'required',
        'nombre' => 'required',
        'curp' => 'required'

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Usuarios::find ( $request->id );

        $data->contrasenia= ($request->contrasenia);
        $data->direccion = ($request->direccion);
        $data->telefono = ($request->telefono);
        $data->sexo = ($request->sexo);
        $data->nombre = ($request->nombre);
        $data->curp = ($request->curp);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteUsuario', function (Request $request) {
    Usuarios::find ( $request->id )->delete ();
    return response ()->json ();
} );

//-------------------------------------------------------------------------------
//-------------------------------------Servicio----------------------------------
//-------------------------------------------------------------------------------
Route::get ( '/Servicio', 'ServicioSocialController@index');
Route::post ( '/editServicio', function (Request $request) {
    $rules = array (
        'institucion' => 'required',
        'fechainicio' => 'required',
        'fechafinal' => 'required',
        'horassemana' => 'required',
        'descripcion' => 'required',
        'encargado' => 'required',
        'direccion' => 'required',
        'cvesubprograma' => 'required',
        'nua' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (
            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {
        $data = Servicio::find ( $request->id );
        $data->institucion= ($request->institucion);
        $data->fechainicio = ($request->fechainicio);
        $data->fechafinal = ($request->fechafinal);
        $data->horassemana= ($request->horassemana);
        $data->descripcion = ($request->descripcion);
        $data->encargado = ($request->encargado);
        $data->direccion = ($request->direccion);
        $data->nua = ($request->nua);
        $data->cvesubprograma = ($request->cvesubprograma);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteServicio','ServicioSocialController@delete' );

Route::get ( '/registroSSocial', function (  ) {
//    $data = Listas::all ();
    $data=SubprogramasServicio::pluck('cvesubprograma','subprograma');

    return view ( 'registroSSocial', compact('data') );
} );

//-------------------------------------------------------------------------------
//-------------------------------------Oportunidades----------------------------------
//-------------------------------------------------------------------------------

Route::get ( '/Oportunidades', 'OportunidadesController@index');
//Route::post ( '/editOportunidad','OportunidadesController@update');


Route::post ( '/editOportunidad', function (Request $request) {

    $rules = array (
        'descripcion' => 'required',

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Oportunidades::find ( $request->id );

        $data->descripcion= ($request->descripcion);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteOportunidad', function (Request $request) {
    Oportunidades::find ( $request->id )->delete ();
    return response ()->json ();
} );

//-------------------------------------------------------------------------------
//-------------------------------------Alumnos----------------------------------
//-------------------------------------------------------------------------------
Route::get ( '/Alumnos', function () {
    $data = Alumnos::all ();
    return view ( 'Alumnos' )->withData ( $data );
} );


Route::post ( '/editAlumno', function (Request $request) {

    $rules = array (
        'cveesp' => 'required',
        'email' => 'required',
        'semestre' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data =Alumnos::find ( $request->id );

        $data->cveesp= ($request->cveesp);
        $data->email = ($request->email);
        $data->semestre = ($request->semestre);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteAlumno', function (Request $request) {
    Alumnos::find ( $request->id )->delete ();
    return response ()->json ();
} );

//-------------------------------------------------------------------------------
//-------------------------------------Especialidades----------------------------------
//-------------------------------------------------------------------------------

Route::post ( '/addEspecialidades','EspecialidadesController@updateDos');

Route::get ( '/Especialidades','EspecialidadesController@index');

Route::post ( '/editEspecialidad', function (Request $request) {

    $rules = array (
        'descripcion' => 'required',

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Especialidades::find ( $request->id );

        $data->descripcion= ($request->descripcion);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteEspecialidad','EspecialidadesController@delete' );

//-------------------------------------------------------------------------------
//-------------------------------------Reticula----------------------------------
//-------------------------------------------------------------------------------

Route::get ( '/Reticula', function () {
    $data = Reticula::all ();
    $data2=Especialidades::pluck('cveesp','descripcion');
    $data3=Materias::pluck('cvemat','nombre');


    return view ( 'Reticula',compact('data2','data3') )->withData ( $data );
} );

Route::post ( '/editReticula', function (Request $request) {

    $rules = array (
        'cvemat' => 'required'

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Reticula::find ( $request->id );

        $data->cveesp= ($request->cveesp);
        $data->cvemat= ($request->cvemat);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteReticula', function (Request $request) {
    Reticula::find ( $request->id )->delete ();
    return response ()->json ();
} );
//-------------------------------------------------------------------------------
//-------------------------------------Maestros----------------------------------
//-------------------------------------------------------------------------------

Route::get ( '/Maestros', function () {
    $data = Maestros::all ();
    return view ( 'Maestros' )->withData ( $data );
} );
Route::post ( '/MaestrosList','MaestrosController@updateDos');


Route::post ( '/editMaestro', function (Request $request) {

    $rules = array (
        'noempleado' => 'required',
        'email' => 'required',
        'rfc' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (
            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data =Maestros::find ( $request->id );

        $data->noempleado= ($request->noempleado);
        $data->email = ($request->email);
        $data->rfc = ($request->rfc);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteMaestro', function (Request $request) {
    Maestros::find ( $request->id )->delete ();
    return response ()->json ();
} );
//-------------------------------------------------------------------------------
//-------------------------------------Kardex----------------------------------
//-------------------------------------------------------------------------------

Route::get ( '/Kardex', function () {
//    $data = Kardex::all ();

    $query="SELECT k.nua,m.cvemat, m.nombre,k.calificacion, o.descripcion as oportunidad, m.creditos, k.semestre FROM kardex k inner join  materias m on m.cvemat=k.cvemat inner join oportunidad o on o.oportunidad=k.oportunidad";
    $data=DB::select($query);


    $data2=Alumnos::pluck('email','nua');
    $data3=Materias::pluck('cvemat','nombre');
    $data4=Oportunidades::pluck('oportunidad','descripcion');

    return view ( 'Kardex',compact('data2','data3','data4') )->withData ( $data );
} );


Route::get ( '/Kardex/{email}', function ( $email) {
    $nua=Session::get('nua');

    $query="SELECT k.nua,m.cvemat, m.nombre,k.calificacion, o.descripcion as oportunidad, m.creditos, k.semestre FROM kardex k inner join  materias m on m.cvemat=k.cvemat inner join oportunidad o on o.oportunidad=k.oportunidad where k.nua ='$nua'";
    $data=DB::select($query);
    $data2=Alumnos::pluck('email','nua');
    $data3=Materias::pluck('cvemat','nombre');
    $data4=Oportunidades::pluck('oportunidad','descripcion');

    return view ( 'Kardex',compact('data2','data3','data4') )->withData ( $data );
} );

Route::post ( '/editKardex', function (Request $request) {

    $rules = array (
        'cvemat' => 'required',
        'nua' => 'required',
        'oportunidad' => 'required',
        'calificacion' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = Kardex::find ( $request->id );

        $data->nua= ($request->nua);
        $data->oportunidad= ($request->oportunidad);
        $data->calificacion= ($request->calificacion    );
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteReticula', function (Request $request) {
    Kardex::find ( $request->id )->delete ();
    return response ()->json ();
} );
//-------------------------------------------------------------------------------
//-------------------------------------Eventos----------------------------------
//-------------------------------------------------------------------------------
Route::post ( '/addEventos','EventosController@updateDos');
Route::get ( '/Eventos', 'EventosController@index' );

Route::get ( '/Eventos/{email}', function ( $email ) {
    $data = Eventos::all ();
    return view ( 'Eventos' )->withData ( $data );
} );

Route::post ( '/editEvento', function (Request $request) {
    $rules = array (
        'nombre' => 'required',
        'descripcion' => 'required',
        'email' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data =Eventos::find ( $request->id );

        $data->nombre= ($request->nombre);
        $data->descripcion = ($request->descripcion);
        $data->email = ($request->email);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteEvento','EventosController@delete');

//-------------------------------------------------------------------------------
//-------------------------------------Horarios----------------------------------
//-------------------------------------------------------------------------------
Route::get ( '/Horarios', function () {
    $data = Horario::all ();
    return view ( 'Horario' )->withData ( $data );
} );


Route::post ( '/editHorario', function (Request $request) {

    $rules = array (
        'cvemat' => 'required',
        'horainicia' => 'required',
        'horatermina' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

/*        $data =Horario::find ( $request->id );

        $data->cvemat= ($request->cvemat);
        $data->horainicia = ($request->horainicia);
        $data->horatermina = ($request->horatermina);
        $data->save ();
*/


            $data = Horario::where([['id_dia', '=', $request->id],['cvemat', '=', $request->cvemat]])->update(
                ['id_dia' => $request->id, 'cvemat' => $request->cvemat,'horainicia' => $request->horainicia,'horatermina' => $request->horatermina]);


        $data->refresh();
        return response ()->json    ($data);

    }
}

);

Route::post ( '/deleteHorario', function (Request $request) {
    Horario::where([['id_dia', '=', $request->id],['cvemat', '=', $request->cvemat]])->delete();
       return response ()->json ();
} );

//-------------------------------------------------------------------------------
//-------------------------------------Listas----------------------------------
//-------------------------------------------------------------------------------
/*Route::get ( '/Listas', function (  ) {
    $data = Listas::all ();

//    $nua='1235';
   // $data =Listas::where('nua',$nua)->get();
//echo "<pre>";

    return view ( 'Listas' )->withData ( $data);
} );

//Route::post('/Listas', array('as'=>'Listas','uses' => 'UsuariosController@Listas'));


/*Route::post('/Listas', function( Request $request) {
//    $user=session('user');
//    dd($request);

    print_r($request['user']);

 //   print_r($request->user);
//    print_r(session());


//    return view('UsuariosPage', $user);
})->name('newusr');


*/



Route::get ( '/Listas/{email}', function ( $email) {
    $query="select l.cvemat, l.nogpo, l.nua, l.parcial1, l.parcial2, l.parcial3 from usuarios u inner join alumnos a on a.email=u.email inner join listas l on l.nua=a.nua where u.email ='$email'";
    $data=DB::select($query);
       return view ( 'Listas' )->withData ( $data );
} );

Route::get ( '/Listas','ListasController@index');

    Route::post ( '/editList', function (Request $request) {

        $rules = array (
            'nogpo' => 'required',
            'nua' => 'required',
            'parcial1' => 'required',
            'parcial2' => 'required',
            'parcial3' => 'required'

        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {

            $data = Listas::where([['cvemat', '=', $request->id],['nogpo', '=', $request->nogpo],  ['nua', '=', $request->nua]])->update(
                ['parcial1' => $request->parcial1, 'parcial2' => $request->parcial2,'parcial3' => $request->parcial3]);


            $data->refresh();
            return response ()->json    ($data);

        }
    }

    );

Route::post ( '/deleteLista','ListasController@delete');



//-------------------------------------------------------------------------------
//----------------Subprogramas Servicio Social ----------------------------------
//-------------------------------------------------------------------------------

Route::post ( '/addSubprogramaServicio','SubprogramaservicioController@updateDos');

Route::get ( '/SubprogramasServicio','SubprogramaservicioController@index' );

Route::post ( '/editSubprogramasServicio', function (Request $request) {

    $rules = array (
        'subprograma' => 'required',

    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (

            'errors' => $validator->getMessageBag ()->toArray ()
        ) );
    else {

        $data = SubprogramasServicio::find ( $request->id );

        $data->subprograma= ($request->subprograma);
        $data->save ();

        $data->refresh();
        return response ()->json ( $data );

    }
}

);
Route::post ( '/deleteSubprogramaServicio','SubprogramaservicioController@delete' );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
