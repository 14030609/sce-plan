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

<center>

    {!! Form::open(['route' => 'talleres/search', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}

    <div class="form-group">
        <label for="exampleInputName2">Cve mat</label>

        <input type="text" class="form-control" name = "name" >

        <!--input type="text" class="form-control" placeholder="Search"-->
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    {{ Form::close() }}



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
                <th class="text-center">cve taller</th>
                <th class="text-center">nombre</th>
                <th class="text-center">instructor</th>
                <th class="text-center">horario</th>
                <th class="text-center">lugar</th>
                <th class="text-center">cupo</th>
                <th class="text-center">requisitos</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->cvetaller}}">
                <td>{{$item->cvetaller}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->instructor}}</td>
                <td>{{$item->horario}}</td>
                <td>{{$item->lugar}}</td>
                <td>{{$item->cupo}}</td>
                <td>{{$item->requisitos}}</td>
                <td>

                    <button class="show-modal btn btn-success"
                            data-cvetaller="{{$item->cvetaller}}"
                            data-nombre="{{$item->nombre}}"
                            data-instructor="{{$item->instructor}}"
                            data-horario="{{$item->horario}}"
                            data-lugar="{{$item->lugar}}"
                            data-cupo="{{$item->cupo}}"
                            data-requisitos="{{$item->requisitos}}"
                    >

                        <span class="glyphicon glyphicon-eye-open"></span> Show</button>

                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->cvetaller}},{{$item->nombre}},{{$item->instructor}},{{$item->horario}},{{$item->lugar}},{{$item->cupo}},{{$item->requisitos}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->cvetaller}},{{$item->nombre}},{{$item->instructor}},{{$item->horario}},{{$item->lugar}},{{$item->cupo}},{{$item->requisitos}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button></td>

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
                        <label class="control-label col-sm-2" for="instructor">Instructor:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="instructor">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horario">Horario:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="horario">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lugar">Lugar:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="lugar">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cupo">Cupo:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="cupo">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="requisitos">Requisitos:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="requisitos">
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

                {{ Form::open(array('action' => 'TalleresController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cvetaller">cvetaller:</label>
                    <div class="col-sm-10">

                        {{ Form::text('cvetaller', '', array('id' => 'cvetaller_show', 'class' => 'form-control input-sm', 'placeholder' => 'clave del taller', 'disabled')) }}
                        {{ Form::hidden('cvetaller', '', array('id' => 'cvetaller_show', 'class' => 'form-control input-sm', 'placeholder' => 'Clave de la materia')) }}

                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="Taller">Taller:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nombre','', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'Taller', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="instructor">instructor:</label>
                    <div class="col-sm-10">
                        {{ Form::text('instructor', '', array('id' => 'instructor_show', 'class' => 'form-control input-sm', 'placeholder' => 'instructor', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="horario">horario:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horario', '', array('id' => 'horario_show', 'class' => 'form-control input-sm', 'placeholder' => 'horario', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="lugar">lugar:</label>
                    <div class="col-sm-10">
                        {{ Form::text('lugar', '', array('id' => 'lugar_show', 'class' => 'form-control input-sm', 'placeholder' => 'lugar', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cupo">cupo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('cupo', '', array('id' => 'cupo_show', 'class' => 'form-control input-sm', 'placeholder' => 'cupo', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="requisitos">requisitos:</label>
                    <div class="col-sm-10">
                        {{ Form::text('requisitos', '', array('id' => 'requisitos_show', 'class' => 'form-control input-sm', 'placeholder' => 'requisitos', 'disabled')) }}
                    </div>
                </div>
                <br>
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

                {{ Form::open(array('action' => 'TalleresController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="CveTaller">cveTallert:</label>
                    <div class="col-sm-10">

                        {{ Form::text('cvetaller', '', array('id' => 'cvetaller_show', 'class' => 'form-control input-sm', 'placeholder' => 'clave de taller', 'required' => 'required')) }}

                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="Taller">Taller:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nombre','', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'Taller', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="instructor">instructor:</label>
                    <div class="col-sm-10">
                        {{ Form::text('instructor', '', array('id' => 'instructor_show', 'class' => 'form-control input-sm', 'placeholder' => 'instructor', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="horario">horario:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horario', '', array('id' => 'horario_show', 'class' => 'form-control input-sm', 'placeholder' => 'Lunes,Martes,Miercoles,Jueves,Viernes', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="lugar">lugar:</label>
                    <div class="col-sm-10">
                        {{ Form::text('lugar', '', array('id' => 'lugar_show', 'class' => 'form-control input-sm', 'placeholder' => 'lugar', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cupo">cupo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('cupo', '', array('id' => 'cupo_show', 'class' => 'form-control input-sm', 'placeholder' => 'cupo', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="requisitos">requisitos:</label>
                    <div class="col-sm-10">
                        {{ Form::text('requisitos', '', array('id' => 'requisitos_show', 'class' => 'form-control input-sm', 'placeholder' => 'requisitos', 'required' => 'required')) }}
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
        $('#cvetaller_show').val($(this).data('cvetaller'));
        $('#nombre_show').val($(this).data('nombre'));
        $('#instructor_show').val($(this).data('instructor'));
        $('#horario_show').val($(this).data('horario'));
        $('#lugar_show').val($(this).data('lugar'));
        $('#cupo_show').val($(this).data('cupo'));
        $('#requisitos_show').val($(this).data('requisitos'));
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
        $('#cvetaller_show').val($(this).data('cvetaller'));
        $('#nombre_show').val($(this).data('nombre'));
        $('#instructor_show').val($(this).data('instructor'));
        $('#horario_show').val($(this).data('horario'));
        $('#lugar_show').val($(this).data('lugar'));
        $('#cupo_show').val($(this).data('cupo'));
        $('#requisitos_show').val($(this).data('requisitos'));
        $('#showModal').modal('show');
    });
    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#nombre').val(details[1]);
        $('#instructor').val(details[2]);
        $('#horario').val(details[3]);
        $('#lugar').val(details[4]);
        $('#cupo').val(details[5]);
        $('#requisitos').val(details[6]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editTaller',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'nombre': $('#nombre').val(),
                'instructor': $('#instructor').val(),
                'horario': $('#horario').val(),
                'lugar': $('#lugar').val(),
                'cupo': $('#cupo').val(),
                'requisitos': $('#requisitos').val(),
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
                        "</td><td>" + data.instructor +
                        "</td><td>" + data.horario +
                        "</td><td>" + data.lugar +
                        "</td><td>" + data.cupo +
                        "</td><td>" + data.requisitos +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.nombre+","
                        +data.instructor+","
                        +data.lugar+","
                        +data.cupo+","
                        +data.requisitos+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.nombre+","
                        +data.instructor+","
                        +data.lugar+","
                        +data.cupo+","
                        +data.requisitos+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteTaller',
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