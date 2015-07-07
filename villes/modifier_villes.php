
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier villes</h1>
                              <form class="cmxform form-horizontal" role="form" action="villes/actions_villes.php" id="modifier_villes" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_villes=$_GET['id_villes'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                              $nom=utf8_encode($_GET['nom']);
                              
                              $query = "SELECT 
									`ville`.`id`,
									
									`ville`.`nom`,
									`pays`.`nom`,
									`pays`.`id`
									FROM 
									ville, pays
									WHERE
									`ville`.`pays` = `pays`.`id` and `ville`.`id`= ".$id_villes;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_villes" value="<?php echo $ligne[0]; ?>" />
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
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[1]; else echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Pays</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="pays" id="pays">
                                          <?php 
	                                          $query_pays = "SELECT 
													`pays`.`id`,
													`pays`.`nom` 
													FROM 
													pays
													";
					
											  $result_pays = mysql_query($query_pays);
	                                          while($ligne_pays=mysql_fetch_row($result_pays)){

                                          ?>
										  <option 
										  <?php if ($ligne[3] == $ligne_pays[0]) echo "selected";?>
										  value="<?php echo $ligne_pays[0]; ?>"><?php echo $ligne_pays[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="villes.php">Annuler</a>
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
     

      