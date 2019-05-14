
<!DOCTYPE html>
<html>
<head>


<title>Datatables implementation in laravel - justlaravel.com</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script
    src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
</style>
<br><br>
<body>
    <div class="container ">
        {{ csrf_field() }}
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                    <tr>
                        <th class="text-center">cvemat</th>
                        <th class="text-center">nombre</th>
                        <th class="text-center">creditos</th>
                        <th class="text-center">horasprofesor</th>
                        <th class="text-center">horasautonomo</th>
                        <th class="text-center">semestre </th>
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
                    <td><button class="edit-modal btn btn-info"
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
                            <label class="control-label col-sm-2" for="cvemat">Cvemat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="cvemat" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre">nombre</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nombre">
                            </div>
                        </div>
                        <p class="nombre_error error text-center alert alert-danger hidden"></p>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="creditos">Creditos:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="creditos">
                            </div>
                        </div>
                        <p class="creditos_error error text-center alert alert-danger hidden"></p>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="horasprofesor">horasprofesor</label>
                            <div class="col-sm-10">
                                <input type="horasprofesor" class="form-control" id="horasprofesor">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="horasautonomo">horasautonomo:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="horasautonomo">
                            </div>
                        </div>
                        <p
                            class="semestre_error error text-center alert alert-danger hidden"></p>

                        <p class="horasprofesor_error error text-center alert alert-danger hidden"></p>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="semestre">semestre</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="semestre" name="semestre">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="1">Primer Semestre</option>
                                    <option value="2">Segundo Semestre</option>
                                    <option value="3">Tercer Semestre</option>
                                    <option value="4">Cuarto Semestre</option>
                                    <option value="5">Quinto Semestre</option>
                                    <option value="6">Sexto Semestre</option>
                                
                                </select>
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
    $('#cvemat').val(details[0]);
    $('#nombre').val(details[1]);
    $('#creditos').val(details[2]);
    $('#horasprofesor').val(details[3]);
    $('#horasautonomo').val(details[4]);
    $('#semestre').val(details[5]);
 }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                'cvemat': $("#cvemat").val(),
                'nombre': $('#nombre').val(),
                'creditos': $('#creditos').val(),
                'horasprofesor': $('#horasprofesor').val(),
                'horasautonomo': $('#horasautonomo').val(),
                'semestre': $('#semestre').val()        },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.nombre) {
                        $('.nombre_error').removeClass('hidden');
                        $('.nombre_error').text("nombre can't be empty !");
                    }
                    if(data.errors.creditos) {
                        $('.creditos_error').removeClass('hidden');
                        $('.creditos_error').text("Creditos can't be empty !");
                    }
                    if(data.errors.horasprofesor) {
                        $('.horasprofesor_error').removeClass('hidden');
                        $('.horasprofesor_error').text("horasprofesor must be a valid one !");
                    }
                    if(data.errors.horasautonomo) {
                        $('.horasautonomo_error').removeClass('hidden');
                        $('.horasautonomo_error').text("horasautonomo must be a valid one !");
                    }
                    if(data.errors.semestre) {
                        $('.semestre_error').removeClass('hidden');
                        $('.semestre_error').text("semestre must be a valid one !");
                    }
                }
                 else {
                     
                     $('.error').addClass('hidden');
                $('.item' + data.cvemat).replaceWith("<tr class='item" + data.cvemat + "'><td>" +
                        data.cvemat + "</td><td>" + data.nombre +
                        "</td><td>" + data.creditos + "</td><td>" + data.horasprofesor + "</td><td>" +
                         data.horasautonomo + "</td><td>" + data.semestre + "</td><td>" + data.salary +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.cvemat+","+data.nombre+","+data.creditos+","+data.horasprofesor+","+data.horasautonomo+","+data.semestre+","+data.salary+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.cvemat+","+data.nombre+","+data.creditos+","+data.horasprofesor+","+data.horasautonomo+","+data.semestre+","+data.salary+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'cvemat': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>

</body>
</html>
