
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail de la promotion - Option pour un modèle</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_option=$_GET['id_option'];
							  $id_modele=$_GET['id_modele'];
                              $query = "SELECT 
									`promotion_option_modele`.`modele`,
									`modele_vehicule`.`nom`,
									DATE_FORMAT(`promotion_option_modele`.`date_debut`, '%d / %m / %Y'),
									DATE_FORMAT(`promotion_option_modele`.`date_fin`, '%d / %m / %Y'),
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
                                      <label  class="col-lg-2 control-label">Option</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[6]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Modèle</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[1]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Date de début</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[2]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Date de fin</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[3]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Prix pour une courte durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[4]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Prix pour une longue durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[5]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="option_modele_promotions.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_option_modele_promotions"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="option_modele_promotions.php?action=modifier&&id_option=<?php echo $ligne[7]; ?>&&id_modele=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/option_modele_promotions/advanced-multiselect.js"></script>