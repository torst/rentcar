<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
		
	//recuperation des coordonnées de l agence si l id_agence existe dans l URL
	if(isset($_GET['id_agence'])){ 
		include("config.php");
  		$id_agence=$_GET['id_agence'];
		$query = "SELECT 
				`agence`.`latitude`,
				`agence`.`longitude`
				FROM 
				agence
				WHERE
				 `agence`.`id`= ".$id_agence;

		$result = mysql_query($query);
		$ligne=mysql_fetch_row($result);
		$latt = $ligne[0];
		$long = $ligne[1];	
		}
		else{ 
		$latt = "34.0122322";
		$long = "-6.8160400";
		}
		
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
	
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

    <title>Liste des agences</title>

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
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

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
	
     <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgrj58PbXr2YriiRDqbnL1RSqrCjdkglBijPNIIYrqkVvD1R4QxRl47Yh2D_0C1l5KXQJGrbkSDvXFA"
      type="text/javascript"></script>
      
      <script type="text/javascript">

 function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        
        var center = new GLatLng(<?php echo $latt; ?>, <?php echo $long; ?>);
        map.setCenter(center, 10);
        geocoder = new GClientGeocoder();
        var marker = new GMarker(center, {draggable: <?php if (strcmp($action,"detailler")==0) echo "false"; else echo "true"; ?>});  
        map.addOverlay(marker);
        
        document.getElementById("lat2").value = center.lat().toFixed(7);
	   document.getElementById("lng2").value = center.lng().toFixed(7);
        

	  GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
	      map.panTo(point);
       
       document.getElementById("lat2").value = point.lat().toFixed(7);
	   document.getElementById("lng2").value = point.lng().toFixed(7);

        });

<?php if (strcmp($action,"detailler")!=0) { ?>
	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: <?php if (strcmp($action,"detailler")==0) echo "false"; else echo "true"; ?>});
		  map.addOverlay(marker);
	   
	   document.getElementById("lat2").value = center.lat().toFixed(7);
	   document.getElementById("lng2").value = center.lng().toFixed(7);


	 GEvent.addListener(marker, "dragend", function() {
      var point =marker.getPoint();
	     map.panTo(point);
	     
	     document.getElementById("lat2").value = point.lat().toFixed(7);
	   document.getElementById("lng2").value = point.lng().toFixed(7);

        });
 
        });
<?php } ?>
      }
    }

		

	   function showAddress(address) {
	   var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       map.addControl(new GMapTypeControl());
       if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
	   
	   document.getElementById("lat2").value = point.lat().toFixed(7);
	   document.getElementById("lng2").value = point.lng().toFixed(7);
	   
		 map.clearOverlays()
			map.setCenter(point, 14);
   var marker = new GMarker(point, {draggable: <?php if (strcmp($action,"detailler")==0) echo "false"; else echo "true"; ?>});  
		 map.addOverlay(marker);

		GEvent.addListener(marker, "dragend", function() {
      var pt = marker.getPoint();
	     map.panTo(pt);
	     
	     document.getElementById("lat2").value = pt.lat().toFixed(7);
	   document.getElementById("lng2").value = pt.lng().toFixed(7);
        });


	 GEvent.addListener(map, "moveend", function() {
		  map.clearOverlays();
    var center = map.getCenter();
		  var marker = new GMarker(center, {draggable: <?php if (strcmp($action,"detailler")==0) echo "false"; else echo "true"; ?>});
		  map.addOverlay(marker);
	   
	   document.getElementById("lat2").value = center.lat().toFixed(7);
	   document.getElementById("lng2").value = center.lng().toFixed(7);

	 GEvent.addListener(marker, "dragend", function() {
     var pt = marker.getPoint();
	    map.panTo(pt);
	   
	   document.getElementById("lat2").value = pt.lat().toFixed(7);
	   document.getElementById("lng2").value = pt.lng().toFixed(7);
        });
 
        });

            }
          }
        );
      }
    }
    </script>
    
  </head>

  <body onload="load()" onunload="GUnload()">

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
		    include("agences/lister_agences.php");
		    break;
		  case 'ajouter':
		    include("agences/ajouter_agence.php");
		    break;
		  case 'modifier':
		    include("agences/modifier_agence.php");
		    break;
		  case 'detailler':
		    include("agences/detail_agence.php");
		    break;
		  default:
		    include("agences/lister_agences.php");
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
	    <script src="js/agences/validation-form-agence.js"></script>
	    <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	    <script src="js/agences/editable-table-agences.js"></script>
        <script src="js/respond.min.js" ></script>
        
       
		<script>
          jQuery(document).ready(function() {
			  
              EditableTable.init();
          });
      </script>
    

   
    

  </body>
</html>
