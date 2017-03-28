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

function etatProjet($id_projet,$obj_bdd) {
    $projet = $obj_bdd -> selectProjetById($id_projet) ;
    
    $format = 'd/m/Y';
    $totalJour = 0 ;
    $today = DateTime::createFromFormat($format, date ('d/m/Y')) ;
    $etat = array (
        'OK' => true,
        'ALERT' => false,
        'DEPASSE' => false,
        'MESSAGE' => ''
        ) ;

    $dateReceptionDAO = DateTime::createFromFormat($format, $projet -> getDateReceptionDAO());
    $dateOuverturePlis = DateTime::createFromFormat($format, $projet -> getDateOuverturePlis());
    $dateRapportEvaluation = DateTime::createFromFormat($format, $projet -> getDateRapportEvaluation());
    $datePublicationAttribution = DateTime::createFromFormat($format, $projet -> getDatePublicationAttribution());
    $projetCeContrat = DateTime::createFromFormat($format, $projet -> getProjetCeContrat());
    $approbationAttribuaire = DateTime::createFromFormat($format,$projet -> getApprobationAttribuaire());
    $approbationAC = DateTime::createFromFormat($format, $projet -> getApprobationAC());
    $approbationACGPMP = DateTime::createFromFormat($format, $projet -> getApprobationACGPMP());
    $approbationMEF = DateTime::createFromFormat($format, $projet -> getApprobationMEF());

    $reception_ouverture = array(
    'autorise' => 10,
    'alerte' => 5 
    ) ;
     $ouverture_evaluation = array(
        'autorise' => 5,
        'alerte' => 3 
        ) ;
    $evaluation_publlication = array(
        'autorise' => 15,
        'alerte' => 10 
        );
     $publlication_contrat = array(
        'autorise' => 12,
        'alerte' => 8 
        ) ;
     $contrat_attribuaire = array(
        'autorise' => 12,
        'alerte' => 8 
        ) ;
     $attribuaire_ac = array(
        'autorise' => 20,
        'alerte' => 5 
        ) ;
     $ac_acgpmp = array(
        'autorise' => 40,
        'alerte' => 25 
        ) ;
     $acgpmp_mef = array(
        'autorise' => 40,
        'alerte' => 25 
        ) ;
    
    if ($dateReceptionDAO != false ) {
        if($dateOuverturePlis == false ) {
             $interval_reception_today = date_diff($dateReceptionDAO, $today) -> days ;
             if($interval_reception_today < $reception_ouverture['autorise']) {
                 if($interval_reception_today < $reception_ouverture['alerte']) {
                     //pas de blem ici
                     $etat['OK'] = true;

                 } else {
                     //alerte jaune
                     $etat['OK'] = false;
                     $etat['ALERT'] = true ;
                     $etat['DEPASSE'] = false ;
                     $etat['MESSAGE'] = "la date d'ouverture de ce projet n'a pas encore été fournie alors que le delai approche " ;
                 }

             } else {
                //alerte rouge
                $etat['OK'] = false;
                $etat['ALERT'] = true ;
                $etat['DEPASSE'] = true ;
                $etat['MESSAGE'] = "le delai permis pour la date d'ouverture est depassé" ;
              }
         $totalJour += $interval_reception_today ;
        
        } else { //la date d'ouverture est fourni
            $totalJour += date_diff($dateReceptionDAO, $dateOuverturePlis) -> days ;
           if($dateRapportEvaluation == false) { 
                $interval_ouverture_today = date_diff($dateOuverturePlis, $today) -> days ;
                if($interval_ouverture_today < $ouverture_evaluation['autorise']) {
                 if($interval_ouverture_today < $ouverture_evaluation['alerte']) {
                     //pas de blem ici
                     $etat['OK'] = true;

                 } else {
                     //alerte jaune
                     $etat['OK'] = false;
                     $etat['ALERT'] = true ;
                     $etat['DEPASSE'] = false ;
                     $etat['MESSAGE'] = "la date d'evaluation de ce projet n'a pas encore été fournie alors que le delai approche " ;
                 }

             } else {
                //alerte rouge
                $etat['OK'] = false;
                $etat['ALERT'] = true ;
                $etat['DEPASSE'] = true ;
                $etat['MESSAGE'] = "le delai permis pour la date d'evaluation est depassé" ;
              }
            $totalJour += $interval_ouverture_today ;

           }else { // la date du rapport est fournie
             if($datePublicationAttribution == false ) {
                 $interval_rapport_today = date_diff($dateRapportEvaluation, $today) -> days ;
                if($interval_rapport_today < $evaluation_publlication['autorise']) {
                 if($interval_rapport_today < $evaluation_publlication['alerte']) {
                     //pas de blem ici
                     $etat['OK'] = true;

                 } else {
                     //alerte jaune
                     $etat['OK'] = false;
                     $etat['ALERT'] = true ;
                     $etat['DEPASSE'] = false ;
                     $etat['MESSAGE'] = "la date de publication de ce projet n'a pas encore été fournie alors que le delai approche " ;
                 }

             } else {
                //alerte rouge
                $etat['OK'] = false;
                $etat['ALERT'] = true ;
                $etat['DEPASSE'] = true ;
                $etat['MESSAGE'] = "le delai permis pour la date de publication est depassé" ;
              }
            $totalJour += $interval_rapport_today ;

            } else { //la date de publication est fourni
               if($projetCeContrat == false) {
                   $interval_publication_today = date_diff($datePublicationAttribution, $today) -> days ;
                   if($interval_publication_today < $publlication_contrat['autorise']) {
                    if($interval_publication_today < $publlication_contrat['alerte']) {
                        //pas de blem ici
                        $etat['OK'] = true;

                    } else {
                        //alerte jaune
                        $etat['OK'] = false;
                        $etat['ALERT'] = true ;
                        $etat['DEPASSE'] = false ;
                        $etat['MESSAGE'] = "la date de contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                    }

                } else {
                    //alerte rouge
                    $etat['OK'] = false;
                    $etat['ALERT'] = true ;
                    $etat['DEPASSE'] = true ;
                    $etat['MESSAGE'] = "le delai permis pour la date du contrat est depassé" ;
                }
                $totalJour += $interval_publication_today ;
               
               } else { // la date du contrat est fourni
                if($approbationAttribuaire == false) {
                    $interval_contrat_today = date_diff($projetCeContrat, $today) -> days ;
                    if($interval_contrat_today < $contrat_attribiaire['autorise']) {
                    if($interval_contrat_today < $contrat_attribiaire['alerte']) {
                        //pas de blem ici
                        $etat['OK'] = true;

                    } else {
                        //alerte jaune
                        $etat['OK'] = false;
                        $etat['ALERT'] = true ;
                        $etat['DEPASSE'] = false ;
                        $etat['MESSAGE'] = "la date d'approbation attribuaire de ce projet n'a pas encore été fournie alors que le delai approche " ;
                    }

                } else {
                    //alerte rouge
                    $etat['OK'] = false;
                    $etat['ALERT'] = true ;
                    $etat['DEPASSE'] = true ;
                    $etat['MESSAGE'] = "le delai permis pour la date d'approbation attribuaire de contrat est depassé" ;
                  }
                  $totalJour += $interval_contrat_today ;   

                } else { // la date d'approbation attribiaire est fourni
                    if($approbationAC == false ) {
                        $interval_attribuaire_today = date_diff($approbationAttribuaire, $today) -> days ;
                        if($interval_attribuaire_today < $attribuaire_ac['autorise']) {
                            if($interval_attribuaire_today < $attribuaire_ac['alerte']) {
                                //pas de blem ici
                                $etat['OK'] = true;

                            } else {
                                //alerte jaune
                                $etat['OK'] = false;
                                $etat['ALERT'] = true ;
                                $etat['DEPASSE'] = false ;
                                $etat['MESSAGE'] = "la date d'approbation AC de ce projet n'a pas encore été fournie alors que le delai approche " ;
                            }

                        } else {
                            //alerte rouge
                            $etat['OK'] = false;
                            $etat['ALERT'] = true ;
                            $etat['DEPASSE'] = true ;
                            $etat['MESSAGE'] = "le delai permis pour la date d'approbation AC de contrat est depassé" ;
                        }
                        $totalJour += $interval_attribuaire_today ;
                    } else { // approbation AC est fourni
                        if($approbationACGPMP == false ) {
                            $interval_ac_today = date_diff($approbationAC, $today) -> days ;
                            
                            if($interval_ac_today < $ac_acgpmp['autorise']) {
                            if($interval_ac_today < $ac_acgpmp['alerte']) {
                                //pas de blem ici
                                $etat['OK'] = true;

                            } else {
                                //alerte jaune
                                $etat['OK'] = false;
                                $etat['ALERT'] = true ;
                                $etat['DEPASSE'] = false ;
                                $etat['MESSAGE'] = "la date d'approbation ACGPMP de ce projet n'a pas encore été fournie alors que le delai approche " ;
                            }

                        } else {
                            //alerte rouge
                            $etat['OK'] = false;
                            $etat['ALERT'] = true ;
                            $etat['DEPASSE'] = true ;
                            $etat['MESSAGE'] = "le delai permis pour la date d'approbation ACGPMP de contrat est depassé" ;
                        }
                        $totalJour += $interval_ac_today ;

                        }else { // approbation ACGPMP est fournie
                            if($approbationMEF == false) {
                                $interval_acgpmp_today = date_diff($approbationACGPMP, $today) -> days ;
                                if($interval_acgpmp_today < $acgpmp_mef['autorise']) {
                                    if($interval_acgpmp_today < $acgpmp_mef['alerte']) {
                                        //pas de blem ici
                                        $etat['OK'] = true;

                                    } else {
                                        //alerte jaune
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = false ;
                                        $etat['MESSAGE'] = "la date d'approbation MEF de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                    }

                                } else {
                                    //alerte rouge
                                    $etat['OK'] = false;
                                    $etat['ALERT'] = true ;
                                    $etat['DEPASSE'] = true ;
                                    $etat['MESSAGE'] = "le delai permis pour la date d'approbation MEF de contrat est depassé" ;
                                }
                             $totalJour += $interval_acgpmp_today ;
                            } // fin if mef
                        } // fin else ACGPMP
                    } // fin else approbation AC
                  } //fin else approbation attribuaire
               } //fin else contrat
            } // fin else publication
           } //fin else rapport
        } // fin else ouverture
    } // date receptionDAO
 
 $etat['TOTALJOUR'] = $totalJour ;
 return $etat;

}

?>