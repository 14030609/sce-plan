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
    <!--link rel="stylesheet"     href="../asset/css/bootstrap.min.css"-->
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

<br>
<br>
<br>
<br>
<button class="add-modal btn btn-info"
<span class="glyphicon glyphicon-edit"></span> ADD
</button>


<div class="container ">

    {{ csrf_field() }}
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">cvemat</th>
                <th class="text-center">nogpo</th>
                <th class="text-center">nua</th>
                <th class="text-center">parcial1</th>
                <th class="text-center">parcial2</th>
                <th class="text-center">parcial3</th>
                <th class="text-center">final</th>
                <th class="text-center">actions</th>
            </tr>
            </thead>
            @foreach($data as $item)


            <tr class="item{{$item->cvemat}}">
                <td>{{$item->cvemat}}</td>
                <td>{{$item->nogpo}}</td>
                <td>{{$item->nua}}</td>
                <td>{{$item->parcial1}}</td>
                <td>{{$item->parcial2}}</td>
                <td>{{$item->parcial3}}</td>
                <td>{{$item->final}}</td>
                <td>
                    <button class="show-modal btn btn-success"
                            data-cvemat="{{$item->cvemat}}"
                            data-nogpo="{{$item->nogpo}}"
                            data-nua="{{$item->nua}}"
                            data-parcial1="{{$item->parcial1}}"
                            data-parcial2="{{$item->parcial2}}"
                            data-parcial3="{{$item->parcial3}}"
                            data-final="{{$item->final}}"
                    >
                        <span class="glyphicon glyphicon-eye-open"></span> Show
                    </button>
                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->cvemat}},{{$item->nogpo}},{{$item->nua}},{{$item->parcial1}},{{$item->parcial2}},{{$item->parcial3}},{{$item->final}}">
                        <span class="glyphicon glyphicon-trash"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->cvemat}},{{$item->nogpo}},{{$item->nua}},{{$item->parcial1}},{{$item->parcial2}},{{$item->parcial3}},{{$item->final}}">
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
                        <label class="control-label col-sm-2" for="id">cvemat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nogpo">nogpo</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nogpo">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nua">nua:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nua">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial1">parcial1:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="parcial1">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial2">parcial2:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="parcial2">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial3">parcial3:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="parcial3">
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

                {{ Form::open(array('action' => 'MaestrosController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cvemat">cvemat:</label>
                    <div class="col-sm-10">

                            {{ Form::text('cvemat_show', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'cvemat Address', 'disabled')) }}
                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="nogpo">nogpo:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nogpo_show','', array('id' => 'nogpo_show', 'class' => 'form-control input-sm', 'placeholder' => 'Password', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="nua">nua:</label>
                    <div class="col-sm-10">

                        {{ Form::text('nua_show', '', array('id' => 'nua_show', 'class' => 'form-control input-sm', 'placeholder' => 'nua', 'disabled')) }}
                        {{ Form::hidden('nua', '', array('id' => 'nua_show', 'class' => 'form-control input-sm', 'placeholder' => 'nua Address')) }}

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="parcial1">parcial1:</label>
                    <div class="col-sm-10">
                        {{ Form::text('parcial1_show', '', array('id' => 'parcial1_show', 'class' => 'form-control input-sm', 'placeholder' => 'parcial1', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="parcial2">parcial2:</label>
                    <div class="col-sm-10">
                        {{ Form::text('parcial2_show', '', array('id' => 'parcial2_show', 'class' => 'form-control input-sm', 'placeholder' => 'parcial2', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="parcial3">parcial3:</label>
                    <div class="col-sm-10">
                        {{ Form::text('parcial3_show', '', array('id' => 'parcial3_show', 'class' => 'form-control input-sm', 'placeholder' => 'parcial3', 'disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="final">final:</label>
                    <div class="col-sm-10">
                        {{ Form::text('final_show', '', array('id' => 'final_show', 'class' => 'form-control input-sm', 'placeholder' => 'final', 'disabled')) }}
                    </div>
                </div>


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

                {{ Form::open(array('action' => 'MateriasController@updateDos', 'method' => 'post')) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="CveMat">cveMat:</label>
                    <div class="col-sm-10">

                        {{ Form::text('cvemat_show', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'cvemat Address', 'required' => 'required')) }}
                        {{ Form::hidden('cvemat', '', array('id' => 'cvemat_show', 'class' => 'form-control input-sm', 'placeholder' => 'Clave de la materia')) }}

                    </div>

                </div>


                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Grupo">Grupo</label>
                        <div class="col-sm-10">

                            <select class="form-control" name="nogpo" id="nogpo">
                                @foreach($data2 as $key => $value)
                                <option value="{{$value}}"> Materia: {{$value}}   ==========>    Grupo: {{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nua">Nua</label>
                        <div class="col-sm-10">

                            <select class="form-control" name="nua" id="nua">
                                @foreach($data3 as $key => $value)
                                <option value="{{$key}}">{{$key}}</option>
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
        $('#nogpo').val($(this).data('nogpo'));
        $('#nua').val($(this).data('nua'));
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
        $('#nua_show').val($(this).data('nua'));
        $('#nogpo_show').val($(this).data('nogpo'));
        $('#parcial1_show').val($(this).data('parcial1'));
        $('#parcial2_show').val($(this).data('parcial2'));
        $('#parcial3_show').val($(this).data('parcial3'));
        $('#final_show').val($(this).data('final'));
        $('#cvemat_show').val($(this).data('cvemat'));

        $('#showModal').modal('show');
    });


    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#nogpo').val(details[1]);
        $('#nua').val(details[2]);
        $('#parcial1').val(details[3]);
        $('#parcial2').val(details[4]);
        $('#parcial3').val(details[5]);
        $('#final').val(details[6]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editList',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'nogpo': $('#nogpo').val(),
                'nua': $('#nua').val(),
                'parcial1': $('#parcial1').val(),
                'parcial2': $('#parcial2').val(),
                'parcial3': $('#parcial3').val(),
                'final': $('#final').val(),
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
                        data.id + "</td><td>" + data.nogpo +
                        "</td><td>" + data.nua +
                        "</td><td>" + data.parcial1 +
                        "</td><td>" + data.parcial2 +
                        "</td><td>" + data.parcial3 +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.nogpo+","
                        +data.nua+","
                        +data.parcial1+","
                        +data.parcial2+","
                        +data.parcial3+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.nogpo+","
                        +data.nua+","
                        +data.parcial1+","
                        +data.parcial2+","
                        +data.parcial3+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteList',
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