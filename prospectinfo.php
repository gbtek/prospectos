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
 
      <div class="MainFormModal templatemo-content-widget white-bg">
            <form action="index.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
              <i onClick="Cancelar('#MsgModal');" class="fa fa-times"></i>
              <div class="media margin-bottom-30">
                
                <?PHP
                  $idprosGet=Desencriptar($_GET['dat']);               
                  $consulta = ConsultarSQLi("select * from pr_prospectos where id_prospecto=$idprosGet limit 1");
                  //write_to_console($Querty);                

                  // Compara si la variable dat fue enviada por metodo GET y si tiene valor
                  if(isset($_GET['dat']) && $idprosGet>0){ 

                    // Verifica que la consulta haya regresado algun resultado
                    $nfilas = $consulta->num_rows;
                      if ($nfilas > 0)
                      {     // Carga los datos de al consulta en la variable fila
                            $fila = $consulta->fetch_assoc();

                ?>
                <div class="media-body">
                  <h2 class="media-heading text-uppercase"><?PHP print($fila['pros_nombre']." ".$fila['pros_apell1']." ".$fila['pros_apell2']); ?></h2>
                  
                  <table class="table table-striped ">
                    <tbody>
                    <tr>
                      <td><div class="<?PHP            print($fila['pros_estatus']."\">".$fila['pros_estatus']);?> :</div>
                        <?PHP print($fila['pros_notas']); ?>
                      </td>
                    </tr>
                  </table>
                  
                  <p> </p>
                </div>        
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><div class="circle blue-bg"></div></td>
                      <td>Nombre:</td>
                      <td><?PHP print($fila['pros_nombre']); ?></td>                    
                    </tr> 
                    <tr>
                      <td><div class="circle blue-bg"></div></td>
                      <td>Primer Apellido:</td>
                      <td><?PHP print($fila['pros_apell1']); ?></td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle blue-bg"></div></td>
                      <td>Segundo Apellido:</td>
                      <td><?PHP print($fila['pros_apell2']); ?></td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>Calle:</td>
                      <td><?PHP print($fila['pros_calle']); ?></td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>Número:</td>
                      <td><?PHP print($fila['pros_num']); ?></td>                    
                    </tr> 
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>Colonia:</td>
                      <td><?PHP print($fila['pros_col']); ?></td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle yellow-bg"></div></td>
                      <td>C.P. </td>
                      <td><?PHP print($fila['pros_cp']); ?></td>                    
                    </tr>  
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>Teléfono:</td>
                      <td><?PHP print($fila['pros_tel']); ?></td>                    
                    </tr>
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>RFC:</td>
                      <td><?PHP print($fila['pros_rfc']); ?></td>                    
                    </tr> 
                    <?PHP  // Continua con la consulta
                        }
                        else
                           print ("No hay datos disponibles");
                    } //Si está presente la variable dat se ejecuta
                      ?> 
                    
                    <tr>
                      <td><div class="circle green-bg"></div></td>
                      <td>ARCHIVOS:</td>
                      <td>
                        <?PHP //Lista todos los archivos disponibles del prospecto seleccionado.
                          $consulta = ConsultarSQLi("select * from pr_docs Where id_prospecto = $idprosGet;");

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
                              print ("<a href='".$fila['doc_url']."' target='_blank'>".$fila['doc_nombre']."</a>"); 
                              if (($i+1)<$nfilas) print(" , ");
                            }
                          }
                          else
                          print ("No hay Archivos disponibles");
                        ?> 
                      </td>                    
                    </tr> 
                  </tbody>
                </table>
              </div>             
            
              
              
        </form>
      </div>

    
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>        <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
    <script type="text/javascript" src="js/templatemo-script.js"></script>       
  </body>
</html>
