
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier la promotion - Option pour un modèle</h1>
                              <form class="cmxform form-horizontal" role="form" action="option_modele_promotions/actions_option_modele_promotions.php" id="modifier_option_modele_promotions" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_date_debut'])) {$erreur_date_debut=$_GET['erreur_date_debut'];} else {$erreur_date_debut="";}
							  if(isset($_GET['erreur_date_fin'])) {$erreur_date_fin=$_GET['erreur_date_fin'];} else {$erreur_date_fin="";}
							  if(isset($_GET['erreur_prix_court'])) {$erreur_prix_court=$_GET['erreur_prix_court'];} else {$erreur_prix_court="";}
							  if(isset($_GET['erreur_prix_longue'])) {$erreur_prix_longue=$_GET['erreur_prix_longue'];} else {$erreur_prix_longue="";}
							  if(isset($_GET['erreur_modele'])) {$erreur_modele=$_GET['erreur_modele'];} else {$erreur_modele="";}
							  if(isset($_GET['erreur_option'])) {$erreur_option=$_GET['erreur_option'];} else {$erreur_option="";}
                              $modele=($_GET['modele']);
							  $option_rec=($_GET['option_rec']);
							  $date_debut=($_GET['date_debut']);
							  $date_fin=($_GET['date_fin']);
							  $prix_court=($_GET['prix_court']);
							  $prix_longue=($_GET['prix_longue']);
                              
                              $id_option=$_GET['id_option'];
							  $id_modele=$_GET['id_modele'];
                              $query = "SELECT 
									`promotion_option_modele`.`modele`,
									`modele_vehicule`.`nom`,
									DATE_FORMAT(`promotion_option_modele`.`date_debut`, '%d/%m/%Y'),
									DATE_FORMAT(`promotion_option_modele`.`date_fin`, '%d/%m/%Y'),
									`promotion_option_modele`.`prix_court_duree`,
									`promotion_option_modele`.`prix_longue_duree`,
									`option`.`nom`,
									`promotion_option_modele`.`option`
									FROM 
									promotion_option_modele, modele_vehicule, `option`
									WHERE
									`promotion_option_modele`.`modele` = `modele_vehicule`.`id`
									and `promotion_option_modele`.`option` = `option`.`id`
									  and `promotion_option_modele`.`modele`= ".$id_modele."
									  and `promotion_option_modele`.`option`= ".$id_option;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_option" value="<?php echo $ligne[7]; ?>" />
                                  <input type="hidden" name ="id_modele" value="<?php echo $ligne[0]; ?>" />
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
                                  <div class="form-group <?php if(strcmp($erreur_option,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Option</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="option_rec" id="option_rec">
                                          <?php 
	                                          $query_option = "SELECT 
													`option`.`id`,
													`option`.`nom` 
													FROM 
													`option`
													";
					
											  $result_option = mysql_query($query_option);
	                                          while($ligne_option=mysql_fetch_row($result_option)){

                                          ?>
										  <option <?php if ($ligne[7] == $ligne_option[0]) echo "selected";?> 
										  value="<?php echo $ligne_option[0]; ?>"><?php echo $ligne_option[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_option,"")!=0) echo " <p class='help-block'>".$erreur_option."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_modele,"")!=0) echo " has-error";?>">
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
										  <option <?php if ($ligne[0] == $ligne_modele[0]) echo "selected";?> 
										  value="<?php echo $ligne_modele[0]; ?>"><?php echo $ligne_modele[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_modele,"")!=0) echo " <p class='help-block'>".$erreur_modele."</p>";?>
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
                                      	  <a  class=" btn btn-primary  " href="option_modele_promotions.php">Annuler</a>
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
     

      