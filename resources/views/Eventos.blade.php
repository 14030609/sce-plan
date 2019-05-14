@extends('welcome')
@section('add')
<!DOCTYPE html>
<html>
<head>
    <title>Datatables implementation in laravel - justlaravel.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="../asset/js/jquery-1.12.3.js"></script>
    <script src="../asset/js/jquery.dataTables.min.js"></script>
    <!--link rel="stylesheet" href="../asset/css/bootstrap.min.css"-->
    <script
        src="../asset/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="../asset/css/dataTables.bootstrap.min.css">
    <script
        src="../asset/js/bootstrap.min.js"></script>

</head>
<style>
</style>
<body>
<br><br><br>
<button class="add-modal btn btn-info"
<span class="glyphicon glyphicon-edit"></span> ADD
</button>
@if(session('servicio'))

<div class="alert alert-danger">
    {{session('servicio')}}
</div>
@endif


<div class="container ">

    {{ csrf_field() }}
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">id_evento</th>
                <th class="text-center">nombre</th>
                <th class="text-center">descripcion</th>
                <th class="text-center">email</th>
                <th class="text-center">actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->id_evento}}">
                <td>{{$item->id_evento}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->email}}</td>
                <td>
<?php

//echo "<pre>";
$rol=Session::get('credenciales');

//print_r($rol['rol'][0]);

if($rol['rol'][0]==='Alumno')
{

}else {

    echo '


    <button class="edit-modal btn btn-info"
                            data-info="' . $item->id_evento . ',' . $item->nombre . ',' . $item->descripcion . ',' . $item->email . '">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="' . $item->id_evento . ',' . $item->nombre . ',' . $item->descripcion . ',' . $item->email . '">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button>';

}
?>

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
                        <label class="control-label col-sm-2" for="nombre">nombre</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nombre">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descripcion">descripcion:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="descripcion">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">email:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="email">
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
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                {{ Form::open(array('action' => 'EventosController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="id_evento">id_evento:</label>
                    <div class="col-sm-10">
                        {{ Form::text('id_evento', '', array('id' => 'id_evento_show', 'class' => 'form-control input-sm', 'placeholder' => 'clave de taller', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="Evento">Evento:</label>
                    <div class="col-sm-10">
                        {{ Form::text('nombre','', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'Taller', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="descripcion">Descripcion:</label>
                    <div class="col-sm-10">
                        {{ Form::text('descripcion', '', array('id' => 'descripcion_show', 'class' => 'form-control input-sm', 'placeholder' => 'descripcion', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">email:</label>
                    <div class="col-sm-10">

                        <?php

                        $email=Session::get('usuario');
//                        print_r($email);
                        ?>

                        {{ Form::email('email_show', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' =>$email, 'disabled')) }}
                        {{ Form::hidden('email', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => $email)) }}

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
        $('#id_evento_show').val($(this).data('id_evento'));
        $('#nombre_show').val($(this).data('nombre'));
        $('#descripcion_show').val($(this).data('descripcion'));
        $('#email').val($(this).data('email'));
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

    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#nombre').val(details[1]);
        $('#descripcion').val(details[2]);
        $('#email').val(details[3]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editEvento',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'nombre': $('#nombre').val(),
                'descripcion': $('#descripcion').val(),
                'email': $('#email').val(),
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
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.nombre +
                        "</td><td>" + data.descripcion +
                        "</td><td>" + data.email +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.nombre+","
                        +data.descripcion+","
                        +data.email+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.nombre+","
                        +data.descripcion+","
                        +data.email+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteEvento',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>

</body>
</html>

@stop