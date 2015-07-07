<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
              <div class="alert alert-block alert-danger fade in">
                  
                  <strong>Attention ! </strong> 
                  Ne pas modifier ce contenu sans la consultation de l'éditeur du logiciel. Une mauvaise configuration induit certainement à un dysfonctionnement de votre site web publique.
              </div>
                  <header class="panel-heading">
                      Liste des types des banières
                  </header>
                  <div class="panel-body">
                      <div class="adv-table editable-table ">
                          <div class="clearfix">
                          		<?php
									if(isset($_SESSION["ajouter_type_baniere"])){ 
								?>
                              <div class="btn-group">
                              <!--le lien est dans le fichier editable-table-type_baniere.js dans l evenement onclick-->
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
                                  <th>Nom</th>
                                  <th>Taille</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              
                              $query = "SELECT 
									`type_baniere`.`id`,
									`type_baniere`.`nom`,
									`type_baniere`.`taille`
									FROM 
									type_baniere
									";
	
							$result = mysql_query($query);
							while($ligne=mysql_fetch_row($result)){
                              
                              ?>
                              <tr class="" id="<?php echo $ligne[0]; ?>">
                                  <td ><?php echo $ligne[1]; ?></td>
                                  <td ><?php echo $ligne[2]; ?></td>
                                  <td>
                                  <?php
										if(isset($_SESSION["zoom_type_baniere"])){ 
									?>
                                  	<a id="detail" class=" btn btn-primary  btn-xs" href="type_baniere.php?action=detailler&&id_type_baniere=<?php echo $ligne[0]; ?>">
                                  		<i class="  icon-zoom-in"></i>
                                  	</a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["modifier_type_baniere"])){ 
									?>
                                  	<a id="remove-all" class=" btn btn-warning  btn-xs" href="type_baniere.php?action=modifier&&id_type_baniere=<?php echo $ligne[0]; ?>"><i class=" icon-edit"></i></a>
                                    <?php
										}
									?>
                                    <?php
										if(isset($_SESSION["supprimer_type_baniere"])){ 
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
    <script src="js/type_baniere/advanced-multiselect.js"></script>