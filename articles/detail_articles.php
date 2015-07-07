
		<section id="main-content">
          <section class="wrapper">
              <!-- article start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Détail de l'article</h1>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_articles=$_GET['id_articles'];
                              $query = "SELECT 
									`articles`.`id`,
									`articles`.`publicationDate`,
									`articles`.`title`,
									`articles`.`summary`,
									`articles`.`content`
									FROM 
									articles
									WHERE
									`articles`.`id`= ".$id_articles;
	
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
                                      <label  class="col-lg-2 control-label">Date de publication</label>
                                      <div class="col-lg-10">
                                          <input type="text" value="<?php echo $ligne[1]; ?>" class="form-control" id="f-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Titre</label>
                                      <div class="col-lg-10">
                                          <input type="text" value="<?php echo $ligne[2]; ?>" class="form-control" id="a-name" placeholder=" " readonly>
                                      </div>
                                  </div>
                                 
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Résumé de la article</label>
                                      <div class="col-lg-10">
                                         <!-- <textarea class="form-control" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="20"></textarea>-->
                                          <?php echo $ligne[3];  ?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Contenu de la article</label>
                                      <div class="col-lg-10">
                                         <!-- <textarea class="form-control" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="20"></textarea>-->
                                          <?php echo $ligne[4];  ?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="articles.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_article"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="articles.php?action=modifier&&id_articles=<?php echo $ligne[0]; ?>">Modifier</a>
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

              <!-- article end-->
          </section>
      </section>
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/articles/advanced-multiselect.js"></script>