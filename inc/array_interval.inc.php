<?php 
// ce fichier contient les delai de traitements
// NB: ce fichier est utilisé actuelement dans :
//  bd/Projet.php
// inc/fonction.inc.php
// inc/chartData.php
// DONC ATTENTION EN LE MODIFIANT

 $delai = 30;
 $alert = 25 ;
 
   $reception_ano = array(
        'autorise' => 7,
        'alerte' => 4
        ) ;
    $ano_publication = array(
        'autorise' => 7,
        'alerte' => 4
        ) ; 
    
    $publication_ouverture = array(
          'autorise' => (int) $delai,
          'alerte' => (int)  $alert 
        );
    $ouverture_evaluation = array(
        'autorise' => 10,
        'alerte' => 6 
        ) ;
    $evaluation_rapport = array(
        'autorise' => 7,
        'alerte' => 4 
        ) ;
    $rapport_provisoir = array(
        'autorise' => 3,
        'alerte' => 2 
        ) ;
    $provisoir_nego = array(
        'autorise' => 5,
        'alerte' => 3 
        ) ;
    $nego_contrat = array(
        'autorise' => 5,
        'alerte' => 3 
        ) ;
    $contrat_attribuaire = array(
        'autorise' => 3,
        'alerte' => 2 
        ) ;
    $attribuaire_ac = array(
        'autorise' => 2,
        'alerte' => 1
        ) ;
    $ac_acgpmp = array(
        'autorise' => 2,
        'alerte' => 1
        ) ;
    $acgpmp_mef = array(
        'autorise' => 5,
        'alerte' => 3
    ) ;
     $mef_impot = array(
        'autorise' => 2,
        'alerte' => 1
    ) ;
     $impot_immatriculation = array(
        'autorise' => 2,
        'alerte' => 1
    ) ;
    
 ?>