
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier la promotion - Service pour une Catégorie</h1>
                              <form class="cmxform form-horizontal" role="form" action="service_categorie_promotions/actions_service_categorie_promotions.php" id="modifier_service_categorie_promotions" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_date_debut'])) {$erreur_date_debut=$_GET['erreur_date_debut'];} else {$erreur_date_debut="";}
							  if(isset($_GET['erreur_date_fin'])) {$erreur_date_fin=$_GET['erreur_date_fin'];} else {$erreur_date_fin="";}
							  if(isset($_GET['erreur_prix_court'])) {$erreur_prix_court=$_GET['erreur_prix_court'];} else {$erreur_prix_court="";}
							  if(isset($_GET['erreur_prix_longue'])) {$erreur_prix_longue=$_GET['erreur_prix_longue'];} else {$erreur_prix_longue="";}
							  if(isset($_GET['erreur_categorie'])) {$erreur_categorie=$_GET['erreur_categorie'];} else {$erreur_categorie="";}
							  if(isset($_GET['erreur_service'])) {$erreur_service=$_GET['erreur_service'];} else {$erreur_service="";}
                              $categorie=($_GET['categorie']);
							  $service=($_GET['service']);
							  $date_debut=($_GET['date_debut']);
							  $date_fin=($_GET['date_fin']);
							  $prix_court=($_GET['prix_court']);
							  $prix_longue=($_GET['prix_longue']);
                              
                              $id_service=$_GET['id_service'];
							  $id_categorie=$_GET['id_categorie'];
                              $query = "SELECT 
									`promotion_service_categorie`.`categorie`,
									`categorie`.`nom`,
									DATE_FORMAT(`promotion_service_categorie`.`date_debut`, '%d/%m/%Y'),
									DATE_FORMAT(`promotion_service_categorie`.`date_fin`, '%d/%m/%Y'),
									`promotion_service_categorie`.`prix_court_duree`,
									`promotion_service_categorie`.`prix_longue_duree`,
									`service`.`nom`,
									`promotion_service_categorie`.`service`
									FROM 
									promotion_service_categorie, categorie, `service`
									WHERE
									`promotion_service_categorie`.`categorie` = `categorie`.`id`
									and `promotion_service_categorie`.`service` = `service`.`id`
									  and `promotion_service_categorie`.`categorie`= ".$id_categorie."
									  and `promotion_service_categorie`.`service`= ".$id_service;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_service" value="<?php echo $ligne[7]; ?>" />
                                  <input type="hidden" name ="id_categorie" value="<?php echo $ligne[0]; ?>" />
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
                                  <div class="form-group <?php if(strcmp($erreur_service,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">service</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="service" id="service">
                                          <?php 
	                                          $query_service = "SELECT 
													`service`.`id`,
													`service`.`nom` 
													FROM 
													`service`
													";
					
											  $result_service = mysql_query($query_service);
	                                          while($ligne_service=mysql_fetch_row($result_service)){

                                          ?>
										  <option <?php if ($ligne[7] == $ligne_service[0]) echo "selected";?> 
										  value="<?php echo $ligne_service[0]; ?>"><?php echo $ligne_service[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_service,"")!=0) echo " <p class='help-block'>".$erreur_service."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_categorie,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Catégorie</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="categorie" id="categorie">
                                          <?php 
	                                          $query_categorie = "SELECT 
													`categorie`.`id`,
													`categorie`.`nom` 
													FROM 
													categorie
													";
					
											  $result_categorie = mysql_query($query_categorie);
	                                          while($ligne_categorie=mysql_fetch_row($result_categorie)){

                                          ?>
										  <option <?php if ($ligne[0] == $ligne_categorie[0]) echo "selected";?> 
										  value="<?php echo $ligne_categorie[0]; ?>"><?php echo $ligne_categorie[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_categorie,"")!=0) echo " <p class='help-block'>".$erreur_categorie."</p>";?>
                                      </div>
                                  </div>
                                   
                                  <div class='form-group <?php if(strcmp($erreur_date_debut,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date de début</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[2]; else echo $date_debut; ?>" class="form-control form-control-inline input-medium dp1" id="date_debut" name="date_debut" placeholder="" >
                                          <?php if(strcmp($erreur_date_debut,"")!=0) echo " <p class='help-block'>".$erreur_date_debut."</p>";?>
                                      </div>
                                      
                                  </div>
                                  
                                  <div class='form-group <?php if(strcmp($erreur_date_fin,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date de fin</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[3]; else echo $date_fin; ?>" class="form-control form-control-inline input-medium dp2" id="date_fin" name="date_fin" placeholder="" >
                                          <?php if(strcmp($erreur_date_fin,"")!=0) echo " <p class='help-block'>".$erreur_date_fin."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_prix_court,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix pour courte durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[4]; else echo $prix_court; ?>" class="form-control" id="prix_court" name="prix_court" placeholder="Prix. Exemple: 100, 100.00 ou 100.21" >
                                         <?php if(strcmp($erreur_prix_court,"")!=0) echo " <p class='help-block'>".$erreur_prix_court."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_prix_longue,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix pour longue durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[5]; else echo $prix_longue; ?>" class="form-control" id="prix_longue" name="prix_longue" placeholder="Prix. Exemple: 100, 100.00 ou 100.21" >
                                          <?php if(strcmp($erreur_prix_longue,"")!=0) echo " <p class='help-block'>".$erreur_prix_longue."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="service_categorie_promotions.php">Annuler</a>
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
     

      