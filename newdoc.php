<?PHP
session_start(); // SESION ----------- >
include("data/cont.php");

if(!isset($_SESSION['DU51'])){ //checamos si la variable de sesion esta creada
  header('Location: login.php'); //Si no esta creada nos vamos al login
} 
else if ($Tiempo = (time() - $_SESSION['DU54']) > 600) { //Si sí esta creada la variable de sesion, checamos si la sesion tiene menos de 10 min. Si tiene mas caducamos la sesion y la destruimos 
    session_destroy();
    header('Location: login.php');
    die();  
}
else	{ // si sí esta la variable de sesion y aun esa en tiempo de sesion, reiniciamos el contador para tener 10 min mas de sesion.
  $idUser=$_SESSION['DU51']; //Guardamos el ID de usuario para usarlo en referencias de procesos. 
  $_SESSION['DU54']=time(); } 

// < ----------- SESION
?>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Documento</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
  </head>
  <body>
 
    <!-- Formulario -->
    <!--  has-success, has-warning, has-error style="overflow-y:scroll; max-height:500px; max-width:490px;" -->
 
      <div  class="MainFormModal templatemo-content-widget white-bg">
            <h2 class="margin-bottom-10">Subir un Documento</h2>
            <form action="index.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
              <div class="row form-group">
                <div class="col-lg-12 has-success">                  
                    <label for="file_01">Nombre del Documento</label>
                    <input type="text" class="form-control" id="file_01" name="file_01" placeholder="Dejar vacio para utilizar el nombre original">                  
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-lg-12">
                  <label class="control-label templatemo-block">Subir Archivo</label> 
                  <!-- <input type="file" name="fileToUpload" id="fileToUpload" class="margin-bottom-10"> -->
                  <input type="file" id="file_02" name="file_02"  class="filestyle" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false">
                  <p>Máximo 5 MB.</p>                  
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-lg-12 form-group">                   
                    <label class="control-label" for="file_03">Observaciones</label>
                    <textarea class="form-control" id="file_03" name="file_03"  rows="3"></textarea>
                </div>
              </div>
              <input type="hidden" id="file_04" name="file_04" value="<?PHP print(($_GET["dat"])); ?>">
              <div class="form-group text-right">
                <button type="submit" class="templatemo-blue-button">Guardar</button>
                <button onClick="Cancelar('#MsgModal');" class="templatemo-white-button">Cerrar</button>
              </div>                           
            </form>
          </div>
          
    
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>        <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>       
  </body>
</html>
