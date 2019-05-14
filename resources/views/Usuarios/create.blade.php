@extends('welcome')
@section('add')
<div class="container">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Agregar Usuario</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">add user</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-0">
                    {!! Form::open(['route' => 'Usuarios.store', 'method' => 'post', 'validate']) !!}
                    <div class="form-group">
                        {!! Form::label('full_name', 'Nombre Completo ') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('curp', 'curp ') !!}
                        {!! Form::text('curp', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fullname', 'email') !!}
                        {!! Form::text('email', 'nombre@gmail.com', ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fullname', 'contrasenia ') !!}
                        {!! Form::text('contrasenia', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fullname', 'sexo ') !!}
                        {!! Form::select('sexo', ['M' => 'Mujer', 'H' => 'Hombre']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('direccion', 'direccion') !!}
                        {!! Form::text('direccion', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefono', 'telefono ') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control' , 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('full_name', 'Rol') !!}
                        <select class="form-control" name="id_rol", id_rol="id_rol">
                            @foreach($category as $key => $value)
                            <option value="{{$value}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Siguiente', ['class' => 'btn btn-outline-success ' ] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>




            </div>

        </div>
    </div>



</div>
@stop
