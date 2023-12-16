<?php
//*/ server setings
define("HOST", "localhost");// El alojamiento al que deseas conectarte
define("USER", "root");// El nombre de usuario de la base de datos
//define("PWD", "=S]JmRL[N?YE");// La contraseña de la base de datos
define("PWD", "");// La contraseña de la base de datos
define("BDN", "prospectos");  // El nombre de la base de datos
//*/

$MESES = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


// FUNCION PARA CONECTAR A LA BASE DE DATOS
function Conectar(){
	
  $conexion = new mysqli(HOST, USER,PWD, BDN);
    if ($conexion->connect_errno) {
      echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
    }
	return $conexion;
}

// FUNCION PARA REALIZAR CONSULTAS A LA BASE DE DATOS
function ConsultarSQLi ($instruccion){
  $conexion = mysqli_connect(HOST, USER,PWD, BDN);
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
  }
   
  if ($resultado = mysqli_query($conexion, $instruccion)) 
    return $resultado;
  else 
    return "Error al leer datos ".mysqli_error(); 
}

// FUNCION PARA GENERAR UNA SESION
function sec_session_start() {
    session_start();            // Inicia la sesión PHP.
    //session_regenerate_id();    // Regenera la sesión, borra la previa. 
}
//INICIO DE SESION
function login($nomusuario, $password) {
  	$INST = "SELECT id_user, user_name, user_pass, user_displayname, user_type FROM pr_usdata WHERE user_name='$nomusuario' LIMIT 1;";
		
    $consulta= ConsultarSQLi($INST);
  
		$nfilas = $consulta->num_rows;
		
    if($nfilas > 0){// Si hay registros, los guarda en la variable UsInf
			$Usuario = $consulta->fetch_assoc();

			if( (md5($password))===$Usuario['user_pass']){// compara la contraseña tecleada con la almacenada
        
        $_SESSION['DU51']=$Usuario['id_user'];
			  $_SESSION['DU52']=$Usuario['user_type'];
			  $_SESSION['DU53']=$Usuario['user_displayname'];
        $_SESSION['DU54']=time();
        
				return "iniciar" ; // si es correcto, guardara los datos en SESSION
			}
			else // De lo contrario enviara un mensaje de contraseña incorrecta
				return "psswrd";// compara la contraseña tecleada con la almacenada];
		}
		else // Si no encuentra ningun dato, regresara la siguiente leyenda
			return "name";

}//---------FUNCION login

function write_to_console($data) {
 $console = $data;
 if (is_array($console))
 $console = implode(',', $console);

 echo "<script>console.log('Console: " . $console . "' );</script>";
}

function Encriptar($string) {
   $key="	2(v-";
	 $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
//---------ENCRIPTAR STRING <--
//---------DESENCRIPTAR STRING -->	
function Desencriptar($string) {
   $key="	2(v-";
	 $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

function NumeroAzar(){
		date_default_timezone_set('America/Mazatlan');
		$Ahora=getdate();
	$CodigoAl= "$Ahora[year]$Ahora[mon]$Ahora[mday]$Ahora[hours]$Ahora[minutes]$Ahora[seconds]";
	return $CodigoAl;
}



function formatFecha($Fecha){
	$anio=substr($Fecha, 0,4); $mes=substr($Fecha,5,-3); $dia=substr($Fecha, 8);
	if ($mes=='01') $mes="Ene";
	elseif ($mes=='02') $mes="Feb";
	elseif ($mes=='03') $mes="Mar";
	elseif ($mes=='04') $mes="Abr";
	elseif ($mes=='05') $mes="May";
	elseif ($mes=='06') $mes="Jun";
	elseif ($mes=='07') $mes="Jul";
	elseif ($mes=='08') $mes="Ago";
	elseif ($mes=='09') $mes="Sep";
	elseif ($mes=='10') $mes="Oct";
	elseif ($mes=='11') $mes="Nov";
	elseif ($mes=='12') $mes="Dic";
	return $dia."-".$mes."-".$anio;
}



?>
