
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier vehicules</h1>
                              <form class="cmxform form-horizontal" role="form" action="vehicules/actions_vehicules.php" id="modifier_vehicules" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_vehicules=$_GET['id_vehicules'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_matricule'])) {$erreur_matricule=$_GET['erreur_matricule'];} else {$erreur_matricule="";}
                              $matricule=utf8_encode($_GET['matricule']);
                              
                              $query = "SELECT 
									`vehicule`.`id`,
									`vehicule`.`matricule`,
									`vehicule`.`chassis`,
									`vehicule`.`couleur`,
									`modele_vehicule`.`nom`,
									`statut_vehicule`.`nom`,
									`modele_vehicule`.`id`,
									`statut_vehicule`.`id`
									FROM 
									vehicule, modele_vehicule,statut_vehicule
									WHERE
									`vehicule`.`modele` = `modele_vehicule`.`id`
									and
									`vehicule`.`statut` = `statut_vehicule`.`id`
									 and `vehicule`.`id`= ".$id_vehicules;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_vehicules" value="<?php echo $ligne[0]; ?>" />
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
                                  <div class='form-group <?php if(strcmp($erreur_matricule,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Matricule</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[1]; else echo $matricule; ?>" class="form-control" id="matricule" name="matricule" placeholder="Matricule. Exemple 000000 A 1" >
                                          <?php if(strcmp($erreur_matricule,"")!=0) echo " <p class='help-block'>".$erreur_matricule."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Numéro de chassis</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[2]; else echo $chassis; ?>" class="form-control" id="chassis" name="chassis" placeholder="Numéro de chassis" >
                                      </div>
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Couleur</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[3]; else echo $couleur; ?>" class="form-control" id="couleur" name="couleur" placeholder="Couleur" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Modèle</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="modele" id="modele">
                                          <?php 
	                                          $query_modele = "SELECT 
													`modele_vehicule`.`id`,
													`modele_vehicule`.`nom` 
													FROM 
													modele_vehicule
													";
					
											  $result_modele = mysql_query($query_modele);
	                                          while($ligne_modele=mysql_fetch_row($result_modele)){

                                          ?>
										  <option 
										  <?php if ($ligne[6] == $ligne_modele[0]) echo "selected";?>
										  value="<?php echo $ligne_modele[0]; ?>"><?php echo $ligne_modele[1]; ?></option>
										  
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
													`statut_vehicule`.`id`,
													`statut_vehicule`.`nom` 
													FROM 
													statut_vehicule
													";
					
											  $result_statut = mysql_query($query_statut);
	                                          while($ligne_statut=mysql_fetch_row($result_statut)){

                                          ?>
										  <option 
										  <?php if ($ligne[7] == $ligne_statut[0]) echo "selected";?>
										  value="<?php echo $ligne_statut[0]; ?>"><?php echo $ligne_statut[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="vehicules.php">Annuler</a>
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
     

      