<nav class="navbar navbar-default navbar-fixed navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
						<?php
							echo ((isset($page_title) && !empty($page_title)) ? $page_title : 'Tableau de bord');
						?>
					</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="data.php">
                                Liste
                            </a>
                        </li>
                        <li>
                            <a href="import.php">
                                Importer
                            </a>
                        </li>
						 <li>
                            <a href="chart.php">
                                graphes
                            </a>
                        </li>
						 <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Mon compte
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="compte.php">Mes infos</a></li>
                                <li><a href="change_passwd.php">Changer de mot de passe</a></li>
                                <li><a href="deconnection.php">Deconnection</a></li>
                               </ul>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>