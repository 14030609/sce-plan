<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/plan.jpeg" type="image/x-icon">

    <title>Plan Guanajuato</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="asset/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.css">

    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(assets/login/fonts/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
            </div>

            {{ Form::open(array('action' => 'UsuariosController@updateTres', 'method' => 'post','class'=>'login100-form validate-form')) }}

            <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                <span class="label-input100">Username</span>
                {{ Form::email('email_show', '', array('id' => 'email_show', 'class' => 'input100', 'placeholder' => 'Email Address')) }}

                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                <span class="label-input100">Password</span>
                {{ Form::password('contrasenia_show', array('id' => 'contrasenia_show', 'class' => 'input100', 'placeholder' => 'Password')) }}

                <span class="focus-input100"></span>

            </div>

            <div class="flex-sb-m w-full p-b-30">
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div>
                    <a href="#" class="txt1">
                        Forgot Password?
                    </a>
                </div>
            </div>
            <div class="container-login100-form-btn">

            </div>

            {!! Form::submit( 'Login', ['class' => 'btn btn-info btn-block', 'name' => 'submitbutton', 'value' => 'login'])!!}
            <hr>
            {{ Form::close() }}


        </div>


    </div>
</div>
</div>


</body>
</html>
