<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_GET['format'] ) ? $_GET['format'] : "";
      switch ( $option ) {
		  case 'excel':
		  	
		    	excel();
		    
		    
		  case 'pdf':
		  	
		    	pdf();
		    
		
		  
		    
		  default:
		  	//traitement erreur
		    
		}
		
function excel() {
    
	include("../config.php");
	$excel ="Colonne 1 \t Colonne 2 \t Colonne 3 \n";
                              
	$query = "SELECT 
			`articles_site`.`id`,
			`articles_site`.`nom`
			FROM 
			articles_site
			";

	$result = mysql_query($query);
	while($ligne=mysql_fetch_row($result)){
		$excel .= "$ligne[0] \t $ligne[1] \t $ligne[1]  \n";
		
		}
	header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=export.xls");
    print $excel;
    exit;
  
}

function pdf() {
	

	include("../config.php");
	$query = "SELECT `nom` FROM articles_site WHERE `nom`='" . mysql_real_escape_string($nom) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_nom = "Le Nom renseigné est déjà attribué, veuillez renseigner un Nom correct";
		$erreur=1;
	}
	

}

?> 