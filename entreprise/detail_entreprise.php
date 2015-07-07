
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Informations de l'Entreprise</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_entreprise=$_GET['id_entreprise'];
                              $query = "SELECT 
									`entreprise`.`id`,
									`entreprise`.`nom`,
									`entreprise`.`hotline`,
									`entreprise`.`contact_commercial`,
									`entreprise`.`contact_technique`,
									`entreprise`.`fax`,
									`entreprise`.`adresse_siege`,
									`entreprise`.`description`
									
									FROM entreprise ";
	
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
                                      <label  class="col-lg-2 control-label">Hotline</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[2];  ?>" class="form-control" id="hotline" name="hotline" placeholder="Hotline" readonly>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Contact commercial</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[3];  ?>" class="form-control" id="contact_commercial" name="contact_commercial" placeholder="Contact commercial" readonly>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Contact technique</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[4];  ?>" class="form-control" id="contact_technique" name="contact_technique" placeholder="Contact technique" readonly>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Fax</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[5];  ?>" class="form-control" id="fax" name="fax" placeholder="Fax" readonly>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Adresse du siège</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse" rows="3" readonly><?php echo $ligne[6];  ?></textarea>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Description</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="description" name="description" placeholder="Description" rows="20" readonly><?php  echo $ligne[7];  ?></textarea>
                                         
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  
                                          <?php
												if(isset($_SESSION["modifier_entreprise"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="entreprise.php?action=modifier&&id_entreprise=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/entreprise/advanced-multiselect.js"></script>