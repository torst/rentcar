<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_mail_modeles"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_mail_modeles"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_mail_modeles"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_mail_modeles'])){
			
	$id=$_POST['id_mail_modeles'];
	$nom=$_POST['nom'];
	$corps=$_POST['corps'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	
	//unicite login
	include("../config.php");
	$query = "SELECT `nom` FROM mail_modeles WHERE `nom`='" . mysql_real_escape_string($nom) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_nom = "Le Nom renseigné est déjà attribué, veuillez renseigner un Nom correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../mail_modeles.php?action=modifier&&id_mail_modeles=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&corps=".urlencode($corps);
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `mail_modeles` SET 
	`nom` ='".mysql_real_escape_string($nom)."',
	`corps` ='".mysql_real_escape_string(nl2br($corps))."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../mail_modeles.php?action=detailler&&id_mail_modeles=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../mail_modeles.php?action=modifier&&id_mail_modeles=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$nom=$_POST['nom'];
	$corps=$_POST['corps'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	$query = "SELECT `nom` FROM mail_modeles WHERE `nom`='" . mysql_real_escape_string($nom) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_nom = "Le nom renseigné est déjà attribué, veuillez renseigner un nom correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../mail_modeles.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&corps=".urlencode($corps);
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "INSERT into `mail_modeles` (`nom`,`corps`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string(nl2br($corps))."')" ;
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../mail_modeles.php?action=detailler&&id_mail_modeles=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../mail_modeles.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
					
			include("../config.php");
			
			$query = "delete  FROM mail_modeles WHERE `id`=" . $id ;
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