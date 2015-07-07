<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php
      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
      switch ( $option ) {
		  case 'update_info':
		  	
		    	update_info();
		    break;
		    
		  case 'update_password_avatar':
		  	
		    	update_password_avatar();
		    break;
		
		  case 'update_avatar':
		  	
		    	update_avatar();
		    break;
		
		  
		  default:
		  	//traitement erreur
		    
		}
		
function update_info() {

			
	$id=$_SESSION['id'];
	
	$nom=($_POST['nom']);
	$prenom=($_POST['prenom']);
	$login=($_POST['login']);
	$email=($_POST['email']);
	$telephone=($_POST['telephone']);
	
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
	
	if($erreur == 1)
	{
		
		$header = "location:../profile.php?action=modifier";
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
		
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `agent` SET 
	`nom`='".mysql_real_escape_string($nom)."',
	`prenom`='".mysql_real_escape_string($prenom)."',
	`login`='".mysql_real_escape_string($login)."', 
	`email`='".mysql_real_escape_string($email)."',
	`telephone`='".mysql_real_escape_string($telephone)."'";
	
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			//Mise a jour des variables session
			$_SESSION["login"] = $login;
			$_SESSION["nom"] = $nom;
			$_SESSION["prenom"] = $prenom;
			$_SESSION["email"] = $email;
			$_SESSION["telephone"] = $telephone;
			$header = "location:../profile.php?action=detail&&message_success=Votre profile a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../profile.php?action=modifier";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  


function update_password_avatar() {
			
	$id=$_SESSION['id'];
	
	$password=($_POST['password']);
	$new_password=($_POST['new_password']);
	$confirm_password=($_POST['confirm_password']);
	
	//controle champ
	$erreur_password_form = 0;
	if(strcmp($password,"")==0) {
		$erreur_password = "Veuillez renseigner votre mot de passe";
		$erreur_password_form=1;
	}
	else{
		//verification mot de passe
		include("../config.php");
		$query = "SELECT `login` FROM agent WHERE `password`=MD5( '" . mysql_real_escape_string($password) . "') and `id`= ".$id;
		$result = mysql_query($query);
		if(!mysql_num_rows($result)){
			$erreur_password = "Mot de passe incorrecte ! Veuillez renseigner votre mot de passe.";
			$erreur_password_form=1;
		}
	}
	if(strcmp($new_password,"")==0) {
		$erreur_new_password = "Veuillez choisir un nouveau mot de passe";
		$erreur_password_form=1;
	}
	if(strcmp($confirm_password,"")==0) {
		$erreur_confirm_password = "Veuillez confirmer votre nouveau mot de passe";
		$erreur_password_form=1;
	}
	else
	if(strcmp($confirm_password,$new_password)!=0) {
		$erreur_confirm_password = "Veuillez confirmer votre nouveau mot de passe";
		$erreur_password_form=1;
	}
	
	
	if($erreur_password_form == 1)
	{
		
		$header = "location:../profile.php?action=modifier";
		$header = $header."&&erreur_password_form=".$erreur_password_form;
		if(strcmp($erreur_password,"")!=0) {
			$header = $header."&&erreur_password=".$erreur_password;
			
		}
		if(strcmp($erreur_new_password,"")!=0) {
			$header = $header."&&erreur_new_password=".$erreur_new_password;
			
		}
		if(strcmp($erreur_confirm_password,"")!=0) {
			$header = $header."&&erreur_confirm_password=".$erreur_confirm_password;
			
		}
		//position vers deuxieme formulaire
		$header = $header."#update_password_avatar";
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `agent` SET 
	`password`=MD5( '".mysql_real_escape_string($new_password)."')";
	$requete = $requete." WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../profile.php?action=detail&&message_success=Modification enregistrée avec succès.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale_password_form = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../profile.php?action=modifier";
			$header = $header."&&erreur_generale_password_form=".$erreur_generale_password_form;
			header($header);
			exit;
		}
		     	
          
}
  
	

function update_avatar() {
	$id=$_SESSION['id'];
	
	//$avatar...
	$path = "";
	$path_sql = "";
	
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
						include("../config.php");
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
					$erreur_avatar_form=1;
				}
			}
	
		}
		else{
			$erreur_avatar = "La taille de l'image ne doit pas dépasser 1 Mo.";
			$erreur_avatar_form=1;
		}
	}
	if($erreur_avatar_form == 1)
	{
		
		$header = "location:../profile.php?action=modifier";
		
		$header = $header."&&erreur_avatar_form=".$erreur_avatar_form;
		
		if(strcmp($erreur_avatar,"")!=0) {
			$header = $header."&&erreur_avatar=".$erreur_avatar;
				
		}
		
		header($header);
		exit;
	}

          
          //requete
	$requete = "UPDATE `agent` SET  `avatar` = '".$path_sql."'  WHERE `id`=".$id;
	
        if(mysql_query($requete)){
			$header = "location:../profile.php?action=detail&&message_success=Modification enregistrée avec succès.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale_avatar_form = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../profile.php?action=modifier";
			$header = $header."&&erreur_generale_avatar_form=".$erreur_generale_avatar_form;
			header($header);
			exit;
		}
  		
}
?> 