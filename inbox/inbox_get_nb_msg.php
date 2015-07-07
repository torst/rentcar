<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}


	include("../config.php");
	
	$inbox = 0;
	$important = 0;
	$traite = 0;
	$corbeille = 0;
	$allmsg = 0;
	  
	//requete pour le nombre de message non lus
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 1 and statut = 2";
	$result = mysql_query($requete);
	$inbox=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 2 and statut = 2";
	$result = mysql_query($requete);
	$important=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 3 and statut = 2";
	$result = mysql_query($requete);
	$traite=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 4 and statut = 2";
	$result = mysql_query($requete);
	$corbeille=mysql_num_rows($result);
	
	$allmsg = $inbox + $important + $traite + $corbeille;
	///fin requete message non lus
		
	$json = array(
	  "inbox" => $inbox,
	  "important"      => $important,
	  "traite"      => $traite,
	  "corbeille"      => $corbeille,
	  "allmsg"      => $allmsg
	);
	echo json_encode($json);


?>