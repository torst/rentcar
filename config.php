<?php
// Déclaration des paramètres de connexion
$host = "localhost";

// Généralement la machine est localhost
// c'est-a-dire la machine sur laquelle le script est hébergé

$user = "root";

$bdd = "location_car_R2";

$passwd  = "";


// Connexion au serveur
mysql_connect($host, $user,$passwd) or die("erreur de connexion au serveur");

mysql_select_db($bdd) or die("erreur de connexion a la base de donnees");
mysql_query("SET NAMES 'utf8'");



?>