<?php session_start(); ?>
<?php 
 if((!isset($_SESSION['idUser']) || empty($_SESSION['idUser'])) ||
	  (!isset($_SESSION['emailUser']) || empty($_SESSION['emailUser'])) ||
		(!isset($_SESSION['levelUser']) || empty($_SESSION['levelUser']))
		// || (!isset($_SESSION['levelUser']) != 5)

   ) {
	   header('location:data.php');
   } else {

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Rapport des projets</title>

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
	$page_title = 'Rapports';
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
					<td class='date_element'>Ex. Creation du DAO</td>
					<td class='date_element'>Ex. Date ANO sur DAO</td>
					<td class='date_element'>Ex. Date Publication DAO</td>
					<td class='date_element'>Ex. Date Ouverture des Plis</td>
					<td class='date_element'>Ex. Date Rapport Evaluation</td>
					<td class='date_element'>Ex. Date ANO sur Rapport Evaluation</td>
					<td class='date_element'>Ex. Date Notif Provisoire</td>
					
					<td class='date_element'>Ex. Date Reception et Negociation Projet Contrat</td>
					<td class='date_element'>Ex. Date ANO Projet Contrat</td>
					<td class='date_element'>Ex. Date Signature Attributaire</td>
					<td class='date_element'>Ex. Date Signature AC</td>
					<td class='date_element'>Ex. Date Signature ACGPMP</td>
					<td class='date_element'>Ex. Date Signature MEF</td>
					<td class='date_element'>Ex. Date Enregistrement Impots</td>
					<td class='date_element'>Ex. Date Immatriculation</td>
					<td>Total Jrs</td>
          <td>Total Excedent</td>
          <td>Graphes</td>
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
						$totalJour  = (int) totalJour($id, $obj_bdd);

            $cl_dao_recep = ($projet -> getDateReceptionDAOEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_ano_dao = ($projet -> getDateAnoSurDAOEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_pub_dao = ($projet -> getDatePublicationDAOEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_ouv = ($projet -> getDateOuverturePlisEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_rapp = ($projet -> getDateRapportEvaluationEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_ano_rapp = ($projet -> getDateAnoSurRapEvalEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_notif = ($projet -> getDateNotifProvisoirEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_nego = ($projet ->getprojetNegoContratEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_date_ano = ($projet ->getDateAnoProjetContratEx () > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_app_attr = ($projet ->getApprobationAttribuaireEx () > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_app_ac = ($projet -> getApprobationACEx() > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_app_acgpmp = ($projet ->getApprobationACGPMPEx () > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_app_mef = ($projet -> getapprobationMEFEx () > 0) ? 'txt_depasser' : 'txt_non_depasser' ;
            $cl_enreg = ($projet ->getEnregistrementImpotsEx () > 0) ? 'txt_depasser' : 'txt_non_depasser' ;

            $totalExcedent = $projet -> getDateReceptionDAOEx() + 
                            $projet -> getDateAnoSurDAOEx() +
                            $projet -> getDateOuverturePlisEx() +
                            $projet -> getDateRapportEvaluationEx() +
                            $projet -> getDateAnoSurRapEvalEx() +
                            $projet -> getDateNotifProvisoirEx() +
                            $projet ->getprojetNegoContratEx() +
                            $projet ->getDateAnoProjetContratEx () +
                            $projet ->getApprobationAttribuaireEx () +
                            $projet -> getApprobationACEx() +
                            $projet ->getApprobationACGPMPEx () +
                            $projet -> getapprobationMEFEx () +
                            $projet ->getEnregistrementImpotsEx () ;

														$reception_dao_ex = ($projet -> getDateReceptionDAOEx() > 0 ) ? $projet -> getDateReceptionDAOEx() : "" ;
														$ano_sur_dao_ex = ($projet -> getDateAnoSurDAOEx() > 0 ) ? $projet -> getDateAnoSurDAOEx() : "" ;
														$pub_dao = ($projet -> getDatePublicationDAOEx() > 0 ) ? $projet -> getDatePublicationDAOEx() : "" ;
														$ouverture = ($projet -> getDateOuverturePlisEx() > 0 ) ? $projet -> getDateOuverturePlisEx() : "" ;
														$rapport = ($projet -> getDateRapportEvaluationEx() > 0 ) ? $projet -> getDateRapportEvaluationEx() : "" ;
														$ano_sur_rapport = ($projet -> getDateAnoSurRapEvalEx() > 0 ) ? $projet -> getDateAnoSurRapEvalEx() : "" ;
														$notif_provisoire = ($projet -> getDateNotifProvisoirEx() > 0 ) ? $projet -> getDateNotifProvisoirEx() : "" ;
														
														$nego_contrat = ($projet -> getprojetNegoContratEx() > 0 ) ? $projet -> getprojetNegoContratEx() : "" ;
														$date_ano = ($projet -> getDateAnoProjetContratEx() > 0 ) ? $projet -> getDateAnoProjetContratEx() : "" ;
														$app_attr = ($projet -> getApprobationAttribuaireEx() > 0 ) ? $projet -> getApprobationAttribuaireEx() : "" ;
														$app_ac = ($projet -> getApprobationACEx() > 0 ) ? $projet -> getApprobationACEx() : "" ;
														$app_acgpmp = ($projet -> getApprobationACGPMPEx() > 0 ) ? $projet -> getApprobationACGPMPEx() : "" ;
														$app_mef = ($projet -> getapprobationMEFEx() > 0 ) ? $projet -> getapprobationMEFEx() : "" ;
														$enreg = ($projet -> getEnregistrementImpotsEx() > 0 ) ? $projet -> getEnregistrementImpotsEx() : "" ;

						echo "
							<tr>
								<td>".$projet -> getAutoriteContractante()."</td>
								<td>".$projet -> getDescription()."</td>
								<td>".$projet -> getSourceFinancement()."</td>
								<td>".$projet -> getTypeProcedure()."</td>

								<td> <span class = '$cl_dao_recep' >".$reception_dao_ex ."</span></td>
								<td> <span class = '$cl_ano_dao' >".$ano_sur_dao_ex."</span></td>
								<td> <span class = '$cl_pub_dao' >".$pub_dao."</span></td>
								<td> <span class = '$cl_ouv' >".$ouverture."</span></td>
								<td> <span class = '$cl_rapp' >".$rapport."</span></td>
								<td> <span class = '$cl_ano_rapp' >".$ano_sur_rapport."</span></td>
								<td> <span class = '$cl_notif' >".$notif_provisoire."</span></td>
								
								<td> <span  class = '$cl_nego' >".$nego_contrat."</span></td>
								<td> <span  class = '$cl_date_ano' >".$date_ano."</span></td>
								<td> <span  class = '$cl_app_attr' >".$app_attr."</span></td>
								<td> <span  class = '$cl_app_ac' >".$app_ac."</span></td>
								<td> <span  class = '$cl_app_acgpmp' >".$app_acgpmp."</span></td>
								<td> <span  class = '$cl_app_mef' >".$app_mef."</span></td>
								<td> <span  class = '$cl_enreg' >".$enreg."</span></td>
								<td>".$projet -> getImmatriculation()."</td>
								<td>".$totalJour."</td>
                <td>".$totalExcedent."</td>
                <td><a href='chart.php?projet=$id'> Voir </a></td>
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