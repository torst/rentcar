	<?php
		  //recuperation donnees a partir de la BD
		  include("config.php");
		  $id_agent=$_SESSION['id'];
		  $query = "SELECT 
				
				`profil_agent`.`nom`,
				`statut_agent`.`nom`
				
				FROM 
				agent,profil_agent,statut_agent
				WHERE
				`agent`.`profil` = `profil_agent`.`id`
				and `agent`.`statut` = `statut_agent`.`id`
				and `agent`.`id`= ".$id_agent;
	
		$result = mysql_query($query);
		$ligne=mysql_fetch_row($result);
		  
		  ?>
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="<?php echo $_SESSION["avatar"]; ?>" alt="">
                              </a>
                              <h1><?php echo $_SESSION["nom"]." ".$_SESSION["prenom"]; ?></h1>
                              <p><?php echo $_SESSION["email"]; ?></p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="profile.php?action=detail"> <i class="icon-user"></i> Profile</a></li>
                              
                              <li><a href="profile.php?action=modifier"> <i class="icon-edit"></i> Modifier profile</a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      
                      <section class="panel">
                          <div class="bio-graph-heading">
                              Votre Compte
                          </div>
                          <div class="panel-body bio-graph-info">
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
                              
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Nom </span>: <?php echo $_SESSION["nom"]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Prénom </span>: <?php echo $_SESSION["prenom"]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Login </span>: <?php echo $_SESSION["login"]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email</span>: <?php echo $_SESSION["email"]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Type de compte </span>: <?php echo $ligne[0]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Statut </span>: <?php echo $ligne[1]; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: <?php echo $_SESSION["telephone"]; ?></p>
                                  </div>
                                  
                              </div>
                          </div>
                      </section>
                      
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
