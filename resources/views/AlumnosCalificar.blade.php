<!DOCTYPE html>
<html>
<head>
    <title>Datatables implementation in laravel - justlaravel.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="asset/js/jquery-1.12.3.js"></script>
    <script src="asset/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet"
          href="asset/css/bootstrap.min.css">
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
<div class="container ">

    {{ csrf_field() }}
    <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
            <tr>
                <th class="text-center">nua</th>
                <th class="text-center">nombre</th>
                <th class="text-center">grupo</th>
                <th class="text-center">cvemat</th>
                <th class="text-center">materia</th>
                <th class="text-center">parcial 1</th>
                <th class="text-center">parcial 2</th>
                <th class="text-center">pqrcial 3</th>
                <th class="text-center">actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <tr class="item{{$item->cvemat}}">
                <td>{{$item->nua}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->nogpo}}</td>
                <td>{{$item->cvemat}}</td>
                <td>{{$item->materia}}</td>
                <td>{{$item->parcial1}}</td>
                <td>{{$item->parcial2}}</td>
                <td>{{$item->parcial3}}</td>
                <td>
                    <button class="edit-modal btn btn-danger"
                            data-info="{{$item->cvemat}},{{$item->nogpo}},{{$item->nua}},{{$item->parcial1}},{{$item->parcial2}},{{$item->parcial3}},{{$item->nombre}},{{$item->materia}},">
                        <span class="glyphicon glyphicon-edit"></span> Calificar
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
                            <input type="name" class="form-control" id="nogpo" disabled>
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nua">nua</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="nua" disabled>
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial1">Parcial 1</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="parcial1">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial2">Parcial 2</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="parcial2">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parcial3">Parcial 3</label>
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
<script>
    $(document).ready(function() {
        $('#table').DataTable();
    } );
</script>

<script>

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Calificar");
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
        $('#nogpo').val(details[1]);
        $('#nua').val(details[2]);
        $('#parcial1').val(details[3]);
        $('#parcial2').val(details[4]);
        $('#parcial3').val(details[5]);
        $('#nombre').val(details[6]);
        $('#materia').val(details[7]);

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
                'nombre': $('#nombre').val(),
                'materia': $('#materia  ').val(),
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
                        "</td><td>" + data.nombre +
                        "</td><td>" + data.materia +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.nogpo+","
                        +data.nua+","
                        +data.parcial1+","
                        +data.parcial2+","
                        +data.parcial3+","
                        +data.nombre+","
                        +data.materia+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.nogpo+","
                        +data.nua+","
                        +data.parcial1+","
                        +data.parcial2+","
                        +data.parcial3+","
                        +data.nombre+","
                        +data.materia+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteAlumno',
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