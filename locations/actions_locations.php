<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php

      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
	  
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_reservations"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_locations"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_reservations"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_reservation']) ){
	include("../config.php");
	$statut_reservation=$_POST['statut_reservation'];
	$id_reservation=$_POST['id_reservation'];

	//cham a modifier

	//Montant a payer
	//statut paiement
	//statut location
	//commentaire suivi location
	
          //requete
	$requete = "update `reservation` set `statut_reservation` = ?1 where `id`= ?2";	  
	$requete =str_replace("?1",mysql_real_escape_string(mysql_real_escape_string($statut_reservation)),$requete);
	$requete =str_replace("?2",mysql_real_escape_string($id_reservation),$requete);
	
        if(mysql_query($requete)){
			$header = "location:../reservations.php?action=detailler&&id_reservation=".$id_reservation."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../reservations.php?action=modifier&&id_reservation=".$id_reservation;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	$client=($_POST['client']);
	$vehicule=$_POST['vehicule'];
	$date_debut=($_POST['date_debut']);
	$date_fin=($_POST['date_fin']);
	$heure_debut=($_POST['heure_debut']);
	$heure_fin=($_POST['heure_fin']);
	$agence_depart=($_POST['agence_depart']);
	$agence_reprise=($_POST['agence_reprise']);
	$lieu_depart=($_POST['lieu_depart']);
	$lieu_reprise=($_POST['lieu_reprise']);
	$options=$_POST['options'];
	$services=$_POST['services'];
	$remise=$_POST['remise'];
	$valeur_remise=$_POST['valeur_remise'];
	$montant_apayer=($_POST['montant_apayer']);
	$montant_paye=($_POST['montant_paye']);
	$statut_paiement=$_POST['statut_paiement'];
	$type_paiement=$_POST['mode_paiement'];
	$statut_location=($_POST['statut_location']);
	
	
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
	//unicite modele
	include("../config.php");
	
	//test si prix a payer est numerique
	if(!is_numeric($montant_apayer)) {
		if($montant_apayer == "") {
			$montant_apayer = 0;
		}
		else {
			$erreur_montant_apayer = "Veuillez renseigner une valeur numérique";
			$erreur=1;
			}
	}
	
	//test si prix a payer est positive
	else
	if($montant_apayer < 0) {
		$erreur_montant_apayer = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	//test si prix paye est numerique
	if(!is_numeric($montant_paye)) {
		if($montant_paye == "") {
			$montant_paye = 0;
		}
		else {
			$erreur_montant_paye = "Veuillez renseigner une valeur numérique";
			$erreur=1;
		}
	}
	//test si prix paye est positive
	else
	if($montant_paye < 0) {
		$erreur_montant_paye = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	//test si valeur remise est numerique
	if(!is_numeric($valeur_remise)) {
		if($valeur_remise == "") {
			$valeur_remise = 0;
		}
		else {
			$erreur_valeur_remise = "Veuillez renseigner une valeur numérique";
			$erreur=1;
		}
	}
	//test si prix est positive
	else
	if($valeur_remise < 0) {
		$erreur_valeur_remise = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
	
	
		$header = "location:../locations.php?action=ajouter";
		
		$header = $header."&&date_debut=".$date_debut;
		$header = $header."&&date_fin=".$date_fin;
		$header = $header."&&heure_debut=".$heure_debut;
		$header = $header."&&heure_fin=".$heure_fin;
		$header = $header."&&agence_depart=".$agence_depart;
		$header = $header."&&agence_reprise=".$agence_reprise;
		
		$header = $header."&&lieu_depart=".$lieu_depart;
		$header = $header."&&lieu_reprise=".$lieu_reprise;
		$header = $header."&&options=".$options;
		$header = $header."&&services=".$services;
		
		$header = $header."&&remise=".$remise;
		$header = $header."&&valeur_remise=".$valeur_remise;
		$header = $header."&&montant_apayer=".$montant_apayer;
		$header = $header."&&montant_paye=".$montant_paye;
		$header = $header."&&statut_paiement=".$statut_paiement;
		$header = $header."&&type_paiement=".$type_paiement;
		$header = $header."&&statut_location=".$statut_location;
		$header = $header."&&erreur=".$erreur;
		
		
		if(strcmp($erreur_date_debut,"")!=0) { 
			$header = $header."&&erreur_date_debut=".$erreur_date_debut;
			
		}
		if(strcmp($erreur_date_fin,"")!=0) {
			$header = $header."&&erreur_date_fin=".$erreur_date_fin;
			
		}
		if(strcmp($erreur_montant_apayer,"")!=0) {
			$header = $header."&&erreur_montant_apayer=".$erreur_montant_apayer;
			
		}
		if(strcmp($erreur_montant_paye,"")!=0) {
			$header = $header."&&erreur_montant_paye=".$erreur_montant_paye;
			
		}
		if(strcmp($erreur_valeur_remise,"")!=0) {
			$header = $header."&&erreur_valeur_remise=".$erreur_valeur_remise;
			
		}
		
		header($header);
		exit;
	}
	
	
	if(strcmp($montant_paye,"")==0) { 
		$montant_paye = 0;
	}
	if(strcmp($valeur_remise,"")==0) {
		$valeur_remise = 0;
	}
        
          //requete
	$requete = "INSERT INTO `location` (`client`,  `agent`,   `montant`, `montant_paye`, `statut_location`, `statut_paiement`, `type_paiement`, `agence_depart`, `agence_retour`, `date_depart`, `date_retour`, `heure_depart`, `heure_retour`, `vehicule`, `remise`, `valeur_remise`) VALUES
( ?A,  ?3,  ?5, ?6, ?7, ?8, ?9, ?10, ?11, STR_TO_DATE('?12', '%d/%m/%Y'), STR_TO_DATE('?13', '%d/%m/%Y'), ?14, ?15, ?16, ?17, ?18)";
		  
	$requete =str_replace("?A",mysql_real_escape_string($client),$requete);
	$requete =str_replace("?3",mysql_real_escape_string($_SESSION["id"]),$requete);
	$requete =str_replace("?5",mysql_real_escape_string($montant_apayer),$requete);
    $requete =str_replace("?6",mysql_real_escape_string($montant_paye),$requete);
	$requete =str_replace("?7",mysql_real_escape_string($statut_location),$requete);
    $requete =str_replace("?8",mysql_real_escape_string($statut_paiement),$requete);
	if ($statut_paiement != '1')
		$requete = str_replace("?9",mysql_real_escape_string($type_paiement),$requete); //inserer si statut paiement = payé, sinon inserer 0
	else 
		$requete = str_replace("?9",mysql_real_escape_string("NULL"),$requete);
	//inserer agence depart si lieu depar personalisé n a pas ete rempli
	if (isset($_POST['check_depart_perso'])){
		$requete =str_replace("?10",mysql_real_escape_string("NULL"),$requete);
	}
	else{
		$requete =str_replace("?10",mysql_real_escape_string($agence_depart),$requete);
	}
	//inserer agence reprise si lieu depar personalisé n a pas ete rempli
    if (isset($_POST['check_reprise_perso'])){
		$requete =str_replace("?11",mysql_real_escape_string("NULL"),$requete);
	}
	else{
		$requete =str_replace("?11",mysql_real_escape_string($agence_reprise),$requete);
	}
	$requete =str_replace("?12",mysql_real_escape_string($date_debut),$requete);
	$requete =str_replace("?13",mysql_real_escape_string($date_fin),$requete);
    $requete =str_replace("?14",mysql_real_escape_string($heure_debut),$requete);
	$requete =str_replace("?15",mysql_real_escape_string($heure_fin),$requete);
    $requete =str_replace("?16",mysql_real_escape_string($vehicule),$requete);
	$requete =str_replace("?17",mysql_real_escape_string($remise),$requete);
    $requete =str_replace("?18",mysql_real_escape_string($valeur_remise),$requete);	

		
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			
			
			//insertion de la liste des optons si existe
			if(count($options)>0){
				$requete = "INSERT INTO `location_option` (`option`,`location`,  `quantite`) VALUES". "(". mysql_real_escape_string($options[0]). "," . $last_id . ", 1)"; 
				for($i=1; $i<count($options); $i++){
					$requete = $requete . ",(". $options[$i]. "," . $last_id . ", 1)";
				}
				mysql_query($requete);
				
			}
			
			//insertion de la liste des services si existe
			if(count($services)>0){
				$requete = "INSERT INTO `location_service` ( `service`, `location`,`quantite`) VALUES". "(". mysql_real_escape_string($services[0]). "," . $last_id . ", 1)"; 
				for($i=1; $i<count($services); $i++){
					$requete = $requete . ",(". $services[$i]. "," . $last_id . ", 1)";
				}
				mysql_query($requete);
				
			}
			
			//inserer lieu depar perso s il a été choisi
			if (isset($_POST['check_depart_perso'])){
				$requete = "INSERT INTO `loc_depart_perso` (`id`, `lieu`) VALUES". "(". $last_id. ",'" . mysql_real_escape_string($lieu_depart) . "')"; 
				mysql_query($requete);
				

			}
			
			//inserer lieu reprise perso s il a été choisi
			if (isset($_POST['check_reprise_perso'])){
				$requete = "INSERT INTO `loc_retour_perso` (`id`, `lieu`) VALUES". "(". $last_id. ",'" . mysql_real_escape_string($lieu_reprise) . "')"; 
				mysql_query($requete);
				
			}
			
			$header = "location:../locations.php?action=detailler&&id_location=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			header($header);
			exit;
		}
		else
		{
			echo mysql_errno() . ": " . mysql_error() . "\n";
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../locations.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id_reservation']) ){
		$id_reservation=$_POST['id_reservation'];
					
			include("../config.php");
			
			$query = "delete  FROM reservation WHERE `id`=" . $id_reservation ;
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
function validateDate($date, $format = 'd/m/Y')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
function compareDate($date1, $format1 = 'd/m/Y',$date2, $format2 = 'd/m/Y')
		{
			$d1 = DateTime::createFromFormat($format1, $date1);
			$d2 = DateTime::createFromFormat($format2, $date2);
			if($d2->getTimestamp() < $d1->getTimestamp())
				return false;
			else 
				return true;
			
		}
?> 