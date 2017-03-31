<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Projets </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
  <!--menu vertical -->

    <div class="main-panel">
      <?php
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $_SESSION['id'] = htmlspecialchars($_GET['id']);
            $isEdition = true ;
            $page_title = "Details du projet";
            $action = "Update";

        } else {
            $_SESSION['id'] = null;
            $isEdition = false ;
            $page_title = "Nouveau Projet";
            $action = "Insert";
        }
        $page_active = 2;
        ?>
		  
          <!--menu top-->
		   <?php 
			require_once('inc/menu.top.php');

			require_once('bd/Projet.php');
			require_once('bd/connection_bd.php');
            require_once('bd/fonctions.inc.php');
			require_once('bd/CRUD.php');
			$obj_bdd = new CRUD ($bdd);

			$projet = $obj_bdd -> selectProjetById($_SESSION['id']);
            $res = etatProjet($_SESSION['id'], $obj_bdd);
            $totalJour = $res['TOTALJOUR'] ;
			
			$numContrat = ((isset($_POST['numContrat']) && !empty($_POST['numContrat'])) ? htmlspecialchars($_POST['numContrat']) : ((isset($projet) && !empty($projet)) ? $projet -> getNumContrat() : '' ));
			$autoriteContractante = ((isset($_POST['autoriteContractante']) && !empty($_POST['autoriteContractante'])) ? htmlspecialchars($_POST['autoriteContractante']) : ((isset($projet) && !empty($projet)) ? $projet -> getAutoriteContractante() : '' ));
            $description = ((isset($_POST['description']) && !empty($_POST['description'])) ? htmlspecialchars($_POST['description']) : ((isset($projet) && !empty($projet)) ? $projet -> getDescription() : '' ));
            $beneficiaire = ((isset($_POST['beneficiaire']) && !empty($_POST['beneficiaire'])) ? htmlspecialchars($_POST['beneficiaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getBeneficiaire() : '' ));
            $phase = ((isset($_POST['phase']) && !empty($_POST['phase'])) ? htmlspecialchars($_POST['phase']) : ((isset($projet) && !empty($projet)) ? $projet -> getPhase() : '' ));
            $montant = ((isset($_POST['montant']) && !empty($_POST['montant'])) ? htmlspecialchars($_POST['montant']) : ((isset($projet) && !empty($projet)) ? $projet -> getMontant() : '' ));
            $dateReceptionDAO = ((isset($_POST['dateReceptionDAO']) && !empty($_POST['dateReceptionDAO'])) ? htmlspecialchars($_POST['dateReceptionDAO']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateReceptionDAO() : '' ));
            $dateOuverturePlis = ((isset($_POST['dateOuverturePlis']) && !empty($_POST['dateOuverturePlis'])) ? htmlspecialchars($_POST['dateOuverturePlis']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateOuverturePlis() : '' ));
            $dateRapportEvaluation = ((isset($_POST['dateRapportEvaluation']) && !empty($_POST['dateRapportEvaluation'])) ? htmlspecialchars($_POST['dateRapportEvaluation']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateRapportEvaluation() : '' ));
            $datePublicationAttribution = ((isset($_POST['datePublicationAttribution']) && !empty($_POST['datePublicationAttribution'])) ? htmlspecialchars($_POST['datePublicationAttribution']) : ((isset($projet) && !empty($projet)) ? $projet -> getDatePublicationAttribution() : '' ));
            $projetCeContrat = ((isset($_POST['projetCeContrat']) && !empty($_POST['projetCeContrat'])) ? htmlspecialchars($_POST['projetCeContrat']) : ((isset($projet) && !empty($projet)) ? $projet -> getProjetCeContrat() : '' ));
            $approbationAttribuaire = ((isset($_POST['approbationAttribuaire']) && !empty($_POST['approbationAttribuaire'])) ? htmlspecialchars($_POST['approbationAttribuaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationAttribuaire() : '' ));
            $approbationAC = ((isset($_POST['approbationAC']) && !empty($_POST['approbationAC'])) ? $_POST['approbationAC'] : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationAC() : '' ));
            $approbationACGPMP = ((isset($_POST['approbationACGPMP']) && !empty($_POST['approbationACGPMP'])) ? htmlspecialchars($_POST['approbationACGPMP']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationACGPMP() : '' ));
            $approbationMEF = ((isset($_POST['approbationMEF']) && !empty($_POST['approbationMEF'])) ? htmlspecialchars($_POST['approbationMEF']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationMEF() : '' ));
           // $totalJour = ((isset($_POST['totalJour']) && !empty($_POST['totalJour'])) ? htmlspecialchars($_POST['totalJour']) : ((isset($projet) && !empty($projet)) ? $projet -> getTotalJour() : '' ));
           // $inferieur60 = ((isset($_POST['inferieur60']) && !empty($_POST['inferieur60'])) ? htmlspecialchars($_POST['inferieur60']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur60() : '' ));
           // $inferieur90 = ((isset($_POST['inferieur90']) && !empty($_POST['inferieur90'])) ? htmlspecialchars($_POST['inferieur90']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur90() : '' ));
           // $inferieur120 = ((isset($_POST['inferieur120']) && !empty($_POST['inferieur120'])) ? htmlspecialchars($_POST['inferieur120']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur120() : '' ));
           // $superieur120 = ((isset($_POST['superieur120']) && !empty($_POST['superieur120'])) ? htmlspecialchars($_POST['superieur120']) : ((isset($projet) && !empty($projet)) ? $projet -> getSuperieur120() : '' ));
            $inferieur60 = ($totalJour < 60 ) ? 'OUI' : 'NON' ;
            $inferieur90 = ($totalJour < 90 ) ? 'OUI' : 'NON' ;
            $inferieur120 = ($totalJour < 120 ) ? 'OUI' : 'NON' ;
            $superieur120 = ($totalJour > 120 ) ? 'OUI' : 'NON' ;
            
            $commentaire = ((isset($_POST['commentaire']) && !empty($_POST['commentaire'])) ? htmlspecialchars($_POST['commentaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getCommentaire() : '' ));
  			
			if(isset($_POST['action']) && $_POST['action']){
                
                $projet = new Projet ();
                $projet -> setNumContrat($numContrat);
                $projet -> setautoriteContractante($autoriteContractante);
                $projet -> setdescription($description);
                $projet -> setbeneficiaire($beneficiaire);
                $projet -> setphase($phase);
                $projet -> setmontant($montant);
                $projet -> setdateReceptionDAO($dateReceptionDAO);
                $projet -> setdateOuverturePlis($dateOuverturePlis);
                $projet -> setdateRapportEvaluation($dateRapportEvaluation);
                $projet -> setdatePublicationAttribution($datePublicationAttribution);
                $projet -> setprojetCeContrat($projetCeContrat);
                $projet -> setapprobationAttribuaire($approbationAttribuaire);
                $projet -> setapprobationAC($approbationAC);
                $projet -> setapprobationACGPMP($approbationACGPMP);
                $projet -> setapprobationMEF($approbationMEF);
                $projet -> settotalJour($totalJour);
                $projet -> setInferieur60($inferieur60);
                $projet -> setInferieur90($inferieur90);
                $projet -> setInferieur120($inferieur120);
                $projet -> setSuperieur120($inferieur120);
                $projet -> setCommentaire($commentaire);

               // if ($_POST['action']==='Update') {
                   // echo "......update <br/>";
                   // $data_updated = $obj_bdd -> updateProjet($projet) ;

               // } elseif ($_POST['action']==='Insert') {
                  //  echo "......insert <br/>";
                 //   $data_inserted = $obj_bdd -> insertProjet($projet) ;
                // header('location:projet.php');
              //  }		
			}
			
			?>
        <div class="content">
		 <div class="container-fluid" style="margin-left:25%;" >	
		<?php 
			if(isset($data_updated) && ($data_updated == true)){
				 echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span> Les données du projet ont été mise à jour avec succès</strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> Le formulaire a été rechargé avec succès</strong>
						</div>
					</div>
				</div>";
			} elseif(isset($data_inserted) && ($data_inserted == true)) {
                 echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span> Les données du projet ont été inserées avec succès</strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> Le formulaire a été vidé avec succès</strong>
						</div>
					</div>
				</div>";
            }
		?>
		<form role="form" action = 'data.php' method='POST'>
            <div class="col-lg-8 center">
				 <div class="form-group">
                    <label for="numContrat">Numero du contrat</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="numContrat" id="numContrat" placeholder="numero du contrat"   <?php echo"value='$numContrat'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="autoriteContractante">Autorité Contractante</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="autoriteContractante" id="autoriteContractante" placeholder="Autorité Contractante "   <?php echo"value='$autoriteContractante'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Desciption"  <?php echo"value='$description'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label for="beneficiaire">Beneficiaire</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="beneficiaire" id="beneficiaire" placeholder="Beneficiaire"   <?php echo"value='$beneficiaire'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="phase">Phase</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="phase" id="phase" placeholder="Phase"  <?php echo"value='$phase'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="montant">Montant</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="montant" id="montant" placeholder="Montant"   <?php echo"value='$montant'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateReceptionDAO">Date Reception DAO</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dateReceptionDAO" id="dateReceptionDAO"   <?php echo"value='$dateReceptionDAO'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateOuverturePlis">Date Ouverture Plis</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dateOuverturePlis" id="dateOuverturePlis"   <?php echo"value='$dateOuverturePlis'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateRapportEvaluation">Date Rapport Evaluation</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="dateRapportEvaluation" id="dateRapportEvaluation"   <?php echo"value='$dateRapportEvaluation'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datePublicationAttribution">Date Publication Attribution</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="datePublicationAttribution" id="datePublicationAttribution"   <?php echo"value='$datePublicationAttribution'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="projetCeContrat">Projet Ce Contrat</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="projetCeContrat" id="projetCeContrat"   <?php echo"value='$projetCeContrat'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationAttribuaire">Approbation Attribuaire</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="approbationAttribuaire" id="approbationAttribuaire"   <?php echo"value='$approbationAttribuaire'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="approbationAC">Approbation AC</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="approbationAC" id="approbationAC"   <?php echo"value='$approbationAC'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationACGPMP">Approbation ACGPMP</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="approbationACGPMP" id="approbationACGPMP"   <?php echo"value='$approbationACGPMP'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationMEF">Approbation MEF</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="approbationMEF" id="approbationMEF"   <?php echo"value='$approbationMEF'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalJour">Total Jour</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="totalJour" id="totalJour"   <?php echo"value='$totalJour'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inferieur60"> Inferieur 60 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur60" id="inferieur60" placeholder="inferieur 60"  <?php echo"value='$inferieur60'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inferieur90"> Inferieur 90 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur90" id="inferieur90" placeholder="inferieur 90"  <?php echo"value='$inferieur90'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inferieur120"> Inferieur 120 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur120" id="inferieur120" placeholder="inferieur 120"  <?php echo"value='$inferieur120'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="superieur120"> Superieur 120 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="superieur120" id="superieur120" placeholder="superieur 120"  <?php echo"value='$superieur120'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="commentaire" id="commentaire" placeholder="commentaire"  <?php echo"value='$commentaire'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
				<input type ='hidden' name = 'action' <?php echo"value='$action'" ;?> />
                <a <?php echo "href='alertes.php?projet=$_SESSION[id]'"; ?> class="btn btn-info pull-right" style ="margin-left:10px;">Voir l'historique des alertes</a>
                <input type="submit" name="submit" id="submit" value="Retour à la liste " class="btn btn-info pull-right">
               
           
            </div>
        </form>
			
			
			
			
		 </div>
        </div>


       <!--footer -->
	    <?php 
		require_once('inc/footer.inc.php');
		?>

    </div>
</div>

</body>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

 
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
</html>
