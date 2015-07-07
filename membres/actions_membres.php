<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_membres"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_membres"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_membres"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_membres'])){
			
	$id=$_POST['id_membres'];
	$email=$_POST['email'];
	$statut=$_POST['statut'];
	$client=$_POST['client'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($email,"")==0) {
		$erreur_email = "Veuillez renseigner l'Email";
		$erreur=1;
	}
	
	//unicite email
	include("../config.php");
	$query = "SELECT `email` FROM membre WHERE `email`='" . mysql_real_escape_string($email) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_email = "L'Email renseigné est déjà attribué, veuillez renseigner un email correct";
		$erreur=1;
	}
	
	
	
	if($erreur == 1)
	{
		
		$header = "location:../membres.php?action=modifier&&id_membres=".$id;
		$header = $header."&&email=".$email;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_email,"")!=0) {
			$header = $header."&&erreur_email=".$erreur_email;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `membre` SET 
	`email` ='".mysql_real_escape_string($email)."',
	`statut` = ".mysql_real_escape_string($statut);
	//si fiche client renseignée
	if(strcmp($client,"")!=0) {
		$requete = $requete." ,  `id_client`=".$client;
	}
	$requete = $requete." WHERE `id`=".$id;
	
	
	
        if(mysql_query($requete)){
			$header = "location:../membres.php?action=detailler&&id_membres=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../membres.php?action=modifier&&id_membres=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$email=$_POST['email'];
	$statut=$_POST['statut'];
	$client=$_POST['client'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($email,"")==0) {
		$erreur_email = "Veuillez renseigner l'Email";
		$erreur=1;
	}
	//unicite email
	include("../config.php");
	$query = "SELECT `email` FROM membre WHERE `email`='" . mysql_real_escape_string($email) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_email = "L'Email renseigné existe déjà dans votre base de données, veuillez renseigner un autre email";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../membres.php?action=ajouter";
		$header = $header."&&email=".$email;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_email,"")!=0) {
			$header = $header."&&erreur_email=".$erreur_email;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "INSERT into `membre` (`email`,`password`,`statut`) VALUES( 
	'".mysql_real_escape_string($email)."',
	MD5( 'Pa123456' ) ,
	".mysql_real_escape_string($statut).")" ;
	//si fiche client renseignée
	if(strcmp($client,"")!=0) {
		$requete = "INSERT into `membre` (`email`,`password`,`statut`,`id_client`) VALUES( 
		'".mysql_real_escape_string($email)."',
		MD5( 'Pa123456' ) ,
		".mysql_real_escape_string($statut)."
		, ".mysql_real_escape_string($client).")" ;
	}
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../membres.php?action=detailler&&id_membres=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			//envoie email au client lui informer du compte créé avec son nouveau mot de passe
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../membres.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
					
			include("../config.php");
			
			$query = "delete  FROM membre WHERE `id`=" . $id ;
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