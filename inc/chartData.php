<?php
 
	require_once('../bd/Carriere.php');
	require_once('../bd/connection_bd.php');
	require_once('../bd/CRUD.php');
	$obj_bdd = new CRUD ($bdd);
	
	$rows = array();
	$table = array();
	
	 if(isset($_GET['chart']) && $_GET['chart']=='Exportation') {
		$table['cols'] = array(
		array('label' => 'Substance', 'type' => 'string'),
		array('label' => 'Exportation', 'type' => 'number')
	);
	
	$data = $obj_bdd -> substanceExporte();
	if($data != null){
		foreach ($data AS $substance => $exportation){
			 $temp = array();
			 $temp[] = array('v' => (string)  $substance);
			 $temp[] = array('v' => (int) $exportation);
			 
			 $rows[] = array('c' => $temp);
			}
	}
    $table['rows'] = $rows;
    $jsonTable = json_encode($table);
    echo $jsonTable;
	
	}
	//emploi des homme et des femme de maniere direct et indirect
   if(isset($_GET['chart']) && $_GET['chart']=='emploiHommeFemme') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Emploi direct Homme', 'type' => 'number'),
		array('label' => 'Emploi direct Femme', 'type' => 'number'),
		array('label' => 'Emploi Indirect Homme', 'type' => 'number'),
		array('label' => 'Emploi Indirect Femme', 'type' => 'number')
		
	);
	
	$data = $obj_bdd -> emploiHommeFemme();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			 $homme = $valeur['emploiDirectHomme'];
			 $femme = $valeur['emploiDirectFemme'];
			 $ind_homme = $valeur['emploiIndirectHomme'];
			 $ind_femme = $valeur['emploiIndirectFemme'];
			 
			 
			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' =>   (int) $homme);
			 $temp[] = array('v' => (int) $femme);
			 $temp[] = array('v' => (int) $ind_homme);
			 $temp[] = array('v' => (int) $ind_femme);
			 
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	}
  
  if(isset($_GET['chart']) && $_GET['chart']=='emploiExpatrier') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Emploi Expatrier Homme', 'type' => 'number'),
		array('label' => 'Emploi Expatrier Femme', 'type' => 'number')
		
	);
	
	$data = $obj_bdd -> emploiExpatrier();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			 $homme = $valeur['emploiExpatrierHomme'];
			 $femme = $valeur['emploiExpatrierFemme'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' =>   (int) $homme);
			 $temp[] = array('v' => (int) $femme);
			 
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
	
    echo $jsonTable;
	
	}
 
  if(isset($_GET['chart']) && $_GET['chart']=='depenseInfrastructure') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Contribution au developpement', 'type' => 'number'),
		array('label' => 'Loyer en infrastructure', 'type' => 'number'),
		array('label' => 'Montant en investissement', 'type' => 'number')
		
	);
	
	$data = $obj_bdd -> depenseInfrastructure();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$contribution = $valeur['contributionDeveloppement'];
			$loyer = $valeur['loyerInfrastructure'];
			$invest = $valeur['montantInvestissement'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $contribution);
			 $temp[] = array('v' =>   (int) $loyer);
			 $temp[] = array('v' => (int) $invest);
			
			 
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
	
    echo $jsonTable;
	
	}
  if(isset($_GET['chart']) && $_GET['chart']=='statusOuvrier') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Ouvriés Qualifiés', 'type' => 'number'),
		array('label' => 'Ouvriés Non Qualifiés', 'type' => 'number')
		
	);
	$data = $obj_bdd -> statusOuvrier();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$qualifier = $valeur['ouvrierQualifier'];
			$non_qualifier = $valeur['ouvrierNonQualifier'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $qualifier);
			 $temp[] = array('v' =>   (int) $non_qualifier);
			
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	
	}
	
	
 if(isset($_GET['chart']) && $_GET['chart']=='statusEmployer') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Cadre', 'type' => 'number'),
		array('label' => 'Stagiaire', 'type' => 'number')
		
	);
	$data = $obj_bdd -> statusEmployer();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$cadre = $valeur['cadre'];
			$stagiaire = $valeur['stagiaire'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $cadre);
			 $temp[] = array('v' =>   (int) $stagiaire);
			
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	
	}

 if(isset($_GET['chart']) && $_GET['chart']=='productionVente') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Production totale', 'type' => 'number'),
		array('label' => 'Vente', 'type' => 'number')
		
	);
	$data = $obj_bdd -> productionVente();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$production = $valeur['productionTotal'];
			$vente = $valeur['quantiteVendu'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $production);
			 $temp[] = array('v' =>   (int) $vente);
			
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	
	}
	
 if(isset($_GET['chart']) && $_GET['chart']=='accident') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Accident avec arret', 'type' => 'number'),
		array('label' => 'Accident sans arret', 'type' => 'number'),
		array('label' => 'Accident avec arret de plus 6 mois', 'type' => 'number')
		
	);
	$data = $obj_bdd -> accident();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$accidentArret = $valeur['accidentArret'];
			$accidentSansArret = $valeur['accidentSansArret'];
			$accidentArretPlusSix = $valeur['accidentArretPlusSix'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $accidentArret);
			 $temp[] = array('v' =>   (int) $accidentSansArret);
			 $temp[] = array('v' =>   (int) $accidentArretPlusSix);
			
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	
	}
  if(isset($_GET['chart']) && $_GET['chart']=='surface') {
		$table['cols'] = array(
		array('label' => 'Societe', 'type' => 'string'),
		array('label' => 'Surface Restaurée', 'type' => 'number'),
		array('label' => 'Surface Reboisée', 'type' => 'number')
		
	);
	$data = $obj_bdd -> surface();
	if($data != null){
		foreach ($data AS $societe => $valeur){
			
			$surfaceRestaure = $valeur['surfaceRestaure'];
			$surfaceReboiser = $valeur['surfaceReboiser'];

			 $temp = array();
			 $temp[] = array('v' => (string)  $societe);
			 $temp[] = array('v' => (int) $surfaceRestaure);
			 $temp[] = array('v' =>   (int) $surfaceReboiser);
			
			 $rows[] = array('c' => $temp);
			}
	   $table['rows'] = $rows;
       $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	
	}
	
	
	
	
	
	
	
	
	
	
	
  ?>