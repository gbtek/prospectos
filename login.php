<?php
session_start();
	include("data/cont.php");
	
	if(isset($_GET["a"])){
		if($_GET["a"]==1){//Variable para cerrar sesion
		session_destroy();
		//header('Location: index.php');
		}
	}
	

	if(isset($_POST["usname"])){// Variable para iniciar sesion de usuario registrado
		
    $Dato=login($_POST["usname"], $_POST["psswrd"]);
		
    if ($Dato=="psswrd") header('Location: login.php?msg=Contraseña incorrecta');
    elseif ($Dato=="name") header('Location: login.php?msg=Nombre de Usuario incorrecto');
    elseif ($Dato=="iniciar") header('Location: index.php');
    
	}
?>

<html lang="es">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
      <title>Administración de Prospectos</title>
      <meta name="description" content="Pagina para prospeccion Rápida">
      <meta name="author" content="Fernando Godoy">
      <link rel="shortcut icon" href="images/prospeccion_icono.png">
    
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/templatemo-style.css" rel="stylesheet">
	    
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <h1>PROSPECCIÓN</h1>
	        </header>
	        <form action="login.php" method="post" class="templatemo-login-form">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="usname" class="form-control" placeholder="macario">           
		          	</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input type=password name="psswrd" class="form-control" placeholder="******">           
		          	</div>	
	        	</div>	          	
	          	<div class="form-group">
				    <div class="checkbox squaredTwo">
						<label for="c1"><span></span><? print($_GET["msg"]); ?></label>
				    </div>				    
				</div>
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">ENTRAR</button>
				</div>
	        </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Aun no tienes una cuenta? <strong><a href="#" class="blue-text">Solicita una!</a></strong></p>
		</div>
	</body>
</html>