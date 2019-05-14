
<?php

//echo "<pre>";
//print_r(Session::all());

//Session::flush();

$query="select * from serviciosocial";
//         print_r($query);
$data2=DB::select($query);
//print_r($data);


if($data2==null)

{


}else{

   $hola= Session::all();

    $hola= Session::get('error servicio');
echo '  
      <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

   <div>

    <div class="alert alert-danger">
        '.$hola.'
    </div>

</div>';


die();
}
?>

<div class="container">

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

<br>



    <div class="panel panel-info">
        <div class="panel-heading">Servicio Social</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de servicio Social</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-0">

                    {{ Form::open(array('action' => 'ServicioSocialController@create', 'method' => 'post')) }}
                    <div class="form-group">
                        {!! Form::label('full_name', 'Institucion ') !!}
                        {!! Form::text('institucion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fecha', 'Fecha de inicio ') !!}
                        {!! Form::date('fechainicio', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha', 'Fecha de Termino ') !!}
                        {!! Form::date('fechafinal', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fullname', 'Direccion') !!}
                        {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fullname', 'horas x semana ') !!}
                        {!! Form::text('horassemana', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>


                    <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('full_name', 'Subprograma') !!}
                                <select class="form-control" name="cvesubprograma" id="cvesubprograma">
                                    @foreach($data as $key => $value)
                                    <option value="{{$value}}"> {{$value}} ->{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>

                    </div>

                    <div class="form-group">
                        {!! Form::label('fullname', 'Descripcion ') !!}
                        {!! Form::text('descripcion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('encargado', 'Encargado en la Institucion donde se relaiza el servicio ') !!}
                        {!! Form::text('encargado', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">

                    </div>

                    <div class="form-group">
                        {!! Form::submit('Aceptar', ['class' => 'btn btn-outline-success ' ] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>




            </div>

        </div>
    </div>



</div>
