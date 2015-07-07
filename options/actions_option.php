<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_option"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_option"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_option"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_option'])){
	include("../config.php");
	$id=$_POST['id_option'];
	
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$prix=$_POST['prix'];
	$periode=$_POST['periode'];
	
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom du option";
		$erreur=1;
	}
	if(strcmp($description,"")==0) {
		$erreur_description = "Veuillez renseigner la description du option";
		$erreur=1;
	}
	if(strcmp($prix,"")==0) {
		$erreur_prix = "Veuillez renseigner le prix du option";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix)) {
		$erreur_prix = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix < 0) {
		$erreur_prix = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	
	
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['optionn']['tmp_name']) AND is_uploaded_file($_FILES['optionn']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['optionn']['tmp_name'])<12000000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['optionn']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/options/option".$valeur.".jpg";
					$path_sql = "img/options/option".$valeur.".jpg";
					$path_small = "../img/options/option_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/options/option".$valeur.".png";
					$path_sql = "img/options/option".$valeur.".png";
					$path_small = "../img/options/option_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/options/option".$valeur.".gif";
					$path_sql = "img/options/option".$valeur.".gif";
					$path_small = "../img/options/option_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['optionn']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
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
						$query = "SELECT `image` FROM `option` WHERE `id`=" . $id ;
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
						if(mysql_num_rows($result)){
							$chemin_image = $line[0];
							//ne pas supprimer l image si elle est celle du system par defaut
							if (strcmp($chemin_image,"img/options/optiondefault.png")!=0)	{
								unlink("../".$chemin_image);
								unlink("../".str_replace("s/option","s/option_small",$chemin_image));
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
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 10 Mo.";
			$erreur=1;
		}
	}
	if($erreur == 1)
	{
		
		$header = "location:../options.php?action=modifier&&id_option=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&description=".urlencode($description);
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_description,"")!=0) {
			$header = $header."&&erreur_description=".$erreur_description;
			
		}
		if(strcmp($erreur_prix,"")!=0) {
			$header = $header."&&erreur_prix=".$erreur_prix;
			
		}
		
		header($header);
		exit;
	}

          
          //requete
	
	$requete = "UPDATE `option` SET 
	`nom`='".mysql_real_escape_string($nom)."',
	`description`='".mysql_real_escape_string($description)."',
	`prix`=".mysql_real_escape_string($prix).",
	`periode`=".mysql_real_escape_string($periode)." ";
	if (strcmp($path,"")!=0)
		$requete = $requete." , `image` = '".$path_sql."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			
			$header = "location:../options.php?action=detailler&&id_option=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../options.php?action=modifier&&id_option=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	include("../config.php");
	$id=$_POST['id_option'];
	$nom=$_POST['nom'];
	$description=$_POST['description'];
	$prix=$_POST['prix'];
	$periode=$_POST['periode'];
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le nom du option";
		$erreur=1;
	}
	if(strcmp($description,"")==0) {
		$erreur_description = "Veuillez renseigner la description du option";
		$erreur=1;
	}
	if(strcmp($prix,"")==0) {
		$erreur_prix = "Veuillez renseigner le prix du option";
		$erreur=1;
	}
	//test si prix est numerique
	if(!is_numeric($prix)) {
		$erreur_prix = "Veuillez renseigner une valeur numérique";
		$erreur=1;
	}
	//test si prix est positive
	else
	if($prix < 0) {
		$erreur_prix = "Veuillez renseigner un prix positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['optionn']['tmp_name']) AND is_uploaded_file($_FILES['optionn']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['optionn']['tmp_name'])<1200000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['optionn']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/options/option".$valeur.".jpg";
					$path_sql = "img/options/option".$valeur.".jpg";
					$path_small = "../img/options/option_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/options/option".$valeur.".png";
					$path_sql = "img/options/option".$valeur.".png";
					$path_small = "../img/options/option_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/options/option".$valeur.".gif";
					$path_sql = "img/options/option".$valeur.".gif";
					$path_small = "../img/options/option_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['optionn']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
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
		
		$header = "location:../options.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&description=".urlencode($description);
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		
		if(strcmp($erreur_description,"")!=0) {
			$header = $header."&&erreur_description=".$erreur_description;
			
		}
		if(strcmp($erreur_prix,"")!=0) {
			$header = $header."&&erreur_prix=".$erreur_prix;
			
		}
		
		
		header($header);
		exit;
	}

          
          
          
          //requete
	$requete = "INSERT into `option` (`nom`,`description`,`prix`,`periode`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string($description)."',
	".mysql_real_escape_string($prix).",
	".mysql_real_escape_string($periode).")" ;
	
	
	if (strcmp($path,"")!=0){
		$requete = "INSERT into `option` (`nom`,`description`,`prix`,`periode`,`image`) VALUES( 
		'".mysql_real_escape_string($nom)."',
		'".mysql_real_escape_string($description)."',
		".mysql_real_escape_string($prix).",
		".mysql_real_escape_string($periode).",
		'".$path_sql."')" ;
		
			
	}

       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../options.php?action=detailler&&id_option=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete.mysql_error();
			$header = "location:../options.php?action=ajouter";
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
			$query = "SELECT `image` FROM `option` WHERE `id`=" . $id ;
			$result = mysql_query($query);
			$line = mysql_fetch_row($result);
			if(mysql_num_rows($result)){
				$chemin_image = $line[0];
				//ne pas supprimer l image si elle est celle du system par defaut
				if (strcmp($chemin_image,"img/options/optiondefault.png")!=0)	{
					unlink("../".$chemin_image);
					unlink("../".str_replace("s/option","s/option_small",$chemin_image));
				}
			}
			
			$query = "delete  FROM `option` WHERE `id`=" . $id ;
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