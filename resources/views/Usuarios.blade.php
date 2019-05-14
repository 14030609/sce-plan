@extends('welcome')
@section('add')

<head>
    <title>Datatables implementation in laravel - justlaravel.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
            src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script
            src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<style>
</style>
<body>
<br><br><br><br><br>
<button action="{{ route('Usuarios.create') }}"> add </button>
<button class="add-modal btn btn-info"
      <span class="glyphicon glyphicon-edit"></span> ADD
</button>





<center>

        {{ Form::open(array('action' => 'UsuariosController@updateDos', 'method' => 'post', 'class'=>'navbar-form navbar')) }}
        <div class="form-group">
            {{ Form::text('direccion_show', '', array('id' => 'direccion_show', 'class' => 'form-control input-sm', 'placeholder' => 'direccion')) }}

            <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
       {{ Form::close() }}

</center>
<div class="container ">

    {{ csrf_field() }}

    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">email</th>
                <th class="text-center">contrasenia</th>
                <th class="text-center">direccion</th>
                <th class="text-center">telefono</th>
                <th class="text-center">sexo</th>
                <th class="text-center">nombre</th>
                <th class="text-center">curp</th>
                <th class="text-center">rol</th>
                <th class="text-center">actios</th>
            </tr>
            </thead>



            @foreach($data as $item)
<?php
$_SESSION['email']=$item->email;





$query2= \App\Usuarios::join('usuarios_rol', 'usuarios.email',   '=', 'usuarios_rol.email')
    ->join('rol', 'usuarios_rol.id_rol', '=', 'rol.id_rol')
    ->select('rol.rol')
    ->where('usuarios.email','=',$item->email)
    ->get();

$query="select * from usuarios u  where u.email='".$item->email."'";
$rol=DB::select($query);

//echo "<pre>";
//print_r($rol[0]->email);
$email=$rol[0]->email;
//echo "<br>";



//print_r(sizeof($query2));
//print_r($query2[0]->rol);
$rol=$query2[0]->rol;

if ($rol=='Docente')
{
    $rol='segun que Maestro';
}else
{

   $query4="select * from usuarios u inner join alumnos a on a.email=u.email where u.email='".$item->email."'";
    $rol4=DB::select($query4);
    //print_r($rol4[0]->nua);
   // $email=$rol[0]->email;
    echo "<br>";
    $query3="select * from calificaciones where nua='1235'";
    $calificaciones=DB::select($query3);
  //  print_r($calificaciones);
    echo "<br>";
//    print_r($calificaciones[0]->cvemat);

}

