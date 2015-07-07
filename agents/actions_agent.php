<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_agent"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_agent"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_agent"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_agent'])){
			
	$id=$_POST['id_agent'];
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$login=$_POST['login'];
	$email=$_POST['email'];
	$profil=$_POST['profil'];
	$statut=$_POST['statut'];
	$telephone=$_POST['telephone'];
	$agences=$_POST['agences'];
	
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	if(strcmp($prenom,"")==0) {
		$erreur_prenom = "Veuillez renseigner le Prénom";
		$erreur=1;
	}
	if(strcmp($login,"")==0) {
		$erreur_login = "Veuillez renseigner le Login";
		$erreur=1;
	}
	if(strcmp($email,"")==0) {
		$erreur_email = "Veuillez renseigner l'Email";
		$erreur=1;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	$erreur_email = "Veuillez renseigner un email correct";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	$query = "SELECT `login` FROM agent WHERE `login`='" . mysql_real_escape_string($login) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_login = "Le login renseigné est déjà attribué, veuillez renseigner un login correct";
		$erreur=1;
	}
	//unicite email
	$query = "SELECT `email` FROM agent WHERE `email`='" . mysql_real_escape_string($email) . "' and `id`<> ".$id;
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_email = "L'adresse email renseignée est déjà attribuée, veuillez renseigner une adresse correcte";
		$erreur=1;
	}
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['avatar']['tmp_name']) AND is_uploaded_file($_FILES['avatar']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['avatar']['tmp_name'])<12000000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['avatar']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/avatars/avatar".$valeur.".jpg";
					$path_sql = "img/avatars/avatar".$valeur.".jpg";
					$path_small = "../img/avatars/avatar_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/avatars/avatar".$valeur.".png";
					$path_sql = "img/avatars/avatar".$valeur.".png";
					$path_small = "../img/avatars/avatar_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/avatars/avatar".$valeur.".gif";
					$path_sql = "img/avatars/avatar".$valeur.".gif";
					$path_small = "../img/avatars/avatar_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
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
					   
					   //changement du chemin de l'avatar dans la variable session, si l utilisateur modifié est celui qui est connecté
					   if (strcmp($id,$_SESSION["id"])==0)	
							$_SESSION["avatar"] = $path_sql;
							
						//supression des images precedentes
						$query = "SELECT `avatar` FROM agent WHERE `id`=" . $id ;
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
						if(mysql_num_rows($result)){
							$chemin_image = $line[0];
							//ne pas supprimer l image si elle est celle du system par defaut
							if (strcmp($chemin_image,"img/avatars/avatardefault.png")!=0)	{
								unlink("../".$chemin_image);
								unlink("../".str_replace("s/avatar","s/avatar_small",$chemin_image));
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
		
		$header = "location:../agents.php?action=modifier&&id_agent=".$id;
		$header = $header."&&nom=".$nom;
		$header = $header."&&prenom=".$prenom;
		$header = $header."&&login=".$login;
		$header = $header."&&email=".$email;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_prenom,"")!=0) {
			$header = $header."&&erreur_prenom=".$erreur_prenom;
			
		}
		if(strcmp($erreur_login,"")!=0) {
			$header = $header."&&erreur_login=".$erreur_login;
			
		}
		if(strcmp($erreur_email,"")!=0) {
			$header = $header."&&erreur_email=".$erreur_email;
			
		}
		if(strcmp($erreur_avatar,"")!=0) {
			$header = $header."&&erreur_avatar=".$erreur_avatar;
				
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `agent` SET 
	`nom`='".mysql_real_escape_string($nom)."',
	`prenom`='".mysql_real_escape_string($prenom)."',
	`login`='".mysql_real_escape_string($login)."', 
	`email`='".mysql_real_escape_string($email)."', 
	`telephone`='".mysql_real_escape_string($telephone)."', 
	`profil`=".mysql_real_escape_string($profil).", 
	`statut`=".mysql_real_escape_string($statut);
	if (strcmp($path,"")!=0)
		$requete = $requete." , `avatar` = '".$path_sql."'";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			//modification des agences de l utilisateur
			//supression des agences anciennes
			$requete = "DELETE FROM `agence_agent` WHERE `agent`=".$id;
			mysql_query($requete);
			//insertion de la nouvelle liste agences
			if(count($agences)>0){
				$requete = "INSERT INTO `agence_agent` (`agence`, `agent`) VALUES". "(". $agences[0]. "," . $id . ")"; 
				for($i=1; $i<count($agences); $i++){
					$requete = $requete . ",(". $agences[$i]. "," . $id . ")";
				}
				mysql_query($requete);
			}
			$header = "location:../agents.php?action=detailler&&id_agent=".$id."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../agents.php?action=modifier&&id_agent=".$id;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$login=$_POST['login'];
	$email=$_POST['email'];
	$profil=$_POST['profil'];
	$statut=$_POST['statut'];
	$telephone=$_POST['telephone'];
	$agences=$_POST['agences'];
	//$avatar...
	$path = "";
	$path_sql = "";
	//controle champ
	$erreur = 0;
	if(strcmp($nom,"")==0) {
		$erreur_nom = "Veuillez renseigner le Nom";
		$erreur=1;
	}
	if(strcmp($prenom,"")==0) {
		$erreur_prenom = "Veuillez renseigner le Prénom";
		$erreur=1;
	}
	if(strcmp($login,"")==0) {
		$erreur_login = "Veuillez renseigner le Login";
		$erreur=1;
	}
	if(strcmp($email,"")==0) {
		$erreur_email = "Veuillez renseigner l'Email";
		$erreur=1;
	}
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    	$erreur_email = "Veuillez renseigner un email correct";
		$erreur=1;
	}
	//unicite login
	include("../config.php");
	$query = "SELECT `login` FROM agent WHERE `login`='" . mysql_real_escape_string($login) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_login = "Le login renseigné est déjà attribué, veuillez renseigner un login correct";
		$erreur=1;
	}
	//unicite email
	$query = "SELECT `email` FROM agent WHERE `email`='" . mysql_real_escape_string($email) . "' ";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){
    	$erreur_email = "L'adresse email renseignée est déjà attribuée, veuillez renseigner une adresse correcte";
		$erreur=1;
	}
	//traitement chargement fichier
	//echo "juste avant traitement fichier\n";
	if(!empty($_FILES['avatar']['tmp_name']) AND is_uploaded_file($_FILES['avatar']['tmp_name'])){
		//echo "dans traitement de fichier\n";
		//On va vérifier la taille du fichier en ne passant pas par $_FILES['avatar']['size'] pour éviter les failles de sécurité
		if(filesize($_FILES['avatar']['tmp_name'])<1200000){
			//On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
			list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['avatar']['tmp_name']);
			//Si le Type est JPEG (correspond au chiffre 2) on copie l'image
			if(($type==IMAGETYPE_JPEG)||($type==IMAGETYPE_PNG)||($type==IMAGETYPE_GIF)){
				$valeur = time();
				if($type==IMAGETYPE_JPEG) {
					$path = "../img/avatars/avatar".$valeur.".jpg";
					$path_sql = "img/avatars/avatar".$valeur.".jpg";
					$path_small = "../img/avatars/avatar_small".$valeur.".jpg";
					}
				if($type==IMAGETYPE_PNG) {
					$path = "../img/avatars/avatar".$valeur.".png";
					$path_sql = "img/avatars/avatar".$valeur.".png";
					$path_small = "../img/avatars/avatar_small".$valeur.".png";
					}
				if($type==IMAGETYPE_GIF) {
					$path = "../img/avatars/avatar".$valeur.".gif";
					$path_sql = "img/avatars/avatar".$valeur.".gif";
					$path_small = "../img/avatars/avatar_small".$valeur.".gif";
					}
				//Copie le fichier dans le répertoire de destination
				if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path)){//Le fichier a été uploadé correctement
					
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
		
		$header = "location:../agents.php?action=ajouter";
		$header = $header."&&nom=".$nom;
		$header = $header."&&prenom=".$prenom;
		$header = $header."&&login=".$login;
		$header = $header."&&email=".$email;
		$header = $header."&&erreur=".$erreur;
		if(strcmp($erreur_nom,"")!=0) {
			$header = $header."&&erreur_nom=".$erreur_nom;
			
		}
		if(strcmp($erreur_prenom,"")!=0) {
			$header = $header."&&erreur_prenom=".$erreur_prenom;
			
		}
		if(strcmp($erreur_login,"")!=0) {
			$header = $header."&&erreur_login=".$erreur_login;
			
		}
		if(strcmp($erreur_email,"")!=0) {
			$header = $header."&&erreur_email=".$erreur_email;
			
		}
		if(strcmp($erreur_avatar,"")!=0) {
			$header = $header."&&erreur_avatar=".$erreur_avatar;
			//echo "erreur avatar\n";
			
		}
		
		
		header($header);
		exit;
	}

          
          
          
          //requete
	$requete = "INSERT into `agent` (`nom`,`prenom`,`login`,`email`,`profil`,`statut`,`telephone`) VALUES( 
	'".mysql_real_escape_string($nom)."',
	'".mysql_real_escape_string($prenom)."',
	'".mysql_real_escape_string($login)."', 
	'".mysql_real_escape_string($email)."', 
	".mysql_real_escape_string($profil).", 
	".mysql_real_escape_string($statut).",
	'".mysql_real_escape_string($telephone)."')" ;
	//echo "avant if path\n";
	if (strcmp($path,"")!=0){
		$requete = "INSERT into `agent` (`nom`,`prenom`,`login`,`email`,`profil`,`statut`,`telephone`,`avatar`) VALUES( 
		'".mysql_real_escape_string($nom)."',
		'".mysql_real_escape_string($prenom)."',
		'".mysql_real_escape_string($login)."', 
		'".mysql_real_escape_string($email)."', 
		".mysql_real_escape_string($profil).", 
		".mysql_real_escape_string($statut).", 
		'".mysql_real_escape_string($telephone)."',
		'".$path_sql."')" ;
		//echo "requete ".$requete."\n";
			
	}

       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			$header = "location:../agents.php?action=detailler&&id_agent=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			
			//insertion de la nouvelle liste agences
			if(count($agences)>0){
				$requete = "INSERT INTO `agence_agent` (`agence`, `agent`) VALUES". "(". $agences[0]. "," . $last_id . ")"; 
				for($i=1; $i<count($agences); $i++){
					$requete = $requete . ",(". $agences[$i]. "," . $last_id . ")";
				}
				mysql_query($requete);
			}
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../agents.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		//Ne pas supprimer l utilisateur connecté
	   	if (strcmp($id,$_SESSION["id"])!=0)	{
			
			include("../config.php");
			//suppression de l'image du serveur
			$query = "SELECT `avatar` FROM agent WHERE `id`=" . $id ;
			$result = mysql_query($query);
			$line = mysql_fetch_row($result);
			if(mysql_num_rows($result)){
				$chemin_image = $line[0];
				//ne pas supprimer l image si elle est celle du system par defaut
				if (strcmp($chemin_image,"img/avatars/avatardefault.png")!=0)	{
					unlink("../".$chemin_image);
					unlink("../".str_replace("s/avatar","s/avatar_small",$chemin_image));
				}
			}
			
			$query = "delete  FROM agent WHERE `id`=" . $id ;
			if(mysql_query($query)){
				//supression des agences anciennes
				$requete = "DELETE FROM `agence_agent` WHERE `agent`=".$id;
				mysql_query($requete);
				echo "OK:Enregistrement supprimé avec succès";
			}
			
			else
			{
				echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
			}
		}
		else
			{
				echo "KO:Vous ne pouvez pas supprimer votre compte tout en étant connecté.";
			}
	}	
	else
	{
		echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
	}
  		
}
?> 