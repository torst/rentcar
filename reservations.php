<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Liste des réservations</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />
    <!-- Custom css by zbanzai -->
    <link rel="stylesheet" type="text/css" href="css/style-zbanzai.css" />
    <!-- pour l autocompletion -->
    <link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/selectize.default.css" data-theme="default">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
     <!-- js placed at the end of the document so the pages load faster -->
     <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
    <script src="js/respond.min.js" ></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    
  </head>

  <body>
	<div id="lockscreen">
  	<div class="lock-wrapper">
		<div id="time"></div>
		<div class="lock-box text-center">
            <img src="<?php echo $_SESSION["avatar"]; ?>" alt="lock avatar"/>
            <h1><?php echo $_SESSION["nom"]." ".$_SESSION["prenom"]; ?></h1>
            <span class="locked">Session en veille</span>
            <a class="btn btn-compose" id="unlock_screen_btn"  >
                             <i class=" icon-unlock icon-white"> </i> 
                          </a> 
        </div>
    </div>
   </div>
<!--fin lockscreen-->
  <section id="container" class="">
      <!--header start-->
      <?php
      	include("header.php");
      ?>
      <!--header end-->
      <!--sidebar start-->
      <?php
      	include("menu.php");
      ?>      <!--sidebar end-->
      <!--main content start-->
      <?php
      $action = isset( $_GET['action'] ) ? $_GET['action'] : "";
      switch ( $action ) {
		  case 'lister':
		    include("reservations/lister_reservations.php");
		    break;
		  case 'ajouter':
		    include("reservations/ajouter_reservations.php");
		    break;
		  case 'modifier':
		    include("reservations/modifier_reservations.php");
		    break;
		  case 'detailler':
		    include("reservations/detail_reservations.php");
		    break;
		  default:
		    include("reservations/lister_reservations.php");
		}
				
		?> 
      <!--main content end-->
      <!--footer start-->
      <?php
      	include("footer.php");
      ?>
      <!--footer end-->
  </section>

   
     
      <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
      <!--script for this page-->
	    <script src="js/reservations/validation-form-reservations.js"></script>
	    <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	    <script src="js/reservations/editable-table-reservations.js"></script>
        <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/reservations/date-reservations.js"></script>
       
		<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
      </script>
    
    <script src="js/inbox/alerte_inbox.js"></script>
    <script src="js/inbox/refresh_alerte_inbox.js" type="text/javascript"></script>
	<script src="js/idle_timer.js" type="text/javascript"></script>
    <script src="js/lockscreen.js" type="text/javascript"></script>
    
    <script src="js/reservations/reservation.js"></script>
  </body>
</html>
