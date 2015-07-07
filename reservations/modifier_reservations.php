
		<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h2> Modifier la réservation</h2>
                              
                              
                              
                              <form class="form-horizontal" role="form" action="reservations/actions_reservations.php" id="modifier_statut_resa" method="post">
                              	
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
							  if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              $id_reservation=$_GET['id_reservation'];
                              $query = "SELECT 
									r.id,
									c.nom,
									c.prenom,
									r.client,
									o.libelle,
									sr.libelle,
									sp.libelle,
									tp.libelle,
									DATE_FORMAT(r.date_creation, '%d/%m/%Y à %H:%i'),
									r.montant_calcule,
									r.montant_paye,
									DATE_FORMAT(r.date_depart, '%d/%m/%Y'),
									DATE_FORMAT(r.date_retour, '%d/%m/%Y'),
									r.heure_depart,
									r.heure_retour,
									mv.nom,
									rem.nom,
									r.valeur_remise,
									a1.nom,
									a2.nom,
									l1.lieu,
									l2.lieu,
									r.montant_a_payer,
									DATE_FORMAT(r.date_retour, '%d/%m/%Y') - DATE_FORMAT(r.date_depart, '%d/%m/%Y') + 1,
									sr.id
									FROM
									reservation AS r
									LEFT JOIN client AS c ON r.client = c.id
									LEFT JOIN origine_reservation AS o ON r.origine = o.id
									LEFT JOIN statut_reservation AS sr ON r.statut_reservation = sr.id
									LEFT JOIN statut_paiement AS sp ON r.statut_paiement = sp.id
									LEFT JOIN type_paiement AS tp ON r.type_paiement = tp.id
									LEFT JOIN modele_vehicule AS mv ON r.modele_vehicule = mv.id
									LEFT JOIN remise AS rem ON r.remise = rem.id
									LEFT JOIN agence AS a1 ON r.agence_depart = a1.id
									LEFT JOIN agence AS a2 ON r.agence_retour = a2.id
									LEFT JOIN res_depart_perso AS l1 ON r.id = l1.id
									LEFT JOIN res_retour_perso AS l2 ON r.id = l2.id
									
									WHERE r.id= ?1";
							$query = str_replace("?1",mysql_real_escape_string($id_reservation),$query);
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
                              
                              ?>

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
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_reservation" value="<?php echo $ligne[0]; ?>" />
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Créée le</label>
                                      <label  class="col-lg-3 control-label"><?php echo $ligne[8]; ?></label>
                                      
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
                                      <label  class="col-lg-1 control-label zbanzai-label">Origine</label>
                                      <label  class="col-lg-2 control-label"><?php echo $ligne[4]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Statut réservation</label>
                                      <!--<label  class="col-lg-3 control-label"><?php //echo $ligne[5]; ?></label>-->
                                      <div class="col-lg-3">
                                         
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
										  <option <?php if ($ligne[24] == $ligne_statut_reservation[0]) echo "selected";?> value="<?php echo $ligne_statut_reservation[0]; ?>"><?php echo $ligne_statut_reservation[1]; ?></option>
										  
										  <?php 
	                                          }
                                          ?>
										</select>
                                      </div>
                                     <div class=" col-lg-3">
                                      	  <a  class=" btn btn-primary  " href="reservations.php">Retour</a>
                                          <?php
												if(isset($_SESSION["modifier_reservations"])){ 
											?>
                                          <button  class=" btn btn-warning  " type="submit">Modifier</button>
                                          <?php
												}
											?>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Modèle véhicule</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[15]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Date et heure départ</label>
                                       <label  class="col-lg-6 control-label"><?php echo $ligne[11]." à ".$ligne[13].":00"; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Date et heure  reprise</label>
                                       <label  class="col-lg-6 control-label"><?php echo $ligne[12]." à ".$ligne[14].":00"; ?></label>
                                  </div>
                                  
                                  
                                  <?php
                                  if ($ligne[18] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Agence de départ</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[18]; ?></label>
                                  </div>
                                   <?php
								  }
								  else{
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Lieu de départ</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[20]; ?></label>
                                  </div>
                                  <?php
								  }
								  ?>
                                  <?php
                                  if ($ligne[19] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Agence de reprise</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[19]; ?></label>
                                  </div>
                                   <?php
								  }
								  else{
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Lieu de reprise</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[21]; ?></label>
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
                              $query_option = "SELECT o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree
FROM reservation_option as ro
LEFT JOIN `option` AS o ON ro.`option` = o.id
LEFT JOIN reservation AS r ON r.id = ro.`reservation`
LEFT JOIN modele_vehicule AS m ON r.modele_vehicule = m.`id`
LEFT JOIN promotion_option_modele AS pm ON ro.`option` = pm.`option` and pm.modele = r.modele_vehicule and pm.date_debut <=  r.date_creation and pm.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
LEFT JOIN promotion_option_categorie AS pc ON ro.`option` = pc.`option` and pc.categorie = m.categorie and pc.date_debut <=  r.date_creation and pc.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
WHERE
ro.`reservation` = ?1";
							$query_option = str_replace("?1",mysql_real_escape_string($id_reservation),$query_option);
	
							$result_option = mysql_query($query_option);
							$nb = 0;
							while($ligne_option=mysql_fetch_row($result_option)){
                              $nb++;
                              ?>
                                      <tr>
                                          <td><?php echo $ligne_option[0]; ?></td>
                                          <td><?php echo $ligne_option[1]; ?></td>
                                          <td><?php if ($ligne_option[2] == '1')  echo $ligne[23]." jour(s)"; else if ($ligne_option[2] == '2') echo "1"; ?></td>
                                          <td><?php $total_option = $ligne_option[1]; if ($ligne_option[2] == '1') {$total_option = $ligne_option[1] * $ligne[23]; echo number_format($total_option, 2, ',', ' ');} else if ($ligne_option[2] == '2') {echo number_format($total_option, 2, ',', ' ');} ?></td>
                                          <?php 
										  	$prix_promotion = 0.00;
											$total_promotion = 0.00;
											$promotion = "Non";
										  	
											$seuil  = 30; //longue durée commence a partir de x jour (a variabiliser)
											$query_seuil = "SELECT valeur from parametrage WHERE id= ?1";
											$query_seuil = str_replace("?1",1,$query_seuil);
											$result_seuil = mysql_query($query_seuil);
											$ligne_seuil=mysql_fetch_row($result_seuil);
											$seuil  = $ligne_seuil[0];
												
											if(($ligne_option[5]<>"") OR ($ligne_option[6]<>"")){
												$promotion = "Oui";
												if($ligne[23] < $seuil)
													$prix_promotion = $ligne_option[5];
												else
													$prix_promotion = $ligne_option[6];
							
											}
											else if(($ligne_option[3]<>"") OR ($ligne_option[4]<>"")){
													$promotion = "Oui";
													if($ligne[23] < $seuil)
														$prix_promotion = $ligne_option[3];
													else
														$prix_promotion = $ligne_option[4];
												}
											if($promotion == "Oui"){
												$total_promotion = $prix_promotion; 
												if ($ligne_option[2] == '1') {
													$total_promotion = $prix_promotion * $ligne[23];} 
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
FROM reservation_service as rs
LEFT JOIN `service` AS s ON rs.`service` = s.id
LEFT JOIN reservation AS r ON r.id = rs.`reservation`
LEFT JOIN modele_vehicule AS m ON r.modele_vehicule = m.`id`
LEFT JOIN promotion_service_modele AS pm ON rs.`service` = pm.`service` and pm.modele = r.modele_vehicule and pm.date_debut <=  r.date_creation and pm.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
LEFT JOIN promotion_service_categorie AS pc ON rs.`service` = pc.`service` and pc.categorie = m.categorie and pc.date_debut <=  r.date_creation and pc.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
WHERE
rs.`reservation` = ?1";
							$query_service = str_replace("?1",mysql_real_escape_string($id_reservation),$query_service);
	
							$result_service = mysql_query($query_service);
							$nb = 0;
							while($ligne_service=mysql_fetch_row($result_service)){
                              $nb++;
                              ?>
                                      <tr>
                                          <td><?php echo $ligne_service[0]; ?></td>
                                          <td><?php echo $ligne_service[1]; ?></td>
                                          <td><?php if ($ligne_service[2] == '1')  echo $ligne[23]." jour(s)"; else if ($ligne_service[2] == '2') echo "1"; ?></td>
                                          <td><?php $total_service = $ligne_service[1]; if ($ligne_service[2] == '1') {$total_service = $ligne_service[1] * $ligne[23]; echo number_format($total_service, 2, ',', ' ');} else if ($ligne_service[2] == '2') {echo number_format($total_service, 2, ',', ' ');} ?></td>
                                          <?php 
										  	$prix_promotion = 0.00;
											$total_promotion = 0.00;
											$promotion = "Non";
										  	
											$seuil  = 30; //longue durée commence a partir de 5 jour (a variabiliser)
												
											if(($ligne_service[5]<>"") OR ($ligne_service[6]<>"")){
												$promotion = "Oui";
												if($ligne[23] < $seuil)
													$prix_promotion = $ligne_service[5];
												else
													$prix_promotion = $ligne_service[6];
											}
											else if(($ligne_service[3]<>"") OR ($ligne_service[4]<>"")){
													$promotion = "Oui";
													if($ligne[23] < $seuil)
														$prix_promotion = $ligne_service[3];
													else
														$prix_promotion = $ligne_service[4];
												}
											if($promotion == "Oui"){
												$total_promotion = $prix_promotion; 
												if ($ligne_service[2] == '1') {
													$total_promotion = $prix_promotion * $ligne[23];} 
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
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[6]; ?></label>
                                  </div>
                                  <?php
                                  if ($ligne[7] != "") {
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Moyen de paiement</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[7]; ?></label>
                                  </div>
                                   <?php
								  }
								  ?>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Montant calculé</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[9]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Remise</label>
                                      <label  class="col-lg-2 control-label"><?php echo $ligne[16]; ?></label>
                                       <label  class="col-lg-2 control-label zbanzai-label">Valeur de la remise</label>
                                      <label  class="col-lg-2 control-label"><?php echo $ligne[17]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Montant à payer</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[22]; ?></label>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label zbanzai-label">Montant payé</label>
                                      <label  class="col-lg-6 control-label"><?php echo $ligne[10]; ?></label>
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