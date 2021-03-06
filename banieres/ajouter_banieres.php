<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'une nouvelle banière</h1>
                              <form class="cmxform form-horizontal" role="form" action="banieres/actions_banieres.php" id="modifier_banieres" method="post"  enctype="multipart/form-data" nom="modifier_banieres">
                              <?php
                              
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
							  if(isset($_GET['erreur_url'])) {$erreur_url=$_GET['erreur_url'];} else {$erreur_url="";}
                              
                              $nom=($_GET['nom']);
							  $url=($_GET['url']);
							  $description=($_GET['description']);
							  
                              
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
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $nom; ?>" class="form-control" id="nom" name="nom" placeholder="Nom" >
                                          <?php if(strcmp($erreur_nom,"")!=0) echo " <p class='help-block'>".$erreur_nom."</p>";?>
                                      </div>
                                  </div>
                                  
                                 <div class="form-group">
                                      <label  class="col-lg-2 control-label">Type</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="type" id="type">
                                          <?php 
	                                          $query_type = "SELECT 
													`type_baniere`.`id`,
													`type_baniere`.`nom` 
													FROM 
													type_baniere
													";
					
											  $result_type = mysql_query($query_type);
	                                          while($ligne_type=mysql_fetch_row($result_type)){

                                          ?>
										  <option value="<?php echo $ligne_type[0]; ?>"><?php echo $ligne_type[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Description</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $nom; ?>" class="form-control" id="description" name="description" placeholder="Petite description" >
                                          
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_url,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Lien internet</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $url; ?>" class="form-control" id="url" name="url" placeholder="Exemple: http://..." >
                                          <?php if(strcmp($erreur_url,"")!=0) echo " <p class='help-block'>".$erreur_url."</p>";?>
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                  	<label  class="col-lg-2 control-label">Image</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Sélectionner une image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="image" id="image"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                             
                                          </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="banieres.php">Annuler</a>
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
    <script src="js/banieres/advanced-multiselect.js"></script>
    