<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_vehicules"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_vehicules"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_vehicules"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_vehicules'])){
			
	$id=$_POST['id_vehicules'];
	$matricule=$_POST['matricule'];
	$chassis=$_POST['chassis'];
	$couleur=$_POST['couleur'];
	$modele=$_POST['modele'];
	$statut=$_POST['statut'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($matricule,"")==0) {
		$erreur_matricule = "Veuillez renseigner le Matricule";
		$erreur=1;
	}
	
	//unicite login
	include("../config.php");
	$query = "SELECT `matricule` FROM vehicule WHERE `matricule`='" . mysql_real_escape_string($matricule) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_matricule = "Le Matricule renseigné est déjà attribué, veuillez renseigner un Matricule correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../vehicules.php?action=modifier&&id_vehicules=".$id;
		$header = $header."&&matricule=".$matricule;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_matricule,"")!=0) {
			$header = $header."&&erreur_matricule=".$erreur_matricule;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `vehicule` SET 
	`matricule` ='".mysql_real_escape_string($matricule)."',
	`chassis` ='".mysql_real_escape_string($chassis)."',
	`couleur` ='".mysql_real_escape_string($couleur)."',
	`modele` =".mysql_real_escape_string($modele).",
	`statut` = ".mysql_real_escape_string($statut);
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../vehicules.php?action=detailler&&id_vehicules=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../vehicules.php?action=modifier&&id_vehicules=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$matricule=$_POST['matricule'];
	$chassis=$_POST['chassis'];
	$couleur=$_POST['couleur'];
	$modele=$_POST['modele'];
	$statut=$_POST['statut'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($matricule,"")==0) {
		$erreur_matricule = "Veuillez renseigner le matricule";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	$query = "SELECT `matricule` FROM vehicule WHERE `matricule`='" . mysql_real_escape_string($matricule) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_matricule = "Le matricule renseigné est déjà attribué, veuillez renseigner un matricule correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../vehicules.php?action=ajouter";
		$header = $header."&&matricule=".$matricule;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_matricule,"")!=0) {
			$header = $header."&&erreur_matricule=".$erreur_matricule;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "INSERT into `vehicule` (`matricule`,`chassis`,`couleur`,`modele`,`statut`) VALUES( 
	'".mysql_real_escape_string($matricule)."',
	'".mysql_real_escape_string($chassis)."',
	'".mysql_real_escape_string($couleur)."',
	".mysql_real_escape_string($modele).",
	".mysql_real_escape_string($statut).")" ;
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../vehicules.php?action=detailler&&id_vehicules=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../vehicules.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
					
			include("../config.php");
			
			$query = "delete  FROM vehicule WHERE `id`=" . $id ;
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