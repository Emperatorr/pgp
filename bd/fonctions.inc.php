<?php

function getData($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
			echo"method POST<br/>";
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
		case "DELETE":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

   // Optional Authentication:
   $login = "ministryfm";
   $passwd = "mfm2016";
   
	 curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     curl_setopt($curl, CURLOPT_USERPWD, $login.":".$passwd);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_COOKIESESSION, 1);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function stringValueChamp($value, $champ){
	return ((isset($value -> $champ))? $value -> $champ : '' );
}

function uploadFile($file, $nom_fichier, $chemin_stockage, $ext_autorisees, $max_size) {

    //$ext_autorisees = ((!isset($ext_autorisees) || empty($ext_autorisee) || !is_array($ext_autorisees)) ? array('jpg','JPG','jpeg','JPEG','gif','GIF', 'png','PNG','bmp','BMP') : $ext_autorisee) ;
    $taille_max = ((!isset($taille_max) || empty($taille_max)) ? 1000000 : (int) $taille_max);
    //$chemin_stockage = ((!isset($chemin_stockage) || empty($chemin_stockage)) ? 'fichier/telechargement/' :  $chemin_stockage);
    //$nom_fichier = ((!isset($nom_fichier) || empty($nom_fichier)) ? 'tmp_file'.date('dd_mm_yyy_H_m_s') :  $nom_fichier);
    
    if(isset($file) &&  !empty($file) && $file['error'] == 0) {
        if($file['size'] <= $taille_max) {
            $infos = pathinfo($file['name']) ;
			$ext_telecharger= $infos['extension'];
			if (in_array($ext_telecharger, $ext_autorisees)) {
                if(move_uploaded_file($file['tmp_name'], $chemin_stockage.$nom_fichier.'.'.$ext_telecharger)) {
						 $_SESSION['status']['_code'] = 0;
                         $_SESSION['status']['_message']="Fichier télécharger avec succès";
                         $_SESSION['status']['_uploadedFile'] = $chemin_stockage.$nom_fichier.'.'.$ext_telecharger ;

					}else{
                         $_SESSION['status']['_code'] = 1;
                         $_SESSION['status']['_message']="Impossible d'enregistrer l'image sur le serveur";  
                    }
				}else{
                     $_SESSION['status']['_code'] = 2;
                     $_SESSION['status']['_message']="l'extension '".$ext_telecharger."' de votre fichier n'est pas autorisees ";
				}
			}else{
                 $_SESSION['status']['_code'] = 3;
				 $_SESSION['status']['_message']="la taille de votre image est trop grande<br/>Votre image ne doit pas depasse 1Mo";
			 }
		}else{
            $_SESSION['status']['_code'] = 4;
           	$_SESSION['status']['_message']="Une erreur est survenu lors du chargement de l'image";
		}  
    return (isset($_SESSION['status']))? $_SESSION['status'] : null ;
}//fin fonction

function processXML ($file_path, $obj_bdd) {
     $xml = simplexml_load_file ($file_path);

    var_dump($xml);
     $nbr = 0 ;
     foreach($xml as $contrat) {

        $numContrat = $contrat -> NumContrat ;
        $autoriteContractante = $contrat -> AutContractante ;
        $description = $contrat -> Description ;
        $beneficiaire = $contrat -> Beneficiare ;
        $phase = $contrat -> Phase ;
        $montant = $contrat -> Montant ;
        $dateReceptionDAO = $contrat -> DateRecepDAO ;
        $dateOuverturePlis = $contrat -> DateOuvPlis ;
        $dateRapportEvaluation = $contrat -> DateRappEval ;
        $datePublicationAttribution = $contrat  -> DatePubAttr ;
        $projetCeContrat = $contrat -> ProjCeContrat ;
        $approbationAttribuaire = $contrat -> ApprAttribuaire ;
        $approbationAC  = $contrat -> ApprobationAC ;
        $approbationACGPMP = $contrat -> ApprACGPMP ;
        $approbationMEF = $contrat -> ApprMEF ;
        $commentaire = $contrat -> Comment ;
        
        // creation du projet et insertion 
        $projet = new Projet ();
        $projet -> setNumContrat($numContrat);
        $projet -> setautoriteContractante($autoriteContractante);
        $projet -> setdescription($description);
        $projet -> setbeneficiaire($beneficiaire);
        $projet -> setphase($phase);
        $projet -> setmontant($montant);
        $projet -> setdateReceptionDAO($dateReceptionDAO);
        $projet -> setdateOuverturePlis($dateOuverturePlis);
        $projet -> setdateRapportEvaluation($dateRapportEvaluation);
        $projet -> setdatePublicationAttribution($datePublicationAttribution);
        $projet -> setprojetCeContrat($projetCeContrat);
        $projet -> setapprobationAttribuaire($approbationAttribuaire);
        $projet -> setapprobationAC($approbationAC);
        $projet -> setapprobationACGPMP($approbationACGPMP);
        $projet -> setapprobationMEF($approbationMEF);
        $projet -> setCommentaire($commentaire);

        $obj_bdd -> insertProjet($projet) ;
        $nbr++ ;
     }
     return $nbr ;
  }

?>