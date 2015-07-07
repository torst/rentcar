
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail du compte web</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_membres=$_GET['id_membres'];
                              $query = "SELECT 
									`membre`.`id`,
									`membre`.`email`,
									`statut_membre`.`nom`,
									`membre`.`id_client`
									FROM 
									membre, statut_membre
									WHERE
									`membre`.`statut` = `statut_membre`.`id`
									 and `membre`.`id`= ".$id_membres;
	
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
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Password</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="********" class="form-control" id="f-pays" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Fiche Client</label>
                                      <div class="col-lg-6">
                                      <?php 
									  if ($ligne[3] == "") 
                                          echo 'Non disponibe. <a href="">  Créer</a>';
									  else{
										  $query_client = "SELECT 
														`client`.`id`,
														`client`.`nom` ,
														`client`.`prenom` ,
														`client`.`numero_pi`,
														`type_pi`.`nom` 
														
														FROM 
															client, type_pi
														WHERE
															client.type_pi =  type_pi.id
														and 
															`client`.`id`= ".$ligne[3];
												$result_client = mysql_query($query_client);
												$ligne_client=mysql_fetch_row($result_client);
									  	   echo $ligne_client[1].' '.$ligne_client[2].'<a href="clients.php?action=detailler&&id_clients='.$ligne[3].'"> + détails</a>';
										   
										   }
                                      ?>
                                       
                                      </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="membres.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_membres"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="membres.php?action=modifier&&id_membres=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/membres/advanced-multiselect.js"></script>