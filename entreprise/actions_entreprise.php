<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_entreprise"]))
		    	update();
		    break;
		    
		  
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_entreprise'])){
			
	$id=$_POST['id_entreprise'];
	
	$nom=($_POST['nom']);
	$hotline=($_POST['hotline']);
	$contact_commercial=($_POST['contact_commercial']);
	$contact_technique=($_POST['contact_technique']);
	$fax=($_POST['fax']);
	$adresse=($_POST['adresse']);
	$description=($_POST['description']);
	
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	
	
	
	if($erreur == 1)
	{
		
		$header = "location:../entreprise.php?action=modifier&&id_entreprise=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	include("../config.php");
	$requete = "UPDATE `entreprise` SET 
	`nom`='".mysql_real_escape_string($nom)."'"
	.",`hotline`='".mysql_real_escape_string($hotline)."'"
	.",`contact_commercial`='".mysql_real_escape_string($contact_commercial)."'"
	.",`contact_technique`='".mysql_real_escape_string($contact_technique)."'"
	.",`fax`='".mysql_real_escape_string($fax)."'"
	.",`adresse_siege`='".mysql_real_escape_string($adresse)."'"
	.",`description`='".mysql_real_escape_string($description)."'";
	
        if(mysql_query($requete)){
			$header = "location:../entreprise.php?action=detailler&&id_entreprise=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../entreprise.php?action=modifier&&id_entreprise=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}


?> 