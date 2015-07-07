<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_baniere"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_baniere"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_baniere"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
	
if(isset($_POST['id_baniere'])){
	
	include("../config.php");
	$id=$_POST['id_baniere'];
	
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$url=$_POST['url'];
	$type=$_POST['type'];
	
	
	//$image...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de la banière";
		$erreur=1;
	}
	if(strcmp($url,"")==0) {
		$erreur_url = "Veuillez renseigner le lien de la banière";
		$erreur=1;
	}
	
	
	
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['image']['tmp_name']) AND is_uploaded_file($_FILES['image']['tmp_name'])){
		
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['image']['tmp_name'])<12000000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['image']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/banieres/baniere".$valeur.".jpg";
					$path_sql = "img/banieres/baniere".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/banieres/baniere".$valeur.".png";
					$path_sql = "img/banieres/baniere".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/banieres/baniere".$valeur.".gif";
					$path_sql = "img/banieres/baniere".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['image']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
							
						//supression des images precedentes
						$query = "SELECT `image` FROM baniere WHERE `id`=" . $id ;
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
						if(mysql_num_rows($result)){
							$chemin_image = $line[0];
							unlink("../".$chemin_image);
							
							
						}
					
				}
				else{
					//Erreur
					$erreur_avatar = "Erreur technique lors de du téléchargement du fichier.";
					$erreur=1;
				}
			}
	
		}
		else{
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 10 Mo.";
			$erreur=1;
		}
	}
	if($erreur == 1)
	{
		
		$header = "location:../banieres.php?action=modifier&&id_baniere=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&url=".urlencode($url);
		$header = $header."&&description=".$description;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_url,"")!=0) {
			$header = $header."&&erreur_url=".$erreur_url;
			
		}
		
		
		
		header($header);
		exit;
	}

          
          //requete
	
	$requete = "UPDATE `baniere` SET 
	`nom`='".mysql_real_escape_string($nom)."',
	`description`='".mysql_real_escape_string($description)."',
	`url`='".mysql_real_escape_string($url)."', 
	`type`=".mysql_real_escape_string($type);
	if (strcmp($path,"")!=0)
		$requete = $requete." , `image` = '".$path_sql."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			
			$header = "location:../banieres.php?action=detailler&&id_baniere=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../banieres.php?action=modifier&&id_baniere=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	include("../config.php");
	$id=$_POST['id_baniere'];
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$type=$_POST['type'];
	$url=$_POST['url'];
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de la banière";
		$erreur=1;
	}
	if(strcmp($url,"")==0) {
		$erreur_url = "Veuillez renseigner le lien de la banière";
		$erreur=1;
	}
	
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['image']['tmp_name']) AND is_uploaded_file($_FILES['image']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['image']['tmp_name'])<1200000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['image']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/banieres/baniere".$valeur.".jpg";
					$path_sql = "img/banieres/baniere".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/banieres/baniere".$valeur.".png";
					$path_sql = "img/banieres/baniere".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/banieres/baniere".$valeur.".gif";
					$path_sql = "img/banieres/baniere".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['image']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
					
				}
				else{
					//Erreur
					$erreur_avatar = "Erreur technique lors de du téléchargement du fichier.";
					$erreur=1;
				}
			}
	
		}
		else{
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 10 Mo.";
			$erreur=1;
		}
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../banieres.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&description=".($description);
		$header = $header."&&url=".urlencode($url);
		$header = $header."&&type=".$type;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_url,"")!=0) {
			$header = $header."&&erreur_url=".$erreur_url;
			
		}
		
		header($header);
		exit;
	}

          //requete
	$requete = "INSERT into `baniere` (`nom`,`description`,`url`,`type`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string($description)."',
	'".mysql_real_escape_string($url)."', 
	".mysql_real_escape_string($type).")" ;
	
	
	if (strcmp($path,"")!=0){
		$requete = "INSERT into `baniere` (`nom`,`description`,`url`,`type`,`image`) VALUES( 
		'".mysql_real_escape_string($nom)."',
		'".mysql_real_escape_string($description)."',
		'".mysql_real_escape_string($url)."', 
		".mysql_real_escape_string($type).",
		'".$path_sql."')" ;
		
			
	}

       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../banieres.php?action=detailler&&id_baniere=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../banieres.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		//Ne pas supprimer l utilisateur connecté
	   	
			
			include("../config.php");
			//suppression de l'image du serveur
			$query = "SELECT `image` FROM baniere WHERE `id`=" . $id ;
			$result = mysql_query($query);
			$line = mysql_fetch_row($result);
			if(mysql_num_rows($result)){
				$chemin_image = $line[0];
					unlink("../".$chemin_image);
				
			}
			
			$query = "delete  FROM baniere WHERE `id`=" . $id ;
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