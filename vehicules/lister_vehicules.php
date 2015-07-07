<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      Liste des véhicules
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                          		<?php
									if(isset($_SESSION["ajouter_vehicules"])){ 
								?>
                              <div class="btn-group">
                              <!--le lien est dans le fichier editable-table-vehicules.js dans l evenement onclick-->
                                  <button id="editable-sample_new" class="btn green">
                                      Ajouter <i class="icon-plus"></i>
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
                          <div class="space15"></div>
                          <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                  <th>Matricule</th>
                                  <th>Modèle</th>
                                  <th>Statut</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              
                              $query = "SELECT 
									`vehicule`.`id`,
									`vehicule`.`matricule`,
									`modele_vehicule`.`nom`,
									`statut_vehicule`.`nom`
									FROM 
									vehicule, modele_vehicule,statut_vehicule
									WHERE
									`vehicule`.`modele` = `modele_vehicule`.`id`
									and
									`vehicule`.`statut` = `statut_vehicule`.`id`
									
									";
	
							$result = mysql_query($query);
							while($ligne=mysql_fetch_row($result)){
                              
                              ?>
                              <tr class="" id="<?php echo $ligne[0]; ?>">
                                  <td ><?php echo $ligne[1]; ?></td>
                                  <td ><?php echo $ligne[2]; ?></td>
                                  <td ><?php echo $ligne[3]; ?></td>
                                  <td>
                                  <?php
										if(isset($_SESSION["zoom_vehicules"])){ 
									?>
                                  	<a id="detail" class=" btn btn-primary  btn-xs" href="vehicules.php?action=detailler&&id_vehicules=<?php echo $ligne[0]; ?>">
                                  		<i class="  icon-zoom-in"></i>
                                  	</a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["modifier_vehicules"])){ 
									?>
                                  	<a id="remove-all" class=" btn btn-warning  btn-xs" href="vehicules.php?action=modifier&&id_vehicules=<?php echo $ligne[0]; ?>"><i class=" icon-edit"></i></a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["supprimer_vehicules"])){ 
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
    <script src="js/vehicules/advanced-multiselect.js"></script>