<?php 
    require_once('../bd/Projet.php');
    require_once('../bd/User.php');
    require_once('../bd/connection_bd.php');
    require_once('../bd/CRUD.php');
    require_once('../bd/fonctions.inc.php');
		$obj_bdd = new CRUD ($bdd);
		$results = $obj_bdd -> selectProjetAll();
  	
    if($results != null) {
      $projetAlert = array () ;
      $projetDepasse = array () ;
      
      foreach ($results AS $projet) {
        $id = $projet -> getIdProjet();
        $res = etatProjet($id, $obj_bdd);

        if ($res['DEPASSE'] == true) {
           $projetDepasse[$id] =  $res['MESSAGE'] ; 
        } elseif ($res['ALERT'] == true) {
           $projetAlert[$id] =  $res['MESSAGE'] ; 
        }
      }

      $objet  = "Rapport hebdomadaire du ".date('d/m/Y'); 
      $contenu = "<b> Les projets dépassés :</b>";

      foreach ($projetDepasse AS $id => $message ) {
        $contenu .= " " .$id.": ".$message ;
      }

      $contenu .= "<b> Les projets à risque :</b>";
      foreach ($projetAlert AS $id => $message ) {
        $contenu .= " " .$id.": ".$message ;
      }

      //lecture de la liste des personne alertables
      $users = $obj_bdd -> selectUsersForAlerte();
      foreach ($users AS $user) {
        $email = $user -> getEmailUser () ;
        echo "envoi de l'email à $email <br/>";

        if (envoiEmail($email, $objet, $contenu)) {
          echo "email envoyé avec succes <br/>";
        }
      }
   } //if

?>