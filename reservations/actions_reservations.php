<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php

      $option = isset( $_POST['option'] ) ? $_POST['option'] : "";
	  
      switch ( $option ) {
		  case 'update':
		  	if(isset($_SESSION["modifier_reservations"]))
		    	update();
		    break;
		    
		  case 'insert':
		  	if(isset($_SESSION["ajouter_reservations"]))
		    	insert();
		    break;
		
		  case 'delete':
		  	if(isset($_SESSION["supprimer_reservations"]))
		    	delete();
		    break;
		    
		  default:
		  	//traitement erreur
		    
		}
		
function update() {
if(isset($_POST['id_reservation']) ){
	include("../config.php");
	$statut_reservation=$_POST['statut_reservation'];
	$id_reservation=$_POST['id_reservation'];
	
          //requete
	$requete = "update `reservation` set `statut_reservation` = ?1 where `id`= ?2";	  
	$requete =str_replace("?1",mysql_real_escape_string(mysql_real_escape_string($statut_reservation)),$requete);
	$requete =str_replace("?2",mysql_real_escape_string($id_reservation),$requete);
	
        if(mysql_query($requete)){
			$header = "location:../reservations.php?action=detailler&&id_reservation=".$id_reservation."&&message_success=L'enregistrement a bien été modifié.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../reservations.php?action=modifier&&id_reservation=".$id_reservation;
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
			        	
          
}
  
}

function insert() {
	$client=($_POST['client']);
	$modele=$_POST['modele'];
	$date_debut=($_POST['date_debut']);
	$date_fin=($_POST['date_fin']);
	$heure_debut=($_POST['heure_debut']);
	$heure_fin=($_POST['heure_fin']);
	$agence_depart=($_POST['agence_depart']);
	$agence_reprise=($_POST['agence_reprise']);
	//$check_depart_perso=($_POST['check_depart_perso']);
	//$check_reprise_perso=($_POST['check_reprise_perso']);
	$lieu_depart=($_POST['lieu_depart']);
	$lieu_reprise=($_POST['lieu_reprise']);
	$options=$_POST['options'];
	$services=$_POST['services'];
	$montant_calcule=($_POST['montant_calcule']); 
	$remise=$_POST['remise'];
	$valeur_remise=$_POST['valeur_remise'];
	$montant_apayer=($_POST['montant_apayer']);
	$montant_paye=($_POST['montant_paye']);
	$statut_paiement=$_POST['statut_paiement'];
	$type_paiement=$_POST['mode_paiement'];
	$statut_reservation=($_POST['statut_reservation']);
	$origine_reservation=($_POST['origine_reservation']);
	
	
	//controle champ
	$erreur = 0;
	if(strcmp($date_debut,"")==0) {
		$erreur_date_debut = "Veuillez renseigner la date de début";
		$erreur=1;
	}
	
	if(strcmp($date_fin,"")==0) {
		$erreur_date_fin = "Veuillez renseigner la date de fin";
		$erreur=1;
	}
	
	
	//validation dates
	 
	if (!validateDate($date_debut, 'd/m/Y')){
		$erreur_date_debut = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!validateDate($date_fin, 'd/m/Y')){
		$erreur_date_fin = "Veuillez renseigner une date valide";
		$erreur=1;
	}
	if (!compareDate($date_debut, 'd/m/Y',$date_fin, 'd/m/Y')){
		$erreur_date_fin = "La date de fin ne peut pas être inférieure ou égale à la date de début";
		$erreur=1;
	}
	//unicite modele
	include("../config.php");
	
	//test si prix a payer est numerique
	if(!is_numeric($montant_apayer)) {
		if($montant_apayer == "") {
			$montant_apayer = 0;
		}
		else {
			$erreur_montant_apayer = "Veuillez renseigner une valeur numérique";
			$erreur=1;
			}
	}
	
	//test si prix a payer est positive
	else
	if($montant_apayer < 0) {
		$erreur_montant_apayer = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	//test si prix paye est numerique
	if(!is_numeric($montant_paye)) {
		if($montant_paye == "") {
			$montant_paye = 0;
		}
		else {
			$erreur_montant_paye = "Veuillez renseigner une valeur numérique";
			$erreur=1;
		}
	}
	//test si prix paye est positive
	else
	if($montant_paye < 0) {
		$erreur_montant_paye = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	//test si valeur remise est numerique
	if(!is_numeric($valeur_remise)) {
		if($valeur_remise == "") {
			$valeur_remise = 0;
		}
		else {
			$erreur_valeur_remise = "Veuillez renseigner une valeur numérique";
			$erreur=1;
		}
	}
	//test si prix est positive
	else
	if($valeur_remise < 0) {
		$erreur_valeur_remise = "Veuillez renseigner une valeur positive ou 0 pour gratuit";
		$erreur=1;
	}
	
	if($erreur == 1)
	{
	
	
		$header = "location:../reservations.php?action=ajouter";
		$header = $header."&&modele=".$modele;
		$header = $header."&&client=".$client;
		$header = $header."&&date_debut=".$date_debut;
		$header = $header."&&date_fin=".$date_fin;
		$header = $header."&&heure_debut=".$heure_debut;
		$header = $header."&&heure_fin=".$heure_fin;
		$header = $header."&&agence_depart=".$agence_depart;
		$header = $header."&&agence_reprise=".$agence_reprise;
		$header = $header."&&check_depart_perso=".$check_depart_perso;
		$header = $header."&&check_reprise_perso=".$check_reprise_perso;
		$header = $header."&&lieu_depart=".$lieu_depart;
		$header = $header."&&lieu_reprise=".$lieu_reprise;
		$header = $header."&&options=".$options;
		$header = $header."&&services=".$services;
		$header = $header."&&montant_calcule=".$montant_calcule;
		$header = $header."&&remise=".$remise;
		$header = $header."&&valeur_remise=".$valeur_remise;
		$header = $header."&&montant_apayer=".$montant_apayer;
		$header = $header."&&montant_paye=".$montant_paye;
		$header = $header."&&statut_paiement=".$statut_paiement;
		$header = $header."&&type_paiement=".$type_paiement;
		$header = $header."&&statut_reservation=".$statut_reservation;
		$header = $header."&&origine_reservation=".$origine_reservation;
		$header = $header."&&erreur=".$erreur;
		
		
		if(strcmp($erreur_date_debut,"")!=0) { 
			$header = $header."&&erreur_date_debut=".$erreur_date_debut;
			
		}
		if(strcmp($erreur_date_fin,"")!=0) {
			$header = $header."&&erreur_date_fin=".$erreur_date_fin;
			
		}
		if(strcmp($erreur_montant_apayer,"")!=0) {
			$header = $header."&&erreur_montant_apayer=".$erreur_montant_apayer;
			
		}
		if(strcmp($erreur_montant_paye,"")!=0) {
			$header = $header."&&erreur_montant_paye=".$erreur_montant_paye;
			
		}
		if(strcmp($erreur_valeur_remise,"")!=0) {
			$header = $header."&&erreur_valeur_remise=".$erreur_valeur_remise;
			
		}
		
		header($header);
		exit;
	}
	
	//mise a zero des valeurs numeriques facultatives non renseignées
	if(strcmp($montant_calcule,"")==0) { 
		$montant_calcule = 0;
	}
	if(strcmp($montant_paye,"")==0) { 
		$montant_paye = 0;
	}
	if(strcmp($valeur_remise,"")==0) {
		$valeur_remise = 0;
	}

	//calcule nombre de jour
	$nbJours = joursEntreDates($date_debut,$date_fin);
        
          //requete
	$requete = "INSERT INTO `reservation` (`client`, `origine`, `agent`,  `montant_calcule`, `montant_a_payer`, `montant_paye`, `statut_reservation`, `statut_paiement`, `type_paiement`, `agence_depart`, `agence_retour`, `date_depart`, `date_retour`, `heure_depart`, `heure_retour`, `modele_vehicule`, `remise`, `valeur_remise`) VALUES
( ?A, ?2, ?3,  ?4, ?5, ?6, ?7, ?8, ?9, ?10, ?11, STR_TO_DATE('?12', '%d/%m/%Y'), STR_TO_DATE('?13', '%d/%m/%Y'), ?14, ?15, ?16, ?17, ?18)";
		  
	$requete =str_replace("?A",mysql_real_escape_string($client),$requete);
    $requete =str_replace("?2",mysql_real_escape_string($origine_reservation),$requete);
	$requete =str_replace("?3",mysql_real_escape_string($_SESSION["id"]),$requete);
    $requete =str_replace("?4",mysql_real_escape_string($montant_calcule),$requete);
	$requete =str_replace("?5",mysql_real_escape_string($montant_apayer),$requete);
    $requete =str_replace("?6",mysql_real_escape_string($montant_paye),$requete);
	$requete =str_replace("?7",mysql_real_escape_string($statut_reservation),$requete);
    $requete =str_replace("?8",mysql_real_escape_string($statut_paiement),$requete);
	if ($statut_paiement != '1')
		$requete = str_replace("?9",mysql_real_escape_string($type_paiement),$requete); //inserer si statut paiement = payé, sinon inserer 0
	else 
		$requete = str_replace("?9",mysql_real_escape_string("NULL"),$requete);
	//inserer agence depart si lieu depar personalisé n a pas ete rempli
	if (isset($_POST['check_depart_perso'])){
		$requete =str_replace("?10",mysql_real_escape_string("NULL"),$requete);
	}
	else{
		$requete =str_replace("?10",mysql_real_escape_string($agence_depart),$requete);
	}
	//inserer agence reprise si lieu depar personalisé n a pas ete rempli
    if (isset($_POST['check_reprise_perso'])){
		$requete =str_replace("?11",mysql_real_escape_string("NULL"),$requete);
	}
	else{
		$requete =str_replace("?11",mysql_real_escape_string($agence_reprise),$requete);
	}
	$requete =str_replace("?12",mysql_real_escape_string($date_debut),$requete);
	$requete =str_replace("?13",mysql_real_escape_string($date_fin),$requete);
    $requete =str_replace("?14",mysql_real_escape_string($heure_debut),$requete);
	$requete =str_replace("?15",mysql_real_escape_string($heure_fin),$requete);
    $requete =str_replace("?16",mysql_real_escape_string($modele),$requete);
	$requete =str_replace("?17",mysql_real_escape_string($remise),$requete);
    $requete =str_replace("?18",mysql_real_escape_string($valeur_remise),$requete);	
		
       if(mysql_query($requete)){
       		$requete_id = "SELECT LAST_INSERT_ID()";
       		$result = mysql_query($requete_id);
       		$ligne=mysql_fetch_row($result);
       		$last_id = $ligne[0];
			
			
			//insertion de la liste des optons si existe
			if(count($options)>0){
				$requete = "INSERT INTO `reservation_option` (`option`,`reservation`,  `quantite`) VALUES". "(". mysql_real_escape_string($options[0]). "," . $last_id . ", 1)"; 
				for($i=1; $i<count($options); $i++){
					$requete = $requete . ",(". $options[$i]. "," . $last_id . ", 1)";
				}
				mysql_query($requete);

				//insertion dans table detail option pour affichage dans page detail et modifier. Action realiser pour corriger 
				//le fait de changer une promo ou les prix des options, une resa ou location deja enregistree ne doit pas etre modifier en affichage
				//recuperation donnees options
	                          	$query_seuil = "SELECT valeur from parametrage WHERE id= ?1";
								$query_seuil = str_replace("?1",1,$query_seuil);
								$result_seuil = mysql_query($query_seuil);
								$ligne_seuil=mysql_fetch_row($result_seuil);
								$seuil  = $ligne_seuil[0];



                              $query_option = "SELECT o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree, ro.option
FROM reservation_option as ro
LEFT JOIN `option` AS o ON ro.`option` = o.id
LEFT JOIN reservation AS r ON r.id = ro.`reservation`
LEFT JOIN modele_vehicule AS m ON r.modele_vehicule = m.`id`
LEFT JOIN promotion_option_modele AS pm ON ro.`option` = pm.`option` and pm.modele = r.modele_vehicule and pm.date_debut <=  r.date_creation and pm.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
LEFT JOIN promotion_option_categorie AS pc ON ro.`option` = pc.`option` and pc.categorie = m.categorie and pc.date_debut <=  r.date_creation and pc.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
WHERE
ro.`reservation` = ?1";
							$query_option = str_replace("?1",mysql_real_escape_string($last_id),$query_option);
	
							$result_option = mysql_query($query_option);

							$nb = 0;

							while($ligne_option=mysql_fetch_row($result_option)){
                                $nb++;

                                //insertion dans table option resa detail affichage

                                $query_insert_row = "insert into opt_resa_detail_applique 
                              (`reservation`,`option`,`nom`,`prix_unite`,`coefficient`,`total_hors_promotion`,`promotion`,`prix_unite_promotion`,`total_promotion`) 
                              values 
                              (?1, ?2, '?3', '?4', '?5', '?6', '?7', '?8', '?9')";
                              
                                $query_insert_row = str_replace("?1", $last_id, $query_insert_row); 
                                $query_insert_row = str_replace("?2", $ligne_option[7], $query_insert_row); 
                                $query_insert_row = str_replace("?3", $ligne_option[0], $query_insert_row); 
                                $query_insert_row = str_replace("?4", $ligne_option[1], $query_insert_row);
                                $coeff = "1"; 

	                  			if ($ligne_option[2] == '1')  
	                  				$coeff = $nbJours." jour(s)"; 

	                  			$query_insert_row = str_replace("?5", $coeff, $query_insert_row);  
	                   			
	                   			$total_prix_option = 0;
	                  			$total_option = $ligne_option[1]; 

	                  			if ($ligne_option[2] == '1') {
	                  				$total_option = $ligne_option[1] * $nbJours; 
	                  				$total_prix_option = number_format($total_option, 2, ',', ' ');
	                  			} else if ($ligne_option[2] == '2') {
	                  				$total_prix_option = number_format($total_option, 2, ',', ' ');
	                  			} 

	                  			$query_insert_row = str_replace("?6", $total_prix_option, $query_insert_row);
                                          			
                                          
							  	$prix_promotion = 0.00;
								$total_promotion = 0.00;
								$promotion = "Non";
							  	
								
									
								if(($ligne_option[5]<>"") OR ($ligne_option[6]<>"")){
									$promotion = "Oui";
									if($nbJours < $seuil)
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
										$total_promotion = $prix_promotion * $nbJours;} 
									//affichage promotion
									$query_insert_row = str_replace("?7", "Oui", $query_insert_row); 
                                    $query_insert_row = str_replace("?8", number_format($prix_promotion, 2, ',', ' '), $query_insert_row); 
                                    $query_insert_row = str_replace("?9", number_format($total_promotion, 2, ',', ' '), $query_insert_row); 
								}
								else{
									//affichage non promotion
									$query_insert_row = str_replace("?7", "Non", $query_insert_row); 
                                    $query_insert_row = str_replace("?8", "-", $query_insert_row); 
                                    $query_insert_row = str_replace("?9", "-", $query_insert_row); 
									}

								mysql_query($query_insert_row);		
											//echo $query_insert_row;
                            }
			}
			
			//insertion de la liste des services si existe
			if(count($services)>0){
				$requete = "INSERT INTO `reservation_service` ( `service`, `reservation`,`quantite`) VALUES". "(". mysql_real_escape_string($services[0]). "," . $last_id . ", 1)"; 
				for($i=1; $i<count($services); $i++){
					$requete = $requete . ",(". $services[$i]. "," . $last_id . ", 1)";
				}
				mysql_query($requete);

				//insertion dans table detail service pour affichage dans page detail et modifier. Action realiser pour corriger 
				//le fait de changer une promo ou les prix des service, une resa ou location deja enregistree ne doit pas etre modifier en affichage
				//recuperation donnees services
	                         

                              $query_service = "SELECT o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree, ro.service
FROM reservation_service as ro
LEFT JOIN `service` AS o ON ro.`service` = o.id
LEFT JOIN reservation AS r ON r.id = ro.`reservation`
LEFT JOIN modele_vehicule AS m ON r.modele_vehicule = m.`id`
LEFT JOIN promotion_service_modele AS pm ON ro.`service` = pm.`service` and pm.modele = r.modele_vehicule and pm.date_debut <=  r.date_creation and pm.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
LEFT JOIN promotion_service_categorie AS pc ON ro.`service` = pc.`service` and pc.categorie = m.categorie and pc.date_debut <=  r.date_creation and pc.date_fin >=  DATE_SUB(r.date_creation, INTERVAL 1 DAY)
WHERE
ro.`reservation` = ?1";
							$query_service = str_replace("?1",mysql_real_escape_string($last_id),$query_service);
	
							$result_service = mysql_query($query_service);

							$nb = 0;

							while($ligne_service=mysql_fetch_row($result_service)){
                                $nb++;

                                //insertion dans table service resa detail affichage

                                $query_insert_row = "insert into serv_resa_detail_applique 
                              (`reservation`,`service`,`nom`,`prix_unite`,`coefficient`,`total_hors_promotion`,`promotion`,`prix_unite_promotion`,`total_promotion`) 
                              values 
                              (?1, ?2, '?3', '?4', '?5', '?6', '?7', '?8', '?9')";
                              
                                $query_insert_row = str_replace("?1", $last_id, $query_insert_row); 
                                $query_insert_row = str_replace("?2", $ligne_service[7], $query_insert_row); 
                                $query_insert_row = str_replace("?3", $ligne_service[0], $query_insert_row); 
                                $query_insert_row = str_replace("?4", $ligne_service[1], $query_insert_row);
                                $coeff = "1"; 

	                  			if ($ligne_service[2] == '1')  
	                  				$coeff = $nbJours." jour(s)"; 

	                  			$query_insert_row = str_replace("?5", $coeff, $query_insert_row);  
	                   			
	                   			$total_prix_service = 0;
	                  			$total_service = $ligne_service[1]; 

	                  			if ($ligne_service[2] == '1') {
	                  				$total_service = $ligne_service[1] * $nbJours; 
	                  				$total_prix_service = number_format($total_service, 2, ',', ' ');
	                  			} else if ($ligne_service[2] == '2') {
	                  				$total_prix_service = number_format($total_service, 2, ',', ' ');
	                  			} 

	                  			$query_insert_row = str_replace("?6", $total_prix_service, $query_insert_row);
                                          			
                                          
							  	$prix_promotion = 0.00;
								$total_promotion = 0.00;
								$promotion = "Non";
							  	
								
									
								if(($ligne_service[5]<>"") OR ($ligne_service[6]<>"")){
									$promotion = "Oui";
									if($nbJours < $seuil)
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
										$total_promotion = $prix_promotion * $nbJours;} 
									//affichage promotion
									$query_insert_row = str_replace("?7", "Oui", $query_insert_row); 
                                    $query_insert_row = str_replace("?8", number_format($prix_promotion, 2, ',', ' '), $query_insert_row); 
                                    $query_insert_row = str_replace("?9", number_format($total_promotion, 2, ',', ' '), $query_insert_row); 
								}
								else{
									//affichage non promotion
									$query_insert_row = str_replace("?7", "Non", $query_insert_row); 
                                    $query_insert_row = str_replace("?8", "-", $query_insert_row); 
                                    $query_insert_row = str_replace("?9", "-", $query_insert_row); 
									}

								mysql_query($query_insert_row);		
											//echo $query_insert_row;
                            }
			}
			
			//inserer lieu depar perso s il a été choisi
			if (isset($_POST['check_depart_perso'])){
				$requete = "INSERT INTO `res_depart_perso` (`id`, `lieu`) VALUES". "(". $last_id. ",'" . mysql_real_escape_string($lieu_depart) . "')"; 
				mysql_query($requete);
			}
			
			//inserer lieu reprise perso s il a été choisi
			if (isset($_POST['check_reprise_perso'])){
				$requete = "INSERT INTO `res_retour_perso` (`id`, `lieu`) VALUES". "(". $last_id. ",'" . mysql_real_escape_string($lieu_reprise) . "')"; 
				mysql_query($requete);
			}
			
			$header = "location:../reservations.php?action=detailler&&id_reservation=".$last_id."&&message_success=L'enregistrement a bien été inséré.";
			header($header);
			exit;
		}
		else
		{
			$erreur_generale = "Un problème technique est survenu. Veuillez re-essayer ultérieurement.".$requete;
			$header = "location:../reservations.php?action=ajouter";
			$header = $header."&&erreur_generale=".$erreur_generale;
			header($header);
			exit;
		}
		
  
}
function delete() {
	
	
	if(isset($_POST['id_reservation']) ){
		$id_reservation=$_POST['id_reservation'];
					
			include("../config.php");
			
			$query = "delete  FROM reservation WHERE `id`=" . $id_reservation ;
			if(mysql_query($query)){
				
				echo "OK:Enregistrement supprimé avec succès";
			}
			
			else
			{
				echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
			}
		
	}	
	else
	{
		echo "KO:Un problème technique est survenu. Veuillez re-essayer ultérieurement.";
	}
  		
}
function validateDate($date, $format = 'd/m/Y')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
function compareDate($date1, $format1 = 'd/m/Y',$date2, $format2 = 'd/m/Y')
		{
			$d1 = DateTime::createFromFormat($format1, $date1);
			$d2 = DateTime::createFromFormat($format2, $date2);
			if($d2->getTimestamp() < $d1->getTimestamp())
				return false;
			else 
				return true;
			
		}
function joursEntreDates($date1, $date2)
		{
			$date1 = str_replace('/', '-', $date1);
			$date2 = str_replace('/', '-', $date2);

			$nbSecondes= 60*60*24;
 
	        $debut_ts = strtotime(date('Y-m-d', strtotime($date1)));
	        $fin_ts = strtotime(date('Y-m-d', strtotime($date2)));
	        $diff = round(($fin_ts - $debut_ts) / $nbSecondes) +1;
	        return $diff;
		}

?> 