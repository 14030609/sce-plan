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
<style>
</style>
<body>
<br><br><br>
<button class="add-modal btn btn-info">
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
                <th class="text-center">CveMat</th>
                <th class="text-center">Materia</th>
                <th class="text-center">Creditos</th>
                <th class="text-center">horasprofesor</th>
                <th class="text-center">horasautonomo</th>
                <th class="text-center">semestre</th>
                <th class="text-center">Actions</th>

            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->cvemat}}">
                <td>{{$item->cvemat}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->creditos}}</td>
                <td>{{$item->horasprofesor}}</td>
                <td>{{$item->horasautonomo}}</td>
                <td>{{$item->semestre}}</td>
                <td>
                    <button class="show-modal btn btn-success"
        data-cvemat="{{$item->cvemat}}"
        data-nombre="{{$item->nombre}}"
        data-creditos="{{$item->creditos}}"
        data-horasprofesor="{{$item->horasprofesor}}"
        data-horasautonomo="{{$item->horasautonomo}}"
        data-semestre="{{$item->semestre}}">

    <span class="glyphicon glyphicon-eye-open"></span> Show</button>


                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->cvemat}},{{$item->nombre}},{{$item->creditos}},{{$item->horasprofesor}},{{$item->horasautonomo}},{{$item->semestre}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->cvemat}},{{$item->nombre}},{{$item->creditos}},{{$item->horasprofesor}},{{$item->horasautonomo}},{{$item->semestre}}">
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
                        <label class="control-label col-sm-2" for="fname">Nombre</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="fname">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lname">creditos:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="lname">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horasprofesor">horasprofesor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horasprofesor" >
                        </div>
                    </div>
                    <p class="horasprofesor_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horasautonomo">horas autonomo</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="horasautonomo">
                        </div>
                    </div>
                    <p class="horasautonomo_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="semestre">semestre:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="semestre">
                        </div>
                    </div>
                    <p class="semestre_error error text-center alert alert-danger hidden"></p>

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

                {{ Form::open(array('action' => 'MateriasController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="CveMat">cveMat:</label>
                    <div class="col-sm-10">

                        {{ Form::text('cvemat_show', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'cvemat Address', 'disabled')) }}
                        {{ Form::hidden('cvemat', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'Clave de la materia')) }}

                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="materiar">Materia:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nombre_show','', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'Materia', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="creditos">creditos:</label>
                    <div class="col-sm-10">
                        {{ Form::text('creditos_show', '', array('id' => 'creditos_show', 'class' => 'form-control input-sm', 'placeholder' => 'creditos', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="horasprofesor">horasprofesor:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horasprofesor_show', '', array('id' => 'horasprofesor_show', 'class' => 'form-control input-sm', 'placeholder' => 'horasprofesor', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="horasautonomo">horasautonomo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horasautonomo_show', '', array('id' => 'horasautonomo_show', 'class' => 'form-control input-sm', 'placeholder' => 'horasautonomo', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="semestre">semestre:</label>
                    <div class="col-sm-10">
                        {{ Form::text('semestre_show', '', array('id' => 'semestre_show', 'class' => 'form-control input-sm', 'placeholder' => 'semestre', 'disabled')) }}
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

                {{ Form::open(array('action' => 'MateriasController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="CveMat">cveMat:</label>
                    <div class="col-sm-10">

                        {{ Form::text('cvemat_show', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'cvemat Address', 'required' => 'required')) }}
                        {{ Form::hidden('cvemat', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'Clave de la materia')) }}

                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="materiar">Materia:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nombre_show','', array('id' => 'nombre_show', 'class' => 'form-control input-sm', 'placeholder' => 'Materia', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="creditos">creditos:</label>
                    <div class="col-sm-10">
                        {{ Form::text('creditos_show', '', array('id' => 'creditos_show', 'class' => 'form-control input-sm', 'placeholder' => 'creditos', 'required' => 'required')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="horasprofesor">horasprofesor:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horasprofesor_show', '', array('id' => 'horasprofesor_show', 'class' => 'form-control input-sm', 'placeholder' => 'horasprofesor', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="horasautonomo">horasautonomo:</label>
                    <div class="col-sm-10">
                        {{ Form::text('horasautonomo_show', '', array('id' => 'horasautonomo_show', 'class' => 'form-control input-sm', 'placeholder' => 'horasautonomo', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="semestre">semestre:</label>
                    <div class="col-sm-10">
                        {{ Form::text('semestre_show', '', array('id' => 'semestre_show', 'class' => 'form-control input-sm', 'placeholder' => 'semestre', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="especialidad">Especialidad</label>
                        <div class="col-sm-10">

                        <select class="form-control" name="cveesp" id="cveesp">
                            @foreach($data2 as $key => $value)
                            <option value="{{$value}}"> {{$value}} ->{{$key}}</option>
                            @endforeach
                        </select>
                        </div>
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
        $('#cvemat_show').val($(this).data('cvemat'));
        $('#nombre_show').val($(this).data('nombre'));
        $('#creditos_show').val($(this).data('creditos'));
        $('#horasprofesor_show').val($(this).data('horasprofesor'));
        $('#horasautonomo_show').val($(this).data('horasautonomo'));
        $('#semestre_show').val($(this).data('semestre'));
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
          $('#cvemat_show').val($(this).data('cvemat'));
          $('#nombre_show').val($(this).data('nombre'));
          $('#creditos_show').val($(this).data('creditos'));
          $('#horasprofesor_show').val($(this).data('horasprofesor'));
          $('#horasautonomo_show').val($(this).data('horasautonomo'));
          $('#semestre_show').val($(this).data('semestre'));
          $('#showModal').modal('show');
      });



    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#fname').val(details[1]);
        $('#lname').val(details[2]);
        $('#horasprofesor').val(details[3]);
        $('#horasautonomo').val(details[4]);
        $('#semestre').val(details[5]);

    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '  editMateria',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'nombre': $('#fname').val(),
                'creditos': $('#lname').val(),
                'horasprofesor': $("#horasprofesor").val(),
                'horasautonomo': $('#horasautonomo').val(),
                'semestre': $('#semestre').val()
            }
        });
    });
    $('.modal-footer').on('click', '.delete', function() {

        alert($('.did').text());
        $.ajax({
            type: 'post',
            url: '/deleteMateria',
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