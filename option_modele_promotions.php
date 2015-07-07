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

    <title>Liste des options en promotion pour un modèle</title>

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
    <!-- Custom css by zbanzai -->
    <link rel="stylesheet" type="text/css" href="css/style-zbanzai.css" />

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
		    include("option_modele_promotions/lister_option_modele_promotions.php");
		    break;
		  case 'ajouter':
		    include("option_modele_promotions/ajouter_option_modele_promotions.php");
		    break;
		  case 'modifier':
		    include("option_modele_promotions/modifier_option_modele_promotions.php");
		    break;
		  case 'detailler':
		    include("option_modele_promotions/detail_option_modele_promotions.php");
		    break;
		  default:
		    include("option_modele_promotions/lister_option_modele_promotions.php");
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
	    <script src="js/option_modele_promotions/validation-form-option_modele_promotions.js"></script>
	    <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	    <script src="js/option_modele_promotions/editable-table-option_modele_promotions.js"></script>
        <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/option_modele_promotions/date-option_modele_promotions.js"></script>
       
		<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
      </script>
    
    

  </body>
</html>
