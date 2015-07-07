<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Ajout d'un nouveau client</h1>
                              <form class="cmxform form-horizontal" role="form" action="clients/actions_clients.php" id="modifier_clients" method="post"  enctype="multipart/form-data" nom="modifier_clients">
                              <?php
                              
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
							  if(isset($_GET['erreur_prenom'])) {$erreur_prenom=$_GET['erreur_prenom'];} else {$erreur_prenom="";}
							  if(isset($_GET['erreur_adresse'])) {$erreur_adresse=$_GET['erreur_adresse'];} else {$erreur_adresse="";}
							  if(isset($_GET['erreur_telephone'])) {$erreur_telephone=$_GET['erreur_telephone'];} else {$erreur_telephone="";}
							  if(isset($_GET['erreur_numero'])) {$erreur_numero=$_GET['erreur_numero'];} else {$erreur_numero="";}
                              $nom=utf8_encode($_GET['nom']);
							  $prenom=utf8_encode($_GET['prenom']);
							  $raison_social=utf8_encode($_GET['raison_social']);
							  $numero=utf8_encode($_GET['numero']);
							  $adresse=utf8_encode($_GET['adresse']);
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
                                  <div class='form-group <?php if(strcmp($erreur_prenom,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prénom</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $prenom; ?>" class="form-control" id="prenom" name="prenom" placeholder="Prénom" >
                                           <?php if(strcmp($erreur_prenom,"")!=0) echo " <p class='help-block'>".$erreur_prenom."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Type</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="type_client" id="type_client">
                                          <?php 
	                                          $query_type_client = "SELECT 
													`type_client`.`id`,
													`type_client`.`nom` 
													FROM 
													type_client
													";
					
											  $result_type_client = mysql_query($query_type_client);
	                                          while($ligne_type_client=mysql_fetch_row($result_type_client)){

                                          ?>
										  <option 
										  
										  value="<?php echo $ligne_type_client[0]; ?>"><?php echo $ligne_type_client[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Raison sociale</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[3]; else echo $raison_social; ?>" class="form-control" id="raison_social" name="raison_social" placeholder="Ou Nom de l'Organisme" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Type pièce d'identité</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="type_pi" id="type_pi">
                                          <?php 
	                                          $query_type_pi = "SELECT 
													`type_pi`.`id`,
													`type_pi`.`nom` 
													FROM 
													type_pi
													";
					
											  $result_type_pi = mysql_query($query_type_pi);
	                                          while($ligne_type_pi=mysql_fetch_row($result_type_pi)){

                                          ?>
										  <option 
										  
										  value="<?php echo $ligne_type_pi[0]; ?>"><?php echo $ligne_type_pi[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_numero,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Numéro d'identité</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php  echo $numero; ?>" class="form-control" id="numero" name="numero" placeholder="Numéro de pièce d'identité" >
                                          <?php if(strcmp($erreur_numero,"")!=0) echo " <p class='help-block'>".$erreur_numero."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Nationalité</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="nationalite" id="nationalite">
                                          <?php 
	                                          $query_nationalite = "SELECT 
													`nationnalite`.`id`,
													`nationnalite`.`nom` 
													FROM 
													nationnalite
													";
					
											  $result_nationalite = mysql_query($query_nationalite);
	                                          while($ligne_nationalite=mysql_fetch_row($result_nationalite)){

                                          ?>
										  <option 
										  
										  value="<?php echo $ligne_nationalite[0]; ?>"><?php echo $ligne_nationalite[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_adresse,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Adresse</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $adresse; ?>" class="form-control" id="adresse" name="adresse" placeholder="Adresse" >
                                           <?php if(strcmp($erreur_adresse,"")!=0) echo " <p class='help-block'>".$erreur_adresse."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_telephone,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Téléphone</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" >
                                           <?php if(strcmp($erreur_telephone,"")!=0) echo " <p class='help-block'>".$erreur_telephone."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Fax</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $fax; ?>" class="form-control" id="fax" name="fax" placeholder="Fax" >
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="clients.php">Annuler</a>
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
    <script src="js/clients/advanced-multiselect.js"></script>
    