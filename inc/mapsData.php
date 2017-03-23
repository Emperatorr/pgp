<?php
 
	require_once('../bd/Carriere.php');
	require_once('../bd/connection_bd.php');
	require_once('../bd/CRUD.php');
	$obj_bdd = new CRUD ($bdd);
	
	$data = $obj_bdd -> selectCarriereAll();
	$resultat = array();
	if($data != null){
	  foreach ($data AS $carriere){
		 $tmp = array(
			'prefecture' =>  $carriere -> getPrefecture(),
			'societe' =>  $carriere -> getSociete(),
			'substance' =>  $carriere -> getSubstance(),
			'date' =>  $carriere -> getDat(),
			'prenomNom' =>  $carriere -> getPrenomNom(),
			'latitude' =>  $carriere -> getLatitude(),
			'longitude' =>  $carriere -> getLongitude()
		 );
		 
		$resultat[] = $tmp;	 
		}
	}
	
    $jsonData = json_encode($resultat);
    echo $jsonData;
	
	
	
	
	
	
	
	
	
	
	
	
	
  ?>