
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h2> Détail de la location</h2>
                              
                              
                              
                              <form class="form-horizontal" role="form">
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_location=$_GET['id_location'];
                              $query = "SELECT 
									l.id,
									c.nom,
									c.prenom,
									l.client,
									
									sr.libelle, 
									sp.libelle,
									tp.libelle,
									DATE_FORMAT(l.date_creation, '%d/%m/%Y à %H:%i'),
									
									l.montant_paye,
									DATE_FORMAT(l.date_depart, '%d/%m/%Y'),
									DATE_FORMAT(l.date_retour, '%d/%m/%Y'),
									l.heure_depart,
									l.heure_retour,
									v.matricule,
									rem.nom,
									l.valeur_remise,
									a1.nom,
									a2.nom,
									l1.lieu, 
									l2.lieu, 
									l.montant,
									DATE_FORMAT(l.date_retour, '%d/%m/%Y') - DATE_FORMAT(l.date_depart, '%d/%m/%Y') + 1, 
									mv.id
									
									FROM
									location AS l
									LEFT JOIN client AS c ON l.client = c.id
									LEFT JOIN statut_location AS sr ON l.statut_location = sr.id
									LEFT JOIN statut_paiement AS sp ON l.statut_paiement = sp.id
									LEFT JOIN type_paiement AS tp ON l.type_paiement = tp.id
									LEFT JOIN vehicule AS v ON l.vehicule = v.id
									LEFT JOIN remise AS rem ON l.remise = rem.id
									LEFT JOIN agence AS a1 ON l.agence_depart = a1.id
									LEFT JOIN agence AS a2 ON l.agence_retour = a2.id
									LEFT JOIN loc_depart_perso AS l1 ON l.id = l1.id
									LEFT JOIN loc_retour_perso AS l2 ON l.id = l2.id
									LEFT JOIN modele_vehicule AS mv ON v.modele = mv.id
									
									WHERE l.id= ?1";
							$query = str_replace("?1",mysql_real_escape_string($id_location),$query);
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
                              
                              ?>

                                  <?php 
                                  		if(isset($_GET['message_success'])) {$message_success=$_GET['message_success'];} else {$message_success="";}
										if(strcmp($message_success,"")!=0){
								
									?>
						        	<div class="alert alert-success fade in ">
						                                  <button data-dismiss="alert" class="close close-sm" type="button">
						                                      <i class="icon-remove"></i>
						                                  </button>
						                                  <strong>Succès ! </strong> 
						                                  <?php 
																echo $message_success;
								
															?>
						            </div>
						            <?php 
										}
								
									?>
                                 
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Créée le</label>
                                      <label  class="col-lg-3 control-label"><?php echo $ligne[7]; ?></label>
                                      
                                      <label  class="col-lg-1 control-label zbanzai-label">Référence</label>
                                      <label  class="col-lg-3 control-label"><?php echo $ligne[0]; ?></label>
                                     
                                      
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Client</label>
                                      <label  class="col-lg-3 control-label">
                                      	<a href="clients.php?action=detailler&&id_clients=<?php echo $ligne[3]; ?>" data-placement="right" data-toggle="tooltip" class="tooltips" data-original-title="Voir fiche client">
											<?php echo $ligne[1]." ".$ligne[2]; ?>
                                        </a>
                                      </label>
                                      
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Statut location</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[4]; ?></label>
                                     
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Matricule véhicule</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[13]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Date et heure départ</label>
                                       <label  class="col-lg-6 control-label"><?php echo $ligne[9]." à ".$ligne[11].":00"; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Date et heure  reprise</label>
                                       <label  class="col-lg-6 control-label"><?php echo $ligne[10]." à ".$ligne[12].":00"; ?></label>
                                  </div>
                                  
                                  
                                  <?php
                                  if ($ligne[16] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Agence de départ</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[16]; ?></label>
                                  </div>
                                   <?php
								  }
								  else{
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Lieu de départ</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[18]; ?></label>
                                  </div>
                                  <?php
								  }
								  ?>
                                  <?php
                                  if ($ligne[17] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Agence de reprise</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[17]; ?></label>
                                  </div>
                                   <?php
								  }
								  else{
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Lieu de reprise</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[19]; ?></label>
                                  </div>
                                  <?php
								  }
								  ?>
                                  
                                  <h1><span class="icon-pushpin" ></span>  Options</h1>
                                  <div class="col-lg-8">
                                  <table class="table table-striped col-lg-8">
                                      <thead>
                                      <tr>
                                          <th>Option</th>
                                          <th>Prix unité</th>
                                          <th>Coefficient</th>
                                          <th>Total hors promotion</th>
                                          <th>Promotion</th>
                                          <th>Prix unité en promotion</th>
                                          <th>Total en promotion</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                              //recuperation donnees options
                                      $query_seuil = "SELECT valeur from parametrage WHERE id= ?1";
										$query_seuil = str_replace("?1",1,$query_seuil);
										$result_seuil = mysql_query($query_seuil);
										$ligne_seuil=mysql_fetch_row($result_seuil);
										$seuil  = $ligne_seuil[0];

                              $query_option = "SELECT o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree
								FROM location_option AS lo
								LEFT JOIN `option` AS o ON lo.`option` = o.id
								LEFT JOIN location AS l ON l.id = lo.`location`
								LEFT JOIN modele_vehicule AS mv ON mv.`id` = (
									SELECT modele
									FROM vehicule
									WHERE vehicule.matricule = '?2' )
								LEFT JOIN promotion_option_modele AS pm ON lo.`option` = pm.`option`
								AND pm.modele =mv.id
								AND pm.date_debut <= l.date_creation
								AND pm.date_fin >= DATE_SUB( l.date_creation, INTERVAL 1
								DAY )
								LEFT JOIN promotion_option_categorie AS pc ON lo.`option` = pc.`option`
								AND pc.categorie = mv.categorie
								AND pc.date_debut <= l.date_creation
								AND pc.date_fin >= DATE_SUB( l.date_creation, INTERVAL 1
								DAY )
								WHERE lo.`location` = ?1";
							$query_option = str_replace("?1",mysql_real_escape_string($id_location),$query_option);
							$query_service = str_replace("?2",mysql_real_escape_string($ligne[13]),$query_service);
	
							$result_option = mysql_query($query_option);
							$nb = 0;
							while($ligne_option=mysql_fetch_row($result_option)){
                              $nb++;
                              ?>
                                      <tr>
                                          <td><?php echo $ligne_option[0]; ?></td>
                                          <td><?php echo $ligne_option[1]; ?></td>
                                          <td><?php if ($ligne_option[2] == '1')  echo $ligne[21]." jour(s)"; else if ($ligne_option[2] == '2') echo "1"; ?></td>
                                          <td><?php $total_option = $ligne_option[1]; if ($ligne_option[2] == '1') {$total_option = $ligne_option[1] * $ligne[21]; echo number_format($total_option, 2, ',', ' ');} else if ($ligne_option[2] == '2') {echo number_format($total_option, 2, ',', ' ');} ?></td>
                                          <?php 
										  	$prix_promotion = 0.00;
											$total_promotion = 0.00;
											$promotion = "Non";
										  	
											
											$query_seuil = "SELECT valeur from parametrage WHERE id= ?1";
											$query_seuil = str_replace("?1",1,$query_seuil);
											$result_seuil = mysql_query($query_seuil);
											$ligne_seuil=mysql_fetch_row($result_seuil);
											$seuil  = $ligne_seuil[0];
												
											if(($ligne_option[5]<>"") OR ($ligne_option[6]<>"")){
												$promotion = "Oui";
												if($ligne[21] < $seuil)
													$prix_promotion = $ligne_option[5];
												else
													$prix_promotion = $ligne_option[6];
							
											}
											else if(($ligne_option[3]<>"") OR ($ligne_option[4]<>"")){
													$promotion = "Oui";
													if($ligne[21] < $seuil)
														$prix_promotion = $ligne_option[3];
													else
														$prix_promotion = $ligne_option[4];
												}
											if($promotion == "Oui"){
												$total_promotion = $prix_promotion; 
												if ($ligne_option[2] == '1') {
													$total_promotion = $prix_promotion * $ligne[21];} 
												//affichage promotion
												echo "<td>Oui</td> <td>".number_format($prix_promotion, 2, ',', ' ')."</td> <td>".number_format($total_promotion, 2, ',', ' ')."</td>";
											}
											else{
												//affichage non promotion
												echo "<td>Non</td> <td>-</td> <td>-</td>";
												}
										
												
										   ?>
                                      </tr>
                            <?php } 
							if($nb == 0)
								echo "<tr><td colspan='7'>Aucune option sélectionnée pour cette réservation<td></tr>";
							?>
                            
                                      </tbody>
                                  </table>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label"></label>
                                  </div>
                                  
                                  <h1><span class="icon-pushpin" ></span> Services</h1>
                                  <div class="col-lg-8">
                                  <table class="table table-striped col-lg-8">
                                      <thead>
                                      <tr>
                                          <th>Service</th>
                                          <th>Prix unité</th>
                                          <th>Coefficient</th>
                                          <th>Total hors promotion</th>
                                          <th>Promotion</th>
                                          <th>Prix unité en promotion</th>
                                          <th>Total en promotion</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                       <?php
                              //recuperation donnees options
                              $query_service = "SELECT s.nom, s.prix, s.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree
									FROM location_service AS ls
									LEFT JOIN `service` AS s ON ls.`service` = s.id
									LEFT JOIN location AS l ON l.id = ls.`location`
									LEFT JOIN modele_vehicule AS mv ON mv.`id` = (
									SELECT modele
									FROM vehicule
									WHERE vehicule.matricule = '?2' )
									LEFT JOIN promotion_service_modele AS pm ON ls.`service` = pm.`service`
									AND pm.modele = mv.id
									AND pm.date_debut <= l.date_creation
									AND pm.date_fin >= DATE_SUB( l.date_creation, INTERVAL 1
									DAY )
									LEFT JOIN promotion_service_categorie AS pc ON ls.`service` = pc.`service`
									AND pc.categorie = mv.categorie
									AND pc.date_debut <= l.date_creation
									AND pc.date_fin >= DATE_SUB( l.date_creation, INTERVAL 1
									DAY )
									WHERE ls.`location` = ?1";
							$query_service = str_replace("?1",mysql_real_escape_string($id_location),$query_service);
							$query_service = str_replace("?2",mysql_real_escape_string($ligne[13]),$query_service);
	
							$result_service = mysql_query($query_service);
							$nb = 0;
							while($ligne_service=mysql_fetch_row($result_service)){
                              $nb++;
                              ?>
                                      <tr>
                                          <td><?php echo $ligne_service[0]; ?></td>
                                          <td><?php echo $ligne_service[1]; ?></td>
                                          <td><?php if ($ligne_service[2] == '1')  echo $ligne[21]." jour(s)"; else if ($ligne_service[2] == '2') echo "1"; ?></td>
                                          <td><?php $total_service = $ligne_service[1]; if ($ligne_service[2] == '1') {$total_service = $ligne_service[1] * $ligne[21]; echo number_format($total_service, 2, ',', ' ');} else if ($ligne_service[2] == '2') {echo number_format($total_service, 2, ',', ' ');} ?></td>
                                          <?php 
										  	$prix_promotion = 0.00;
											$total_promotion = 0.00;
											$promotion = "Non";
										  	
												
											if(($ligne_service[5]<>"") OR ($ligne_service[6]<>"")){
												$promotion = "Oui";
												if((int)$ligne[21] < $seuil){
													$prix_promotion = $ligne_service[5];
													}
												else{
													$prix_promotion = $ligne_service[6];
													}
											}
											else if(($ligne_service[3]<>"") OR ($ligne_service[4]<>"")){
													$promotion = "Oui";
													if($ligne[21] < $seuil)
														$prix_promotion = $ligne_service[3];
													else
														$prix_promotion = $ligne_service[4];
												}
											if($promotion == "Oui"){
												$total_promotion = $prix_promotion; 
												if ($ligne_service[2] == '1') {
													$total_promotion = $prix_promotion * $ligne[21];} 
												//affichage promotion
												echo "<td>Oui</td> <td>".number_format($prix_promotion, 2, ',', ' ')."</td> <td>".number_format($total_promotion, 2, ',', ' ')."</td>";
											}
											else{
												//affichage non promotion
												echo "<td>Non</td> <td>-</td> <td>-</td>";
												}
										
												
										   ?>
                                      </tr>
                            <?php } 
							if($nb == 0)
								echo "<tr><td colspan='7'>Aucun service sélectionné pour cette réservation<td></tr>";
								?>
                                      
                                      </tbody>
                                  </table>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label"></label>
                                  </div>
                                  <h1><span class=" icon-money" ></span> Paiement</h1>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Statut paiement</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[5]; ?></label>
                                  </div>
                                  <?php
                                  if ($ligne[6] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Moyen de paiement</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[6]; ?></label>
                                  </div>
                                   <?php
								  }
								  ?>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Remise</label>
                                      <label  class="col-lg-2 control-label"><?php echo $ligne[14]; ?></label>
                                       <label  class="col-lg-2 control-label zbanzai-label">Valeur de la remise</label>
                                      <label  class="col-lg-2 control-label"><?php echo $ligne[15]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Montant à payer</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[20]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Montant payé</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[8]; ?></label>
                                  </div>
                                  
                                  
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="locations.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_locations"])){ 
											?>
                                          <a  class=" btn btn-warning  " href="locations.php?action=modifier&&id_location=<?php echo $_GET['id_location']; ?>">Modifier</a>
                                          <?php
												}
											?>

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
      <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/reservations/advanced-multiselect.js"></script>