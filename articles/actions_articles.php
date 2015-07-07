<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_article"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_article"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_article"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_articles'])){
			
	$id=$_POST['id_articles'];
	$contenu=$_POST['contenu'];
	$titre=$_POST['titre'];
	$resume=$_POST['resume'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($titre,"")==0) {
		$erreur_titre = "Veuillez renseigner le titre";
		$erreur=1;
	}
	
	//unicite login
	include("../config.php");
	
	
	if($erreur == 1)
	{
		
		$header = "location:../articles.php?action=modifier&&id_articles=".$id;
		$header = $header."&&titre=".$titre;
		$header = $header."&&resume=".urlencode($resume);
		$header = $header."&&contenu=".urlencode($contenu);
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_titre,"")!=0) {
			$header = $header."&&erreur_titre=".$erreur_titre;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `articles` SET 
	`title` ='".mysql_real_escape_string($titre)."',
	`content` = '".mysql_real_escape_string($contenu)."',
	`summary` = '".mysql_real_escape_string($resume)."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../articles.php?action=detailler&&id_articles=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../articles.php?action=modifier&&id_articles=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$titre=$_POST['titre'];
	$resume=$_POST['resume'];
	$contenu=$_POST['contenu'];
	
	//controle champ
	$erreur = 0;
	if(strcmp($titre,"")==0) {
		$erreur_titre = "Veuillez renseigner le Titre";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	
	
	if($erreur == 1)
	{
		
		$header = "location:../articles.php?action=ajouter";
		$header = $header."&&titre=".$titre;
		$header = $header."&&erreur=".$erreur;
		$header = $header."&&resume=".urlencode($resume);
		$header = $header."&&contenu=".urlencode($contenu);
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_titre=".$erreur_titre;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "INSERT into `articles` (`title`,`summary`,`content`,`publicationDate`) VALUES( 
	'".mysql_real_escape_string($titre)."','".mysql_real_escape_string($resume)."','".mysql_real_escape_string($contenu)."',CURDATE())" ;
	
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../articles.php?action=detailler&&id_articles=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../articles.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		
			
			include("../config.php");
			
			$query = "delete  FROM articles WHERE `id`=" . $id ;
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