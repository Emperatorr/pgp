﻿<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tableau de bord</title>

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
    <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">

  <!--menu vertical -->
  <?php 
	$page_title = 'Table des données';
	$page_active = 2;
  ?>

    <div class="main-panel">
    
		  <!--menu top-->
		   <?php 
			require_once('inc/menu.top.php');
			?>

     <div class="content">
		  <div class="container-fluid" style ="max-width:100%; overflow-x: scroll;">
			<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<td>Aut. Contractante</td>
					<td>S. Financement</td>
					<td>Type</td>
					<td>Reception DAO</td>
					<td>ANO sur DAO</td>
					<td>Publication DAO</td>
					<td>Ouverture Plis</td>
					<td>Rap. Eval.</td>
					<td>ANO sur Rap. Eval.</td>
					<td>Notif Prov.</td>
					
					<td>Nego. Contrat</td>
					<td>ANO Projet de Contrat</td>
					<td>Attribuaire</td>
					<td>App. Attribuaire</td>
					<td>Montant</td>
					<td>App. AC</td>
					<td>App. ACGPMP</td>
					<td>App. MEF</td>
					<td>Total Jrs</td>

					<td>Etat</td>
					<td>Alertes</td>

				</tr>
			</thead>
			<tbody>
			<?php
				require_once('bd/Projet.php');
				require_once('bd/connection_bd.php');
				require_once('bd/CRUD.php');
				require_once('bd/fonctions.inc.php');
				$obj_bdd = new CRUD ($bdd);
				
				$results = $obj_bdd -> selectProjetAll();
				
				if($results != null){
					foreach ($results AS $projet){
						$id = $projet -> getIdProjet();
						$res = etatProjet($id, $obj_bdd);
						$totalJour  = (int) totalJour($id, $obj_bdd);
						
						 $class = 'ok';
						 $msg = 'OK' ;
						 $title = "Ce projet est dans les normes" ;
						if ($res['DEPASSE'] == true) {
							$class = 'depasser';
							$msg = 'DEPASSE' ;
							$title = $res['MESSAGE'] ;
						} elseif ($res['ALERT'] == true) {
							$class = 'alert';
							$msg = 'A RISQUE' ;
							$title = $res['MESSAGE'] ;
						}

						echo "
							<tr>
								<td>".$projet -> getAutoriteContractante()."</td>
								<td>".$projet -> getSourceFinancement()."</td>
								<td>".$projet -> getTypeProcedure()."</td>
								<td>".$projet -> getDateReceptionDAO()."</td>
								<td>".$projet -> getDateAnoSurDAO()."</td>
								<td>".$projet -> getDatePublicationDAO()."</td>
								<td>".$projet -> getDateOuverturePlis()."</td>
								<td>".$projet -> getDateRapportEvaluation()."</td>
								<td>".$projet -> getDateAnoSurRapEval()."</td>
								<td>".$projet -> getDateNotifProvisoir()."</td>
								
								<td>".$projet -> getprojetNegoContrat()."</td>
								<td>".$projet -> getDateAnoProjetContrat()."</td>
								<td>".$projet -> getAttribuaire()."</td>
								<td>".$projet -> getApprobationAttribuaire()."</td>
								<td>".$projet -> getMontant()."</td>
								<td>".$projet -> getApprobationAC()."</td>
								<td>".$projet -> getApprobationACGPMP()."</td>
								<td>".$projet -> getApprobationMEF()."</td>
								<td>".$totalJour."</td>
								<td class ='$class' title ='$title'>".$msg."</td>
								<td><a href='alertes.php?projet=$id'> Voir </a></td>
							</tr>
						";
					}
				}
			
			?>
			
			  </tbody>
			</table>
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
    <script src="assets/js/jquery-1.12.4.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src=""></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script type="text/javascript" >
		$(document).ready(function() {
			$('#table').DataTable();
		} );
	</script>
</html>
