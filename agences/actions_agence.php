<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_agence"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_agence"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_agence"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_agence'])){
	include("../config.php");
	$id=$_POST['id_agence'];
	
	$nom=$_POST['nom'];
	$adresse=$_POST['adresse'];
	$ville=$_POST['ville'];
	$telephone=$_POST['telephone'];
	$fax=$_POST['fax'];
	$horaire=$_POST['horaire'];
	$lattitude=$_POST['lattitude'];
	$longitude=$_POST['longitude'];
	
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de l'agence";
		$erreur=1;
	}
	if(strcmp($adresse,"")==0) {
		$erreur_adresse = "Veuillez renseigner l'adresse de l'agence";
		$erreur=1;
	}
	if(strcmp($horaire,"")==0) {
		$erreur_horaire = "Veuillez renseigner l'horaire de l'agence";
		$erreur=1;
	}
	
	
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['agence']['tmp_name']) AND is_uploaded_file($_FILES['agence']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['agence']['tmp_name'])<12000000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['agence']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/agences/agence".$valeur.".jpg";
					$path_sql = "img/agences/agence".$valeur.".jpg";
					$path_small = "../img/agences/agence_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/agences/agence".$valeur.".png";
					$path_sql = "img/agences/agence".$valeur.".png";
					$path_small = "../img/agences/agence_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/agences/agence".$valeur.".gif";
					$path_sql = "img/agences/agence".$valeur.".gif";
					$path_small = "../img/agences/agence_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['agence']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
						$img_src = $path;
						$img_dest = $path;
						$dst_w = 140;
						$dst_h = 140;
					 // Lit les dimensions de l'image
					   $size = GetImageSize($img_src);  
					   $src_w = $size[0]; $src_h = $size[1];  
					   // Teste les dimensions tenant dans la zone
					   $test_h = round(($dst_w / $src_w) * $src_h);
					   $test_w = round(($dst_h / $src_h) * $src_w);
					   // Si Height final non précisé (0)
					   if(!$dst_h) $dst_h = $test_h;
					   // Sinon si Width final non précisé (0)
					   elseif(!$dst_w) $dst_w = $test_w;
					   // Sinon teste quel redimensionnement tient dans la zone
					   elseif($test_h>$dst_h) $dst_w = $test_w;
					   else $dst_h = $test_h;							
					   // Crée une image vierge aux bonnes dimensions
					   //$dst_im = ImageCreate($dst_w,$dst_h);
					   $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
					   // Copie dedans l'image initiale redimensionnée
					   
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		$src_im = ImageCreateFromJpeg($img_src);
						//si png
						if($type ==IMAGETYPE_PNG)
							$src_im = ImageCreateFromPng($img_src);
						//si Gif
						if($type ==IMAGETYPE_GIF)
							$src_im = ImageCreateFromGif($img_src);
					   //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   //supprime l image uploadée
					   unlink($path);
					   // Sauve la nouvelle image
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		ImageJpeg($dst_im,$img_dest);
						//si png
						if($type ==IMAGETYPE_PNG)
							Imagepng($dst_im,$img_dest);
						//si gif
						if($type ==IMAGETYPE_GIF)
							Imagegif($dst_im,$img_dest);
					   // Détruis les tampons
					   ImageDestroy($dst_im);  
					   ImageDestroy($src_im);
					   //creation de l image small
					   $img_dest = $path_small;
					   $dst_w = 29;
						$dst_h = 29;
					 // Lit les dimensions de l'image
					   $size = GetImageSize($img_src);  
					   $src_w = $size[0]; $src_h = $size[1];  
					   // Teste les dimensions tenant dans la zone
					   $test_h = round(($dst_w / $src_w) * $src_h);
					   $test_w = round(($dst_h / $src_h) * $src_w);
					   // Si Height final non précisé (0)
					   if(!$dst_h) $dst_h = $test_h;
					   // Sinon si Width final non précisé (0)
					   elseif(!$dst_w) $dst_w = $test_w;
					   // Sinon teste quel redimensionnement tient dans la zone
					   elseif($test_h>$dst_h) $dst_w = $test_w;
					   else $dst_h = $test_h;							
					   // Crée une image vierge aux bonnes dimensions
					   //$dst_im = ImageCreate($dst_w,$dst_h);
					   $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
					   // Copie dedans l'image initiale redimensionnée
					   
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		$src_im = ImageCreateFromJpeg($img_src);
						//si png
						if($type ==IMAGETYPE_PNG)
							$src_im = ImageCreateFromPng($img_src);
						//si Gif
						if($type ==IMAGETYPE_GIF)
							$src_im = ImageCreateFromGif($img_src);
					   //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   
					   // Sauve la nouvelle image
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		ImageJpeg($dst_im,$img_dest);
						//si png
						if($type ==IMAGETYPE_PNG)
							Imagepng($dst_im,$img_dest);
						//si gif
						if($type ==IMAGETYPE_GIF)
							Imagegif($dst_im,$img_dest);
					   // Détruis les tampons
					   ImageDestroy($dst_im);  
					   ImageDestroy($src_im);
					   
					   
							
						//supression des images precedentes
						$query = "SELECT `image` FROM agence WHERE `id`=" . $id ;
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
						if(mysql_num_rows($result)){
							$chemin_image = $line[0];
							//ne pas supprimer l image si elle est celle du system par defaut
							if (strcmp($chemin_image,"img/agences/agencedefault.png")!=0)	{
								unlink("../".$chemin_image);
								unlink("../".str_replace("s/agence","s/agence_small",$chemin_image));
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
		
		$header = "location:../agences.php?action=modifier&&id_agence=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&adresse=".urlencode($adresse);
		$header = $header."&&horaire=".urlencode($horaire);
		$header = $header."&&telephone=".$telephone;
		$header = $header."&&fax=".$fax;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_horaire,"")!=0) {
			$header = $header."&&erreur_horaire=".$erreur_horaire;
			
		}
		if(strcmp($erreur_adresse,"")!=0) {
			$header = $header."&&erreur_adresse=".$erreur_adresse;
			
		}
		
		
		header($header);
		exit;
	}

          
          //requete
	
	$requete = "UPDATE `agence` SET 
	`nom`='".mysql_real_escape_string($nom)."',
	`horaire`='".mysql_real_escape_string($horaire)."',
	`adresse`='".mysql_real_escape_string($adresse)."', 
	`ville`=".mysql_real_escape_string($ville).", 
	`tel`='".mysql_real_escape_string($telephone)."', 
	`fax`='".mysql_real_escape_string($fax)."', 
	`latitude`='".mysql_real_escape_string($lattitude)."', 
	`longitude`='".mysql_real_escape_string($longitude)."' ";
	if (strcmp($path,"")!=0)
		$requete = $requete." , `image` = '".$path_sql."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			
			$header = "location:../agences.php?action=detailler&&id_agence=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../agences.php?action=modifier&&id_agence=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	include("../config.php");
	$id=$_POST['id_agence'];
	$nom=$_POST['nom'];
	$adresse=$_POST['adresse'];
	$ville=$_POST['ville'];
	$telephone=$_POST['telephone'];
	$fax=$_POST['fax'];
	$horaire=$_POST['horaire'];
	$lattitude=$_POST['lattitude'];
	$longitude=$_POST['longitude'];
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom de l'agence";
		$erreur=1;
	}
	if(strcmp($adresse,"")==0) {
		$erreur_adresse = "Veuillez renseigner l'adresse de l'agence";
		$erreur=1;
	}
	if(strcmp($horaire,"")==0) {
		$erreur_horaire = "Veuillez renseigner l'horaire de l'agence";
		$erreur=1;
	}
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['agence']['tmp_name']) AND is_uploaded_file($_FILES['agence']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['agence']['tmp_name'])<1200000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['agence']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/agences/agence".$valeur.".jpg";
					$path_sql = "img/agences/agence".$valeur.".jpg";
					$path_small = "../img/agences/agence_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/agences/agence".$valeur.".png";
					$path_sql = "img/agences/agence".$valeur.".png";
					$path_small = "../img/agences/agence_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/agences/agence".$valeur.".gif";
					$path_sql = "img/agences/agence".$valeur.".gif";
					$path_small = "../img/agences/agence_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['agence']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
						$img_src = $path;
						$img_dest = $path;
						$dst_w = 140;
						$dst_h = 140;
					 // Lit les dimensions de l'image
					   $size = GetImageSize($img_src);  
					   $src_w = $size[0]; $src_h = $size[1];  
					   // Teste les dimensions tenant dans la zone
					   $test_h = round(($dst_w / $src_w) * $src_h);
					   $test_w = round(($dst_h / $src_h) * $src_w);
					   // Si Height final non précisé (0)
					   if(!$dst_h) $dst_h = $test_h;
					   // Sinon si Width final non précisé (0)
					   elseif(!$dst_w) $dst_w = $test_w;
					   // Sinon teste quel redimensionnement tient dans la zone
					   elseif($test_h>$dst_h) $dst_w = $test_w;
					   else $dst_h = $test_h;							
					   // Crée une image vierge aux bonnes dimensions
					   //$dst_im = ImageCreate($dst_w,$dst_h);
					   $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
					   // Copie dedans l'image initiale redimensionnée
					   
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		$src_im = ImageCreateFromJpeg($img_src);
						//si png
						if($type ==IMAGETYPE_PNG)
							$src_im = ImageCreateFromPng($img_src);
						//si Gif
						if($type ==IMAGETYPE_GIF)
							$src_im = ImageCreateFromGif($img_src);
					   //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   //supprime l image uploadée
					   unlink($path);
					   // Sauve la nouvelle image
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		ImageJpeg($dst_im,$img_dest);
						//si png
						if($type ==IMAGETYPE_PNG)
							Imagepng($dst_im,$img_dest);
						//si gif
						if($type ==IMAGETYPE_GIF)
							Imagegif($dst_im,$img_dest);
					   // Détruis les tampons
					   ImageDestroy($dst_im);  
					   ImageDestroy($src_im);
					   //creation de l image small
					   $img_dest = $path_small;
					   $dst_w = 29;
						$dst_h = 29;
					 // Lit les dimensions de l'image
					   $size = GetImageSize($img_src);  
					   $src_w = $size[0]; $src_h = $size[1];  
					   // Teste les dimensions tenant dans la zone
					   $test_h = round(($dst_w / $src_w) * $src_h);
					   $test_w = round(($dst_h / $src_h) * $src_w);
					   // Si Height final non précisé (0)
					   if(!$dst_h) $dst_h = $test_h;
					   // Sinon si Width final non précisé (0)
					   elseif(!$dst_w) $dst_w = $test_w;
					   // Sinon teste quel redimensionnement tient dans la zone
					   elseif($test_h>$dst_h) $dst_w = $test_w;
					   else $dst_h = $test_h;							
					   // Crée une image vierge aux bonnes dimensions
					   //$dst_im = ImageCreate($dst_w,$dst_h);
					   $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
					   // Copie dedans l'image initiale redimensionnée
					   
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		$src_im = ImageCreateFromJpeg($img_src);
						//si png
						if($type ==IMAGETYPE_PNG)
							$src_im = ImageCreateFromPng($img_src);
						//si Gif
						if($type ==IMAGETYPE_GIF)
							$src_im = ImageCreateFromGif($img_src);
					   //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
					   
					   // Sauve la nouvelle image
					   //si jpg jpeg
						if ($type == IMAGETYPE_JPEG)
					   		ImageJpeg($dst_im,$img_dest);
						//si png
						if($type ==IMAGETYPE_PNG)
							Imagepng($dst_im,$img_dest);
						//si gif
						if($type ==IMAGETYPE_GIF)
							Imagegif($dst_im,$img_dest);
					   // Détruis les tampons
					   ImageDestroy($dst_im);  
					   ImageDestroy($src_im);
					   
					
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
		$header = $header."&&adresse=".urlencode($adresse);
		$header = $header."&&horaire=".urlencode($horaire);
		$header = $header."&&telephone=".$telephone;
		$header = $header."&&fax=".$fax;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_horaire,"")!=0) {
			$header = $header."&&erreur_horaire=".$erreur_horaire;
			
		}
		if(strcmp($erreur_adresse,"")!=0) {
			$header = $header."&&erreur_adresse=".$erreur_adresse;
			
		}
		
		
		header($header);
		exit;
	}

          
          
          
          //requete
	$requete = "INSERT into `agence` (`nom`,`adresse`,`ville`,`horaire`,`tel`,`fax`,`latitude`,`longitude`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string($adresse)."',
	".mysql_real_escape_string($ville).", 
	'".mysql_real_escape_string($horaire)."', 
	'".mysql_real_escape_string($telephone)."',
	'".mysql_real_escape_string($fax)."',
	'".mysql_real_escape_string($lattitude)."',
	'".mysql_real_escape_string($longitude)."')" ;
	
	
	if (strcmp($path,"")!=0){
		$requete = "INSERT into `agence` (`nom`,`adresse`,`ville`,`horaire`,`tel`,`fax`,`image`) VALUES( 
		'".mysql_real_escape_string($nom)."',
		'".mysql_real_escape_string($adresse)."',
		".mysql_real_escape_string($ville).", 
		'".mysql_real_escape_string($horaire)."', 
		'".mysql_real_escape_string($telephone)."', 
		'".mysql_real_escape_string($fax)."', 
		'".mysql_real_escape_string($lattitude)."', 
		'".mysql_real_escape_string($longitude)."',
		'".$path_sql."')" ;
		
			
	}

       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../agences.php?action=detailler&&id_agence=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../agences.php?action=ajouter";
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
			$query = "SELECT `image` FROM agence WHERE `id`=" . $id ;
			$result = mysql_query($query);
			$line = mysql_fetch_row($result);
			if(mysql_num_rows($result)){
				$chemin_image = $line[0];
				//ne pas supprimer l image si elle est celle du system par defaut
				if (strcmp($chemin_image,"img/agences/agencedefault.png")!=0)	{
					unlink("../".$chemin_image);
					unlink("../".str_replace("s/agence","s/agence_small",$chemin_image));
				}
			}
			
			$query = "delete  FROM agence WHERE `id`=" . $id ;
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