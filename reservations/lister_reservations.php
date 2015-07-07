<?php

function custom_request($nom, $type, $valeur, $operateur){
  $resultat = "";
  if ($type == "TEXTE")
    if ($valeur <> ""){
      if ($operateur == "1")
        $resultat = " and ".$nom." like '%".$valeur."%'";
      if ($operateur == "4")
        $resultat = " and ".$nom." = '".$valeur."'";
      }

  if ($type == "NOMBRE")
    if ($valeur <> ""){
      if ($operateur == "2")
        $resultat = " and ".$nom." >".$valeur."";
      if ($operateur == "3")
        $resultat = " and ".$nom." < ".$valeur."";
      if ($operateur == "4")
        $resultat = " and ".$nom." = ".$valeur."";
      }

  if ($type == "DATE")
    if ($valeur <> ""){
      if ($operateur == "2")
        $resultat = " and ".$nom." > str_to_date('".$valeur."','%d/%m/%Y')";
      if ($operateur == "3")
        $resultat = " and ".$nom." < str_to_date('".$valeur."','%d/%m/%Y')";
      if ($operateur == "4")
        $resultat = " and DATE_FORMAT( r.".$nom.", '%d/%m/%Y' )  = '".$valeur."'";
      }


  return $resultat;

}
?>
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Liste des réservations
                  </header>
                  <div class="panel-body">
                  <div class="clearfix">
                    <?php
                    include("config.php");
                    ?>
                          		<?php
									if(isset($_SESSION["ajouter_reservations"])){ 
								?>
                              <div class="btn-group">
                              <!--le lien est dans le fichier editable-table-vehicules.js dans l evenement onclick-->
                                  <button id="editable-sample_new" class="btn green">
                                      Ajouter <i class="icon-plus"></i>
                                  </button>
                              </div>
                              <div class="btn-group">
                                  <button id="btn_advanced_search" class="btn green">
                                      Recherche Avancée <i class="icon-caret-down"></i>
                                  </button>
                              </div>
                              <?php
									}
								?>
                              <div class="btn-group pull-right">
                                  <button class="btn dropdown-toggle" data-toggle="dropdown">Outils <i class="icon-angle-down"></i>
                                  </button>
                                  <ul class="dropdown-menu pull-right">
                                      <li><a href="#">Imprimer</a></li>
                                      <li><a href="#">Enregistrer PDF</a></li>
                                      <li><a href="#">Exporter Excel</a></li>
                                  </ul>
                              </div>
                          </div>
                  </div>
              </section>
              <section class="panel" id="advanced_search">
                  <header class="panel-heading">
                      Recherche avancée
                  </header>
                  <div class="panel-body">
                  <div>
                          	<form class="form-horizontal" role="form" name="recherche_avancee" id="recherche_avancee" method="POST" action="reservations.php">
                              
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Date Création</label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_date_creation" name = "operateur_date_creation" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="2">Supérieur à</option>
                                            <option value="3">Inférieur à</option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <input type="text" value="" class="form-control dp1" id="date_recherche_creation" name="date_recherche_creation" placeholder=" " >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Date début</label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_date_debut" name = "operateur_date_debut" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="2">Supérieur à</option>
                                            <option value="3">Inférieur à</option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <input type="text" value="" class="form-control dp1" id="date_recherche_debut" name="date_recherche_debut" placeholder=" " >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Date fin </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_date_fin" name = "operateur_date_fin" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="2">Supérieur à</option>
                                            <option value="3">Inférieur à</option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <input type="text" value="" class="form-control dp1" id="date_recherche_fin" name="date_recherche_fin" placeholder=" " >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut réservation </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_statut" name = "operateur_statut" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <select class="form-control" name="statut_reservation" id="statut_reservation"> <option value=""> </option>
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
                                      <label  class="col-lg-2 control-label">Origine </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_origine" name = "operateur_origine" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <select class="form-control" name="origine_reservation" id="origine_reservation"><option value=""></option>
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
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut paiement </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_statut_paiement" name = "operateur_statut_paiement" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                           <select class="form-control" name="statut_paiement" id="statut_paiement"><option value=""></option>
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
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Mode de paiement </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_mode_paiement" name = "operateur_mode_paiement" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                           <select class="form-control" name="mode_paiement" id="mode_paiement"><option value=""></option>
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
                                  </div>

                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Montant</label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_montant" name = "operateur_montant" placeholder="" >
                                            <option value="99"></option>
                                            <option value="2">Supérieur à</option>
                                            <option value="3">Inférieur à</option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <input type="text" value="" class="form-control " id="montant" name="montant" placeholder=" Exemple: 100.23 " >
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Client </label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_client" name = "operateur_client" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                           <select name ="client" id ="client" placeholder="Sélectionner un client..."></select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Modele</label>
                                      <div class="col-lg-3">
                                          <select  value="" class="form-control" id="operateur_modele" name = "operateur_modele" placeholder=" " >
                                            <option value="99"></option>
                                            <option value="4">Egale à</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-3">
                                          <select name ="modele" id ="modele" placeholder="Sélectionner un modele..."></select>
                                      </div>
                                  </div>
                                  <input type="hidden" name = "advanced_query" value="salzak" />

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <button  class=" btn btn-primary  " type="reset">Effacer</button>
                                          <button  class=" btn btn-warning  " type="submit">Rechercher</button>
                                        
                                      </div>
                                  </div>
                                 
                              </form>
                          </div>
                  </div>
              </section>
              <section class="panel">
                  <div class="panel-body">
                  	
                      <div class="adv-table editable-table ">
                          
                          
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Client</th>
                                  <th>Créée le</th>
                                  <th>Origine</th>
                                  <th>Statut</th>
                                  <th>Début</th>
                                  <th>Fin</th>
                                  <th>Paiement</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>


                              <?php

                              $query = "SELECT 
                                r.id,
                                c.nom,
                                c.prenom,
                                DATE_FORMAT(r.date_creation, '%d/%m/%Y'),
                                o.libelle,
                                sr.libelle,
                                DATE_FORMAT(r.date_depart, '%d/%m/%Y'),
                                DATE_FORMAT(r.date_retour, '%d/%m/%Y'),
                                sp.libelle,
                                c.type,
                                c.raison_social,
                                m.email
                                FROM
                                reservation as r
                                LEFT JOIN client as c ON r.client = c.id
                                LEFT JOIN origine_reservation as o ON r.origine = o.id
                                LEFT JOIN statut_reservation as sr ON r.statut_reservation = sr.id
                                LEFT JOIN statut_paiement as sp ON r.statut_paiement = sp.id
                                LEFT JOIN membre as m ON  m.id_client = c.id
                                
                                WHERE
                                1

                                  ";
  

                              //test recup var post
                              if(isset($_POST["advanced_query"])){
                               //preparation requete
                                /*$nom = "date_creation";
                                $type = "DATE";
                                $valeur = $_POST["date_recherche_creation"];
                                $operateur = $_POST["operateur_date_creation"];*/
                                $query = $query.custom_request("date_creation", "DATE", $_POST["date_recherche_creation"], $_POST["operateur_date_creation"]);
                                $query = $query.custom_request("date_depart", "DATE", $_POST["date_recherche_debut"], $_POST["operateur_date_debut"]);
                                $query = $query.custom_request("date_retour", "DATE", $_POST["date_recherche_fin"], $_POST["operateur_date_fin"]);

                                $query = $query.custom_request("statut_reservation", "NOMBRE", $_POST["statut_reservation"], $_POST["operateur_statut"]);
                                $query = $query.custom_request("origine", "NOMBRE", $_POST["origine_reservation"], $_POST["operateur_origine"]);
                                $query = $query.custom_request("statut_paiement", "NOMBRE", $_POST["statut_paiement"], $_POST["operateur_statut_paiement"]);

                                $query = $query.custom_request("type_paiement", "NOMBRE", $_POST["mode_paiement"], $_POST["operateur_mode_paiement"]);
                                $query = $query.custom_request("montant_a_payer", "NOMBRE", $_POST["montant"], $_POST["operateur_montant"]);
                                $query = $query.custom_request("client", "NOMBRE", $_POST["client"], $_POST["operateur_client"]);
                                $query = $query.custom_request("modele", "NOMBRE", $_POST["modele"], $_POST["operateur_modele"]);


                                echo "Résultat de votre recherche. <a href='reservations.php'>Cliquez ici pour TOUT afficher</a>";
                               
                                }
                                //pour une bonne xp user, voir comment garder resultat recherche dans tableau
                              
                              //recuperation donnees a partir de la BD
                              
                              
                              $query = $query."  ORDER BY r.date_creation DESC ";
	
							$result = mysql_query($query);
							while($ligne=mysql_fetch_row($result)){
                              
                              ?>
                              <tr class="" id="<?php echo $ligne[0]; ?>">
                              	  <td ><?php echo $ligne[0]; ?></td>
                              	  <td ><span data-original-title="<?php if($ligne[9] == "1") echo "Type : Particulier"; else echo $ligne[10]; ?>" data-content="<?php echo $ligne[11]; ?>" data-placement="right" data-trigger="hover" class="popovers"><?php echo $ligne[1]." ".$ligne[2]; ?></span></td>
                                  <td ><?php echo $ligne[3]; ?></td>
                                  <td ><?php echo $ligne[4]; ?></td>
                                  <td >
									  <?php 
									  	$label_bouton = "primary";
									  	if($ligne[5] == "Validée")
											$label_bouton = "success";
										if($ligne[5] == "Refusée")
											$label_bouton = "danger";
                                      	echo '<span class="label label-'.$label_bouton.' label-mini">'.$ligne[5].'<span>'; 
                                      ?>
                                  </td>
                                  <td ><?php echo $ligne[6]; ?></td>
                                  <td ><?php echo $ligne[7]; ?></td>
                                  <td ><?php echo $ligne[8]; ?></td>
                                  
                                  <td>
                                  <?php
										if(isset($_SESSION["zoom_reservations"])){ 
									?>
                                  	<a id="detail" class=" btn btn-primary  btn-xs" href="reservations.php?action=detailler&&id_reservation=<?php echo $ligne[0]; ?>">
                                  		<i class="  icon-zoom-in"></i>
                                  	</a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["modifier_reservations"])){ 
									?>
                                  	<a id="remove-all" class=" btn btn-warning  btn-xs" href="reservations.php?action=modifier&&id_reservation=<?php echo $ligne[0]; ?>"><i class=" icon-edit"></i></a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["supprimer_reservations"])){ 
									?>
                                  	<a id="remove-all" class="delete btn btn-danger  btn-xs" href="javascript:;"><i class=" icon-trash"></i></a>
                                    <?php
										}
									?>
                                  </td>
                                  
                              </tr>
                              
                              <?php } ?>
                              
                              </tbody>
                          </table>
                      </div>
                      		<!-- Modal -->
                              <div class="modal fade" id="okDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Modal Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              Body goes here...

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>
<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  		<script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script src="js/reservations/advanced-multiselect.js"></script>
    

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
          
          </script>