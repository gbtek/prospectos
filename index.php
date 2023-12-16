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
  
  if($_SESSION['DU52']=="evaluador"){
  
  print("<script type='text/javascript' src='js/pros_jquerty.js'></script>
  <script type='text/javascript' src='js/jquery-1.11.2.min.js'></script> ");
  print ('<script language="javascript">alert("No tienes permiso para acceder a este apartado");</script>');
  header('Location: evaluacion.php');
  }
} 

// < ----------- SESION

// AGREGAR PROSPECTOA A LA BASE DE DATOS ----------- >
if (isset($_POST['prosp_10'])){
  if(Desencriptar($_POST['prosp_10'])=="NuevoProspecto"){ //Si la variable prosp_10 es = a Nuevo prospecto, entonces hay que gregar al nuevo prospecto antes de cargar toda la pagina para incluir este dato.

    $instruccion = "INSERT INTO `pr_prospectos` (`pros_nombre`, `pros_apell1`, `pros_apell2`, `pros_calle`, `pros_num`, `pros_col`, `pros_cp`, `pros_tel`, `pros_rfc`, `pros_estatus`)    VALUES ('".$_POST['prosp_01']."', '".$_POST['prosp_02']."', '".$_POST['prosp_03']."', '".$_POST['prosp_04']."', '".$_POST['prosp_05']."', '".$_POST['prosp_06']."', '".$_POST['prosp_07']."', '".$_POST['prosp_08']."', '".$_POST['prosp_09']."', 'Enviado')";	

    str_replace("''","NULL",$instruccion);

    $consulta = ConsultarSQLi($instruccion);			
    //write_to_console($instruccion." ".$consulta);

  }
}
// < ----------- AGREGAR PROSPECTOA A LA BASE DE DATOS

// SUBIR ARCHIBOS PARA UN PROSPECTO ----------- >
      

      if (isset($_POST['file_04'])) {
        $fileTmpPath = $_FILES['file_02']['tmp_name'];
        $fileName = $_FILES['file_02']['name'];
        $UserFileName = $_POST['file_01'];
        $ID_User = Desencriptar($_POST['file_04']);
        
        //Extension
        $fileExt = str_replace(".","", strrchr($fileName, "."));
        //Nombre sin extension
        $fileNameSE= mb_strrchr($fileName, ".",true);  

        write_to_console($fileName);
        write_to_console("Ext: ".$fileExt);
        write_to_console("Nam: ".$fileNameSE);
        write_to_console("idCryp: ".$_POST['file_04']);
        write_to_console("idDecryp: ".$ID_User);

        //Si el campo de nuevo nombre no esta vacio, se reemplaza el nombre y Si no esta vacio, se le agrega el ID del usuario y un numero al azar para evitar duplicidades.
        if(!empty($UserFileName)) $newFileName= $UserFileName;
        else  $newFileName= $fileNameSE;

        //Lista de Extenciones permitidas para subir.
        $Extensiones = array('jpg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
        if (in_array($fileExt, $Extensiones)) {

          // Cargar el archivo en la nueva carpeta 
          $uploadFileDir = 'archivos_sub/';
          //Nombre del archivo con extencion y carpeta de destino
          $dest_path=$uploadFileDir.$ID_User.'_'.$newFileName.'_'.NumeroAzar().'.'.$fileExt;
          write_to_console($newFileName);        

          if(move_uploaded_file($fileTmpPath, $dest_path)){
            
            $message ='El Archivo se subio correctamente:'.$dest_path;
            
            //Si el archivo se subio correctamente, se inserta el registro en la base de datos
            $instruccion = "INSERT INTO `pr_docs` (`id_prospecto`, `doc_nombre`, `doc_url`, `doc_estatus`) VALUES ('$ID_User','$newFileName', '$dest_path', 'activo')";
   
            str_replace("''","NULL",$instruccion);
            $consulta = ConsultarSQLi($instruccion);
          
          }
            
          else
            $message = 'El archivo no se pudo guardar correctamente.';

          write_to_console($message);
        }
        else $message ='No es la extención'; 
      }
  
// < ----------- SUBIR ARCHIBOS PARA UN PROSPECTO 


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
            <li><a href="" class="active"><i class="fa fa-users fa-fw"></i>Prospectos</a></li>
            <li><a href="evaluacion.php"><i class="fa fa-check-square-o fa-fw"></i>evaluacion</a></li>
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
                <li><a href="" class="active">Prospectos</a></li>
                <li><a href="evaluacion.php">Evaluacion</a></li>
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
                    <td>&nbsp;</td>
                  </tr>
                </thead>
                <tbody>
  <?PHP
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
                <td><button class='templatemo-edit-btn' onClick=\"DivModal('prospectinfo.php?dat=>".$idprospect."','#MsgModal');\"><i class='fa fa-user fa-fw'></i>Ver</button></td>

                <td><button class='templatemo-edit-btn' onClick=\"DivModal('newdoc.php?dat=>".$idprospect."','#MsgModal');\"><i class='fa fa-plus-circle fa-fw'></i>Archivo</button></td>
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
            <div class="view-img-btn-wrap">
              <button class="btn btn-default templatemo-view-img-btn" onClick="DivModal('newprospect.php','#MsgModal');"><i class="fa fa-user-plus fa-fw"></i>Nuevo Prospecto</button>
            </div>
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