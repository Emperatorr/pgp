<?php
 
	require_once('../bd/Projet.php');
	require_once('../bd/connection_bd.php');
	require_once('../bd/fonctions.inc.php');
	require_once('../bd/CRUD.php');
	$obj_bdd = new CRUD ($bdd);
	
	$rows = array();
	$table = array();
	
	//emploi des homme et des femme de maniere direct et indirect
   if(isset($_GET['projet']) && !empty($_GET['projet'])) {
		 $projet_id = (int) htmlspecialchars($_GET['projet']);
				$table['cols'] = array(
				array('label' => '', 'type' => 'string'),
				array('label' => 'Delai reglementaire (Jour)', 'type' => 'number'),
				array('label' => 'Delai de traitement (Jour)', 'type' => 'number')
			);

    
	 $projet = $obj_bdd -> selectProjetById($projet_id) ;
	if($projet != null) {
      require('array_interval.inc.php');
			
			$temp = array();
			$temp[] = array('v' => (string) 'Date Reception DAO');
			$temp[] = array('v' => (int) $reception_ano['autorise']);
			$temp[] = array('v' => (int) $projet ->calculateInterval($projet ->getDateReceptionDAO(), $projet -> getDateAnoSurDAO()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Ano Sur DAO');
			$temp[] = array('v' => (int) $ano_publication['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet ->getDateAnoSurDAO(), $projet -> getDatePublicationDAO()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Publication DAO');
			$temp[] = array('v' => (int) $publication_ouverture['autorise']);
			$temp[] = array('v' => (int)  $projet -> calculateInterval($projet ->getDatePublicationDAO(), $projet -> getDateOuverturePlis()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Ouverture Plis');
			$temp[] = array('v' => (int) $ouverture_evaluation['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getDateOuverturePlis(), $projet -> getDateRapportEvaluation())  );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Rapport evaluation');
			$temp[] = array('v' => (int) $evaluation_rapport['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getDateRapportEvaluation(), $projet -> getDateAnoSurRapEval()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'ANO sur Rapport Evaluation ');
			$temp[] = array('v' => (int) $rapport_provisoir['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getDateAnoSurRapEval(), $projet -> getDateNotifProvisoir()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Notif Provisoire');
			$temp[] = array('v' => (int) $provisoir_nego['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getDateNotifProvisoir(), $projet -> getprojetNegoContrat()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Project Nego Contrat');
			$temp[] = array('v' => (int) $nego_contrat['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getprojetNegoContrat(), $projet -> getDateAnoProjetContrat()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'ANO Projet de contrat');
			$temp[] = array('v' => (int) $contrat_attribuaire['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getDateAnoProjetContrat(), $projet ->getApprobationAttribuaire()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Apporbation Attributaire');
			$temp[] = array('v' => (int) $attribuaire_ac['autorise']);
			$temp[] = array('v' => (int)  $projet -> calculateInterval($projet -> getApprobationAttribuaire(), $projet ->getApprobationAC()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Approbation AC');
			$temp[] = array('v' => (int) $ac_acgpmp['autorise']);
			$temp[] = array('v' => (int)  $projet -> calculateInterval($projet -> getApprobationAC(), $projet ->getApprobationACGPMP()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Approbation ACGPMP');
			$temp[] = array('v' => (int) $acgpmp_mef['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getApprobationACGPMP(), $projet ->getApprobationMEF()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$temp = array();
			$temp[] = array('v' => (string) 'Approbation MEF');
			$temp[] = array('v' => (int) $mef_impot['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getApprobationMEF(), $projet ->getEnregistrementImpots()) );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;
			/*
			$temp = array();
			$temp[] = array('v' => (string) ' Enregistrement Impots ');
			$temp[] = array('v' => (int) $impot_immatriculation['autorise']);
			$temp[] = array('v' => (int) $projet -> calculateInterval($projet -> getEnregistrementImpots(), $projet ->getImmatriculation()));
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;
			*/

			$jsonTable = json_encode($table);
	}
    echo $jsonTable;
	}

  ?>