
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier les informations de l'image</h1>
                              <form class="cmxform form-horizontal" role="form" action="images/actions_image.php" id="modifier_image" method="post"  enctype="multipart/form-data" nom="modifier_image">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_image=$_GET['id_image'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                             
                              
                              $nom=utf8_encode($_GET['nom']);
							 
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

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_image" value="<?php echo $ligne[0]; ?>" />
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
                                  	<label  class="col-lg-2 control-label">Image</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Modifier l'image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="image" id="image"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
                                          </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="images.php">Annuler</a>
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
     

      