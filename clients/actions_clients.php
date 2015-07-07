<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_clients"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_clients"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_clients"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_clients'])){
			
	$id=$_POST['id_clients'];
	$nom=($_POST['nom']);
	$prenom=($_POST['prenom']);
	$raison_social=($_POST['raison_social']);
	$numero=($_POST['numero']);
	$adresse=($_POST['adresse']);
	$telephone=($_POST['telephone']);
	$fax=($_POST['fax']);
	$type_pi=($_POST['type_pi']);
	$type_client=($_POST['type_client']);
	$nationalite=($_POST['nationalite']);
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($prenom,"")==0) {
		$erreur_prenom = "Veuillez renseigner le Prénom";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($adresse,"")==0) {
		$erreur_adresse = "Veuillez renseigner l'Adresse";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($telephone,"")==0) {
		$erreur_telephone = "Veuillez renseigner le Télephone";
		$erreur=1;
	}
	//unicite numero identite
	include("../config.php");
	$query = "SELECT `numero_pi` FROM client WHERE `numero_pi`='" . mysql_real_escape_string($numero) . "' and `id`<> ".$id. " and `type_pi`= ".$type_pi;

	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_numero = "Le Numéro d'identité renseigné est déjà attribué, veuillez renseigner un Numéro d'identité correct";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../clients.php?action=modifier&&id_clients=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&prenom=".$prenom;
		$header = $header."&&adresse=".$adresse;
		$header = $header."&&telephone=".$telephone;
		$header = $header."&&numero=".$numero;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_prenom,"")!=0) {
			$header = $header."&&erreur_prenom=".$erreur_prenom;
			
		}
		if(strcmp($erreur_adresse,"")!=0) {
			$header = $header."&&erreur_adresse=".$erreur_adresse;
			
		}
		if(strcmp($erreur_telephone,"")!=0) {
			$header = $header."&&erreur_telephone=".$erreur_telephone;
			
		}
		if(strcmp($erreur_numero,"")!=0) {
			$header = $header."&&erreur_numero=".$erreur_numero;
			
		}
		
		header($header);
		exit;
	}
	      
          //requete
	$requete = "UPDATE `client` SET 
	`nom` ='".mysql_real_escape_string($nom)."',
	`prenom` ='".mysql_real_escape_string($prenom)."',
	`raison_social` =";
	if(strcmp($raison_social,"")==0) 
		$requete = $requete."NULL";
	else
		$requete = $requete."'".mysql_real_escape_string($raison_social)."' ";
	
	$requete = $requete.",
	`type_pi` =".mysql_real_escape_string($type_pi).",
	`numero_pi` =";
	if(strcmp($numero,"")==0) 
		$requete = $requete."NULL";
	else
		$requete = $requete."'".mysql_real_escape_string($numero)."' ";
	
	$requete = $requete.", 
	`adresse` ='".mysql_real_escape_string($adresse)."',
	`telephone` ='".mysql_real_escape_string($telephone)."',
	`fax` =";
	if(strcmp($fax,"")==0) 
		$requete = $requete."NULL";
	else
		$requete = $requete."'".mysql_real_escape_string($fax)."' ";
	
	$requete = $requete.",
	`type` =".mysql_real_escape_string($type_client).",
	`nationnalite` = ".mysql_real_escape_string($nationalite);
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../clients.php?action=detailler&&id_clients=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../clients.php?action=modifier&&id_clients=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$nom=($_POST['nom']);
	$prenom=($_POST['prenom']);
	$raison_social=($_POST['raison_social']);
	$numero=($_POST['numero']);
	$adresse=($_POST['adresse']);
	$telephone=($_POST['telephone']);
	$fax=($_POST['fax']);
	$type_pi=($_POST['type_pi']);
	$type_client=($_POST['type_client']);
	$nationalite=($_POST['nationalite']);
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($prenom,"")==0) {
		$erreur_prenom = "Veuillez renseigner le Prénom";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($adresse,"")==0) {
		$erreur_adresse = "Veuillez renseigner l'Adresse";
		$erreur=1;
	}
	$erreur = 0;
	if(strcmp($telephone,"")==0) {
		$erreur_telephone = "Veuillez renseigner le Télephone";
		$erreur=1;
	}
	//unicite numero identite
	include("../config.php");
	$query = "SELECT `numero_pi` FROM client WHERE `numero_pi`='" . mysql_real_escape_string($numero) .  "' and `type_pi`= ".$type_pi;

	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_numero = "Le Numéro d'identité renseigné est déjà attribué, veuillez renseigner un Numéro d'identité correct";
		$erreur=1;
	}
	
	
	if($erreur == 1)
	{
		
		$header = "location:../clients.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&prenom=".$prenom;
		$header = $header."&&adresse=".$adresse;
		$header = $header."&&telephone=".$telephone;
		$header = $header."&&numero=".$numero;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_prenom,"")!=0) {
			$header = $header."&&erreur_prenom=".$erreur_prenom;
			
		}
		if(strcmp($erreur_adresse,"")!=0) {
			$header = $header."&&erreur_adresse=".$erreur_adresse;
			
		}
		if(strcmp($erreur_telephone,"")!=0) {
			$header = $header."&&erreur_telephone=".$erreur_telephone;
			
		}
		if(strcmp($erreur_numero,"")!=0) {
			$header = $header."&&erreur_numero=".$erreur_numero;
			
		}
		
		header($header);
		exit;
	} 
          //requete
	$requete = "INSERT into `client` (
		`nom` ,
		`prenom` ,
		`raison_social` ,
		`type_pi` ,
		`numero_pi` ,
		`adresse` ,
		`telephone` ,
		`fax` ,
		`type` ,
		`nationnalite`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string($prenom)."',";
	if(strcmp($raison_social,"")!=0) 
		$requete = $requete."'".mysql_real_escape_string($raison_social)."',";
	else
		$requete = $requete."NULL,";
	
	$requete = $requete."'".mysql_real_escape_string($type_pi)."',";
	if(strcmp($numero,"")!=0) 
		$requete = $requete."'".mysql_real_escape_string($numero)."',";
	else
		$requete = $requete."NULL,";
	
	$requete = $requete."'".mysql_real_escape_string($adresse)."',".
	"'".mysql_real_escape_string($telephone)."',";
	
	if(strcmp($fax,"")!=0) 
		$requete = $requete."'".mysql_real_escape_string($fax)."',";
	else
		$requete = $requete."NULL,";
	
	$requete = $requete.mysql_real_escape_string($type_client).",".mysql_real_escape_string($nationalite).")" ;
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../clients.php?action=detailler&&id_clients=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../clients.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
					
			include("../config.php");
			
			$query = "delete  FROM client WHERE `id`=" . $id ;
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