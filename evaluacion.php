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
  $_SESSION['DU54']=time(); 
  
  if($_SESSION['DU52']=="promotor"){
    echo '<script language="javascript">alert("No tienes permiso para acceder a este apartado");</script>';
    header('Location: index.php');
  }
    
} 

// < ----------- SESION
// EVALUACIÓN DEL PROSPECTO ----------- >
      
        if (isset($_POST['aut']) || isset($_POST['rech'])){
          $id_prospecto=Desencriptar($_POST['eval_01']);
          $observacione=$_POST['eval_02'];
        
          if($_POST['aut']=="si"){
            write_to_console("Aut = si");

            $instruccion = "UPDATE pr_prospectos SET `pros_estatus`='Autorizado', `pros_notas`='$observacione' WHERE (`id_prospecto`='$id_prospecto');";

            $consulta = ConsultarSQLi($instruccion);
          }
          elseif($_POST['rech']=="si"){
            write_to_console("Rech = si");
            $instruccion = "UPDATE `pr_prospectos` SET `pros_estatus`='Rechazado', `pros_notas`='$observacione' WHERE `id_prospecto`='$id_prospecto';";

            str_replace("''","NULL",$instruccion);
            $consulta = ConsultarSQLi($instruccion);
          }
        }
        else
        write_to_console("No entro");

// < ----------- EVALUACIÓN DEL PROSPECTO  
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
  <body>  
    
    
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>PROSPECCIÓN</h1>
        </header>
        <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      
        <!-- Search box -->
        <form class="templatemo-search-form" role="search">
          <div class="input-group">
              <button type="submit" class="fa fa-search"></button>
              <input type="text" class="form-control" placeholder="buscar" name="srch-term" id="srch-term">           
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="index.php"><i class="fa fa-users fa-fw"></i>Prospectos</a></li>
            <li><a href="" class="active"><i class="fa fa-check-square-o fa-fw"></i>evaluacion</a></li>
            <li><a href="login.php?a=1"><i class="fa fa-eject fa-fw"></i>Cerrar Sesion</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="index.php">Prospectos</a></li>
                <li><a href="" class="active">Evaluacion</a></li>
                <li><a href="login.php?a=1">Cerrar Sesión</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                    <td><a href="" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Nombre <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">1er Apellido <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">2do Apellido<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Estatus <span class="caret"></span></a></td>
                    <td>&nbsp;</td>
                  </tr>
                </thead>
                <tbody>
  <?PHP
//CREAMOS LA TABLA DE PROSPECTOS CON LOS EL BOTON VER PARA REVISRAR SU INFORMACIÓN Y AVALUARLO.
   $consulta = ConsultarSQLi("select * from pr_prospectos;");
	         
   // Mostrar resultados de la consulta
	  $nfilas = $consulta->num_rows;
      if ($nfilas > 0)
      {
        $contador=0;
        for ($i=0; $i<$nfilas; $i++)
          {
            $contador=$contador+1;
            $fila = $consulta->fetch_assoc();
            $idprospect=urlencode(Encriptar($fila['id_prospecto']));
            print ("
              <tr>
                <td>".$contador.".</td>
                <td>".$fila['pros_nombre']."</td>
                <td>".$fila['pros_apell1']."</td>
                <td>".$fila['pros_apell2']."</td>
                <td>".$fila['pros_estatus']."</td>
                <td><button class='templatemo-edit-btn' onClick=\"DivModal('prospectevalua.php?dat=>".$idprospect."','#MsgModal');\"><i class='fa fa-user fa-fw'></i>Ver</button></td>
              </tr>
            
            "); 
          }
      }
      else
         print ("No hay datos disponibles");
	  ?>
                </tbody>
              </table>    
            </div> 
            <!-- Boton para agregar prospecto -->
          </div>  

           <!-- Second row ends -->
          <div class="templatemo-flex-row flex-content-row">
          </div>
          <div id="MsgModal" class="MsgModalCover"></div>
          <footer class="text-right">
            <p>Copyright &copy; 2023 Prospección 
            | Designed by <a href="mailto:iscfernandogodoy@gmail.com" target="_parent">Fernando Godoy</a></p>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    
    <script type="text/javascript" src="js/pros_jquerty.js"></script>      <!-- Scrips del Proyecto -->
    
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
    <script>
      $(document).ready(function(){
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();        
      });
    </script>
  </body>
</html>