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

    // var_dump($xml);
     $nbr = 0 ;
     foreach($xml as $contrat) {
        // $numContrat = $contrat -> NumContrat ;
        $id = $contrat -> Id ;
        $autoriteContractante = $contrat -> AutContractante ;
        $description = $contrat -> DescripContrat ;
        $sourceFinancement = $contrat -> SrcFinancement ;
        $typeProcedure = $contrat -> TypePro ;
        $dateReceptionDAO = $contrat -> RecepDAODNMP ;
        $dateAnoSurDAO =  $contrat ->  DatANOsurDAO ;
        $datePublicationDAO =  $contrat -> DatPubDAO ;
        $dateOuverturePlis = $contrat -> DatOuvPlis ;
        $dateRapportEvaluation = $contrat -> DatRapEval ;
        $dateAnoSurRapEval = $contrat -> DatANOsurRapEval ;
        $dateNotifProvisoir = $contrat -> DatNotifProv ;
        $projetNegoContrat = $contrat -> DatRecepNegoProCntrats ;
        $dateAnoProjetContrat = $contrat -> Dateanoprojetdecontrat ;
        $attribuaire = $contrat -> Attributaire ;
        $montant = $contrat -> Montant ;
        $approbationAC  = $contrat -> SignatureAC ;
        $approbationACGPMP = $contrat -> SignACGPMP ;
        $approbationMEF = $contrat -> ApproMEF ;
        $commentaire = $contrat -> Comments ;
        
        // creation du projet et insertion 
        $projet = new Projet ();
        $projet -> setAutoriteContractante($autoriteContractante);
        $projet -> setDescription($description);
        $projet -> setSourceFinancement($sourceFinancement);
        $projet -> setTypeProcedure($typeProcedure);
        $projet -> setDateReceptionDAO($dateReceptionDAO);
        $projet -> setDateAnoSurDAO($dateAnoSurDAO);
        $projet -> setDatePublicationDAO($datePublicationDAO);
        $projet -> setDateOuverturePlis($dateOuverturePlis);
        $projet -> setDateRapportEvaluation($dateRapportEvaluation);
        $projet -> setDateAnoSurRapEval($dateAnoSurRapEval);
        $projet -> setDateNotifProvisoir($dateNotifProvisoir);
        $projet -> setProjetNegoContrat($projetNegoContrat);
        $projet -> setDateAnoProjetContrat($dateAnoProjetContrat);
        $projet -> setAttribuaire($attribuaire);
        $projet -> setmontant($montant);
        $projet -> setApprobationAC($approbationAC);
        $projet -> setApprobationACGPMP($approbationACGPMP);
        $projet -> setApprobationMEF($approbationMEF);
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
    $dateAnoSurRapEval = DateTime::createFromFormat($format, $projet -> getDateAnoSurRapEval());
    $projetCeContrat = DateTime::createFromFormat($format, $projet -> getProjetNegoContrat());
    $approbationAttribuaire = DateTime::createFromFormat($format,$projet -> getDateAnoProjetContrat());
    $approbationAC = DateTime::createFromFormat($format, $projet -> getApprobationAC());
    $approbationACGPMP = DateTime::createFromFormat($format, $projet -> getApprobationACGPMP());
    $approbationMEF = DateTime::createFromFormat($format, $projet -> getApprobationMEF());

    $reception_ouverture = array(
    'autorise' => 7,
    'alerte' => 4
    ) ;
     $ouverture_evaluation = array(
        'autorise' => 7,
        'alerte' => 4
        ) ;
    $evaluation_publlication = array(
        'autorise' => 7,
        'alerte' => 4 
        );
     $publlication_contrat = array(
        'autorise' => 30,
        'alerte' => 25 
        ) ;
     $contrat_attribuaire = array(
        'autorise' => 45,
        'alerte' => 35 
        ) ;
     $attribuaire_ac = array(
        'autorise' => 3,
        'alerte' => 2
        ) ;
     $ac_acgpmp = array(
        'autorise' => 40,
        'alerte' => 30 
        ) ;
     $acgpmp_mef = array(
        'autorise' => 40,
        'alerte' => 30 
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
             if($dateAnoSurRapEval == false ) {
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
                   $interval_publication_today = date_diff($dateAnoSurRapEval, $today) -> days ;
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
                    if($interval_contrat_today < $contrat_attribuaire['autorise']) {
                    if($interval_contrat_today < $contrat_attribuaire['alerte']) {
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

function envoiEmail($email_destinateur,$objet_message,$contenu_message) { 
	if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email_destinateur)) {
         $passage_ligne = "\r\n"; 
         } else { 
             $passage_ligne = "\n";
        }
		$boundary = "-----=".md5(rand());
		
        $header='From: "Notification"<gestion-projet@budget.gn>'.$passage_ligne;
		$header.='Reply-To: lansanalsm@gmail.com'.$passage_ligne;
		$header .= "MIME-Version: 1.0".$passage_ligne;
		$header .='Content-Type: text/html; charset="UTF-8"'.$passage_ligne;
		$header  ='Content-Transfer-Encoding: 8bit';
		
        $contenu_message = str_replace("\n.", "\n..", $contenu_message);
       
        $message = $passage_ligne."--".$boundary.$passage_ligne;
		$message =$contenu_message;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	  
        return (mail($email_destinateur, $objet_message, $contenu_message, $header)) ;
}//fin fonctin

//chart

function delaiTraitement() {
	
    require_once('Projet.php');
    require('connection_bd.php');
    require_once('CRUD.php');
	$obj_bdd = new CRUD ($bdd); 
    
    $results = $obj_bdd -> selectProjetAll() ;
	$nv_tab = array();
	
	$inf_60 = 100 ;
	$inf_90 = 45 ;
	$inf_120 = 50 ;
	$sup_120 = 300 ;
    
	if($results != null) {
			foreach ($results AS $projet) {
				$id = $projet -> getIdProjet();
				$res = etatProjet($id, $obj_bdd);

				if (isset($res['TOTALJOUR']) &&  !empty($res['TOTALJOUR'])) {
						if((int) $res['TOTALJOUR'] < 60 ) {
								$inf_60 ++ ;
						}
						if((int) $res['TOTALJOUR'] < 90 ) {
								$inf_90 ++ ;
						}
						if((int) $res['TOTALJOUR'] < 120 ) {
							$inf_120 ++;
						}
						if( (int) $res['TOTALJOUR'] > 120 ) {
							$sup_120 ++ ;
						}
					}
	 
				}

			$nv_tab['inferieur60'] = $inf_60 ;
			$nv_tab['inferieur90'] = $inf_90 ;
			$nv_tab['inferieur120'] = $inf_120 ;
			$nv_tab['superieur120'] = $sup_120 ;

			return $nv_tab ;
	  
		} else {
			return null;
		}
 }

?>