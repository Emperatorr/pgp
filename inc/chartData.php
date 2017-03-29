<?php
 
	require_once('../bd/Projet.php');
	require_once('../bd/connection_bd.php');
	require_once('../bd/fonctions.inc.php');
	require_once('../bd/CRUD.php');
	$obj_bdd = new CRUD ($bdd);
	
	$rows = array();
	$table = array();
	
	//emploi des homme et des femme de maniere direct et indirect
   if(isset($_GET['chart']) && $_GET['chart']=='delaiTraitement') {
		$table['cols'] = array(
		array('label' => 'Delai', 'type' => 'string'),
		array('label' => 'Inferieur 60', 'type' => 'number'),
		array('label' => 'Inferieur 90', 'type' => 'number'),
		array('label' => 'Inferieur 120', 'type' => 'number'),
		array('label' => 'Superieur 120', 'type' => 'number')
		
	);
	
	$data = delaiTraitement();
	if($data != null) {

	   	 $inf_60 = $data['inferieur60'];
			 $inf_90 = $data['inferieur90'];
			 $inf_120 = $data['inferieur120'];
			 $sup_120 = $data['superieur120'];
			 
			 
			 $temp = array();
			 $temp[] = array('v' => (string) 'Delai de traitement');
			 $temp[] = array('v' => (int) $inf_60);
			 $temp[] = array('v' => (int) $inf_90);
			 $temp[] = array('v' => (int) $inf_120);
			 $temp[] = array('v' => (int) $sup_120);
			 
			 $rows[] = array('c' => $temp);
	   $table['rows'] = $rows;
     $jsonTable = json_encode($table);
	}
    echo $jsonTable;
	}
	
	
	
	
	
	
	
	
	
	
	
  ?>