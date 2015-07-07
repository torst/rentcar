<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}


	include("../config.php");
	
	
	$emails=$_POST['emails_plat'];  
	$to_all=$_POST['to_all'];
	$to_mail_list=$_POST['to_mail_list'];
	$objet=$_POST['objet'];
	$corps=$_POST['corps'];
	
	
	
	//$fichier...
	$path1 = "";
	$path_sql1 = "";
	$path2 = "";
	$path_sql2 = "";
	$path3 = "";
	$path_sql3 = "";
	$piece_jointe = 0;
	
	//controle champ
	$erreur = 0;
	if(strcmp($objet,"")==0) {
		$objet = "Objet vide";
	}
	//controle champ
	
	if(strcmp($corps,"")==0) {
		$corps = "Message vide";
	}
	
	//si to_all est coché, liste destinataire = tous les id clients
	if(strcmp($to_all,"oui")==0) {
		//recup de la bd tous les id
		$requete = "SELECT `id` FROM `membre` WHERE `id_client` IS NOT NULL";
		$result = mysql_query($requete);
		$emails = "";
		while($ligne=mysql_fetch_row($result)){
			$emails = $emails.$ligne[0].",";
		} 
		$emails = substr($emails, 0,-1);
	}
	//controle champ
	if(strcmp($emails,"")==0) {
		$erreur_emails = "Message non envoyé. Veuillez renseigner un destinataire";
		$erreur=1;
	}
	if($erreur == 1)
	{
		$header = "location:../inbox.php?";
		$header = $header."message_erreur=".$erreur_emails;
		header($header);
		exit;
	}

    //traitement chargement fichier 1
	if(!empty($_FILES['file1']['tmp_name']) AND is_uploaded_file($_FILES['file1']['tmp_name'])){
		if(filesize($_FILES['file1']['tmp_name'])<12000000){
			$valeur = time();
			$path1 = "attachement/".$valeur.$_FILES['file1']['name'];
			$path_sql1 = "inbox/attachement/".$valeur.$_FILES['file1']['name'];
				
			//Copie le fichier dans le répertoire de destination
			if(move_uploaded_file($_FILES['file1']['tmp_name'], $path1)){//Le fichier a été uploadé correctement
				$piece_jointe = 1;
			}
			else{
				//Erreur upload image
				$erreur=1;
			}
		}
		else{
			//erreur taille image
			$erreur=1;
		}
	}  
	//traitement chargement fichier 1
	if(!empty($_FILES['file2']['tmp_name']) AND is_uploaded_file($_FILES['file2']['tmp_name'])){
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['file2']['tmp_name'])<12000000){
			$valeur = time();
			$path2 = "attachement/".$valeur.$_FILES['file2']['name'];
			$path_sql2 = "inbox/attachement/".$valeur.$_FILES['file2']['name'];
				
			//Copie le fichier dans le répertoire de destination
			if(move_uploaded_file($_FILES['file2']['tmp_name'], $path2)){//Le fichier a été uploadé correctement
				$piece_jointe = 1;
			}
			else{
				//Erreur upload image
				$erreur=1;
			}
		}
		else{
			//erreur taille image
			$erreur=1;
		}
	}  
	//traitement chargement fichier 3
	if(!empty($_FILES['file3']['tmp_name']) AND is_uploaded_file($_FILES['file3']['tmp_name'])){
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['file3']['tmp_name'])<12000000){
			$valeur = time();
			$path3 = "attachement/".$valeur.$_FILES['file3']['name'];
			$path_sql3 = "inbox/attachement/".$valeur.$_FILES['file3']['name'];
				
			//Copie le fichier dans le répertoire de destination
			if(move_uploaded_file($_FILES['file3']['tmp_name'], $path3)){//Le fichier a été uploadé correctement
				$piece_jointe = 1;
			}
			else{
				//Erreur upload image
				$erreur=1;
			}
		}
		else{
			//erreur taille image
			$erreur=1;
		}
	}  

	if($erreur == 1)
	{
		$header = "location:../inbox.php?";
		$header = $header."message_erreur=Erreur pièce jointe. Maximum 10 Mo";
		header($header);
		exit;
	}    
	
	$liste_email = explode(",", $emails);
    	
          //requete
	$requete = "INSERT into `message` (`objet`,`corps`,`statut`,`destinataire`,`sens`,`label`,`have_pj`) VALUES( 
	 '?1','?2',2,?3,'OUT',5, ?4)" ;
	 
	 $requete =str_replace("?1",mysql_real_escape_string($objet),$requete);
	 $requete =str_replace("?2",mysql_real_escape_string($corps),$requete);
	 $requete =str_replace("?4",$piece_jointe,$requete);
	 
	 if(count($liste_email)>0){
		for($i=0; $i<count($liste_email); $i++){
			$requete_i = str_replace("?3",$liste_email[$i],$requete);
			mysql_query($requete_i); //insertion
			
			$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			
			$requete_j = "INSERT INTO  `piece_jointe` ( `message`, `chemin`) VALUES ( ?1, '?2')";
			$requete_j = str_replace("?1",$last_id,$requete_j);
			
			if(strcmp($path_sql1,"")!=0){
				$requete_j = str_replace("?2",$path_sql1,$requete_j); //insertion
				mysql_query($requete_j);
			}
			if(strcmp($path_sql2,"")!=0){
				$requete_j = str_replace("?2",$path_sql2,$requete_j); //insertion
				mysql_query($requete_j);
			}
			if(strcmp($path_sql3,"")!=0){
				$requete_j = str_replace("?2",$path_sql3,$requete_j); //insertion
				mysql_query($requete_j);
			}
			
		}
	}
	 	
	$header = "location:../inbox.php?";
	$header = $header."message_succes=Message envoyé";
	header($header);
	exit;
	


?>