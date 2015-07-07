<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_image"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_image"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_image"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_image'])){
	include("../config.php");
	$id=$_POST['id_image'];
	
	$nom=$_POST['nom'];
	
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de l'image";
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
					$path = "../img/gallery/images/image".$valeur.".jpg";
					$path_sql = "img/gallery/images/image".$valeur.".jpg";
					$path_small = "../img/gallery/images/image_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/gallery/images/image".$valeur.".png";
					$path_sql = "img/gallery/images/image".$valeur.".png";
					$path_small = "../img/gallery/images/image_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/gallery/images/image".$valeur.".gif";
					$path_sql = "img/gallery/images/image".$valeur.".gif";
					$path_small = "../img/gallery/images/image_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['image']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
						//supression des images precedentes
						$query = "SELECT `lien` FROM images WHERE `id`=" . $id ;
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
						if(mysql_num_rows($result)){
							$chemin_image = $line[0];
							//ne pas supprimer l image si elle est celle du system par defaut
							if (strcmp($chemin_image,"img/gallery/images/imagedefault.png")!=0)	{
								unlink("../".$chemin_image);
								
							}
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
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 1 Mo.";
			$erreur=1;
		}
	}
	if($erreur == 1)
	{
		
		$header = "location:../images.php?action=modifier&&id_image=".$id;
		$header = $header."&&nom=".$nom;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		
		
		header($header);
		exit;
	}

          
          //requete
	
	$requete = "UPDATE `images` SET 
	`nom`='".mysql_real_escape_string($nom)."'";
	if (strcmp($path,"")!=0)
		$requete = $requete." , `lien` = '".$path_sql."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			
			$header = "location:../images.php?action=detailler&&id_image=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../images.php?action=modifier&&id_image=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	include("../config.php");
	$id=$_POST['id_image'];
	$nom=$_POST['nom'];
	
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de l'image";
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
					$path = "../img/gallery/images/image".$valeur.".jpg";
					$path_sql = "img/gallery/images/image".$valeur.".jpg";
					$path_small = "../img/gallery/images/image_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/gallery/images/image".$valeur.".png";
					$path_sql = "img/gallery/images/image".$valeur.".png";
					$path_small = "../img/gallery/images/image_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/gallery/images/image".$valeur.".gif";
					$path_sql = "img/gallery/images/image".$valeur.".gif";
					$path_small = "../img/gallery/images/image_small".$valeur.".gif";
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
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 1 Mo.";
			$erreur=1;
		}
	}
	
	if($erreur == 1)
	{
		
		$header = "location:../images.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		
		
		header($header);
		exit;
	}

          
          
          
          //requete
	$requete = "INSERT into `images` (`nom`) VALUES( 
	'".mysql_real_escape_string($nom)."')" ;
	
	
	if (strcmp($path,"")!=0){
		$requete = "INSERT into `images` (`nom`,`lien`) VALUES( 
		'".mysql_real_escape_string($nom)."','".$path_sql."')" ;
		
			
	}

       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../images.php?action=detailler&&id_image=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../images.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
			
			include("../config.php");
			//suppression de l'image du serveur
			$query = "SELECT `image` FROM image WHERE `id`=" . $id ;
			$result = mysql_query($query);
			$line = mysql_fetch_row($result);
			if(mysql_num_rows($result)){
				$chemin_image = $line[0];
				//ne pas supprimer l image si elle est celle du system par defaut
				if (strcmp($chemin_image,"img/gallery/images/imagedefault.png")!=0)	{
					unlink("../".$chemin_image);
					
				}
			}
			
			$query = "delete  FROM image WHERE `id`=" . $id ;
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