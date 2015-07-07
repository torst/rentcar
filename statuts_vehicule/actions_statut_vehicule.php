<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_statut_vehicule"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_statut_vehicule"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_statut_vehicule"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_statut_vehicule'])){
			
	$id=$_POST['id_statut_vehicule'];
	
	$nom=($_POST['nom']);
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	
	//unicite login
	include("../config.php");
	$query = "SELECT `nom` FROM statut_vehicule WHERE `nom`='" . mysql_real_escape_string($nom) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_nom = "Le Nom renseigné est déjà attribué, veuillez renseigner un Nom correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../statuts_vehicule.php?action=modifier&&id_statut_vehicule=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `statut_vehicule` SET 
	`nom`='".mysql_real_escape_string($nom)."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../statuts_vehicule.php?action=detailler&&id_statut_vehicule=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../statuts_vehicule.php?action=modifier&&id_statuts_vehicule=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$nom=($_POST['nom']);
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	$query = "SELECT `nom` FROM statut_vehicule WHERE `nom`='" . mysql_real_escape_string($nom) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_nom = "Le Nom renseigné est déjà attribué, veuillez renseigner un Nom correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../statuts_vehicule.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "INSERT into `statut_vehicule` (`nom`) VALUES( 
	'".mysql_real_escape_string($nom)."')" ;
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../statuts_vehicule.php?action=detailler&&id_statut_vehicule=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../statuts_vehicule.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
					
			include("../config.php");
			
			$query = "delete  FROM statut_vehicule WHERE `id`=" . $id ;
			if(mysql_query($query)){
				
				echo "OK:Enregistrement supprimé avec succès";
			}
			
			else
			{
				echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
			}
		
	}	
	else
	{
		echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
	}
  		
}
?> 