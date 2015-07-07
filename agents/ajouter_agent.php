<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'un nouvel Agent</h1>
                              <form class="cmxform form-horizontal" role="form" action="agents/actions_agent.php" id="modifier_agent" method="post"  enctype="multipart/form-data" nom="modifier_agent">
                              <?php
                              
                              include("config.php");
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
							  $telephone=utf8_encode($_GET['telephone']);
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="insert" />
                                  
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
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_prenom,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $prenom; ?>" class="form-control" id="prenom" name="prenom" placeholder="Prénom" >
                                          <?php if(strcmp($erreur_prenom,"")!=0) echo " <p class='help-block'>".$erreur_prenom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_login,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Login</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $login; ?>" class="form-control" id="login" name="login" placeholder="Login" >
                                          <?php if(strcmp($erreur_login,"")!=0) echo " <p class='help-block'>".$erreur_login."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_email,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $email; ?>" class="form-control" id="emai" name="email" placeholder="Email@exemple.com" >
                                          <?php if(strcmp($erreur_email,"")!=0) echo " <p class='help-block'>".$erreur_email."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="Numéro(s) de téléphone" >
                                          
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_avatar,"")!=0) echo " has-error";?>">
                                  	<label  class="col-lg-2 control-label">Avatar</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Choisir une image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="avatar" id="avatar" accept="image/gif, image/jpeg, image/jpg, image/png"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
                                              <?php if(strcmp($erreur_avatar,"")!=0) echo " <p class='help-block'>".$erreur_avatar."</p>";?>
                                          </div>
                                  </div>
                                  <h1> Caractéristiques</h1>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Profil</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="profil" id="profil">
                                          <?php 
	                                          $query_profil = "SELECT 
													`profil_agent`.`id`,
													`profil_agent`.`nom` 
													FROM 
													profil_agent
													";
					
											  $result_profil = mysql_query($query_profil);
	                                          while($ligne_profil=mysql_fetch_row($result_profil)){

                                          ?>
										  <option value="<?php echo $ligne_profil[0]; ?>"><?php echo $ligne_profil[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut</label>
                                      <div class="col-lg-6">
                                         <select class="form-control" name="statut" id="statut">
                                          <?php 
	                                          $query_statut = "SELECT 
													`statut_agent`.`id`,
													`statut_agent`.`nom` 
													FROM 
													statut_agent
													";
					
											  $result_statut = mysql_query($query_statut);
	                                          while($ligne_statut=mysql_fetch_row($result_statut)){

                                          ?>
										  <option value="<?php echo $ligne_statut[0]; ?>"><?php echo $ligne_statut[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <h1> Agences</h1>
                                   <div class="form-group last">
                                    <label class="control-label col-lg-2">Liste des agences rattachées</label>
                                    <div class="col-lg-6">
                                   
                                    <?php 
												  $query_agences = "select `id`, `nom` 
																from `agence`
																";
						
												  $result_agences = mysql_query($query_agences);
												  $nombre_lignes=mysql_num_rows($result_agences);
	
											  ?>
                                          <select name="agences[]" class="multi-select" multiple="" id="my_multi_select3" >
                                             <?php 
												  
												  while($ligne_agences=mysql_fetch_row($result_agences)){
	
											  ?>
											  <option value="<?php echo $ligne_agences[0]; ?>"><?php echo $ligne_agences[1]; ?></option>
											  
											  <?php 
												  }
	
											  ?>
                                              
                                          </select>
                              </div>

                          </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="agents.php">Annuler</a>
                                          <button  class=" btn btn-warning  " type="submit">Valider</button>

                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      
                  </aside>
                  
              </div>
              

              <!-- page end-->
          </section>
      </section>
       <!--for multiselect-->
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/agents/advanced-multiselect.js"></script>
    