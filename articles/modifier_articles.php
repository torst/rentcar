
<section id="main-content">
          <section class="wrapper">
              <!-- article start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier article</h1>
                              <form class="cmxform form-horizontal" role="form" action="articles/actions_articles.php" id="modifier_articles" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_articles=$_GET['id_articles'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_titre'])) {$erreur_nom=$_GET['erreur_titre'];} else {$erreur_nom="";}
                              $titre=utf8_encode($_GET['titre']);
                              
                              $query = "SELECT 
									`articles`.`id`,
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

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_articles" value="<?php echo $ligne[0]; ?>" />
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
                                  <div class='form-group <?php if(strcmp($erreur_nom,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Titre</label>
                                      <div class="col-lg-10">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[1]; else echo $titre; ?>" class="form-control" id="titre" name="titre" placeholder="Title" >
                                          <?php if(strcmp($erreur_titre,"")!=0) echo " <p class='help-block'>".$erreur_titre."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Résumé de la article</label>
                                      <div class="col-lg-10">
                                          <textarea class="form-control ckeditor" id="resume" name="resume" placeholder="Insérer un résumé" rows="40"><?php if(strcmp($erreur,"")==0) echo $ligne[2]; else echo $resume; ?></textarea>
                                          
                                          
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Contenu de la article</label>
                                      <div class="col-lg-10">
                                          <textarea class="form-control ckeditor" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="40"><?php if(strcmp($erreur,"")==0) echo $ligne[3]; else echo $contenu; ?></textarea>
                                          
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="articles.php">Annuler</a>
                                          <button  class=" btn btn-warning  " type="submit">Valider</button>

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
     

      