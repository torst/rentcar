<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'une nouvelle page</h1>
                              <form class="cmxform form-horizontal" role="form" action="pages/actions_pages.php" id="modifier_pages" method="post"  enctype="multipart/form-data" nom="modifier_pages">
                              <?php
                              
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                              
                              $nom=utf8_encode($_GET['nom']);
							  
                              
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
                                  <div class='form-group <?php if(strcmp($erreur_nom,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Nom</label>
                                      <div class="col-lg-10">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  
                                <div class="form-group ">
                                      <label  class="col-lg-2 control-label">Contenu de la page</label>
                                      <div class="col-lg-10">
                                         <!-- <textarea class="form-control" id="contenu" name="contenu" placeholder="Insérer du contenu" rows="20"></textarea>-->
                                         
                                                      <textarea class="form-control ckeditor" name="contenu" rows="40" ><?php if(strcmp($erreur,"")==0) echo  $contenu; ?></textarea>
                                                  
                                          
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="pages.php">Annuler</a>
                                          <button  class=" btn btn-warning  " type="submit">Valider</button>

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
       <!--for multiselect-->
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/pages/advanced-multiselect.js"></script>
    