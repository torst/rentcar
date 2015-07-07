
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  
                  <aside class="profile-info col-lg-12">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1> Modifier Compte web client</h1>
                              <form class="cmxform form-horizontal" role="form" action="membres/actions_membres.php" id="modifier_membres" method="post"  >
                              <?php
                              //recuperation donnees a partir de la BD
                              include("config.php");
                              $id_membres=$_GET['id_membres'];
                              if(isset($_GET['erreur'])) {$erreur=$_GET['erreur'];} else {$erreur="";}
                              if(isset($_GET['erreur_generale'])) {$erreur_generale=$_GET['erreur_generale'];} else {$erreur_generale="";}
                              if(isset($_GET['erreur_email'])) {$erreur_email=$_GET['erreur_email'];} else {$erreur_email="";}
                              $email=utf8_encode($_GET['email']);
							  $client=utf8_encode($_GET['client']);
                              
                              $query = "SELECT 
									`membre`.`id`,
									`membre`.`email`,
									`statut_membre`.`id`,
									`membre`.`id_client`
									FROM 
									membre, statut_membre
									WHERE
									
									`membre`.`statut` = `statut_membre`.`id`
									 and `membre`.`id`= ".$id_membres;
	
							$result = mysql_query($query);
							$ligne=mysql_fetch_row($result);
							
                              
                              ?>

                                  
                                  <input type="hidden" name ="option" value="update" />
                                  <input type="hidden" name ="id_membres" value="<?php echo $ligne[0]; ?>" />
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
                                    
                                     
                                    
                                  <div class='form-group <?php if(strcmp($erreur_email,"")!=0) echo " has-error";?>' >
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="<?php if(strcmp($erreur,"")==0) echo $ligne[1]; else echo $email; ?>" class="form-control" id="email" name="email" placeholder="Email@email.com" >
                                          <?php if(strcmp($erreur_email,"")!=0) echo " <p class='help-block'>".$erreur_email."</p>";?>
                                      </div>
                                  </div>
                                 
                                  
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Statut</label>
                                      <div class="col-lg-6">
                                          <select class="form-control" name="statut" id="statut">
                                          <?php 
	                                          $query_statut = "SELECT 
													`statut_membre`.`id`,
													`statut_membre`.`nom` 
													
													FROM 
													statut_membre
													";
					
											  $result_statut = mysql_query($query_statut);
	                                          while($ligne_statut=mysql_fetch_row($result_statut)){

                                          ?>
										  <option 
										  <?php if ($ligne[2] == $ligne_statut[0]) echo "selected";?>
										  value="<?php echo $ligne_statut[0]; ?>"><?php echo $ligne_statut[1]; ?></option>
										  
										  <?php 
	                                          }

                                          ?>
										</select>
                                      </div>
                                  </div>
                                  
                                 
                                  
                                  <script>
									$(function() {
										var clients = [
										<?php
											$query_client = "SELECT 
														`client`.`id`,
														`client`.`nom` ,
														`client`.`prenom` ,
														`client`.`numero_pi`,
														`type_pi`.`nom` 
														
														FROM 
															client, type_pi
														WHERE
															client.type_pi =  type_pi.id
														and 
															`client`.`id`= ".$ligne[3];
														$client_vide = 0;
											if(strcmp($ligne[3],"")!=0){
												$client_vide = 1;
												$result_client = mysql_query($query_client);
												$ligne_client=mysql_fetch_row($result_client);
											}
										?>
										<?php 
											//ne remonter que les clients non encore rattaché à un compte membre + le client rattaché au membre actuel
	                                        if($client_vide==1)  
											  	$query_clients = "SELECT 
													`client`.`id`,
													`client`.`nom` ,
													`client`.`prenom` ,
													`client`.`numero_pi`,
													`type_pi`.`nom`
													
													FROM 
													client, type_pi
													WHERE
													client.type_pi =  type_pi.id
													and `client`.`id` not in
													(SELECT `membre`.`id_client` FROM membre WHERE `id_client` IS NOT NULL and `membre`.`id_client`<> ".$ligne[3].")";
											else
												$query_clients = "SELECT 
													`client`.`id`,
													`client`.`nom` ,
													`client`.`prenom` ,
													`client`.`numero_pi`,
													`type_pi`.`nom`
													
													FROM 
													client, type_pi
													WHERE
													client.type_pi =  type_pi.id
													and `client`.`id` not in
													(SELECT `membre`.`id_client` FROM membre WHERE `id_client` IS NOT NULL)";
					
											  $result_clients = mysql_query($query_clients);
	                                          while($ligne_clients=mysql_fetch_row($result_clients)){

                                          ?>
											{
											value: "<?php echo $ligne_clients[0]; ?>",
											label: "<?php echo $ligne_clients[1]." ".$ligne_clients[2]; ?>",
											desc: "<?php echo $ligne_clients[4].": ".$ligne_clients[3]; ?>"
											},
											 <?php 
	                                          }

                                          ?>
											
										];
										$( "#client" ).autocomplete({
											minLength: 0,
											source: clients,
											focus: function( event, ui ) {
											$( "#client" ).val( ui.item.label );
											return false;
											},
										select: function( event, ui ) {
											$( "#client" ).val( ui.item.label );
											$( "#client-id" ).val( ui.item.value );
											$( "#client-description" ).html( ui.item.desc );
											return false;
											}
											})
										.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
											return $( "<li>" )
											.append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
											.appendTo( ul );
										};
									});
								</script>
							
								<div class="ui-widget form-group">
                                    <label  class="col-lg-2 control-label">Fiche client</label>
                                    <div class="col-lg-6">
                                    	<input id="client" class="form-control" value="<?php if($client_vide==1) echo $ligne_client[1]." ".$ligne_client[2]; ?>" type="text"  placeholder="Ecrire une partie du Nom ou Prénom du client">
                                        <input type="hidden" id="client-id" value="<?php if($client_vide==1) echo $ligne_client[0]; ?>" name="client">
                                        <p id="client-description"><?php if($client_vide==1) echo $ligne_client[4]." ".$ligne_client[3]; ?></p>
                                    </div>
                                </div>
                                   
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      	  <a  class=" btn btn-primary  " href="membres.php">Annuler</a>
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
     

      