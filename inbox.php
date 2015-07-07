<?php
	session_start();
    if(!isset($_SESSION["id"])){ 
  		header("location:login.php");}
	
	
?>

<?php
	
		include("config.php");
      $option = isset( $_GET['option'] ) ? $_GET['option'] : "";
      switch ( $option ) {
		  case 'liste_message':
		  	
		    liste_message();
			break;
		
		  case 'chercher_message':
		  	
		    chercher_message();
			break;
			
		  case 'deplacer_message':
		  	
		    deplacer_message();
			break;
		  
		  default:
		  	liste_message();
		    
		}
	
		
function liste_message() {

	$label = isset( $_GET['label'] ) ? $_GET['label'] : "1";
	$offset = isset( $_GET['offset'] ) ? $_GET['offset'] : "0"; //pour la pagination, dernier element de la liste affichée
	     
          //requete
	//requete pour la pagination
	$requete = "SELECT message.id
						  FROM message
						  WHERE   label = ?1
						  ";
	$requete =str_replace("?1",$label,$requete);
	//echo $requete;
	$result = mysql_query($requete);
	$_SESSION["nb_lignes"]=mysql_num_rows($result);
	///fin requete pagination
	//requete pour le nombre de message non lus
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 1 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["inbox_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 2 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["important_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 3 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["traite_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 4 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["corbeille_nlu"]=mysql_num_rows($result);
	///fin requete message non lus
	
	//requete recup messages
	$requete = "SELECT message.id, objet, corps, UNIX_TIMESTAMP(date_heure), message.statut, nom, prenom, label, have_pj , sens
						  FROM message, client, membre 
						  WHERE 
						  membre.id = message.destinataire  
						  and client.id = membre.id_client
						  and label = ?1
						  ORDER BY date_heure DESC
						  LIMIT ?2,  10";
	$requete =str_replace("?1",$label,$requete);
	$requete =str_replace("?2",$offset,$requete);
	//echo $requete;
	$result = mysql_query($requete);
	$_SESSION["result"] = $result;
	
	
}

function chercher_message() {

	$label = isset( $_GET['label'] ) ? $_GET['label'] : "1";
	$offset = isset( $_GET['offset'] ) ? $_GET['offset'] : "0"; //pour la pagination, dernier element de la liste affichée
	$mots_cles = isset( $_GET['mots_cles'] ) ? $_GET['mots_cles'] : "";
          //requete
	//requete pour la pagination
	$requete = "SELECT message.id
						  FROM message, client, membre
						  WHERE  
						   (objet like ?3 
						  OR
						  corps like ?3
						  OR
						  nom like ?3
						  OR
						  prenom like ?3 )
						  AND membre.id = message.destinataire  
						  AND client.id = membre.id_client  
						  AND label = ?1
						  
						  ";
	$requete =str_replace("?1",$label,$requete);
	$str_mots_cles = "'%".mysql_real_escape_string($mots_cles)."%'";
	$requete =str_replace("?3",$str_mots_cles,$requete);
	$result = mysql_query($requete);
	$_SESSION["nb_lignes"]=mysql_num_rows($result);
	///fin requete pagination
	//requete pour la nombre de message non lus
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 1 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["inbox_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 2 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["important_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 3 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["traite_nlu"]=mysql_num_rows($result);
	
	$requete = "SELECT message.id
						  FROM message
						  WHERE  sens = 'IN' and label = 4 and statut = 2";
	$result = mysql_query($requete);
	$_SESSION["corbeille_nlu"]=mysql_num_rows($result);
	///fin requete message non lus
	
	//requete recup messages
	$requete = "SELECT message.id, objet, corps, DATE_FORMAT(date_heure,
                          '%d/%m/%Y %H:%i'), message.statut, nom, prenom, label, have_pj , sens
						  FROM message, client , membre
						  WHERE 
						  (objet like ?3 
						  OR
						  corps like ?3
						  OR
						  nom like ?3
						  OR
						  prenom like ?3 )
						  AND membre.id = message.destinataire  
						  AND client.id = membre.id_client
						  AND label = ?1
						  ORDER BY date_heure DESC
						  LIMIT ?2,  10";
	$requete =str_replace("?1",$label,$requete);
	$requete =str_replace("?2",$offset,$requete);
	$str_mots_cles = "'%".mysql_real_escape_string($mots_cles)."%'";
	$requete =str_replace("?3",$str_mots_cles,$requete);
	$result = mysql_query($requete);
	$_SESSION["result"] = $result;
	
	
}

function deplacer_message() {
	
	$tolabel = isset( $_GET['tolabel'] ) ? $_GET['tolabel'] : "INBOX";
	$tolabel_id = 1;
	switch ( $tolabel ) {
		  case 'INBOX':
		  	$tolabel_id = 1;
			break;
		  case 'IMPORTANT':
		  	$tolabel_id = 2;
			break;
		  case 'TRAITE':
		  	$tolabel_id = 3;
			break;
		  case 'CORBEILLE':
		  	$tolabel_id = 4;
			break;
		  case 'ENVOYE':
		  	$tolabel_id = 5;
			break;
		}
		
	if(isset($_GET['idMail'])){
		$idmails=$_GET['idMail'];
          //requete
		  
		if(count($idmails)>0){
			
					$requete = "UPDATE `message` SET `label` = '?1' WHERE `message`.`id` =?2";
					$requete =str_replace("?1",$tolabel_id,$requete);
					for($i=0; $i<count($idmails); $i++){
						$requete_i =str_replace("?2",$idmails[$i],$requete);
						mysql_query($requete_i);
					}
					
					//mysql_query($requete);
		}
	}
	liste_message();
	
}

function rdatetime_en($timestamp, $ref = 0) {
	
	setlocale (LC_ALL, "fr_FR");
 
    if ($ref < 1) $ref = time();
 
    $ts = $ref - $timestamp;
    $past = $ts > 0;
    $ts = abs($ts);
 
    if ($past) {
        $left = 'Il y a ';
        $right = '';
    }
    else {
        $left = 'Dans ';
        $right = '';
    }
 
    if ($ts === 0) return 'Maintenant';
 
    if ($ts === 1) return $left.'1 sec'.$right;
 
    // Less than 1 minute
    if ($ts < 60) return $left.$ts.' secs'.$right;
 
    $tm = floor($ts / 60);
    $ts = $ts - $tm * 60;
 
    // Less than 3 min
    if ($tm < 3 && $ts > 0) {
        return $left.$tm.' min'.($tm > 1 ? 's' : '').' et '
            .$ts.' sec'.($ts > 1 ? 's' : '').$right;
    }
 
    // Less than 1 hour
    if ($tm < 60) {
        if ($ts > 0) {
            $left = 'Vers ';
        }
        return $left.$tm.' mins'.$right;
    }
 
    $th = floor($tm / 60);
    $tm = $tm - $th * 60;
 
    // Less than 3 hours
    if ($th < 3) {
        if ($tm > 0) {
            return $left.$th.' heure'.($th > 1 ? 's' : '').' et '
                .$tm.' min'.($tm > 1 ? 's' : '').$right;
        }
        else {
            return $left.$th.' heure'.($th > 1 ? 's' : '').$right;
        }
    }
 
    $refday = strtotime(date('Y-m-d', $ref));
    $refyday = strtotime(date('Y-m-d', $ref - 86400));
 
    // Same day, or yesterday
    if ($timestamp >= $refyday) {
        if ($timestamp < $refday) {
            $left = 'Hier ';
            $right = '';
        }
        else {
            $left = '';
            $right = '';
        }
        return $left.'à '.date('H:i', $timestamp).' '.$right;
    }
 
    $td = floor($th / 24);
    $th = $th - $td * 24;
 
    // Less than 3 days
    if ($td < 3) {
        $left = '';
        $right = '';
        return $left.(strftime('%a', $timestamp)).' à '
            .strftime('%H:%M', $timestamp).$right;
    }
 
    // Less than 5 days
    if ($td < 5) {
        return $left.$td.' jours'.$right;
    }
 
    $refday = strtotime(date('Y-m-01', $ref));
 
    $left = '';
 
    // Same month
    if ($timestamp >= $refyday) {
        $left = 'Le ';
        return $left.strftime('%e F', $timestamp).$right;
    }
 
    return $left.strftime('%b %e, %Y', $timestamp).$right;
 
}

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Inbox</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" >
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/selectize.default.css" data-theme="default">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
   
  </head>

  <body>
  <div id="lockscreen">
  	<div class="lock-wrapper">
		<div id="time"></div>
		<div class="lock-box text-center">
            <img src="<?php echo $_SESSION["avatar"]; ?>" alt="lock avatar"/>
            <h1><?php echo $_SESSION["nom"]." ".$_SESSION["prenom"]; ?></h1>
            <span class="locked">Session en veille</span>
            <a class="btn btn-compose" id="unlock_screen_btn"  >
                             <i class=" icon-unlock icon-white"> </i> 
                          </a> 
        </div>
    </div>
   </div>
<!--fin lockscreen-->
	<div id="spinner"><img src="img/spinner.gif"/></div>
  <section id="container" class="">
      <!--header start-->
      
      <?php
      	include("header.php");
      ?>
      <!--header end-->
      <!--sidebar start-->
      <?php
      	include("menu.php");
      ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--mail inbox start-->
              <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                        <a class="btn btn-compose" data-toggle="modal" href="#myModal" >
                             <i class="icon-edit icon-white"> </i> Nouveau message
                          </a>  
                      </div>
                      <div class="inbox-body">
                         <!-- Modal -->
                          <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog new-message-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title"><?php if(isset($_GET["message_erreur"])) echo "Erreur"; else if(isset($_GET["message_succes"])) echo "Succès";?></h4>
                                      </div>
                                      <div class="modal-body">
                                          <?php if(isset($_GET["message_erreur"])) echo $_GET["message_erreur"]; else if(isset($_GET["message_succes"])) echo $_GET["message_succes"];?>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                          
                          <!-- Modal -->
                          <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog new-message-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title">Détail du message</h4>
                                      </div>
                                      <div class="modal-body">
                                      <div class="mail-option">
                                      <div class="row">
                                          <div class="col-lg-12"> </div>
                                              <div class="col-lg-6">
                                                        <h5 id="detail_msg_dest"></h5>
                                                        <h6 id="detail_msg_date"></h6>
                                              </div>
                                              <div class="col-lg-6">
                                                        <ul class="unstyled inbox-pagination">
                                                            <li>
                                                                <a href="#" class="np-btn tooltips" data-placement="top" data-original-title="Imprimer" id="imprimer"><i class="icon-print pagination-right"></i></a>
                                                            </li>
                                                        </ul>
                                                        <ul class="unstyled inbox-pagination">
                                                            <li>
                                                                <a href="#" class="np-btn tooltips" data-placement="top" data-original-title="Répondre" id="repondre" id_dest=""><i class="icon-mail-reply pagination-left"></i></a>
                                                            </li>
                                                        </ul>
                                              </div>
                                                  
                                          </div>
                                      </div>
                                          
                                          <h4 id="detail_msg_objet"></h4>
                                          
                                          <p>
                                          <pre id="detail_msg_corps">
.
                                          </pre>
                                          </p>
                                          <p>
                                            <a class="btn mini tooltips"  href="lk.js" data-toggle="dropdown" data-placement="right" data-original-title="Ouvrir" id="detail_msg_attch1" target="_blank">
                                                <span class=" icon-paper-clip"></span>
                                            </a>
                                          <br/>
                                            <a class="btn mini tooltips"  href="js.js" data-toggle="dropdown" data-placement="right" data-original-title="Ouvrir" id="detail_msg_attch2" target="_blank">
                                                <span class=" icon-paper-clip"> </span>
                                            </a>
                                          <br/>
                                            <a class="btn mini tooltips"  href="" data-toggle="dropdown" data-placement="right" data-original-title="Ouvrir" id="detail_msg_attch3" target="_blank">
                                                <span class=" icon-paper-clip"> </span>
                                            </a>
                                          </p>
                                          
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                          
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog new-message-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title">Nouveau message</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form class="form-horizontal" role="form"  enctype="multipart/form-data" action="inbox/inbox_action.php" method="post" id="form_new_msg">
                                          <input type="hidden" name="emails_plat" id="emails_plat" >
                                              <div class="form-group" id="dis_emails">
                                                  <label  class="col-lg-2 control-label" id="label_select_to">A</label>
                                                  <div class="col-lg-10">
                                                      <select name ="emails" id="select-to"    placeholder="Sélectionner un client..."></select>
                                                  </div>
                                                  
                                              </div>
                                               <div class="form-group" id="option_diffusion">
                                                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Diffuser</label>
                                                  <div class="col-lg-10" >
                                                      <div class="checkbox">
                                                          <label>
                                                              <input type="checkbox" name="to_all" value="oui" id="to_all">
                                                              Sélectionner pour envoyer à tous les clients
                                                          </label>
                                                      </div>
                                                      <div class="checkbox">
                                                          <label>
                                                              <input type="checkbox" name="to_mail_list" id="to_mail_list" value="oui">
                                                              Sélectionner pour envoyer aux non clients
                                                          </label>
                                                      </div>
            
                                                  </div>
                                              </div>
                                             
                                              
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Objet</label>
                                                  <div class="col-lg-10">
                                                      <div class="input-group m-bot15">
                                                          <div class="input-group-btn">
                                                              <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Modèle <span class="caret"></span></button>
                                                              <ul class="dropdown-menu">
																
																		<?php
																	$requete = "SELECT `id`,`nom`,`corps` FROM `mail_modeles`";
																	$result_modele = mysql_query($requete);
																	$res = $result_modele;
																	while($ligne=mysql_fetch_row($res)){
																	?>
																		<li><a href="#" id="modele<?php echo $ligne[0]; ?>"><?php echo $ligne[1]; ?></a></li>
																		
																<?php } ?>
																
                                                                 
                                                                  <li class="divider"></li>
                                                                  <li><a href="#" id="modele0">Aucun modèle</a></li>
                                                              </ul>
                                                          </div>
                                                          <input type="text" class="form-control" id="objetMail" name="objet" placeholder="Objet du message">
                                                      </div>
                                                  </div>
                                              </div>
                                              
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea name="corps" id="corps" class="form-control" cols="30" rows="10" placeholder="Votre message"></textarea>
                                                  </div>
                                              </div>
                                              
                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <button  type = "reset" class="btn btn-warning " id="btn_reset">Effacer</button>
                                                      <button  id="btn_envoyer" class="btn btn-send ">Envoyer</button>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="icon-paper-clip icon-white"></i>
                                                        <span>Attachment 1</span>
                                                        <input id="attachement1" type="file"  name="file1">
                                                      </span>
                                                      <span class="btn green fileinput-button">
                                                        <i class="icon-paper-clip icon-white"></i>
                                                        <span>Attachment 2</span>
                                                        <input id="attachement2" type="file"  name="file2">
                                                      </span>
                                                      <span class="btn green fileinput-button">
                                                        <i class="icon-paper-clip icon-white"></i>
                                                        <span>Attachment 3</span>
                                                        <input id="attachement3" type="file"   name="file3">
                                                      </span>
                                                      
                                                  </div>
                                                  
                                                  
                                              </div>
                                              
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label"></label>
                                                  <div class="col-lg-10">
                                                      <p>
                                                      	<span id="file1_p"></span>
                                                        <a class="btn mini tooltips" id="action_del_file1" href="" data-toggle="dropdown" data-placement="top" data-original-title="Annuler">
                                     						<span class=" icon-trash"></span>
                                 						</a>
                                                      </p>
                                                      <p>
                                                      	<span id="file2_p"></span>
                                                        <a class="btn mini tooltips" id="action_del_file2" href="" data-toggle="dropdown" data-placement="top" data-original-title="Annuler">
                                     						<span class=" icon-trash"></span>
                                 						</a>
                                                      </p>
                                                      <p>
                                                      	<span id="file3_p"></span>
                                                        <a class="btn mini tooltips" id="action_del_file3" href="" data-toggle="dropdown" data-placement="top" data-original-title="Annuler">
                                     						<span class=" icon-trash"></span>
                                 						</a>
                                                      </p>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li <?php 
						  		$label = isset( $_GET['label'] ) ? $_GET['label'] : 1; 
						  		if ($label ==  1) echo 'class="active"' ?>>
                              <a href="inbox.php?offset=0"><i class="icon-inbox"></i> Boite de réception 
							  <span class="label label-danger pull-right" id="nb_inbox_nl"><?php if ($_SESSION["inbox_nlu"] > 0) echo $_SESSION["inbox_nlu"]; ?></span></a>

                          </li>
                          <li <?php  
						  		if ($label ==  5) echo 'class="active"' ?>>
                              <a href="inbox.php?label=5"><i class="icon-envelope-alt"></i> Envoyés</a>
                          </li>
                          <li <?php  
						  		if ($label ==  2) echo 'class="active"' ?>>
                              <a href="inbox.php?label=2"><i class="icon-bookmark-empty"></i> Importants
                              <span class="label label-danger pull-right" id="nb_important_nl"><?php if ($_SESSION["important_nlu"] > 0) echo $_SESSION["important_nlu"]; ?></span></a>
                          </li>
                          <li <?php 
						  		if ($label ==  3) echo 'class="active"' ?>>
                              <a href="inbox.php?label=3"><i class="icon-bookmark-empty"></i> Traités
                              <span class="label label-danger pull-right" id="nb_traite_nl"><?php if ($_SESSION["traite_nlu"] > 0) echo $_SESSION["traite_nlu"]; ?></span></a>
                          </li>
                          
                          <li <?php 
						  		if ($label ==  4) echo 'class="active"' ?>>
                              <a href="inbox.php?label=4"><i class=" icon-trash"></i> Corbeille
                              <span class="label label-danger pull-right" id="nb_corbeille_nl"><?php if ($_SESSION["corbeille_nlu"] > 0) echo $_SESSION["corbeille_nlu"]; ?></span></a>
                          </li>
                      </ul>
                      

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>RentMail</h3>
                          <form class="pull-right position" action="inbox.php" method="get">
                              <div class="input-append">
                                  <input type="text"  placeholder="Recherche ..." class="sr-input" name="mots_cles">
                                  <input type="hidden"  name="option" value="chercher_message">
                                  <input type="hidden"  name="label" value="<?php $label = isset( $_GET['label'] ) ? $_GET['label'] : 1; echo $label; ?>">
                                  <button type="submit" class="btn sr-btn"><i class="icon-search"></i></button>
                              </div>
                          </form>
                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">
                             
                             <div class="btn-group">
                                 <a class="btn mini blue" href="#" data-toggle="dropdown">
                                     Déplacer vers
                                     <i class="icon-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                
                                     <li><a id= "action_to_important" href="#" ><i class="icon-bookmark-empty"></i> Importants</a></li>
                                     <li><a id= "action_to_traite" href="#" ><i class="icon-bookmark-empty"></i> Traités</a></li>
                                     <li><a id= "action_to_inbox" href="#" ><i class="icon-inbox"></i> Boite de réception</a></li>
                                     <li><a id= "action_to_envoye" href="#" ><i class="icon-envelope-alt"></i> Envoyés</a></li>
                                    
                                     <li class="divider"></li>
                                     <li><a id= "action_to_corbeille" href="#"><i class="icon-trash"></i> Corbeille</a></li>
                                 </ul>
                             </div>
                             
                             
                             
                             <a id="action_refresh" class="btn btn-primary  btn-sm tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Rafraichir">
                             	<span class="icon-refresh"></span>
                             </a>

                             <ul class="unstyled inbox-pagination">
                             	<?php 
									$offset = isset( $_GET['offset'] ) ? $_GET['offset'] : "0"; //pour la pagination
									$label = isset( $_GET['label'] ) ? $_GET['label'] : 1; 
									$nb_lignes = $_SESSION["nb_lignes"];
									
									//si user est dans page resultat de recherche
									$option = isset( $_GET['option'] ) ? $_GET['option'] : "";
									$mots_cles = isset( $_GET['mots_cles'] ) ? $_GET['mots_cles'] : "";
									$param = "&&option=?1&&mots_cles=?2";
									if($option == "chercher_message"){
										//re envoyer option = chercher_message dans les param get de la requete
										$param = str_replace("?1",$option,$param);
										// et re envoyer les mot cles dans les param get de la requete
										$param = str_replace("?2",$mots_cles,$param);
									}
									else{
										$param = "";
									}
								 ?>
                                 <li><span><?php 
								 $debut = $offset + 1 ;
								 if($nb_lignes == 0)
								 	$debut = 0;
							
								 $fin = $offset +  10 ;
								 
								 if ($nb_lignes < $fin) 
								 	$fin = $nb_lignes;
								 
								 echo $debut . "-" . $fin ."  sur " .$nb_lignes; ?></span></li>
                                 <?php 
									 
									 $offset_next = $offset +  10;
									 $offset_prev = $offset -  10;
									  if ($offset_prev < 0) $offset_prev = 0;
									 
									 if ($offset != 0) { 
									 ?>
                                 <li>
                                     <a href="inbox.php?offset=<?php echo $offset_prev; ?>&&label=<?php echo $label.$param; ?>" class="np-btn"><i class="icon-angle-left  pagination-left"></i></a>
                                 </li>
                                 <?php 
									 }
									 if ($offset_next < $nb_lignes) { 
									 ?>
                                 <li>
                                     <a href="inbox.php?offset=<?php echo $offset_next; ?>&&label=<?php echo $label.$param; ?>" class="np-btn"><i class="icon-angle-right pagination-right"></i></a>
                                 </li>
                                 <?php 
									 }
									
									 ?>
                             </ul>
                             
                         </div>
                          <table class="table table-inbox table-hover">
                            <tbody>
                            <form action="inbox.php" method="get" name="action_form" >
                            <?php
							if($nb_lignes != 0)
								while($ligne=mysql_fetch_row($_SESSION["result"])){
                              
                              ?>
                            
                              <tr class="<?php if (($ligne[4] == 2) && !($ligne[7] == 5) && ($ligne[9] == "IN")) echo 'unread'; ?>" >
                                  <td class="inbox-small-cells">
                                  
                                      <input type="checkbox" class="mail-checkbox" name="idMail[]" value="<?php echo $ligne[0]; ?>">
                                     
                                      
                                  </td>
                                   
                                  <td class="view-message  dont-show " <?php echo "id_msg= '".$ligne[0]."'"; ?>>
								  <?php 
								  	$label = isset( $_GET['label'] ) ? $_GET['label'] : 1; 
									if(($ligne[9] == "OUT") && ($label != 5)) 
										echo "moi"; 
									else 
										echo $ligne[5]." ".$ligne[6]; ?>
                                  </td>
                                  <td class="view-message " <?php echo "id_msg= '".$ligne[0]."'"; ?>><?php echo $ligne[1]; ?></td>
                                  <td class="view-message  inbox-small-cells" <?php echo "id_msg= '".$ligne[0]."'"; ?>><?php if ($ligne[8] == 1) echo '<i class="icon-paper-clip">'; ?></i></td>
                                  <td class="view-message  text-right" <?php echo "id_msg= '".$ligne[0]."'"; ?>><?php echo rdatetime_en($ligne[3]); ?></td>
                              </tr>
                              <?php }
							  else
							  	echo '<p>Vous n\'avez aucun message dans cette rubrique.</p>';
							  
							   ?>
                              
                              <?php
							  	
								if ($offset_next >= $nb_lignes)
									$offset = $offset_prev; //apres deplacement du message, il faut garder l ecran a la meme page, sauf s il etait a la derniere page, on recule de 1
								?>
                               <input type="hidden" name="label" value="<?php $label = isset( $_GET['label'] ) ? $_GET['label'] : 1; echo $label; ?>"/>
                               <input type="hidden" name="offset" value="<?php echo $offset; ?>" />
                               <input type="hidden" name="tolabel" id="tolabel" />
                               <input type="hidden" name="option" value="deplacer_message" />
                                  </form>
                          </tbody>
                          </table>
                      </div>
                  </aside>
              </div>
              <!--mail inbox end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <?php
      	include("footer.php");
      ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

  <!-- BEGIN:File Upload Plugin JS files-->
  <script src="assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
  <!-- The Templates plugin is included to render the upload/download listings -->
  <script src="assets/jquery-file-upload/js/vendor/tmpl.min.js"></script>
  <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
  <script src="assets/jquery-file-upload/js/vendor/load-image.min.js"></script>
  <!-- The Canvas to Blob plugin is included for image resizing functionality -->
  <script src="assets/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="assets/jquery-file-upload/js/jquery.fileupload.js"></script>
  <!-- The File Upload file processing plugin -->
  <script src="assets/jquery-file-upload/js/jquery.fileupload-fp.js"></script>
  <!-- The File Upload user interface plugin -->
  <script src="assets/jquery-file-upload/js/jquery.fileupload-ui.js"></script>


    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <script src="js/inbox/alerte_inbox.js"></script>
    
    <!-- script de la page inbox -->
    <script src="js/inbox/inbox.js"></script>
    
		<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="js/highlight.min.js"></script>
		<script src="js/selectize.js"></script>		
        
        <script >
					

					$('#select-to').selectize({
						persist: false,
						maxItems: null,
						valueField: 'id',
						labelField: 'name',
						searchField: ['name', 'email'],
						options: [
						<?php
							$requete_destinataire = "SELECT membre.id, nom, prenom, membre.email FROM membre, client Where client.id = membre.id_client";
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
					</script>
                    <script>
					var actionModele0 = document.getElementById('modele0');
	
					actionModele0.addEventListener('click', function() {
						$('#corps').val('');
					}, false);
					
					<?php
					
					$requete = "SELECT `id`,`nom`,`corps` FROM `mail_modeles`";
					$result_modele = mysql_query($requete);
					while($ligne=mysql_fetch_row($result_modele)){
						
						$packed = str_replace(CHR(13).CHR(10),"",$ligne[2]); 
					?>
						var actionModele<?php echo $ligne[0]; ?> = document.getElementById('modele<?php echo $ligne[0]; ?>');
						var msg<?php echo $ligne[0]; ?> = '<?php echo addslashes($packed); ?>';
						actionModele<?php echo $ligne[0]; ?>.addEventListener('click', function() {
							$('#corps').val(msg<?php echo $ligne[0]; ?>.replace(/\<br \/\>/g,"\n"));
						}, false);
						
					<?php } ?>
					
					<?php if(isset($_GET["message_erreur"]) || isset($_GET["message_succes"])) {?>	
					$(window).load(function(){
						$('#myModal2').modal('show');
					});
					<?php } ?>
					
					
					</script>
					
                    <script src="js/inbox/refresh_alerte_inbox.js" type="text/javascript"></script>
                    <script src="js/idle_timer.js" type="text/javascript"></script>
                    <script src="js/lockscreen.js" type="text/javascript"></script>

  </body>
</html>
