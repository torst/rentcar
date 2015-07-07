
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier les informations de l'Agent</h1>
                              <form class="cmxform form-horizontal" role="form" action="agents/actions_agent.php" id="modifier_agent" method="post"  enctype="multipart/form-data" nom="modifier_agent">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_agent=$_GET['id_agent'];
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
                              
                              $query = "SELECT 
									`agent`.`id`,
									
									`agent`.`nom`,
									`agent`.`prenom`,
									`agent`.`login`,
									`agent`.`email`,
									`profil_agent`.`nom`,
									`statut_agent`.`nom`,
									`profil_agent`.`id`,
									`statut_agent`.`id`,
									`agent`.`telephone`
									FROM 
									agent,profil_agent,statut_agent
									WHERE
									`agent`.`profil` = `profil_agent`.`id`
									and `agent`.`statut` = `statut_agent`.`id`
									and `agent`.`id`= ".$id_agent;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_agent" value="<?php echo $ligne[0]; ?>" />
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
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[1]; else echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_prenom,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[2]; else echo $prenom; ?>" class="form-control" id="prenom" name="prenom" placeholder="Prénom" >
                                          <?php if(strcmp($erreur_prenom,"")!=0) echo " <p class='help-block'>".$erreur_prenom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_login,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Login</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[3]; else echo $login; ?>" class="form-control" id="login" name="login" placeholder="Login" >
                                          <?php if(strcmp($erreur_login,"")!=0) echo " <p class='help-block'>".$erreur_login."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_email,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[4]; else echo $email; ?>" class="form-control" id="email" name="email" placeholder="Email@exemple.com" >
                                          <?php if(strcmp($erreur_email,"")!=0) echo " <p class='help-block'>".$erreur_email."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[9]; else echo $telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="Numéro(s) de téléphone" >
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                  	<label  class="col-lg-2 control-label">Avatar</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Modifier l'image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="avatar" id="avatar"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
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
										  <option 
										  <?php if ($ligne[7] == $ligne_profil[0]) echo "selected";?>
										  value="<?php echo $ligne_profil[0]; ?>"><?php echo $ligne_profil[1]; ?></option>
										  
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
										  <option 
										  <?php if ($ligne[8] == $ligne_statut[0]) echo "selected";?>
										  value="<?php echo $ligne_statut[0]; ?>"><?php echo $ligne_statut[1]; ?></option>
										  
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
    <script>
          $('#my_multi_select3').multiSelect('select',[
		 
		  	<?php 
				  $query_agences = "select `id` 
								from `agence`, `agence_agent` 
								where 
								`agence`.`id` = `agence_agent`.`agence` 
								and `agence_agent`.`agent` = ".$id_agent;

				  $result_agences = mysql_query($query_agences);
 
				  while($ligne_agences=mysql_fetch_row($result_agences)){
					echo "'".$ligne_agences[0]."',"; 
			  		}

			  ?>
		  ]);
      </script>