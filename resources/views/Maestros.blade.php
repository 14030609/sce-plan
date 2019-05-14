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
                <th class="text-center">cvemae</th>
                <th class="text-center">noempleado</th>
                <th class="text-center">email</th>
                <th class="text-center">rfc</th>
                <th class="text-center">actions</th>
            </tr>
            </thead>
            @foreach($data as $item)
            <?php

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


            <tr class="item{{$item->cvemae}}">
                <td>{{$item->cvemae}}</td>
                <td>{{$item->noempleado}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->rfc}}</td>
                <td>
                    <button class="show-modal btn btn-success"
                            data-cvemae="{{$item->cvemae}}"
                            data-noempleado="{{$item->noempleado}}"
                            data-email="{{$item->email}}"
                            data-rfc="{{$item->rfc}}"
                    >
                        <span class="glyphicon glyphicon-eye-open"></span> Show
                    </button>
                    <button class="edit-modal btn btn-info"
                            data-info="{{$item->cvemae}},{{$item->noempleado}},{{$item->email}},{{$item->rfc}}">
                        <span class="glyphicon glyphicon-trash"></span> Edit
                    </button>
                    <button class="delete-modal btn btn-danger"
                            data-info="{{$item->cvemae}},{{$item->noempleado}},{{$item->email}},{{$item->rfc}}">
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
                        <label class="control-label col-sm-2" for="noempleado">cve esp</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="noempleado">
                        </div>
                    </div>
                    <p class="fname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="email">
                        </div>
                    </div>
                    <p class="lname_error error text-center alert alert-danger hidden"></p>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="rfc">rfc:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="rfc">
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
                    <label class="control-label col-sm-2" for="cvemae">cvemae:</label>
                    <div class="col-sm-10">

                            {{ Form::text('cvemae_show', '', array('id' => 'cvemae_show', 'class' => 'form-control input-sm', 'placeholder' => 'cvemae Address', 'disabled')) }}
                    </div>

                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="noempleado">noempleado:</label>
                    <div class="col-sm-10">

                        {{ Form::text('noempleado_show','', array('id' => 'noempleado_show', 'class' => 'form-control input-sm', 'placeholder' => 'Password', 'disabled')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">email:</label>
                    <div class="col-sm-10">

                        {{ Form::email('email_show', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email', 'disabled')) }}
                        {{ Form::hidden('email', '', array('id' => 'email_show', 'class' => 'form-control input-sm', 'placeholder' => 'Email Address')) }}

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="rfc">rfc:</label>
                    <div class="col-sm-10">
                        {{ Form::text('rfc_show', '', array('id' => 'rfc_show', 'class' => 'form-control input-sm', 'placeholder' => 'rfc', 'disabled')) }}
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
        $('#noempleado_show').val($(this).data('noempleado'));
        $('#rfc_show').val($(this).data('rfc'));
        $('#cvemae_show').val($(this).data('cvemae'));

        $('#showModal').modal('show');
    });


    function fillmodalData(details){
        $('#fid').val(details[0]);
        $('#noempleado').val(details[1]);
        $('#email').val(details[2]);
        $('#rfc').val(details[3]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editMaestro',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'noempleado': $('#noempleado').val(),
                'email': $('#email').val(),
                'rfc': $('#rfc').val(),
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
                        data.id + "</td><td>" + data.noempleado +
                        "</td><td>" + data.email +
                        "</td><td>" + data.rfc +
                        "</td><td><button class='edit-modal btn btn-info' data-info='"
                        + data.id+","
                        +data.noempleado+","
                        +data.email+","
                        +data.rfc+
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='"
                        + data.id+","
                        +data.noempleado+","
                        +data.email+","
                        +data.rfc+
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteMaestro',
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