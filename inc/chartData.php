<?php
 
	require_once('../bd/Projet.php');
	require_once('../bd/connection_bd.php');
	require_once('../bd/fonctions.inc.php');
	require_once('../bd/CRUD.php');
	$obj_bdd = new CRUD ($bdd);
	
	$rows = array();
	$table = array();
	
	//chart 1
  if(isset($_GET['projet']) && !empty($_GET['projet']) && (isset($_GET['chart']) && $_GET['chart'] == 1)) {
		 $projet_id = (int) htmlspecialchars($_GET['projet']);
				$table['cols'] = array(
				array('label' => '', 'type' => 'string'),
				array('label' => 'Delai reglementaire (Jour)', 'type' => 'number',array('label' => 'Labeled', 'type' => 'string', 'role' =>'annotation')),
				array('label' => 'Delai de traitement (Jour)', 'type' => 'number'),
			);
		
    
	 $projet = $obj_bdd -> selectProjetById($projet_id) ;
	if($projet != null) {
      require('array_interval.inc.php');

		  	$depassement =  (int)  $projet ->calculateInterval($projet ->getDateReceptionDAO(), $projet -> getDateAnoSurDAO()) - (int) $reception_ano['autorise'] ;
				$depassement = ($depassement > 0) ? $depassement : 0 ;
				$temp = array();
				$temp[] = array('v' => (string) 'Date Reception DAO');
				$temp[] = array('v' => (int) $reception_ano['autorise'], array('v' => (string) 'L'));
				$temp[] = array('v' => (int) $depassement);
				$rows[] = array('c' => $temp);
				$table['rows'] = $rows;
			
		
		  $depassement =  (int) $projet -> calculateInterval($projet ->getDateAnoSurDAO(), $projet -> getDatePublicationDAO()) - (int) $ano_publication['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;	
			$temp = array();
			$temp[] = array('v' => (string) 'Ano Sur DAO');
			$temp[] = array('v' => (int) $ano_publication['autorise'], array('v' => (string) 'L'));
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;
	    

			$depassement = (int)  $projet -> calculateInterval($projet ->getDatePublicationDAO(), $projet -> getDateOuverturePlis()) - (int) $publication_ouverture['autorise'] ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Publication DAO');
			$temp[] = array('v' => (int) $publication_ouverture['autorise'],  array('v' => (string) 'L'));
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement = (int) $projet -> calculateInterval($projet -> getDateOuverturePlis(), $projet -> getDateRapportEvaluation()) - (int) $ouverture_evaluation['autorise']  ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Ouverture Plis');
			$temp[] = array('v' => (int) $ouverture_evaluation['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement =  (int) $projet -> calculateInterval($projet -> getDateRapportEvaluation(), $projet -> getDateAnoSurRapEval()) - (int) $evaluation_rapport['autorise']  ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Rapport evaluation');
			$temp[] = array('v' => (int) $evaluation_rapport['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement =  (int) $projet -> calculateInterval($projet -> getDateAnoSurRapEval(), $projet -> getDateNotifProvisoir()) - (int) $rapport_provisoir['autorise'] ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'ANO sur Rapport Evaluation ');
			$temp[] = array('v' => (int) $rapport_provisoir['autorise']);
			$temp[] = array('v' => $depassement);
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;
			
			$depassement = (int)  (int) $projet -> calculateInterval($projet -> getDateNotifProvisoir(), $projet -> getprojetNegoContrat()) - $provisoir_nego['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Notif Provisoire');
			$temp[] = array('v' => (int) $provisoir_nego['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement = (int)  (int) $projet -> calculateInterval($projet -> getprojetNegoContrat(), $projet -> getDateAnoProjetContrat()) - $nego_contrat['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Project Nego Contrat');
			$temp[] = array('v' => (int) $nego_contrat['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			
			$depassement =  (int) $projet -> calculateInterval($projet -> getDateAnoProjetContrat(), $projet ->getApprobationAttribuaire()) - (int) $contrat_attribuaire['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'ANO Projet de contrat');
			$temp[] = array('v' => (int) $contrat_attribuaire['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement =  (int) $projet -> calculateInterval($projet -> getApprobationAttribuaire(), $projet ->getApprobationAC()) - (int) $attribuaire_ac['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Apporbation Attributaire');
			$temp[] = array('v' => (int) $attribuaire_ac['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement =  (int)  $projet -> calculateInterval($projet -> getApprobationAC(), $projet ->getApprobationACGPMP()) - (int) $ac_acgpmp['autorise'] ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Approbation AC');
			$temp[] = array('v' => (int) $ac_acgpmp['autorise']);
			$temp[] = array('v' => $depassement);
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$depassement =  (int) $projet -> calculateInterval($projet -> getApprobationACGPMP(), $projet ->getApprobationMEF()) - (int) $acgpmp_mef['autorise']  ;
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Approbation ACGPMP');
			$temp[] = array('v' => (int) $acgpmp_mef['autorise']);
			$temp[] = array('v' => $depassement  );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;
			
			$depassement =  (int) $projet -> calculateInterval($projet -> getApprobationMEF(), $projet ->getEnregistrementImpots()) - (int) $mef_impot['autorise'];
			$depassement = ($depassement > 0) ? $depassement : 0 ;
			$temp = array();
			$temp[] = array('v' => (string) 'Approbation MEF');
			$temp[] = array('v' => (int) $mef_impot['autorise']);
			$temp[] = array('v' => $depassement );
			$rows[] = array('c' => $temp);
			$table['rows'] = $rows;

			$jsonTable = json_encode($table);
	}
    echo $jsonTable;
	}


	// chart 2
  if(isset($_GET['projet']) && !empty($_GET['projet']) && (isset($_GET['chart']) && $_GET['chart'] == 2)) {
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

			$jsonTable = json_encode($table);
	}
    echo $jsonTable;
	}

  ?>