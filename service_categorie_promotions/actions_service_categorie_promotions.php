<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php

      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
	  
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_service_categorie_promotions"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_service_categorie_promotions"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_service_categorie_promotions"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
	
if(isset($_POST['categorie']) && isset($_POST['service'])){
	
	$date_debut=($_POST['date_debut']);
	$date_fin=($_POST['date_fin']);
	$prix_court=($_POST['prix_court']);
	$prix_longue=($_POST['prix_longue']);
	$categorie=$_POST['categorie'];
	$service=$_POST['service'];
	$id_categorie=$_POST['id_categorie'];
	$id_service=$_POST['id_service'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($date_debut,"")==0) {
		$erreur_date_debut = "Veuillez renseigner la date de début";
		$erreur=1;
	}
	
	if(strcmp($date_fin,"")==0) {
		$erreur_date_fin = "Veuillez renseigner la date de fin";
		$erreur=1;
	}
	
	if(strcmp($prix_court,"")==0) {
		$erreur_prix_court = "Veuillez renseigner le prix de courte durée";
		$erreur=1;
	}
	
	if(strcmp($prix_longue,"")==0) {
		$erreur_prix_longue = "Veuillez renseigner le prix de longue durée";
		$erreur=1;
	}
	//validation dates
	 
	if (!validateDate($date_debut, 'd/m/Y')){
		$erreur_date_debut = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!validateDate($date_fin, 'd/m/Y')){
		$erreur_date_fin = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!compareDate($date_debut, 'd/m/Y',$date_fin, 'd/m/Y')){
		$erreur_date_fin = "La date de fin ne peut pas être inférieure ou égale à la date de début";
		$erreur=1;
	}
	
	
	//unicite categorie
	include("../config.php");
	
	$trouve=0;
	$query = "SELECT `categorie`,`service` FROM promotion_service_categorie WHERE `categorie`=" . mysql_real_escape_string($categorie) . " and `service`=" . mysql_real_escape_string($service) ;
	$result = mysql_query($query);
	while($ligne=mysql_fetch_row($result)){
	 $trouve=1;
	 if( $ligne[0] == $id_categorie && $ligne[1] == $id_service)
	  $trouve=0;
	}
	if($trouve==1){
    	$erreur_categorie = "Le service renseigné est déjà en promotion pour cette catégorie, veuillez renseigner un autre couple (service,catégorie)";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix_court)) {
		$erreur_prix_court = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix_court < 0) {
		$erreur_prix_court = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix_longue)) {
		$erreur_prix_longue = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix_longue < 0) {
		$erreur_prix_longue = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	
	if($erreur == 1)
	{
		
		$header = "location:../service_categorie_promotions.php?action=modifier&&id_service=".$id_service."&&id_categorie=".$id_categorie;
		$header = $header."&&categorie=".$categorie;
		$header = $header."&&service=".$service;
		$header = $header."&&erreur=".$erreur;
		$header = $header."&&date_debut=".$date_debut;
		$header = $header."&&date_fin=".$date_fin;
		$header = $header."&&prix_court=".$prix_court;
		$header = $header."&&prix_longue=".$prix_longue;
		if(strcmp($erreur_categorie,"")!=0) {
			$header = $header."&&erreur_categorie=".$erreur_categorie;
			
		}
		if(strcmp($erreur_date_debut,"")!=0) {
			$header = $header."&&erreur_date_debut=".$erreur_date_debut;
			
		}
		if(strcmp($erreur_date_fin,"")!=0) {
			$header = $header."&&erreur_date_fin=".$erreur_date_fin;
			
		}
		if(strcmp($erreur_prix_court,"")!=0) {
			$header = $header."&&erreur_prix_court=".$erreur_prix_court;
			
		}
		if(strcmp($erreur_prix_longue,"")!=0) {
			$header = $header."&&erreur_prix_longue=".$erreur_prix_longue;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `promotion_service_categorie` SET 
	`categorie` =".mysql_real_escape_string($categorie).",
	`service` =".mysql_real_escape_string($service).",
	`prix_court_duree` =".mysql_real_escape_string($prix_court).",
	`prix_longue_duree` =".mysql_real_escape_string($prix_longue).",
	`date_debut` =STR_TO_DATE('".mysql_real_escape_string($date_debut)."', '%d/%m/%Y'),
	`date_fin` = STR_TO_DATE('".mysql_real_escape_string($date_fin)."', '%d/%m/%Y')";
	$requete = $requete." WHERE `categorie`=".$id_categorie;
	$requete = $requete." and `service`=".$id_service;
	
        if(mysql_query($requete)){
			$header = "location:../service_categorie_promotions.php?action=detailler&&id_service=".$service."&&id_categorie=".$categorie."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../service_categorie_promotions.php?action=modifier&&id_service=".$id_service."&&id_categorie=".$id_categorie;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	$date_debut=($_POST['date_debut']);
	$date_fin=($_POST['date_fin']);
	$prix_court=($_POST['prix_court']);
	$prix_longue=($_POST['prix_longue']);
	$categorie=$_POST['categorie'];
	$service=$_POST['service'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($date_debut,"")==0) {
		$erreur_date_debut = "Veuillez renseigner la date de début";
		$erreur=1;
	}
	
	if(strcmp($date_fin,"")==0) {
		$erreur_date_fin = "Veuillez renseigner la date de fin";
		$erreur=1;
	}
	
	if(strcmp($prix_court,"")==0) {
		$erreur_prix_court = "Veuillez renseigner le prix de courte durée";
		$erreur=1;
	}
	
	if(strcmp($prix_longue,"")==0) {
		$erreur_prix_longue = "Veuillez renseigner le prix de longue durée";
		$erreur=1;
	}
	//validation dates
	 
	if (!validateDate($date_debut, 'd/m/Y')){
		$erreur_date_debut = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!validateDate($date_fin, 'd/m/Y')){
		$erreur_date_fin = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!compareDate($date_debut, 'd/m/Y',$date_fin, 'd/m/Y')){
		$erreur_date_fin = "La date de fin ne peut pas être inférieure ou égale à la date de début";
		$erreur=1;
	}
	//unicite categorie
	include("../config.php");
	$query = "SELECT `categorie` FROM promotion_service_categorie WHERE `categorie`='" . mysql_real_escape_string($categorie) . "' and `service`='" . mysql_real_escape_string($service) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_categorie = "Le service renseigné est déjà en promotion pour cette catégorie, veuillez renseigner un autre service ou une autre catégorie";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix_court)) {
		$erreur_prix_court = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix_court < 0) {
		$erreur_prix_court = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix_longue)) {
		$erreur_prix_longue = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix_longue < 0) {
		$erreur_prix_longue = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../service_categorie_promotions.php?action=ajouter";
		$header = $header."&&categorie=".$categorie;
		$header = $header."&&erreur=".$erreur;
		$header = $header."&&date_debut=".$date_debut;
		$header = $header."&&date_fin=".$date_fin;
		$header = $header."&&prix_court=".$prix_court;
		$header = $header."&&prix_longue=".$prix_longue;
		if(strcmp($erreur_categorie,"")!=0) {
			$header = $header."&&erreur_categorie=".$erreur_categorie;
			
		}
		if(strcmp($erreur_date_debut,"")!=0) {
			$header = $header."&&erreur_date_debut=".$erreur_date_debut;
			
		}
		if(strcmp($erreur_date_fin,"")!=0) {
			$header = $header."&&erreur_date_fin=".$erreur_date_fin;
			
		}
		if(strcmp($erreur_prix_court,"")!=0) {
			$header = $header."&&erreur_prix_court=".$erreur_prix_court;
			
		}
		if(strcmp($erreur_prix_longue,"")!=0) {
			$header = $header."&&erreur_prix_longue=".$erreur_prix_longue;
			
		}
		
		header($header);
		exit;
	}
        
          //requete
	$requete = "INSERT into `promotion_service_categorie` (`categorie`,`service`,`prix_court_duree`,`prix_longue_duree`,`date_debut`,`date_fin`) VALUES( 
	".mysql_real_escape_string($categorie).",
	".mysql_real_escape_string($service).",
	".mysql_real_escape_string($prix_court).",
	".mysql_real_escape_string($prix_longue).",
	STR_TO_DATE('".mysql_real_escape_string($date_debut)."', '%d/%m/%Y'),
	STR_TO_DATE('".mysql_real_escape_string($date_fin)."', '%d/%m/%Y'))" ;
	
       if(mysql_query($requete)){
       		
			$header = "location:../service_categorie_promotions.php?action=detailler&&id_categorie=".$categorie."&&id_service=".$service."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../service_categorie_promotions.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id_service']) && isset($_POST['id_categorie'])){
		$id_service=$_POST['id_service'];
		$id_categorie=$_POST['id_categorie'];
					
			include("../config.php");
			
			$query = "delete  FROM promotion_service_categorie WHERE `categorie`=" . $id_categorie." and `service`=" . $id_service ;
			
			if(mysql_query($query)){
				
				echo "OK:Enregistrement supprimé avec succès";
			}
			
			else
			{
				echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.tozz";
			}
		
	}	
	else
	{
		echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
	}
  		
}
function validateDate($date, $format = 'd/m/Y')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
function compareDate($date1, $format1 = 'd/m/Y',$date2, $format2 = 'd/m/Y')
		{
			$d1 = DateTime::createFromFormat($format1, $date1);
			$d2 = DateTime::createFromFormat($format2, $date2);
			if($d2->getTimestamp() <= $d1->getTimestamp())
				return false;
			else 
				return true;
			
		}
?> 