<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="index.php">
                          <i class="icon-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <?php
						if(isset($_SESSION["reservations"])){ 
					?>
                  <li>
                      <a  href="reservations.php">
                          <i class=" icon-shopping-cart"></i>
                          <span>RESERVATIONS</span>
                      </a>
                  </li>
                  <?php
						}
					?>
          <?php
            if(isset($_SESSION["locations"])){ 
          ?>
                  <li>
                      <a  href="locations.php">
                          <i class="  icon-file-text-alt"></i>
                          <span>LOCATIONS</span>
                      </a>
                  </li>
                  <?php
            }
          ?>
                  
                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" icon-user"></i>
                          <span>CLIENTS</span>
                      </a>
                      <ul class="sub">
                       <?php
						if(isset($_SESSION["clients"])){ 
					?>
                          <li><a  href="clients.php">Fiches Clients</a></li>
                          <?php
						}
					?>
                    <?php
						if(isset($_SESSION["membres"])){ 
					?>
                          <li><a  href="membres.php">Comptes du web</a></li>
                          <?php
						}
					?>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" icon-envelope-alt"></i>
                          <span>MESSAGERIE</span>
                          <span id="menu_nb_msg" class="label label-danger pull-right mail-info"></span>
                      </a>
                      <ul class="sub">
                       <?php
						if(isset($_SESSION["mails"])){ 
					?>
                          <!--<li><a  href="mails.php">Inbox</a></li>-->
                          <li>
                          	<a  href="inbox.php">
                          		Inbox
                          	</a>
                          </li>
                          <?php
						}
					?>
                    <?php
						if(isset($_SESSION["mail_modeles"])){ 
					?>
                          <li><a  href="mail_modeles.php">Modèles de message</a></li>
                          <?php
						}
					?>
                          
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-truck"></i>
                          <span>FLOTTE</span>
                      </a>
                      <ul class="sub">
                      <?php
						if(isset($_SESSION["categories"])){ 
					?>
                          <li><a  href="categories.php">Catégories</a></li>
                          <?php
						}
					?>
                          <?php
						if(isset($_SESSION["marque_vehicules"])){ 
					?>
                          <li><a  href="marques.php">Marques</a></li>
                          <?php
						}
					?>
                         
                    	<li class="sub-menu">
                              <a  href="#">Modèles</a>
                              <ul class="sub">
	                               
                                    <?php
										if(isset($_SESSION["modele_vehicules"])){ 
									?>
										  <li><a  href="modeles.php">Mes Modèles</a></li>
									<?php
										}
									?>
                                    <?php
										if(isset($_SESSION["composants"])){ 
									?>
                                  	<li><a  href="composants.php">Composants</a></li>
                                  	<?php
										}
									?>
                              </ul>
                          </li>
                          <li class="sub-menu">
                              <a  href="#">Véhicules</a>
                              <ul class="sub">
	                               
                                    <?php
										if(isset($_SESSION["vehicules"])){ 
									?>
										  <li><a  href="vehicules.php">Mes Véhicules</a></li>
									<?php
										}
									?>
                                    <?php
										if(isset($_SESSION["statuts_vehicule"])){ 
									?>
                                  	<li><a  href="statuts_vehicule.php">Statuts véhicule</a></li>
                                  	<?php
										}
									?>
                              </ul>
                          </li>
                      </ul>
                  </li>
                 <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-paper-clip"></i>
                          <span>EQUIPEMENTS</span>
                      </a>
                      <ul class="sub">
                       <?php
						if(isset($_SESSION["services"])){ 
					?>
                          <li><a  href="services.php">Services</a></li>
                          <?php
						}
					?>
                    <?php
						if(isset($_SESSION["options"])){ 
					?>
                          <li><a  href="options.php">Options</a></li>
                          <?php
						}
					?>
                          
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-tag"></i>
                          <span>PROMOTIONS</span>
                      </a>
                      <ul class="sub">
                       <?php
							if(isset($_SESSION["modele_promotions"])){ 
						?>
							  <li><a  href="modele_promotions.php">Modèle</a></li>
							  <?php
							}
						?>
						<?php
							if(isset($_SESSION["categorie_promotions"])){ 
						?>
							  <li><a  href="categorie_promotions.php">Catégorie</a></li>
							  <?php
							}
						?>
						<?php
							if(isset($_SESSION["option_modele_promotions"])){ 
						?>
							  <li><a  href="option_modele_promotions.php">Option Modèle</a></li>
							  <?php
							}
						?>
						<?php
							if(isset($_SESSION["option_categorie_promotions"])){ 
						?>
							  <li><a  href="option_categorie_promotions.php">Option Catégorie</a></li>
							  <?php
							}
						?>
                        <?php
							if(isset($_SESSION["service_modele_promotions"])){ 
						?>
							  <li><a  href="service_modele_promotions.php">Service Modèle</a></li>
							  <?php
							}
						?>
						<?php
							if(isset($_SESSION["service_categorie_promotions"])){ 
						?>
							  <li><a  href="service_categorie_promotions.php">Service Catégorie</a></li>
							  <?php
							}
						?>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-instagram"></i>
                          <span> LOCAUX</span>
                      </a>
                      <ul class="sub">
                       <?php
						if(isset($_SESSION["agences"])){ 
					?>
                          <li><a  href="agences.php">Agences</a></li>
                          <?php
						}
					?>
                    <?php
						if(isset($_SESSION["villes"])){ 
					?>
                          <li><a  href="villes.php">Villes</a></li>
                          <?php
						}
					?>
                          <?php
						if(isset($_SESSION["pays"])){ 
					?>
                          <li><a  href="pays.php">Pays</a></li>
                          <?php
						}
					?>
                      </ul>
                  </li>
					
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-folder-open"></i>
                          <span> DOSSIER WEB</span>
                      </a>
                      <ul class="sub">
                      <?php
						if(isset($_SESSION["entreprise"])){ 
					?>
                          <li><a  href="entreprise.php">Entreprise</a></li>
                          <?php
						}
					?>
                       <?php
						if(isset($_SESSION["pages"])){ 
					?>
                          <li><a  href="pages.php">Pages web</a></li>
                          <?php
						}
					?>
                          <?php
						if(isset($_SESSION["articles"])){ 
					?>
                          <li><a  href="articles.php">Articles</a></li>
                          <?php
						}
					?>
                    <?php
						if(isset($_SESSION["images"])){ 
					?>
                          <li><a  href="images.php">Galerie d'images</a></li>
                          <?php
						}
					?>
                          <li class="sub-menu">
                              <a  href="#">Commerce Pub</a>
                              <ul class="sub">
	                               <?php
										if(isset($_SESSION["types_baniere"])){ 
									?>
                                  	<li><a  href="type_baniere.php">Types banières</a></li>
                                  	<?php
										}
									?>
                                    <?php
										if(isset($_SESSION["banieres"])){ 
									?>
                          			<li><a  href="banieres.php">Banières</a></li>
                                    <?php
										}
									?>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  
                  <?php
						if(isset($_SESSION["utilisateurs"])){ 
					?>
                  <li>
                      <a  href="agents.php">
                          <i class="icon-group"></i>
                          <span>AGENTS</span>
                      </a>
                  </li>
                  <?php
						}
					?>
                  
                  
                  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-tasks"></i>
                          <span>Form Stuff</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                          <li><a  href="advanced_form_components.html">Advanced Components</a></li>
                          <li><a  href="form_wizard.html">Form Wizard</a></li>
                          <li><a  href="form_validation.html">Form Validation</a></li>
                          <li><a  href="dropzone.html">Dropzone File Upload</a></li>
                          <li><a  href="inline_editor.html">Inline Editor</a></li>
                          <li><a  href="image_cropping.html">Image Cropping</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                          <li><a  href="dynamic_table.html">Dynamic Table</a></li>
                          <li><a  href="advanced_table.html">Advanced Table</a></li>
                          <li><a  href="editable_table.html">Editable Table</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="inbox.html">
                          <i class="icon-envelope"></i>
                          <span>Mail </span>
                          <span class="label label-danger pull-right mail-info">2</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" icon-bar-chart"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                          <li><a  href="flot_chart.html">Flot Charts</a></li>
                          <li><a  href="xchart.html">xChart</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-shopping-cart"></i>
                          <span>Shop</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="product_list.html">List View</a></li>
                          <li><a  href="product_details.html">Details View</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="google_maps.html" >
                          <i class="icon-map-marker"></i>
                          <span>Google Maps </span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-glass"></i>
                          <span>Extra</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                          <li><a  href="profile.html">Profile</a></li>
                          <li><a  href="invoice.html">Invoice</a></li>
                          <li><a  href="search_result.html">Search Result</a></li>
                          <li><a  href="404.html">404 Error</a></li>
                          <li><a  href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="login.html">
                          <i class="icon-user"></i>
                          <span>Login Page</span>
                      </a>
                  </li>

                  <!--multi level menu start-->
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="icon-sitemap"></i>
                          <span>Multi level Menu</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="javascript:;">Menu Item 1</a></li>
                          <li class="sub-menu">
                              <a  href="boxed_page.html">Menu Item 2</a>
                              <ul class="sub">
                                  <li><a  href="javascript:;">Menu Item 2.1</a></li>
                                  <li class="sub-menu">
                                      <a  href="javascript:;">Menu Item 3</a>
                                      <ul class="sub">
                                          <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                          <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>