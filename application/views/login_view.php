<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Adonai Barberia">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/login.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/fontawesome.min.css" media="screen" />
<!--
    <link rel="stylesheet" href="style.css" type="text/css" media="all">
    <link rel="stylesheet" href="fontawesome.min.css" type="text/css" media="all">
-->
</head>
<body>
	<?php
	$username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
	$password = array('name' => 'password', 'id' => 'password',	'placeholder' => 'introduce tu contrase&ntilde;a');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
	?>
    <h1 class="title-agile text-center"></h1>
	<!---728x90--->
    <div class="content-w3ls">
        <div class="content-bottom">
			<h2>Login</h2>
			<!---728x90--->
			<?=form_open(base_url().'login/new_user')?>
                <div class="field-group">
                    <span class="fa fa-user" aria-hidden="true"></span>
					<div class="wthree-field">
						<?=form_input($username)?><p><?=form_error('username')?></p>
                    </div>
                </div>
                <div class="field-group">
                    <span class="fa fa-lock" aria-hidden="true"></span>
                    <div class="wthree-field">
						<?=form_password($password)?><p><?=form_error('password')?></p>
						<?=form_hidden('token',$token)?>
                    </div>
                </div>
                <div class="list-login">
                    <div class="switch-agileits">
                        <label class="switch">
                            <input type="checkbox" onclick="myFunction()">
                            <span class="slider round"></span>
                            &nbsp; mostrar contrase&ntilde;a
                        </label>
                    </div>
                    <!-- script for show password -->
                    <script>
                        function myFunction() {
                            var x = document.getElementById("password");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                    <!-- //script for show password -->
                </div>
                <br/>
                <div class="wthree-field">
				<?=form_submit($submit)?>
                </div>
			<?=form_close()?>
			<?php
			if($this->session->flashdata('usuario_incorrecto')){
			?>
				<br/>
				<p><?=$this->session->flashdata('usuario_incorrecto')?></p>
			<?php
			}
			if($this->session->flashdata('dato_no_valido')){
			?>
				<br/>
				<p><?=$this->session->flashdata('dato_no_valido')?></p>
			<?php
			}
			?>
			<br><br>
			<a href="<?=base_url()?>pantalla" target="_blank" style="right:0px;float:right;color:white;font-weight:bold;">Ver pantalla</a>
        </div>
    </div>
	<!---728x90--->
    <div class="copyright text-center">
        <p>© 2018 Adonai. Todos los derechos reservados | Powered by dscg@gmail.com</p>
    </div>
</body>
<!-- //Body -->
</html>
