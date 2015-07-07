
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel ">
                          <div class="user-heading round" >
                              <a data-toggle="modal" href="#myModal" title="Cliquez ici pour modifier votre Avatar">
                                  <img src="<?php echo $_SESSION["avatar"]; ?>" alt="">
                              </a>
                              <!-- Modal -->
                              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Changer votre photo du profile</h4>
                                          </div>
                                          <div class="modal-body">
                                          <form class="form-signin"  action="profile/actions_profile.php" method="POST" id="update_avatar" enctype="multipart/form-data">
                                              <p>Choisissez une image</p>
                                              <input type="hidden" name ="option" value="update_avatar" />
                                              <input type="file" class="default" name="avatar" id="avatar"/>
                    
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
                              <h1><?php echo $_SESSION["nom"]." ".$_SESSION["prenom"]; ?></h1>
                              <p><?php echo $_SESSION["email"]; ?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="profile.php?action=detail"> <i class="icon-user"></i> Profile</a></li>
                              
                              <li><a href="profile.php?action=modifier"> <i class="icon-edit"></i> Modifier profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel panel-primary">
                          <div class="panel-heading"> Informations Profile</div>
                          <div class="panel-body bio-graph-info">
                              
                              <form class="form-horizontal" role="form" action="profile/actions_profile.php" method="POST" id="modifier_profile">
                              <?php
                              //recuperation des codes d erreur
                              $id_agent=$_SESSION['id'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                              if(isset($_GET['erreur_prenom'])) {$erreur_prenom=$_GET['erreur_prenom'];} else {$erreur_prenom="";}
                              if(isset($_GET['erreur_login'])) {$erreur_login=$_GET['erreur_login'];} else {$erreur_login="";}
                              if(isset($_GET['erreur_email'])) {$erreur_email=$_GET['erreur_email'];} else {$erreur_email="";}
                              $nom=utf8_encode($_GET['nom']);
							  $prenom=utf8_encode($_GET['prenom']);
							  $login=utf8_encode($_GET['login']);
							  $email=utf8_encode($_GET['email']);
                              
                              ?>
                                 <input type="hidden" name ="option" value="update_info" />
                                 <?php 
										if(strcmp($erreur_generale,"")!=0){
								
									?>
						        	<div class="alert alert-block alert-danger fade in">
						                                  <button data-dismiss="alert" class="close close-sm" type="button">
						                                      <i class="icon-remove"></i>
						                                  </button>
						                                  <strong>Erreur ! </strong> 
						                                  <?php 
																echo $erreur_generale;
								
															?>
						            </div>
						            <?php 
										}
								
									?>
                                  <div class='form-group <?php if(strcmp($erreur_nom,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Nom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $_SESSION["nom"]; else echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_prenom,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $_SESSION["prenom"]; else echo $prenom; ?>" class="form-control" id="prenom" name="prenom" placeholder="Prénom" >
                                          <?php if(strcmp($erreur_prenom,"")!=0) echo " <p class='help-block'>".$erreur_prenom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_login,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Login</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $_SESSION["login"]; else echo $login; ?>" class="form-control" id="login" name="login" placeholder="Login" >
                                          <?php if(strcmp($erreur_login,"")!=0) echo " <p class='help-block'>".$erreur_login."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_email,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Adresse Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $_SESSION["email"]; else echo $email; ?>" class="form-control" id="emai" name="email" placeholder="Email@exemple.com" >
                                          <?php if(strcmp($erreur_email,"")!=0) echo " <p class='help-block'>".$erreur_email."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $_SESSION["telephone"]; else echo $telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" >
                                          
                                      </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Valider</button>
                                          
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Mot de passe</div>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form" action="profile/actions_profile.php" method="POST" id="update_password_avatar">
                                  <?php
									  //recuperation des codes d erreur
									  if(isset($_GET['erreur_password_form'])) {$erreur_password_form=$_GET['erreur_password_form'];} else {$erreur_password_form="";}
									  if(isset($_GET['erreur_generale_password_form'])) {$erreur_generale_password_form=$_GET['erreur_generale_password_form'];} else {$erreur_generale_password_form="";}
									  if(isset($_GET['erreur_password'])) {$erreur_password=$_GET['erreur_password'];} else {$erreur_password="";}
									  if(isset($_GET['erreur_new_password'])) {$erreur_new_password=$_GET['erreur_new_password'];} else {$erreur_new_password="";}
									  if(isset($_GET['erreur_confirm_password'])) {$erreur_confirm_password=$_GET['erreur_confirm_password'];} else {$erreur_confirm_password="";}
									  
								?>
                                    <input type="hidden" name ="option" value="update_password_avatar" />
                                      <div class="form-group <?php if(strcmp($erreur_password,"")!=0) echo " has-error";?>">
                                      	<label  class="col-lg-2 control-label">Ancien mot de passe</label>
                                      	<div class="col-lg-6">
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Ancien mot de passe" >
                                          <?php if(strcmp($erreur_password,"")!=0) echo " <p class='help-block'>".$erreur_password."</p>";?>
                                      	</div>
                                 	 </div>
                                      <div class="form-group <?php if(strcmp($erreur_new_password,"")!=0) echo " has-error";?>">
                                      	<label  class="col-lg-2 control-label">Nouveau mot de passe</label>
                                      	<div class="col-lg-6">
                                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nouveau mot de passe" >
                                          <?php if(strcmp($erreur_new_password,"")!=0) echo " <p class='help-block'>".$erreur_new_password."</p>";?>
                                      	</div>
                                 	 </div>
                                      <div class="form-group <?php if(strcmp($erreur_confirm_password,"")!=0) echo " has-error";?>">
                                      	<label  class="col-lg-2 control-label">Confirmez mot de passe</label>
                                      	<div class="col-lg-6">
                                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmez mot de passe" >
                                          <?php if(strcmp($erreur_confirm_password,"")!=0) echo " <p class='help-block'>".$erreur_confirm_password."</p>";?>
                                      	</div>
                                 	 </div>

                                     

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                             <button type="submit" class="btn btn-success">Valider</button>
                                              
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>