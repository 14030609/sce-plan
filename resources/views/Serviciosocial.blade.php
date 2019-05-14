@extends('welcome')
@section('add')

<!DOCTYPE html>
<html>
<head>
    <title>Datatables implementation in laravel - justlaravel.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="asset/js/jquery-1.12.3.js"></script>
    <script src="asset/js/jquery.dataTables.min.js"></script>
    <!--link rel="stylesheet" href="asset/css/bootstrap.min.css"-->
    <script
        src="asset/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="asset/css/dataTables.bootstrap.min.css">
    <script
        src="asset/js/bootstrap.min.js"></script>

</head>
<style>
</style>
<body>
<br><br><br>

<div class="container ">
    {{ csrf_field() }}
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">id</th>
                <th class="text-center">institucion</th>
                <th class="text-center">fechainicio</th>
                <th class="text-center">fechafinal</th>
                <th class="text-center">horassemana</th>
                <th class="text-center">descripcion</th>
                <th class="text-center">encargado</th>
                <th class="text-center">direccion</th>
                <th class="text-center">subprograma</th>
                <th class="text-center">nua</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->id_servicio}}">
                <td>{{$item->id_servicio}}</td>
                <td>{{$item->institucion}}</td>
                <td>{{$item->fechainicio}}</td>
                <td>{{$item->fechafinal}}</td>
                <td>{{$item->horassemana}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->encargado}}</td>
                <td>{{$item->direccion}}</td>
                <td>{{$item->cvesubprograma}}</td>
                <td>{{$item->nua}}</td>
                <td>
                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->id_servicio}},{{$item->institucion}},{{$item->fechainicio}},{{$item->fechafinal}},{{$item->horassemana}},{{$item->descripcion}},{{$item->encargado}},{{$item->direccion}},{{$item->nua}},{{$item->cvesubprograma}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->id_servicio}},{{$item->institucion}},{{$item->fechainicio}},{{$item->fechafinal}},{{$item->horassemana}},{{$item->descripcion}},{{$item->encargado}},{{$item->direccion}},{{$item->nua}},,{{$item->cvesubprograma}}">
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
                        <label class="control-label col-sm-2" for="institucion">institucion</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="institucion">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fechainicio">fechainicio:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fechainicio">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fechafinal">fechafinal:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fechafinal">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horassemana">horassemana:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="horassemana">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="descripcion">descripcion:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="descripcion">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="encargado">encargado:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="encargado">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion">direccion:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="direccion">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nua">nua:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nua">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="cvesubprograma">Subprograma:</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="cvesubprograma" id="cvesubprograma">
                                @foreach($data2 as $key => $value)
                                <option value="{{$value}}"> {{$value}}->{{$key}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                    </div>
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
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

<script>

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
        $('#institucion').val(details[1]);
        $('#fechainicio').val(details[2]);
        $('#fechafinal').val(details[3]);
        $('#horassemana').val(details[4]);
        $('#descripcion').val(details[5]);
        $('#encargado').val(details[6]);
        $('#direccion').val(details[7]);
        $('#nua').val(details[8]);
        $('#cvesubprograma').val(details[9]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editServicio',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'institucion': $('#institucion').val(),
                'fechainicio': $('#fechainicio').val(),
                'fechafinal': $('#fechafinal').val(),
                'horassemana': $('#horassemana').val(),
                'descripcion': $('#descripcion').val(),
                'encargado': $('#encargado').val(),
                'direccion': $('#direccion').val(),
                'nua': $('#nua').val(),
                'cvesubprograma': $('#cvesubprograma').val(),
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
                        data.id + "</td><td>" + data.institucion +
                        "</td><td>" + data.fechainicio +
                        "</td><td>" + data.fechafinal +
                        "</td><td>" + data.horassemana +
                        "</td><td>" + data.descripcion +
                        "</td><td>" + data.encargado +
                        "</td><td>" + data.direccion +
                        "</td><td>" + data.nua +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.institucion+","
                        +data.fechainicio+","
                        +data.horassemana+","
                        +data.descripcion+","
                        +data.encargado+","
                        +data.direccion+","
                        +data.nua+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.institucion+","
                        +data.fechainicio+","
                        +data.horassemana+","
                        +data.descripcion+","
                        +data.encargado+","
                        +data.direccion+","
                        +data.nua+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteServicio',
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
