<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'une nouvelle agence</h1>
                              <form class="cmxform form-horizontal" role="form" action="agences/actions_agence.php" id="modifier_agence" method="post"  enctype="multipart/form-data" nom="modifier_agence">
                              <?php
                              
                              include("config.php");
                              $id_agence=$_GET['id_agence'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                              if(isset($_GET['erreur_adresse'])) {$erreur_adresse=$_GET['erreur_adresse'];} else {$erreur_adresse="";}
                              if(isset($_GET['erreur_horaire'])) {$erreur_horaire=$_GET['erreur_horaire'];} else {$erreur_horaire="";}
                              
                              $nom=utf8_encode($_GET['nom']);
							  $adresse=utf8_encode($_GET['adresse']);
							  $horaire=utf8_encode($_GET['horaire']);
							  $telephone=utf8_encode($_GET['telephone']);
							  $fax=utf8_encode($_GET['fax']);
                              
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
                                  <div class="form-group <?php if(strcmp($erreur_adresse,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Adresse</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse" rows="3"><?php if(strcmp($erreur,"")==0) echo $adresse; ?></textarea>
                                          <?php if(strcmp($erreur_adresse,"")!=0) echo " <p class='help-block'>".$erreur_adresse."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Ville</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="ville" id="ville">
                                          <?php 
	                                          $query_ville = "SELECT 
													`ville`.`id`,
													`ville`.`nom` 
													FROM 
													ville
													";
					
											  $result_ville = mysql_query($query_ville);
	                                          while($ligne_ville=mysql_fetch_row($result_ville)){

                                          ?>
										  <option value="<?php echo $ligne_ville[0]; ?>"><?php echo $ligne_ville[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" >
                                          
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Fax</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $fax; ?>" class="form-control" id="fax" name="fax" placeholder="Fax" >
                                         
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_horaire,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Horaire</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="horaire" name="horaire" placeholder="Horaire : " rows="3"><?php if(strcmp($erreur,"")==0) echo $horaire; ?></textarea>
                                          <?php if(strcmp($erreur_horaire,"")!=0) echo " <p class='help-block'>".$erreur_horaire."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                  	<label  class="col-lg-2 control-label">Image</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Modifier l'image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="agence" id="agence"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
                                          </div>
                                  </div>
                                  <!--<
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">GéoLocalisation</label>
                                      <div class="col-lg-6">
                                          div align="center" id="map" style="width: 500px; height: 400px;"><br/></div>
                                         
                                      </div>
                                  </div>
                                  -->
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">GéoLocalisation</label>
                                      <div class="col-lg-6">
                                          <div id="map" class="gmaps"></div>
                                         
                                      </div>
                                  </div>
                                  
                                  	<input type="hidden"  name="lattitude" id="lat2" />
      								<input type="hidden"  name="longitude" id="lng2" />
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="agences.php">Annuler</a>
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
      
    