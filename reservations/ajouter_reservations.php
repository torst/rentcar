<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              
                              <h2> Nouvelle réservation</h2>
                              <div class="notice ">
    								<h4>Aide </h4>
    								<p>Le Montant calculé de la réservation est proposé à titre indicatif en tenant compte des données système (modèle véhicule, durée, options, services, promotions …). Vous avez la possibilité d'appliquer cette proposition ou bien de renseigner une nouvelle proposition dans le champ "Montant à payer".</p>
  								</div>
                              <form class="cmxform form-horizontal" role="form" action="reservations/actions_reservations.php" id="modifier_reservations" method="post"  nom="modifier_reservations">
                              <?php
                              include("config.php");
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_date_debut'])) {$erreur_date_debut=$_GET['erreur_date_debut'];} else {$erreur_date_debut="";}
							  if(isset($_GET['erreur_date_fin'])) {$erreur_date_fin=$_GET['erreur_date_fin'];} else {$erreur_date_fin="";}
							  if(isset($_GET['erreur_montant_apayer'])) {$erreur_montant_apayer=$_GET['erreur_montant_apayer'];} else {$erreur_montant_apayer="";}
							  if(isset($_GET['erreur_montant_paye'])) {$erreur_montant_paye=$_GET['erreur_montant_paye'];} else {$erreur_montant_paye="";}
							  if(isset($_GET['erreur_valeur_remise'])) {$erreur_valeur_remise=$_GET['erreur_valeur_remise'];} else {$erreur_valeur_remise="";}
							  
                              
                              								
								
								$date_debut=($_GET['date_debut']);
								$date_fin=($_GET['date_fin']);								
								$montant_calcule=($_GET['montant_calcule']); 								
								$valeur_remise=$_GET['valeur_remise'];
								$montant_apayer=($_GET['montant_apayer']);
								$montant_paye=($_GET['montant_paye']);
								
                              ?>
