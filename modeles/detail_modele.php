 
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail du modèle</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_modele=$_GET['id_modele'];
                              $query = "SELECT 
									`modele_vehicule`.`id`,
									
									`modele_vehicule`.`nom`,
									`modele_vehicule`.`description`,
									`modele_vehicule`.`image`,
									`categorie`.`nom`,
									`marque_vehicule`.`nom`
									FROM 
									modele_vehicule, categorie, marque_vehicule
									WHERE
									`modele_vehicule`.`marque` = `marque_vehicule`.`id`
									and `modele_vehicule`.`categorie` = `categorie`.`id`
									and `modele_vehicule`.`id`= ".$id_modele;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
							
                              $query_prix = "SELECT 
									
									`prix_modele`.`prix_court_duree`,
									`prix_modele`.`prix_longue_duree`
									FROM 
									modele_vehicule, `prix_modele`
									WHERE
									`prix_modele`.`modele` = ".$id_modele;
	
							$result_prix = mysql_query($query_prix);
							$ligne_prix=mysql_fetch_row($result_prix);
                              
                              ?>

                                  <?php 
                                  		if(isset($_GET['message_success'])) {$message_success=$_GET['message_success'];} else {$message_success="";}
										if(strcmp($message_success,"")!=0){
								
									?>
						        	<div class="alert alert-success fade in ">
						                                  <button data-dismiss="alert" class="close close-sm" type="button">
						                                      <i class="icon-remove"></i>
						                                  </button>
						                                  <strong>Succès ! </strong> 
						                                  <?php 
																echo $message_success;
								
															?>
						            </div>
						            <?php 
										}
								
									?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Nom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[1]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Marque</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[5]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Catégorie</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[4]; ?>" class="form-control" id="f-name" placeholder=" " readonly/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Description</label>
                                      <div class="col-lg-6">
                                          <textarea   class="form-control" id="l-name" placeholder=" " readonly rows="3"><?php echo $ligne[2]; ?></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Prix pour courte durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne_prix[0]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Prix pour longue durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne_prix[1]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Image</label>
                                      
                                      <div class="col-lg-3">
									    <a class="thumbnail">
									      <img src="<?php echo $ligne[3]; ?>" alt="Aucune image">
									    </a>
									  </div>
                                  </div>
                                  
                                  
                                  <?php 
	                                          $query_composant = "SELECT 
													
													`caracteristique_modele`.`nom` ,
													`caracteristique_par_modele`.`valeur`
													FROM 
													`caracteristique_modele`, `caracteristique_par_modele`
													where 
													`caracteristique_modele`.`id` = `caracteristique_par_modele`.`caracteristique`
													and `caracteristique_par_modele`.`modele` = ".$id_modele;
					
											  $result_composant = mysql_query($query_composant);
											  $num_rows = mysql_num_rows($result_composant);
											  if ($num_rows > 0) echo '<h1> Caractéristiques du modèle</h1>';
	                                          while($ligne_composant=mysql_fetch_row($result_composant)){

                                          ?>
										  
										  
						 				  
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label"><?php echo $ligne_composant[0]; ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="f-name"  value="<?php echo $ligne_composant[1]; ?>" readonly/>
                                          
                                      </div>
                                  </div>
                                  <?php 
	                                          
											  }

                                          ?>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="modeles.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_modele_vehicule"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="modeles.php?action=modifier&&id_modele=<?php echo $ligne[0]; ?>">Modifier</a>
                                          <?php
												}
											?>

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
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/modeles/advanced-multiselect.js"></script>