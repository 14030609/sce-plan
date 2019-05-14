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
                <th class="text-center">id_dia</th>
                <th class="text-center">cvemat</th>
                <th class="text-center">horainicia</th>
                <th class="text-center">horatermina</th>
                <th class="text-center">actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->id_dia}}">
                <td>{{$item->id_dia}}</td>
                <td>{{$item->cvemat}}</td>
                <td>{{$item->horainicia}}</td>
                <td>{{$item->horatermina}}</td>
                <td>
                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->id_dia}},{{$item->cvemat}},{{$item->horainicia}},{{$item->horatermina}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->id_dia}},{{$item->cvemat}},{{$item->horainicia}},{{$item->horatermina}}">
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
                        <label class="control-label col-sm-2" for="cvemat">cvemat</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="cvemat">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horainicia">horainicia:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="horainicia">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="horatermina">horatermina:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="horatermina">
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
        $('#cvemat').val(details[1]);
        $('#horainicia').val(details[2]);
        $('#horatermina').val(details[3]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editHorario',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'cvemat': $('#cvemat').val(),
                'horainicia': $('#horainicia').val(),
                'horatermina': $('#horatermina').val(),
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
                        data.id + "</td><td>" + data.cvemat +
                        "</td><td>" + data.horainicia +
                        "</td><td>" + data.horatermina +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.cvemat+","
                        +data.horainicia+","
                        +data.horatermina+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.cvemat+","
                        +data.horainicia+","
                        +data.horatermina+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteHorario',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text(),
                'cvemat': $('.dname').text(),

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
