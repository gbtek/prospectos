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