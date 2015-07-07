<section id="main-content">
          <section class="wrapper">
              <!-- article start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'un nouvelle article</h1>
                              <form class="cmxform form-horizontal" role="form" action="articles/actions_articles.php" id="modifier_articles" method="post"  enctype="multipart/form-data" nom="modifier_articles">
                              <?php
                              
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_titre'])) {$erreur_nom=$_GET['erreur_titre'];} else {$erreur_titre="";}
                              
                              $titre=utf8_encode($_GET['titre']);
							  
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="insert" />
                                  
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
                                  <div class='form-group <?php if(strcmp($erreur_titre,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Titre</label>
                                      <div class="col-lg-10">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $titre; ?>" class="form-control" id="titre" name="titre" placeholder="Titre" >
                                          <?php if(strcmp($erreur_titre,"")!=0) echo " <p class='help-block'>".$erreur_titre."</p>";?>
                                      </div>
                                  </div>
                                
                                <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Résumé de la article</label>
                                      <div class="col-lg-10">
                                         <!-- <textarea class="form-control" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="20"></textarea>-->
                                         
                                          
                                          <textarea class="form-control ckeditor" name="resume" rows="4" ><?php if(strcmp($erreur,"")==0) echo  $resume; ?></textarea>
                                          <div class="alert alert-warning fade in">
                                              <button data-dismiss="alert" class="close close-sm" type="button">
                                                  <i class="icon-remove"></i>
                                              </button>
                                              <strong>Attention !</strong> Ne pas dépasser 3 lignes.
                                          </div>       
                                          
                                      </div>
                                  </div>
                                  
                                <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Contenu de la article</label>
                                      <div class="col-lg-10">
                                         <!-- <textarea class="form-control" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="20"></textarea>-->
                                         
                                                      <textarea class="form-control ckeditor" name="contenu" rows="40" ><?php if(strcmp($erreur,"")==0) echo  $contenu; ?></textarea>
                                                  
                                          
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
       <!--for multiselect-->
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/articles/advanced-multiselect.js"></script>
    