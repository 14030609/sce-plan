<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="asset/images/plan.jpeg" type="image/x-icon">

    <title>Plan Guanajuato</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- MetisMenu CSS -->
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{asset('css/timeline.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/startmin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('css/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">Startmin</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>

        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> secondtruth <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.navbar-top-links -->

</div>
</nav>

<div class="container">

    @foreach($data as $key )

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">Datos Personales </div>
            <div class="panel-body">

                <center>
                    <img src="../asset/images/alumno.jpg" class="img-responsive" alt="Cinque Terre" style=" width: 20%; height: 20%; ">

                </center>


                <div style="padding: 2%;">
                    <div >
                        <div class="panel panel-primary"   >
                            <div class="panel-heading" >Datos</div>
                            <div class="panel-body"  style=" padding-left: 5%;" >
                                <h4><strong>Nombre: </strong> {{$key->nombre}}</h4>
                                <h4><strong>Direccion:</strong> {{$key->direccion}} </h4>
                                <h4><strong>Telefono:</strong> {{$key->telefono}}</h4>
                                <h4><strong>email:</strong>  {{$key->email}}   </h4>
                                <h4><strong>curp:</strong>  {{$key->curp}}   </h4>
                                <h4><strong>sexo:</strong>  {{$key->sexo}}   </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    @endforeach


    <div class="panel panel-success">

        <div class="panel-heading">Calificaciones</div>
        <div class="panel-body">
            <div style="padding: 2%;">
                <table class="table table-bordered">
                    <thead class="table-primary">
                    <tr class="table-primary">
                        <th scope="col">Cvemat </th>
                        <th scope="col">Materia</th>
                        <th scope="col">primer parcial</th>
                        <th scope="col">segundo parcial</th>
                        <th scope="col">tercer parcial</th>
                        <th scope="col"> promedio</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                          <td>$key->cvemat</td>
                        <td>$key->nombre</td>
                        <td>$key->parcial1</td>
                        <td>$key->parcial2</td>
                        <td>$key->parcial3</td>
                        <td>no</td>

                    </tr>

                    </tbody>
                </table>


            </div>



        </div>

    </div>

    <br>




    <div class="col-sm-4 col-md-3 iconApp text-center">
        <a href="/AlumnosCalificar" class="thumbnail">
            <i class="glyphicon glyphicon-education fa-spin fa-5x fa-fw"></i>
            <div class="caption">
                <p class="text-center">Calificar Alumos</p>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-md-3 iconApp text-center">
        <a href="/asset/images/calendario.pdf" class="thumbnail">
            <i class="glyphicon glyphicon-calendar     fa-spin fa-5x fa-fw"></i>
            <div class="caption">
                <p class="text-center">Calendario Escolar</p>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-md-3 iconApp text-center">
        <a src="asset/images/calendario.pdf" class="thumbnail">
            <i class="glyphicon glyphicon-user     fa-spin fa-5x fa-fw"></i>
            <div class="caption">
                <p class="text-center">Datos personales</p>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-md-3 iconApp text-center">
        <a src="asset/images/calendario.pdf" class="thumbnail">
            <i class="glyphicon glyphicon-envelope     fa-spin fa-5x fa-fw"></i>
            <div class="caption">
                <p class="text-center">Enviar Correo</p>
            </div>
        </a>
    </div>
    <div class="col-sm-4 col-md-3 iconApp text-center">
        <a src="asset/images/calendario.pdf" class="thumbnail   ">
            <i class="glyphicon glyphicon-time     fa-spin fa-5x fa-fw"></i>
            <div class="caption">
                <p class="text-center">Eventos</p>
            </div>
        </a>
    </div>








    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<script src="../js/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
<br><br><br><br><br><br><br>


</body>
</html>