?>


            <tr class="item{{$item->email}}">
                <td>{{$email}}</td>
                <td>{{$item->contrasenia}}</td>
                <td>{{$item->direccion}}</td>
                <td>{{$item->telefono}}</td>
                <td>{{$item->sexo}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->curp}}</td>
                <td>{{$rol}}</td>
                <td>


                        <button class="show-modal btn btn-success"
                                data-email="{{$item->email}}"
                                data-contrasenia="{{$item->contrasenia}}"
                                data-direccion="{{$item->direccion}}"
                                data-telefono="{{$item->telefono}}"
                                data-sexo="{{$item->sexo}}"
                                data-nombre="{{$item->nombre}}"
                                data-curp="{{$item->curp}}">

                            <span class="glyphicon glyphicon-eye-open"></span> Show</button>

                        <button class="edit-modal btn btn-info"
                                data-info="{{$item->email}},{{$item->contrasenia}},{{$item->direccion}},{{$item->telefono}},{{$item->sexo}},{{$item->nombre}},{{$item->curp}}">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>

                        <button class="delete-modal btn btn-danger" href=""
                                data-info="{{$item->email}},{{$item->contrasenia}},{{$item->direccion}},{{$item->telefono}},{{$item->sexo}},{{$item->nombre}},{{$item->curp}}">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>


                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>

            </div>
            <div class="modal-body">
                    <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="contrasenia">contrasenia</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="contrasenia">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion">Direccion:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="direccion">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono">Telefono:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="telefono">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="sexo">Sexo:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="sexo">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nombre">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="curp">Curp:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="curp">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="showModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                {{ Form::open(array('action' => 'UsuariosController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        {{ Form::hidden('email', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email Address')) }}
                        {{ Form::email('email_show', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email Address','disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="contrasenia">Contraseña:</label>
                    <div class="col-sm-10">

                    {{ Form::password('contrasenia_show', array('id' => 'contrasenia_show', 'class' => 'form-control input-sm', 'placeholder' => 'Password', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="direccion">Direccion:</label>
                    <div class="col-sm-10">
                        {{ Form::text('direccion_show', '', array('id' => 'direccion_show', 'class' => 'form-control input-sm', 'placeholder' => 'direccion', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="telefono">telefono:</label>
                    <div class="col-sm-10">
                        {{ Form::text('telefono_show', '', array('id' => 'telefono_show', 'class' => 'form-control input-sm', 'placeholder' => 'telefono', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sexo">sexo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('sexo_show', '', array('id' => 'sexo_show', 'class' => 'form-control input-sm', 'placeholder' => 'sexo', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nombre">nombre:</label>
                    <div class="col-sm-10">
                        {{ Form::text('nombre_show', '', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'nombre', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="curp">curp:</label>
                    <div class="col-sm-10">
                        {{ Form::text('curp_show', '', array('id' => 'curp_show', 'class' => 'form-control input-sm', 'placeholder' => 'curp', 'disabled')) }}
                    </div>
                </div>


                {!! Form::submit( 'calificaciones', ['class' => 'btn btn-info btn-block', 'name' => 'submitbutton', 'value' => 'calificaciones'])!!}

                {!! Form::submit( 'kardex', ['class' => 'btn btn-success btn-block', 'name' => 'submitbutton', 'value' => 'kardex']) !!}

                {!! Form::submit( 'horario', ['class' => 'btn btn-secondary btn-block', 'name' => 'submitbutton', 'value' => 'horario']) !!}
                <hr>
                {{ Form::close() }}



                </form>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class='glyphicon glyphicon-remove'></span> Close
                </button>

            </div>

                            </div>
        </div>
    </div>

<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                {{ Form::open(array('action' => 'UsuariosController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        {{ Form::hidden('email', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email Address')) }}

                        {{ Form::email('email_show', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email Address', 'required' => 'required' )) }}
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="contrasenia">Contraseña:</label>
                    <div class="col-sm-10">

                        {{ Form::password('contrasenia_show', array('id' => 'contrasenia_show', 'class' => 'form-control input-sm', 'placeholder' => 'Password','required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="direccion">Direccion:</label>
                    <div class="col-sm-10">
                        {{ Form::text('direccion_show', '', array('id' => 'direccion_show', 'class' => 'form-control input-sm', 'placeholder' => 'direccion','required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="telefono">telefono:</label>
                    <div class="col-sm-10">
                        {{ Form::text('telefono_show', '', array('id' => 'telefono_show', 'class' => 'form-control input-sm', 'placeholder' => 'telefono','required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sexo">sexo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('sexo_show', '', array('id' => 'sexo_show', 'class' => 'form-control input-sm', 'placeholder' => 'sexo','required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nombre">nombre:</label>
                    <div class="col-sm-10">
                        {{ Form::text('nombre_show', '', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'nombre','required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="curp">curp:</label>
                    <div class="col-sm-10">
                        {{ Form::text('curp_show', '', array('id' => 'curp_show', 'class' => 'form-control input-sm', 'placeholder' => 'curp','required' => 'required')) }}
                    </div>
                </div>


                {!! Form::submit( 'add', ['class' => 'btn btn-success btn-block', 'name' => 'submitbutton', 'value' => 'add']) !!}

                <hr>
                {{ Form::close() }}



                </form>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class='glyphicon glyphicon-remove'></span> Close
                </button>

            </div>

        </div>
    </div>
</div>

</div>
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

<script>

    $(document).on('click', '.add-modal', function() {
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('calendario');
        $('.modal-title').text('ADD');
        $('#email_show').val($(this).data('email'));
        $('#contrasenia_show').val($(this).data('contrasenia'));
        $('#direccion_show').val($(this).data('direccion'));
        $('#telefono_show').val($(this).data('telefono'));
        $('#sexo_show').val($(this).data('sexo'));
        $('#nombre_show').val($(this).data('nombre'));
        $('#curp_show').val($(this).data('curp'));

        $('#addModal').modal('show');
    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

    // Show a post
    $(document).on('click', '.show-modal', function() {
        $('#calendatioButton').text("Calendario");
        $('#calendatioButton').removeClass('glyphicon-check');
        $('#calendatioButton').addClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('calendario');
        $('.modal-title').text('Show');
        $('#email_show').val($(this).data('email'));
        $('#contrasenia_show').val($(this).data('contrasenia'));
        $('#direccion_show').val($(this).data('direccion'));
        $('#telefono_show').val($(this).data('telefono'));
       $('#sexo_show').val($(this).data('sexo'));
       $('#nombre_show').val($(this).data('nombre'));
       $('#curp_show').val($(this).data('curp'));

        $('#showModal').modal('show');
    });

    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#contrasenia').val(details[1]);
        $('#direccion').val(details[2]);
        $('#telefono').val(details[3]);
        $('#sexo').val(details[4]);
        $('#nombre').val(details[5]);
        $('#curp').val(details[6]);
    }


    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editUsuario',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'contrasenia': $('#contrasenia').val(),
                'direccion': $('#direccion').val(),
                'telefono': $('#telefono').val(),
                'sexo': $('#sexo').val(),
                'nombre': $('#nombre').val(),
                'curp': $('#curp').val(),
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.fname) {
                        $('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.lname) {
                        $('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                }
                else {

                    $('.error').addClass('hidden');
                    $('.item' + data.id).replaceWith("<tr class='item" +
                        data.id +
                        "'><td>" + data.id +
                        "</td><td>" + data.contrasenia +
                        "</td><td>" + data.direccion +
                        "</td><td>" + data.telefono +
                        "</td><td>" + data.sexo +
                        "</td><td>" + data.nombre +
                        "</td><td>" + data.curp +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.contrasenia+","
                        +data.direccion+","
                        +data.telefono+","
                        +data.sexo+","
                        +data.nombre+","
                        +data.curp+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.contrasenia+","
                        +data.direccion+","
                        +data.telefono+","
                        +data.sexo+","
                        +data.nombre+","
                        +data.curp+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {

        alert("si entra")
           $.ajax({
            type: 'GET',
            url: '{{ route('Usuarios.create') }}',
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });

    $('.modal-footer').on('click', '.calendario', function() {



        alert("ver calendario"+$("#email_show").val())
        $.ajax({
            type: 'POST',
            url: '/editUs',
            data:{
                'id': $("#email_show").val()},
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });

    });



</script>

</body>
</html>


@stop