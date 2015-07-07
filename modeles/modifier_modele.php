
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier les informations du modèle</h1>
                              <form class="cmxform form-horizontal" role="form" action="modeles/actions_modele.php" id="modifier_modele" method="post"  enctype="multipart/form-data" nom="modifier_modele">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_modele=$_GET['id_modele'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_nom'])) {$erreur_nom=$_GET['erreur_nom'];} else {$erreur_nom="";}
                              if(isset($_GET['erreur_description'])) {$erreur_description=$_GET['erreur_description'];} else {$erreur_description="";}
							  if(isset($_GET['erreur_prix_court'])) {$erreur_prix_court=$_GET['erreur_prix_court'];} else {$erreur_prix_court="";}
							  if(isset($_GET['erreur_prix_longue'])) {$erreur_prix_longue=$_GET['erreur_prix_longue'];} else {$erreur_prix_longue="";}
							  
                              
                              $nom=($_GET['nom']);
							  $description=($_GET['description']);
							  $prix_court=($_GET['prix_court']);
							  $prix_longue=($_GET['prix_longue']);
                              
                              $query = "SELECT 
									`modele_vehicule`.`id`,
									
									`modele_vehicule`.`nom`,
									`modele_vehicule`.`description`,
									`categorie`.`nom`,
									`marque_vehicule`.`nom`,
									`categorie`.`id`,
									`marque_vehicule`.`id`,
									`prix_modele`.`prix_court_duree`,
									`prix_modele`.`prix_longue_duree`
									FROM 
									modele_vehicule, categorie, marque_vehicule, `prix_modele`
									WHERE
									`modele_vehicule`.`marque` = `marque_vehicule`.`id`
									and `modele_vehicule`.`categorie` = `categorie`.`id`
									and `modele_vehicule`.`id` = `prix_modele`.`modele`
									and `modele_vehicule`.`id`= ".$id_modele;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                               
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_modele" value="<?php echo $ligne[0]; ?>" />
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
                                      <label  class="col-lg-2 control-label">Marque</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="marque" id="marque">
                                          <?php 
	                                          $query_marque = "SELECT 
													`marque_vehicule`.`id`,
													`marque_vehicule`.`nom` 
													FROM 
													marque_vehicule
													";
					
											  $result_marque = mysql_query($query_marque);
	                                          while($ligne_marque=mysql_fetch_row($result_marque)){

                                          ?>
										  <option <?php if ($ligne[6] == $ligne_marque[0]) echo "selected";?>
                                          value="<?php echo $ligne_marque[0]; ?>"><?php echo $ligne_marque[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Catégorie</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="categorie" id="categorie">
                                          <?php 
	                                          $query_categorie = "SELECT 
													`categorie`.`id`,
													`categorie`.`nom` 
													FROM 
													categorie
													";
					
											  $result_categorie = mysql_query($query_categorie);
	                                          while($ligne_categorie=mysql_fetch_row($result_categorie)){

                                          ?>
										  <option <?php if ($ligne[5] == $ligne_categorie[0]) echo "selected";?>
                                          value="<?php echo $ligne_categorie[0]; ?>"><?php echo $ligne_categorie[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_description,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Description</label>
                                      <div class="col-lg-6">
                                          <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"><?php if(strcmp($erreur,"")==0) echo $ligne[2]; else echo $description; ?></textarea>
                                          <?php if(strcmp($erreur_description,"")!=0) echo " <p class='help-block'>".$erreur_description."</p>";?>
                                      </div>
                                  </div>
                                  
                                  
                                  <div class='form-group <?php if(strcmp($erreur_prix_court,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix de courte durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($prix_court,"")==0) echo $ligne[7]; else echo $prix_court; ?>" class="form-control" id="prix_court" name="prix_court" placeholder="Prix: ex 300, 300.00, 0 pour gratuit" >
                                          <?php if(strcmp($erreur_prix_court,"")!=0) echo " <p class='help-block'>".$erreur_prix_court."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class='form-group <?php if(strcmp($erreur_prix_longue,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix de longue durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($prix_longue,"")==0) echo $ligne[8]; else echo $prix_longue; ?>" class="form-control" id="prix_longue" name="prix_longue" placeholder="Prix: ex 300, 300.00, 0 pour gratuit" >
                                          <?php if(strcmp($erreur_prix_longue,"")!=0) echo " <p class='help-block'>".$erreur_prix_longue."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                  	<label  class="col-lg-2 control-label">Image</label>
                                      <div class="controls col-md-9">
                                              <div class="fileupload fileupload-new" data-provides="fileupload" >
                                                <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="icon-paper-clip"></i> Modifier l'image</span>
                                                <span class="fileupload-exists"><i class="icon-undo"></i> Changer</span>
                                                <input type="file" class="default" name="modele" id="modele"/>
                                                </span>
                                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                              </div>
                                              <p>140x140, jpg, png ou gif, &lt; 10 Mo</p>
                                          </div>
                                  </div>
                                  <h1> Caractéristiques du modèle</h1>
                                  <?php 
	                                          $query_composant = "SELECT 
													`caracteristique_modele`.`id`,
													`caracteristique_modele`.`nom` ,
													`caracteristique_par_modele`.`valeur`
													FROM 
													`caracteristique_modele`, `caracteristique_par_modele`
													where 
													`caracteristique_modele`.`id` = `caracteristique_par_modele`.`caracteristique`
													and `caracteristique_par_modele`.`modele` = ".$id_modele;
					
											  $result_composant = mysql_query($query_composant);
											  $nb_caracteristiques = 0;
	                                          while($ligne_composant=mysql_fetch_row($result_composant)){

                                          ?>
										  
										  
						 				  
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label"><?php echo $ligne_composant[1]; ?></label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php echo $ligne_composant[2]; ?>" class="form-control" id="<?php echo $ligne_composant[0]; ?>" name="<?php echo 'val_car_'.$nb_caracteristiques; ?>" placeholder="<?php echo $ligne_composant[1]; ?>" >
                                          
                                      </div>
                                  </div>
                                  <?php 
	                                          
											  echo '<input type="hidden" name ="id_car_'.$nb_caracteristiques.'" value="'.$ligne_composant[0].'" />';
											  echo '<input type="hidden" name ="nom_car_'.$nb_caracteristiques.'" value="'.$ligne_composant[0].'" />';
											  $nb_caracteristiques++;
											  }

                                          ?>
                                          <input type="hidden" name ="nb_caracteristiques" value="<?php echo $nb_caracteristiques; ?>" />
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="modeles.php">Annuler</a>
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
     

      