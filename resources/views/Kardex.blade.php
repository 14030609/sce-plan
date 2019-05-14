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
<div class="container ">

    {{ csrf_field() }}
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">nua</th>
                <th class="text-center">cvemat</th>
                <th class="text-center">materia</th>
                <th class="text-center">calificacion</th>
                <th class="text-center">oportunidad</th>
                <th class="text-center">creditos</th>
                <th class="text-center">semestre</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->cvemat }}">
                <td>{{$item->nua}}</td>
                <td>{{$item->cvemat}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->calificacion}}</td>
                <td>{{$item->oportunidad}}</td>
                <td>{{$item->creditos}}</td>
                <td>{{$item->semestre}}</td>
                <td>


<?php
if(Session::get('usuario'))
 {

 }else{

     echo'                   <button class="edit-modal btn btn-info"
                            data-info="{{$item->cvemat}},{{$item->nua}},{{$item->oportunidad}},{{$item->calificacion}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->cvemat}},{{$item->nua}},{{$item->oportunidad}},{{$item->calificacion}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                    </button></td>';

}

?>

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
                            <input type=hidden class="form-control" id="cvemat" >
                            <div class="form-group">
                                {!! Form::label('full_name', 'Rol') !!}
                                <select class="form-control"  id="fid">
                                    @foreach($data2 as $key => $value)
                                    <option value="{{$value}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nua">nua</label>
                        <div class="col-sm-10">

                            <div class="form-group">
                                {!! Form::label('full_name', 'Rol') !!}
                                <select class="form-control"  id="nua">
                                    @foreach($data3 as $key => $value)
                                    <option value="{{$value}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete
                    <span class="dname"></span> ? <span class="hidden did"></span>
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
        $('.dname').html(stuff[1]);
        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#nua').val(details[1]);
        $('#cvemat').val(details[0]);

    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editReticula',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#cvemat").val(),
                'cvemat': $("#fid").val(),
                'nua': $('#nua').val(),
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.fname) {
                        $('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                }
                else {

                    $('.error').addClass('hidden');
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.nua +
                        "</td><td><button class='edit-modal btn btn-info' data-info='" +
                        data.id+
                        ","+data.nua+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","+data.nua+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteReticula',
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
