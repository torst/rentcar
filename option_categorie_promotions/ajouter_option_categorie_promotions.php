<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h1> Nouvelle promotion pour une option sur une catégorie</h1>
                              <div class="notice ">
    								<h4>Important </h4>
    								<p>Par défaut, une promotion est définie par un nouveau Prix promotionnel pour une location de courte durée, et par un nouveau Prix promotionnel pour une location de longue durée. Exemple: "Promotion Article: location à partir de X Dhs"
                                    <p>Si le Prix promotionnel pour une location de courte durée est égale au Prix standard, aucune promotion ne sera notifiée pour la courte durée. Exemple: "Promotion Article: Location à X Dhs pour toute location à partir N jours"</p>
                                    <p>Si le Prix promotionnel pour une location de courte durée est égale au Prix promotionnel pour une location de longue durée, le système affichera un notification de promotion tel que: "Promotion Article: Location à X Dhs"</p>
                                    <p>Si dans une même période, une promotion est définie pour une catégorie et une autre promotion est définie pour un modèle appartenant à la même catégorie, la promotion qui sera prise en considération par le système est la Promotion du Modèle."</p>
  								</div>
                              <form class="cmxform form-horizontal" role="form" action="option_categorie_promotions/actions_option_categorie_promotions.php" id="modifier_option_categorie_promotions" method="post"  nom="modifier_option_categorie_promotions">
                              <?php
                              
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_date_debut'])) {$erreur_date_debut=$_GET['erreur_date_debut'];} else {$erreur_date_debut="";}
							  if(isset($_GET['erreur_date_fin'])) {$erreur_date_fin=$_GET['erreur_date_fin'];} else {$erreur_date_fin="";}
							  if(isset($_GET['erreur_prix_court'])) {$erreur_prix_court=$_GET['erreur_prix_court'];} else {$erreur_prix_court="";}
							  if(isset($_GET['erreur_prix_longue'])) {$erreur_prix_longue=$_GET['erreur_prix_longue'];} else {$erreur_prix_longue="";}
							  if(isset($_GET['erreur_categorie'])) {$erreur_categorie=$_GET['erreur_categorie'];} else {$erreur_categorie="";}
							  if(isset($_GET['erreur_option'])) {$erreur_option=$_GET['erreur_option'];} else {$erreur_option="";}
                              
                              $date_debut=($_GET['date_debut']);
							  $date_fin=($_GET['date_fin']);
							  $prix_court=($_GET['prix_court']);
							  $prix_longue=($_GET['prix_longue']);
							  
                              
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
                                  <div class="form-group <?php if(strcmp($erreur_option,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Option</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="option_rec" id="option_rec">
                                          <?php 
	                                          $query_option = "SELECT 
													`option`.`id`,
													`option`.`nom` 
													FROM 
													`option`
													";
					
											  $result_option = mysql_query($query_option);
	                                          while($ligne_option=mysql_fetch_row($result_option)){

                                          ?>
										  <option 
										  value="<?php echo $ligne_option[0]; ?>"><?php echo $ligne_option[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_option,"")!=0) echo " <p class='help-block'>".$erreur_option."</p>";?>
                                      </div>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_categorie,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Modèle</label>
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
										  <option 
										  value="<?php echo $ligne_categorie[0]; ?>"><?php echo $ligne_categorie[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                        <?php if(strcmp($erreur_categorie,"")!=0) echo " <p class='help-block'>".$erreur_categorie."</p>";?>
                                      </div>
                                  </div>
                                   
                                  <div class='form-group <?php if(strcmp($erreur_date_debut,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date de début</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $date_debut; ?>" class="form-control form-control-inline input-medium dp1" id="date_debut" name="date_debut" placeholder="" >
                                          <?php if(strcmp($erreur_date_debut,"")!=0) echo " <p class='help-block'>".$erreur_date_debut."</p>";?>
                                      </div>
                                      
                                  </div>
                                  
                                  <div class='form-group <?php if(strcmp($erreur_date_fin,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date de fin</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $date_fin; ?>" class="form-control form-control-inline input-medium dp2" id="date_fin" name="date_fin" placeholder="" >
                                          <?php if(strcmp($erreur_date_fin,"")!=0) echo " <p class='help-block'>".$erreur_date_fin."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_prix_court,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix pour courte durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $prix_court; ?>" class="form-control" id="prix_court" name="prix_court" placeholder="Prix. Exemple: 100, 100.00 ou 100.21" >
                                         <?php if(strcmp($erreur_prix_court,"")!=0) echo " <p class='help-block'>".$erreur_prix_court."</p>";?>
                                      </div>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_prix_longue,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Prix pour longue durée</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $prix_longue; ?>" class="form-control" id="prix_longue" name="prix_longue" placeholder="Prix. Exemple: 100, 100.00 ou 100.21" >
                                          <?php if(strcmp($erreur_prix_longue,"")!=0) echo " <p class='help-block'>".$erreur_prix_longue."</p>";?>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="option_categorie_promotions.php">Annuler</a>
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
    <script src="js/option_categorie_promotions/advanced-multiselect.js"></script>
    