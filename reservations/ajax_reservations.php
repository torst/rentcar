<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
?>
<?php

      $methode = isset( $_GET['methode'] ) ? $_GET['methode'] : "";
	  
      switch ( $methode ) {
		  case 'getMontantCalcule':
		  
		  	getMontantCalcule();
		    break;
		    
		  default:
		  	echo "Une erreur technique est survenue. Veuillez contacter votre administrateur.";
		    
		}
		
function getMontantCalcule() {
	include("../config.php");
	
$montant_calcule = 0;
//echo "montant calcule = ".$montant_calcule." \n";
//parametre
$query_seuil = "SELECT valeur from parametrage WHERE id= ?1";
$query_seuil = str_replace("?1",1,$query_seuil);
$result_seuil = mysql_query($query_seuil);
$ligne_seuil=mysql_fetch_row($result_seuil);
$seuil  = $ligne_seuil[0];

//recuperation date debut reservation
$date_deb = $_GET['date_deb'];


//recup prix modele
$id_modele = $_GET['id_modele'];
//controle validite champ
if(strcmp($id_modele,"")==0) {
	echo "Veuillez renseigner le modèle du véhicule"; ////////////////////////////////erreur traitement
	exit;
}
//calcule prix modele vehicule
$query = "SELECT 
	prix_court_duree, prix_longue_duree, categorie 
	from prix_modele, modele_vehicule 
	WHERE 
	modele_vehicule.`id`= ?1
	and prix_modele.`modele` = modele_vehicule.`id`
	";
$query = str_replace("?1",mysql_real_escape_string($id_modele),$query);
$result = mysql_query($query);
$ligne = mysql_fetch_row($result);
$prix_court = $ligne[0];
$prix_long = $ligne[1];
$categorie = $ligne[2];
//factoriz par nombre jours
$nombre_jour =  $_GET['nombre_jours'];
//echo "nombre de jours = ".$nombre_jour." \n";
//controle validité champ
if (( $nombre_jour < 1 ) OR ( $nombre_jour > 360 )){
	echo "Veuillez renseigner des dates valides";   //////////////////////////////////////erreur traitement
	exit;
}


$prix_modele = $prix_court * $nombre_jour;
if($nombre_jour >= $seuil)
 $prix_modele = $prix_long * $nombre_jour;
//echo "prix vehicule = ".$prix_modele." \n";

//recup prix de chaque option et factoriz par nombre jour dependant de l option
$prix_total_options = 0;
$prix_options = 0;
$options = $_GET['options_liste'];
if(strcmp($options[0],"")!=0) {

for($i = 0; $i < count($options); $i++){
	$query = "SELECT 
o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree
FROM 
`option` as o
LEFT JOIN promotion_option_modele AS pm ON o.`id` = pm.`option` and pm.modele = ?1 and pm.date_debut <=  STR_TO_DATE('".$date_deb."', '%d/%m/%Y') and pm.date_fin >=  DATE_SUB(STR_TO_DATE('".$date_deb."', '%d/%m/%Y'), INTERVAL 1 DAY)
LEFT JOIN promotion_option_categorie AS pc ON o.`id` = pc.`option` and pc.categorie = ?2 and pc.date_debut <=  STR_TO_DATE('".$date_deb."', '%d/%m/%Y') and pc.date_fin >=  DATE_SUB(STR_TO_DATE('".$date_deb."', '%d/%m/%Y'), INTERVAL 1 DAY)
WHERE
o.id = ?3
	"; 
	
	$query = str_replace("?1",mysql_real_escape_string($id_modele),$query);
	$query = str_replace("?2",mysql_real_escape_string($categorie),$query);
	$query = str_replace("?3",mysql_real_escape_string($options[$i]),$query);
	
	$result = mysql_query($query);
	while($ligne=mysql_fetch_row($result)){
		//echo $ligne[0]." ".$ligne[1] ." ". $ligne[2] ." ". $ligne[3] ." ". $ligne[4] ." ". $ligne[5]." ". $ligne[6]." \n";
		$prix_option = $ligne[1];
		$periode_coeff = $ligne[2];
		$prix_promotion = "";
		//mettre le prix promotionnel si existe. Priorité a la promo sur modele
		if(($ligne[5]<>"") OR ($ligne[6]<>"")){
			if($nombre_jour < $seuil){
				$prix_promotion = $ligne[5]; //si vide, prix standrd
				if($prix_promotion == "")
					$prix_promotion = $prix_option;
			}
				
			else{
				$prix_promotion = $ligne[6]; //si vide, prix court duree
				if($prix_promotion == "")
					$prix_promotion = $ligne[5];
			}
		}
		else if(($ligne[3]<>"") OR ($ligne[4]<>"")){
				if($nombre_jour < $seuil){
					$prix_promotion = $ligne[3]; //si vide, prix standrd
					if($prix_promotion == "")
						$prix_promotion = $prix_option;
				}
					
				else{
					$prix_promotion = $ligne[4]; //si vide, prix court duree
					if($prix_promotion == "")
						$prix_promotion = $ligne[3];
				}
		}
		if ($prix_promotion <> "")
			$prix_option = $prix_promotion;
		
		$prix_unitaire = $prix_option;
			
		if ($periode_coeff == '1') //multiplier par nombre de jour si le prix d option est appliquer au nb jour et non tte la location
			$prix_option = $prix_option * $nombre_jour;
			
		$prix_total_options = $prix_total_options + $prix_option; //cumul prix total des options
			
		//echo "prix option ".$prix_option." prix unitaire ".$prix_unitaire." nombre jour ".$nombre_jour." coeff ".$periode_coeff."\n";
		//echo "prix total ".$prix_total_options."\n";
		
	}//fin boucle while
} //fin boucle for
} //fin traitement options si rempli
//echo "prix options = ".$prix_total_options." \n";
//recup prix de chaque service et factoriz par nombre jour dependant du service
$services = $_GET['services_liste'];
//recup prix de chaque option et factoriz par nombre jour dependant de l service
$prix_total_services = 0;
$prix_services = 0;
$services = $_GET['services_liste'];

	
if(strcmp($services[0],"")!=0) {

for($i = 0; $i < count($services); $i++){
	//echo "service i : ".$i." -> ".$services[$i]."\n";
	$query = "SELECT 
o.nom, o.prix, o.periode, pc.prix_court_duree, pc.prix_longue_duree, pm.prix_court_duree, pm.prix_longue_duree
FROM 
`service` as o
LEFT JOIN promotion_service_modele AS pm ON o.`id` = pm.`service` and pm.modele = ?1 and pm.date_debut <=  STR_TO_DATE('".$date_deb."', '%d/%m/%Y') and pm.date_fin >=  DATE_SUB(STR_TO_DATE('".$date_deb."', '%d/%m/%Y'), INTERVAL 1 DAY)
LEFT JOIN promotion_service_categorie AS pc ON o.`id` = pc.`service` and pc.categorie = ?2 and pc.date_debut <=  STR_TO_DATE('".$date_deb."', '%d/%m/%Y') and pc.date_fin >=  DATE_SUB(STR_TO_DATE('".$date_deb."', '%d/%m/%Y'), INTERVAL 1 DAY)
WHERE
o.id = ?3
	"; 
	
	$query = str_replace("?1",mysql_real_escape_string($id_modele),$query);
	$query = str_replace("?2",mysql_real_escape_string($categorie),$query);
	$query = str_replace("?3",mysql_real_escape_string($services[$i]),$query);
	
	$result = mysql_query($query);
	while($ligne=mysql_fetch_row($result)){
		//echo $ligne[0]." ".$ligne[1] ." ". $ligne[2] ." ". $ligne[3] ." ". $ligne[4] ." ". $ligne[5]." ". $ligne[6]." \n";
		$prix_service = $ligne[1];
		$periode_coeff = $ligne[2];
		$prix_promotion = "";
		//mettre le prix promotionnel si existe. Priorité a la promo sur modele
		if(($ligne[5]<>"") OR ($ligne[6]<>"")){
			if($nombre_jour < $seuil){
				$prix_promotion = $ligne[5]; //si vide, prix standrd
				if($prix_promotion == "")
					$prix_promotion = $prix_service;
			}
				
			else{
				$prix_promotion = $ligne[6]; //si vide, prix court duree
				if($prix_promotion == "")
					$prix_promotion = $ligne[5];
			}
		}
		else if(($ligne[3]<>"") OR ($ligne[4]<>"")){
				if($nombre_jour < $seuil){
					$prix_promotion = $ligne[3]; //si vide, prix standrd
					if($prix_promotion == "")
						$prix_promotion = $prix_service;
				}
					
				else{
					$prix_promotion = $ligne[4]; //si vide, prix court duree
					if($prix_promotion == "")
						$prix_promotion = $ligne[3];
				}
		}
		if ($prix_promotion <> "")
			$prix_service = $prix_promotion;
		
		$prix_unitaire = $prix_service;
			
		if ($periode_coeff == '1') //multiplier par nombre de jour si le prix d service est appliquer au nb jour et non tte la location
			$prix_service = $prix_service * $nombre_jour;
			
		$prix_total_services = $prix_total_services + $prix_service; //cumul prix total des options
			
		//echo "prix service ".$prix_service." prix unitaire ".$prix_unitaire." nombre jour ".$nombre_jour." coeff ".$periode_coeff."\n";
		//echo "prix total ".$prix_total_services."\n";
		
	}//fin boucle while
} //fin boucle for
} //fin traitement options si rempli
//echo "prix services = ".$prix_total_services." \n";
//somme prix vehicule, prix options, prix services

$montant_calcule = $prix_modele + $prix_total_options + $prix_total_services;
echo $montant_calcule;

//echo number_format($montant_calcule, 2, ',', ' ');
  
}


?> 