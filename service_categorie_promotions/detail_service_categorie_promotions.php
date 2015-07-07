
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail de la promotion - Service pour une catégorie</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_service=$_GET['id_service'];
							  $id_categorie=$_GET['id_categorie'];
                              $query = "SELECT 
									`promotion_service_categorie`.`categorie`,
									`categorie`.`nom`,
									DATE_FORMAT(`promotion_service_categorie`.`date_debut`, '%d / %m / %Y'),
									DATE_FORMAT(`promotion_service_categorie`.`date_fin`, '%d / %m / %Y'),
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
                                      <label  class="col-lg-2 control-label">Service</label>
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
                                      	  <a  class=" btn btn-primary  " href="service_categorie_promotions.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_service_categorie_promotions"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="service_categorie_promotions.php?action=modifier&&id_service=<?php echo $ligne[7]; ?>&&id_categorie=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/service_categorie_promotions/advanced-multiselect.js"></script>