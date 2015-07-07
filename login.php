<?php
	
	include("config.php");
	if (isset($_POST['traitement'])){
			
						$login=trim(htmlspecialchars(addslashes($_POST['login'])));
						$password=trim(htmlspecialchars(addslashes($_POST['password'])));
						$query = "SELECT `id`,`login`,`password`,`profil`,`statut`,`nom`,`prenom`,`avatar`,`email`,`telephone`  FROM agent WHERE `password`= MD5( '".mysql_real_escape_string($password)."')  and `login`='".mysql_real_escape_string($login)."'";
	
						$result = mysql_query($query);
						$line = mysql_fetch_row($result);
												
						if(mysql_num_rows($result)){
							$id = $line[0];
							$login = $line[1];
							$profil = $line[3];
							$statut = $line[4];
							$nom = $line[5];
							$prenom = $line[6];
							$avatar = $line[7];
							$email = $line[8];
							$telephone = $line[9];
							
							if ($statut == 1){
								session_start();
								$_SESSION["id"] = $id;
								$_SESSION["login"] = $login;
								$_SESSION["profil"] = $profil;
								$_SESSION["nom"] = $nom;
								$_SESSION["prenom"] = $prenom;
								$_SESSION["avatar"] = $avatar;
								$_SESSION["email"] = $email;
								$_SESSION["telephone"] = $telephone;
								
								//recuperation des entrees menu et action autorisés pour ce profil
								$query_menu = "SELECT `lien_menu` FROM profil_lien_menu WHERE `profil`= ".$profil;
								$result_menu = mysql_query($query_menu);
								while($ligne_menu=mysql_fetch_row($result_menu)){
									$_SESSION[$ligne_menu[0]] = $ligne_menu[0];
									
								}
								$query_action = "SELECT `action` FROM profil_action where `profil`= ".$profil;
								$result_action = mysql_query($query_action);
								while($ligne_action=mysql_fetch_row($result_action)){
									$_SESSION[$ligne_action[0]] = $ligne_action[0];
									
								}
								
							//remeber me
							if($_POST['remember']) {
								$year = time() + 31536000;
								setcookie('remember_me', $_POST['login'], $year);
							}
							elseif(!$_POST['remember']) {
								if(isset($_COOKIE['remember_me'])) {
									$past = time() - 100;
									setcookie('remember_me', gone, $past);
								}
							}
							
							header("location:index.php");
							}
							else{//compte bloque
								$erreur = "Ce compte est bloqué. Veuillez contacter l'administrateur.";
							}
						}
						else{//login pass non valide
						$erreur = "Login ou mot de passe incorrecte";
						}
			
	}

	if (isset($_POST['recuperation'])){
		
			if (isset($_POST['email'])){
				$email=trim(htmlspecialchars(addslashes($_POST['email'])));
				
				$query = "SELECT `id` FROM agent WHERE `email`= '".$email."'";
				$result = mysql_query($query);
				if(mysql_num_rows($result)){
					//generation d un nouveau mot de passe
					$char = 'abcdefghijklmnopqrstuvwxyz0123456789';
					$mot_de_passe = str_shuffle($char);
					$mot_de_passe = substr($mot_de_passe, -12);
					$query = "UPDATE `location_car_R2`.`agent` SET `password` = MD5( '".$mot_de_passe."' ) WHERE `agent`.`email` ='".$email."'";
					if(mysql_query($query)){
						$message = "Un nouveau mot de passe vous a été envoyé par email.";
					}
					else
					//envoi_password_email($email):
					
					{
					$erreur = "Un problème technique est survenu. Veuillez contacter l'administrateur.";					
				}

				}
				else{
					$erreur = "Cette adresse email ne figure pas dans la base de données.";					
				}
					
			}
			
	}
	
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ZBanzai">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Location de voiture : ADMIN PANEL</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Authentification</h2>
        <div class="login-wrap">
        	<?php 
				if(isset($erreur)){
		
			?>
        	<div class="alert alert-block alert-danger fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Erreur !</strong> 
                                  <?php 
										echo $erreur;
		
									?>
            </div>
            <?php 
				}
		
			?>
			<?php 
				if(isset($message)){
		
			?>
        	<div class="alert alert-block alert-info fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Alerte !</strong> 
                                  <?php 
										echo $message;
		
									?>
            </div>
            <?php 
				}
		
			?>
                              
        	<input type='hidden' name='traitement' value="1" />
            <input type="text" class="form-control" placeholder="Login" name="login" value="<?php echo $_COOKIE['remember_me']; ?>">
            <input type="password" class="form-control" placeholder="Mot de passe" name="password">
            <label class="checkbox">
                <input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
		echo 'checked="checked"';
	}
	else {
		echo '';
	}
	?>  value="1"> Se souvenir de moi
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Mot de passe oublié ?</a>

                </span>
            </label>
            
            <button class="btn btn-lg btn-login btn-block" type="submit">Se connecter</button>
        
        </div>
		</form>
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Mot de passe perdu ?</h4>
                      </div>
                      <div class="modal-body">
                      <form class="form-signin" action="login.php" method="post">
                          <p>Entrez votre adresse email pour récupèrer votre mot de passe.</p>
                          <input type='hidden' name='recuperation' value="1" />
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Annuler</button>
                          <button class="btn btn-success" type="submit">Valider</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- modal -->

      

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>
