<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}


	include("../config.php");
	
	if(isset($_GET['id_msg'])){
		$id_msg=$_GET['id_msg'];
		
		//recuperation données du message
		$requete = "SELECT
			nom, 
			prenom, 
			email,
			membre.id,
			DATE_FORMAT(date_heure,'Le %d/%m/%Y - %H:%i'), 
			objet, 
			corps, 
			sens,
			have_pj 
								  
			FROM message, client , membre 
			
			WHERE
			membre.id = message.destinataire  
			AND client.id = membre.id_client
			and `message`.`id` = ?1" ;
	 
		 $requete =str_replace("?1",mysql_real_escape_string($id_msg),$requete);
		 $result = mysql_query($requete);
		 $ligne=mysql_fetch_row($result); //$ligne[1]
	 
		  $nom = $ligne[0]." ".$ligne[1];
		  $mail = $ligne[2];
		  $id_dest = $ligne[3];
		  $date = $ligne[4];
		  $objet = $ligne[5];
		  $corps  = $ligne[6];
		  $sens = $ligne[7];
		  $attachement1 = "";
		  $attachement2 = "";
		  $attachement3 = "";
		  
		  if($ligne[8] == '1'){
			 $requete = "select chemin from piece_jointe where `message` = ?1" ;
	 		 $requete =str_replace("?1",mysql_real_escape_string($id_msg),$requete);
			 $result = mysql_query($requete);
			 if($ligne=mysql_fetch_row($result)){
				 $attachement1 = $ligne[0];
			 }
			 if($ligne=mysql_fetch_row($result)){
				 $attachement2 = $ligne[0];
			 }
			 if($ligne=mysql_fetch_row($result)){
				 $attachement3 = $ligne[0];
			 }
			}
			//marqué comme lu
			$requete = "UPDATE `message` SET statut = 1 WHERE id = ?1";
			$requete =str_replace("?1",mysql_real_escape_string($id_msg),$requete);
			mysql_query($requete);
		  
	}
	else{
		echo 'AJAX: Erreur identifiant du message';
	}
		
	$json = array(
	  "nom" => $nom,
	  "mail"      => $mail,
	  "id_dest"      => $id_dest,
	  "date"      => $date,
	  "objet"      => $objet,
	  "corps"      => $corps,
	  "attachement1"      => $attachement1,
	  "attachement2"      => $attachement2,
	  "attachement3"      => $attachement3,
	  "sens"      => $sens
	);
	echo json_encode($json);


?>