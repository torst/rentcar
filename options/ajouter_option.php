<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'une nouvelle option</h1>
                              <form class="cmxform form-horizontal" role="form" action="options/actions_option.php" id="modifier_option" method="post"  enctype="multipart/form-data" nom="modifier_option">
                              <?php
                              
                              include("config.php");
                              $id_option=$_GET['id_option'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
							  if(isset($_GET['erreur_description'])) {$erreur_description=$_GET['erreur_description'];} else {$erreur_description="";}
							  if(isset($_GET['erreur_prix'])) {$erreur_description=$_GET['erreur_prix'];} else {$erreur_description="";}
                              
                              
                              $nom=($_GET['nom']);
							  $description=($_GET['description']);
							  $prix=($_GET['prix']);
                              
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
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_description,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Description</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"><?php if(strcmp($erreur,"")==0) echo $description; ?></textarea>
                                          <?php if(strcmp($erreur_description,"")!=0) echo " <p class='help-block'>".$erreur_description."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_prix,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $prix; ?>" class="form-control" id="prix" name="prix" placeholder="Prix" >
                                          <?php if(strcmp($erreur_prix,"")!=0) echo " <p class='help-block'>".$erreur_prix."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Appliqué par</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="periode" id="periode">
                                          <?php 
	                                          $query_periode= "SELECT 
													`periode`.`id`,
													`periode`.`nom` 
													FROM 
													periode
													";
					
											  $result_periode = mysql_query($query_periode);
	                                          while($ligne_periode=mysql_fetch_row($result_periode)){

                                          ?>
										  <option 
										  value="<?php echo $ligne_periode[0]; ?>"><?php echo $ligne_periode[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                  	<label  class="col-lg-2 control-label">Image</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Sélectionner une image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="optionn" id="optionn"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
                                          </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="options.php">Annuler</a>
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
      
    