<?php

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
                                  <div class="form-group <?php if(strcmp($erreur_client,"")!=0) echo " has-error";?>" >
                                      <label  class="col-lg-2 control-label">Client</label>
                                      <div class="col-lg-6">
                                          <select name ="client" id ="client" placeholder="Sélectionner un client..."></select>
                                      </div>
                                      <?php if(strcmp($erreur_client,"")!=0) echo " <p class='help-block'>".$erreur_client."</p>";?>
                                  </div>
                                  <div class="form-group <?php if(strcmp($erreur_modele,"")!=0) echo " has-error";?>">
                                      <label  class="col-lg-2 control-label">Modèle véhicule</label>
                                      <div class="col-lg-6">
                                          <select name ="modele" id="modele"    placeholder="Sélectionner un modèle..."></select>
                                      </div>
                                      <?php if(strcmp($erreur_modele,"")!=0) echo " <p class='help-block'>".$erreur_modele."</p>";?>
                                  </div>
                                  <div class='form-group <?php if(strcmp($erreur_date_debut,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date et heure début</label>
                                      <div class="col-lg-3">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $date_debut; ?>" class="form-control form-control-inline input-medium dp1" id="date_debut" name="date_debut" placeholder="Choisir date de début" >
                                          <?php if(strcmp($erreur_date_debut,"")!=0) echo " <p class='help-block'>".$erreur_date_debut."</p>";?>
                                      </div>
                                      
                                      <div class="col-lg-2">
                                          <select class="form-control" name="heure_debut" id="heure_debut">
										  <option value="0">00:00</option>
                                          <option value="1">01:00</option>
										  <option value="2">02:00</option>
                                          <option value="3">03:00</option>
                                          <option value="4">04:00</option>
                                          <option value="5">05:00</option>
                                          <option value="6">06:00</option>
                                          <option value="7">07:00</option>
                                          <option value="8">08:00</option>
                                          <option value="9" selected="selected">09:00</option>
                                          <option value="10">10:00</option>
                                          <option value="11">11:00</option>
                                          <option value="12">12:00</option>
                                          <option value="13">13:00</option>
                                          <option value="14">14:00</option>
                                          <option value="15">15:00</option>
                                          <option value="16">16:00</option>
                                          <option value="17">17:00</option>
                                          <option value="18">18:00</option>
                                          <option value="19">19:00</option>
                                          <option value="20">20:00</option>
                                          <option value="21">21:00</option>
                                          <option value="22">22:00</option>
                                          <option value="23">23:00</option>
										</select>
                                          
                                      </div>
                                      
                                  </div>
                                  
                                  <div class='form-group <?php if(strcmp($erreur_date_fin,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Date et heure fin</label>
                                      <div class="col-lg-3">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $date_fin; ?>" class="form-control form-control-inline input-medium dp1" id="date_fin" name="date_fin" placeholder="Choisir date de fin" >
                                          <?php if(strcmp($erreur_date_fin,"")!=0) echo " <p class='help-block'>".$erreur_date_fin."</p>";?>
                                      </div>
                                      
                                      <div class="col-lg-2">
                                          <select class="form-control" name="heure_fin" id="heure_fin">
										  <option value="0">00:00</option>
                                          <option value="1">01:00</option>
										  <option value="2">02:00</option>
                                          <option value="3">03:00</option>
                                          <option value="4">04:00</option>
                                          <option value="5">05:00</option>
                                          <option value="6">06:00</option>
                                          <option value="7">07:00</option>
                                          <option value="8">08:00</option>
                                          <option value="9" >09:00</option>
                                          <option value="10">10:00</option>
                                          <option value="11">11:00</option>
                                          <option value="12">12:00</option>
                                          <option value="13">13:00</option>
                                          <option value="14">14:00</option>
                                          <option value="15">15:00</option>
                                          <option value="16">16:00</option>
                                          <option value="17">17:00</option>
                                          <option value="18" selected="selected">18:00</option>
                                          <option value="19">19:00</option>
                                          <option value="20">20:00</option>
                                          <option value="21">21:00</option>
                                          <option value="22">22:00</option>
                                          <option value="23">23:00</option>
										</select>
                                          
                                      </div>
                                      
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Agence de départ</label>
                                      <div class="col-lg-4">
                                          <select name ="agence_depart" id="agence_depart"    placeholder="Sélectionner une agence..."></select>
                                      </div>
                                      <div class="col-lg-2">
                                          <label class="label_check" for="check_depart_perso">
                                              <input name="check_depart_perso" id="check_depart_perso" type="checkbox"  />Autre lieu à préciser
                                          </label>
                                       </div>   
                                  </div>
                                  <div class="form-group" id="lieu_depart_groupe">
                                      <label  class="col-lg-2 control-label">Définir un lieu</label>
                                      <div class="col-lg-6">
                                          <textarea name ="lieu_depart" id="lieu_depart"  class="form-control form-control-inline input-medium"  rows="4" placeholder="Définir un lieu..."></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Agence de reprise</label>
                                      <div class="col-lg-4">
                                          <select name ="agence_reprise" id="agence_reprise"    placeholder="Sélectionner une agence..."></select>
                                      </div>
                                      <div class="col-lg-2">
                                          <label class="label_check" for="check_reprise_perso">
                                              <input name="check_reprise_perso" id="check_reprise_perso" type="checkbox"  />Autre lieu à préciser
                                          </label>
                                       </div> 
                                  </div>
                                  <div class="form-group" id="lieu_reprise_groupe">
                                      <label  class="col-lg-2 control-label">Définir un lieu</label>
                                      <div class="col-lg-6">
                                          <textarea name ="lieu_reprise" id="lieu_reprise"  class="form-control form-control-inline input-medium"  rows="4" placeholder="Définir un lieu..."></textarea>
                                      </div>
                                  </div>
                                  <h1><span class="icon-pushpin" ></span> Options et Services</h1>
                                   <div class="form-group last">
                                    <label class="control-label col-lg-2">Sélectionner des options</label>
                                    <div class="col-lg-6">
                                   
                                    <?php 
												  $query_option = "select `id`, `nom` 
																from `option`
																";
						
												  $result_option = mysql_query($query_option);
												  $nombre_lignes=mysql_num_rows($result_option);
	
											  ?>
                                          <select name="options[]" class="multi-select" multiple="" id="option_select" >
                                             <?php 
												  
												  while($ligne_option=mysql_fetch_row($result_option)){
	
											  ?>
											  <option value="<?php echo $ligne_option[0]; ?>"><?php echo $ligne_option[1]; ?></option>
											  
											  <?php 
												  }
	
											  ?>
                                              
                                          </select>
                                  </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-lg-2">Sélectionner des services</label>
                                    <div class="col-lg-6">
                                   
                                    <?php 
												  $query_service = "select `id`, `nom` 
																from `service`
																";
						
												  $result_service = mysql_query($query_service);
												  $nombre_lignes=mysql_num_rows($result_service);
	
											  ?>
                                          <select name="services[]" class="multi-select" multiple="" id="service_select" >
                                             <?php 
												  
												  while($ligne_service=mysql_fetch_row($result_service)){
	
											  ?>
											  <option value="<?php echo $ligne_service[0]; ?>"><?php echo $ligne_service[1]; ?></option>
											  
											  <?php 
												  }
	
											  ?>
                                              
                                          </select>
                                  </div>
                                </div>
                                  
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Montant calculé</label>
                                      <div class="col-lg-5">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $montant_calcule; ?>" class="form-control" id="montant_calcule" name="montant_calcule" placeholder="0.00" id="montant_calcule" >
                                          
                                      </div>
                                      <div class="col-lg-1">
                                      	<a class="btn btn-warning  btn-sm tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Recalculer" id="calcule_montant">
                             				<span class="icon-refresh"></span>
                             			</a>
                                      </div>
                                  </div>
                                  <div class='form-group' >
                                  	  <label  class="col-lg-2 control-label">Remise</label>
                                      <div class="col-lg-2">
                                         
                                          <select class="form-control" name="remise" id="remise">
                                          <?php 
	                                          $query_remise = "SELECT 
													`remise`.`id`,
													`remise`.`nom` 
													FROM 
													remise order by id
													";
					
											  $result_remise = mysql_query($query_remise);
	                                          while($ligne_remise=mysql_fetch_row($result_remise)){

                                          ?>
										  <option value="<?php echo $ligne_remise[0]; ?>"><?php echo $ligne_remise[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                   
                                     
                                      <label  class="col-lg-2 control-label">Valeur</label>
                                      <div class="col-lg-2">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $remise; ?>" class="form-control" id="valeur_remise" name="valeur_remise" placeholder="0.00" >
                                      </div>
                                      
                                  </div>
                                  <div class='form-group ' >
                                      <label  class="col-lg-2 control-label">Montant à payer</label>
                                      <div class="col-lg-5">
                                          <input type="text" value="<?php if(strcmp($erreur,"")!=0) echo $montant_apayer; ?>" class="form-control" id="montant_apayer" name="montant_apayer" placeholder="0.00" >
                                          
                                      </div>
                                      <div class="col-lg-1">
                                      	<a class="btn btn-warning  btn-sm tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Recalculer" id="calcule_montant_remise">
                             				<span class="icon-refresh"></span>
                             			</a>
                                      </div>
                                  </div>
                                  
                                  <div class='form-group' >
                                  	  <label  class="col-lg-2 control-label">Statut de paiement</label>
                                      <div class="col-lg-6">
                                         
                                          <select class="form-control" name="statut_paiement" id="statut_paiement">
                                          <?php 
	                                          $query_statut_paiement = "SELECT 
													`statut_paiement`.`id`,
													`statut_paiement`.`libelle` 
													FROM 
													statut_paiement order by id
													";
					
											  $result_statut_paiement = mysql_query($query_statut_paiement);
	                                          while($ligne_statut_paiement=mysql_fetch_row($result_statut_paiement)){

                                          ?>
										  <option value="<?php echo $ligne_statut_paiement[0]; ?>"><?php echo $ligne_statut_paiement[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                  </div>
                                  
                                  <div class='form-group' id='bloc_paiement'  >
                                  	  <label  class="col-lg-2 control-label">Mode de paiement</label>
                                      <div class="col-lg-2">
                                         
                                           <select class="form-control" name="mode_paiement" id="mode_paiement">
                                          <?php 
	                                          $query_mode_paiement = "SELECT 
													`type_paiement`.`id`,
													`type_paiement`.`libelle` 
													FROM 
													type_paiement 
													WHERE `type_paiement`.`id` > 2
													order by id
													"; // superieur a 2 pour exclure modes de paiement web (C.B et Paypal)
					
											  $result_mode_paiement = mysql_query($query_mode_paiement);
	                                          while($ligne_mode_paiement=mysql_fetch_row($result_mode_paiement)){

                                          ?>
										  <option value="<?php echo $ligne_mode_paiement[0]; ?>"><?php echo $ligne_mode_paiement[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                      <label  class="col-lg-2 control-label">Montant payé</label>
                                      <div class="col-lg-2">
                                          <input type="text" value="" class="form-control" id="montant_paye" name="montant_paye" placeholder="0.00" >
                                      </div>
                                  </div>
                                  
                                  <div class='form-group' >
                                  	  <label  class="col-lg-2 control-label">Origine réservation</label>
                                      <div class="col-lg-6">
                                         
                                          <select class="form-control" name="origine_reservation" id="origine_reservation">
                                          <?php 
	                                          $query_origine_reservation = "SELECT 
													`origine_reservation`.`id`,
													`origine_reservation`.`libelle` 
													FROM 
													origine_reservation order by id
													";
					
											  $result_origine_reservation = mysql_query($query_origine_reservation);
	                                          while($ligne_origine_reservation=mysql_fetch_row($result_origine_reservation)){

                                          ?>
										  <option value="<?php echo $ligne_origine_reservation[0]; ?>"><?php echo $ligne_origine_reservation[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class='form-group' >
                                  	  <label  class="col-lg-2 control-label">Statut réservation</label>
                                      <div class="col-lg-6">
                                         
                                          <select class="form-control" name="statut_reservation" id="statut_reservation">
                                          <?php 
	                                          $query_statut_reservation = "SELECT 
													`statut_reservation`.`id`,
													`statut_reservation`.`libelle` 
													FROM 
													statut_reservation order by id
													";
					
											  $result_statut_reservation = mysql_query($query_statut_reservation);
	                                          while($ligne_statut_reservation=mysql_fetch_row($result_statut_reservation)){

                                          ?>
										  <option value="<?php echo $ligne_statut_reservation[0]; ?>"><?php echo $ligne_statut_reservation[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="reservations.php">Annuler</a>
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
    <script src="js/reservations/advanced-multiselect.js"></script>
    <!--pour l autocompletion-->
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="js/highlight.min.js"></script>
	<script src="js/selectize.js"></script>	
	<script >
					

					$('#client').selectize({
						persist: false,
						maxItems: 1,
						valueField: 'id',
						labelField: 'name',
						searchField: ['name', 'email'],
						options: [
						<?php
							$requete_destinataire = "SELECT client.id, nom, prenom, membre.email FROM membre, client Where client.id = membre.id_client order by nom";
							$result_destinataire = mysql_query($requete_destinataire);
							while($ligne_destinataire=mysql_fetch_row($result_destinataire)){
							?>
								{email: '<?php echo $ligne_destinataire[3]; ?>', name: '<?php echo $ligne_destinataire[1]; ?> <?php echo $ligne_destinataire[2]; ?>', id: '<?php echo $ligne_destinataire[0]; ?>'},
								
						<?php } ?>
							
							
						],
						render: {
							item: function(item, escape) {
								return '<div>' +
									(item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
									(item.email ? '<span class="email"> &lt;' + escape(item.email) + '&gt;</span>' : '') +
								'</div>';
							},
							option: function(item, escape) {
								var label = item.name || item.email;
								var caption = item.name ? item.email : null;
								return '<div>' +
									'<span class="caption">' + escape(label) + '</span>' +
									(caption ? '<span class="caption"> &lt;' + escape(caption) + '&gt;</span>' : '') +
								'</div>';
							}
						},
						create: false
					});
					$('#modele').selectize({
						persist: false,
						maxItems: 1,
						valueField: 'id',
						labelField: 'marque',
						searchField: ['marque', 'modele'],
						options: [
						<?php
							$requete_modele = "SELECT modele_vehicule.id, marque_vehicule.nom, modele_vehicule.nom  FROM `modele_vehicule`, marque_vehicule WHERE modele_vehicule.marque = marque_vehicule.id order by marque_vehicule.nom";
							$result_modele = mysql_query($requete_modele);
							while($ligne_modele=mysql_fetch_row($result_modele)){
							?>
								{modele: '<?php echo $ligne_modele[2]; ?>', marque: '<?php echo $ligne_modele[1]; ?>', id: '<?php echo $ligne_modele[0]; ?>'},
								
						<?php } ?>
							
							
						],
						render: {
							item: function(item, escape) {
								return '<div>' +
									(item.marque ? '<span class="marque">' + escape(item.marque) + '</span>' : '') +
									(item.modele ? '<span class="modele"> ' + escape(item.modele) + '</span>' : '') +
								'</div>';
							},
							option: function(item, escape) {
								var label = item.marque || item.modele;
								var caption = item.marque ? item.modele : null;
								return '<div>' +
									'<span class="zbanzai-marque-selectize">' + escape(label) + '</span>' +
									(caption ? '<span class="caption"> ' + escape(caption) + '</span>' : '') +
								'</div>';
							}
						},
						create: false
					});
					$('#agence_depart').selectize({
						persist: false,
						maxItems: 1,
						valueField: 'id',
						labelField: 'ville',
						searchField: ['ville', 'agence'],
						options: [
						<?php
							$requete_modele = "SELECT agence.id, ville.nom, agence.nom FROM agence, ville WHERE ville.id = agence.ville order by ville.nom";
							$result_modele = mysql_query($requete_modele);
							while($ligne_modele=mysql_fetch_row($result_modele)){
							?>
								
								{agence: '<?php echo $ligne_modele[2]; ?>', ville: '<?php echo $ligne_modele[1]; ?>', id: '<?php echo $ligne_modele[0]; ?>'},
								
						<?php } ?>
							
							
						],
						render: {
							item: function(item, escape) {
								return '<div>' +
									(item.ville ? '<span class="ville">' + escape(item.ville) + '</span>' : '') +
									(item.agence ? '<span class="modele"> ' + escape(item.agence) + '</span>' : '') +
								'</div>';
							},
							option: function(item, escape) {
								var label = item.ville || item.agence;
								var caption = item.ville ? item.agence : null;
								return '<div>' +
									'<span class="zbanzai-marque-selectize">' + escape(label) + '</span>' +
									(caption ? '<span class="caption"> ' + escape(caption) + '</span>' : '') +
								'</div>';
							}
						},
						create: false
					});
					$('#agence_reprise').selectize({
						persist: false,
						maxItems: 1,
						valueField: 'id',
						labelField: 'ville',
						searchField: ['ville', 'agence'],
						options: [
						<?php
							$requete_modele = "SELECT agence.id, ville.nom, agence.nom FROM agence, ville WHERE ville.id = agence.ville order by ville.nom";
							$result_modele = mysql_query($requete_modele);
							while($ligne_modele=mysql_fetch_row($result_modele)){
							?>
								{agence: '<?php echo $ligne_modele[2]; ?>', ville: '<?php echo $ligne_modele[1]; ?>', id: '<?php echo $ligne_modele[0]; ?>'},
								
						<?php } ?>
							
							
						],
						render: {
							item: function(item, escape) {
								return '<div>' +
									(item.ville ? '<span class="ville">' + escape(item.ville) + '</span>' : '') +
									(item.agence ? '<span class="modele"> ' + escape(item.agence) + '</span>' : '') +
								'</div>';
							},
							option: function(item, escape) {
								var label = item.ville || item.agence;
								var caption = item.ville ? item.agence : null;
								return '<div>' +
									'<span class="zbanzai-marque-selectize">' + escape(label) + '</span>' +
									(caption ? '<span class="caption"> ' + escape(caption) + '</span>' : '') +
								'</div>';
							}
						},
						create: false
					});
					</script>
    