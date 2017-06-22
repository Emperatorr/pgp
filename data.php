<?php session_start(); ?>
<?php 
 if((!isset($_SESSION['idUser']) || empty($_SESSION['idUser'])) ||
	  (!isset($_SESSION['emailUser']) || empty($_SESSION['emailUser'])) ||
		(!isset($_SESSION['levelUser']) || empty($_SESSION['levelUser']))
   ) {
	   header('location:index.php');
   } else {

?>
<!doctype html>
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
		<style>
			.date_element {
				min-width:55px ;
				max-width:55px ;
				overflow : hidden;
			}
		</style>
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
					<td>Autorite Contractante</td>
					<td>Description du Contrat</td>
					<td>Source du Financement</td>
					<td>Type de Procedures</td>
					<td class='date_element'>Creation du DAO</td>
					<td class='date_element'>Date ANO sur DAO</td>
					<td class='date_element'>Date Publication DAO</td>
					<td class='date_element'>Date Ouverture des Plis</td>
					<td class='date_element'>Date Rapport Evaluation</td>
					<td class='date_element'>Date ANO sur Rapport Evaluation</td>
					<td class='date_element'>Date Notif Provisoire</td>
					
					<td class='date_element'>Date Reception et Negociation Projet Contrat</td>
					<td class='date_element'>Date ANO Projet Contrat</td>
					<td>Attribuaire</td>
					<td class='date_element'>Date Signature Attributaire</td>
					<td>Montant</td>
					<td class='date_element'>Date Signature AC</td>
					<td class='date_element'>Date Signature ACGPMP</td>
					<td class='date_element'>Date Signature MEF</td>
					<td class='date_element'>Date Enregistrement Impots</td>
					<td class='date_element'>Date Immatriculation</td>
					<td>Total Jrs</td>

					<td>Etat</td>
					<td>Editer</td>
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
								<td>".$projet -> getDescription()."</td>
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
								<td>".$projet -> getapprobationMEF()."</td>
								<td>".$projet -> getEnregistrementImpots()."</td>
								<td>".$projet -> getImmatriculation()."</td>
								<td>".$totalJour."</td>
								<td class ='$class' title ='$title'>".$msg."</td>
								<td><a href='projet.php?id=$id'> Editer </a></td>
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
<?php 
   }
 ?>
