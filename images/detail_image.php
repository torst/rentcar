
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Informations de l'image</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_image=$_GET['id_image'];
                              $query = "SELECT 
									`images`.`id`,
									
									`images`.`nom`,
									`images`.`lien`
									FROM 
									images
									WHERE
									 `images`.`id`= ".$id_image;
	
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
                                      <label  class="col-lg-2 control-label">Lien</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne[2]; ?>" class="form-control" id="c-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Image</label>
                                      
                                      <div class="col-lg-3">
									    <a class="thumbnail">
									      <img src="<?php echo $ligne[2]; ?>" alt="Aucune image">
									    </a>
									  </div>
                                  </div>
                                  
                                 
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="images.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_image"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="images.php?action=modifier&&id_image=<?php echo $ligne[0]; ?>">Modifier</a>
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
    <script src="js/images/advanced-multiselect.js"></script>