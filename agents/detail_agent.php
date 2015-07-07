
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Informations de l'Agent</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_agent=$_GET['id_agent'];
                              $query = "SELECT 
									`agent`.`id`,
									
									`agent`.`nom`,
									`agent`.`prenom`,
									`agent`.`login`,
									`agent`.`email`,
									`profil_agent`.`nom`,
									`statut_agent`.`nom`,
									`agent`.`avatar`,
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
                                      <label  class="col-lg-2 control-label">Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[2]; ?>" class="form-control" id="l-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Login</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[3]; ?>" class="form-control" id="c-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[4]; ?>" class="form-control" id="b-day" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[8]; ?>" class="form-control" id="b-day" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Avatar</label>
                                      
                                      <div class="col-lg-3">
									    <a class="thumbnail">
									      <img src="<?php echo $ligne[7]; ?>" alt="avatar">
									    </a>
									  </div>
                                  </div>
                                  <h1> Caractéristiques</h1>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Profil</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[5]; ?>" class="form-control" id="occupation" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[6]; ?>" class="form-control readonly" id="email" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  
                                  
                                  
                              </form>

                              <h1> Agences</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                               
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Liste des agences rattachées</label>
                                      <div class="col-lg-6">
                                         
                                         <?php 
												  $query_agences = "select `nom` 
																from `agence`, `agence_agent` 
																where 
																`agence`.`id` = `agence_agent`.`agence` 
																and `agence_agent`.`agent` = ".$id_agent;
						
												  $result_agences = mysql_query($query_agences);
												  $nombre_lignes=mysql_num_rows($result_agences);
	
											  ?>
                                           <?php 
												  
												  if($nombre_lignes>0){
	
											  ?>
                                          <select multiple class="form-control" size ="<?php if ($nombre_lignes < 10)  echo $nombre_lignes; else echo 10;?>" >
                                             <?php 
												  
												  while($ligne_agences=mysql_fetch_row($result_agences)){
	
											  ?>
											  <option ><?php echo $ligne_agences[0]; ?></option>
											  
											  <?php 
												  }
	
											  ?>
                                              </select>
										  <?php 
                                              }
											  else {
											  ?>
												<label  class="col-lg-9 control-label">Cet agent n'est affecté à aucune agence</label>
												 
											<?php 
											}
                                          ?>
                                              
                                          
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="agents.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_agent"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="agents.php?action=modifier&&id_agent=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/agents/advanced-multiselect.js"></script>