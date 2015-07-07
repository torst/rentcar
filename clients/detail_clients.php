
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail du client</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_clients=$_GET['id_clients'];
                              $query = "SELECT 
									`client`.`id`,
									`client`.`nom`,
									`client`.`prenom`,
									`client`.`raison_social`,
									`type_pi`.`nom`,
									`client`.`numero_pi`,
									`type_client`.`nom`,
									`client`.`adresse`,
									`client`.`telephone`,
									`client`.`fax`,
									`nationnalite`.`nom`
									
									FROM 
									client, type_client, type_pi, nationnalite
									WHERE
									`client`.`type` = `type_client`.`id`
									and
									`client`.`nationnalite` = `nationnalite`.`id`
									and
									`client`.`type_pi` = `type_pi`.`id`
									 and `client`.`id`= ".$id_clients;
	
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
                                      <label  class="col-lg-2 control-label">Nom et Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[1]." ".$ligne[2]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Type</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[6]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <?php 
                                  		if(strcmp($ligne[3],"")!=0){
									?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Raison Sociale</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[3]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <?php 
										}
								
									?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Type de pièce d'identité</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[4]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Numéro d'identité</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[5]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[8]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <?php 
                                  		if(strcmp($ligne[9],"")!=0){
									?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Fax</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[9]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <?php 
										}
								
									?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Nationalité</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[10]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Adresse</label>
                                      <div class="col-lg-6">
                                          <?php echo $ligne[7]; ?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="clients.php">Retour à la liste des clients</a>
                                          <?php
												if(isset($_SESSION["modifier_clients"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="clients.php?action=modifier&&id_clients=<?php echo $ligne[0]; ?>">Modifier</a>
                                          <?php
												}
											?>

                                      </div>
                                  </div>
                                  
                                   <h1> Compte web du client</h1>
                                 	<?php
                              //recuperation donnees a partir de la BD
                              $query = "SELECT 
									`membre`.`id`,
									`membre`.`email`,
									`statut_membre`.`nom`,
									`membre`.`id_client`
									FROM 
									membre, statut_membre
									WHERE
									`membre`.`statut` = `statut_membre`.`id`
									 and `membre`.`id_client`= ".$id_clients;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							$nmbre=mysql_num_rows($result);
							if ($nmbre <>0){
                              
                              ?>
                              	<div class="form-group">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[1]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[2]; ?>" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                            <?php }
							
							else{
							
							 ?>
                             
                             <div class="form-group">
                                      <label  class="col-lg-10 control-label">Ce client ne dispose pas encore de compte web</label>
                                      
                             </div>
                             
                             <?php }
							
							 ?>
                              <div class="form-group">
                                      <label  class="col-lg-offset-2 col-lg-10">
                                        <a  class=" btn btn-primary  " href="membres.php">Retour à la liste des comptes web</a>
                                      </label>
                                      
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
    <script src="js/clients/advanced-multiselect.js"></script>