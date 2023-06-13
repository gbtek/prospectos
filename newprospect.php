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
    <title>Agregar Prospecto</title>
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
            <h2 class="margin-bottom-10">Prospectos</h2>
            <p>Los campos con * Son Obligatorios</p>
            <form action="index.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
              <div class="row form-group">
                <div class="col-lg-12 has-success">                  
                    <label for="prosp_01">Nombre*</label>
                    
                    <input type="text" class="form-control" id="prosp_01" name="prosp_01" placeholder="Fernando" required>                  
                </div>
              </div>
              
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_02">1er Apellido*</label>
                    <input type="text" class="form-control" id="prosp_02" name="prosp_02" required placeholder="Escribe tu primer apellido">             
                </div>
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_03">2do Apellido</label>
                    <input type="text" class="form-control" id="prosp_03" name="prosp_03" placeholder="Escribe tu segundo apellido">             
                </div> 
              </div>
              
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_04">Calle*</label>
                    <input type="text" class="form-control" id="prosp_04" name="prosp_04" required placeholder="Escribe el nombre de la calle">             
                </div>
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_05">Numero Ext.*</label>
                    <input type="text" class="form-control" iid="prosp_05" name="prosp_05" required placeholder="Numero Ext">             
                </div> 
              </div>
              
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_06">Colonia*</label>
                    <input type="text" class="form-control" id="prosp_06" name="prosp_06" required placeholder="Colonia">             
                </div>
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_07">Codigo Postal*</label>
                    <input type="number" class="form-control" id="prosp_07" name="prosp_07" required placeholder="Codigo Postal" maxlength="5">             
                </div> 
              </div>
              
              <div class="row form-group">
                <div class="col-lg-6 col-md-6 form-group">                   <label for="prosp_08">Teléfono*</label>
                    <input type="number" class="form-control" id="prosp_08" name="prosp_08" required placeholder="Solo numeros 10 digitos" maxlength="10">       
                </div>
                <div class="col-lg-6 col-md-6 form-group">               
                    <label for="prosp_09">RFC*</label>
                    <input type="text" class="form-control" id="prosp_09" name="prosp_09" required placeholder="XXXX000000XXX" maxlength="14">             
                </div> 
              </div>
              <? 
                $Dato=urldecode(Encriptar("NuevoProspecto"));
              ?>
              
               <input type="hidden" name="prosp_10" value="<? print($Dato);?>">
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
