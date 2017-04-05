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
        $approbationAttribuaire = $contrat -> SignatureAttributaire ;
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
        $projet -> setApprobationAttribuaire($approbationAttribuaire);
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
    $dateAnoSurDAO =  DateTime::createFromFormat($format, $projet -> getDateAnoSurDAO());
    $datePublicationDAO = DateTime::createFromFormat($format, $projet -> getDatePublicationDAO());
    $dateOuverturePlis = DateTime::createFromFormat($format, $projet -> getDateOuverturePlis());
    $dateRapportEvaluation = DateTime::createFromFormat($format, $projet -> getDateRapportEvaluation());
    $dateAnoSurRapEval = DateTime::createFromFormat($format, $projet -> getDateAnoSurRapEval());
    $dateNotifProvisoir = DateTime::createFromFormat($format, $projet -> getDateNotifProvisoir());
    $projetNegoContrat = DateTime::createFromFormat($format, $projet -> getProjetNegoContrat());
    $dateAnoProjetContrat = DateTime::createFromFormat($format, $projet -> getDateAnoProjetContrat());
    $approbationAttribuaire = DateTime::createFromFormat($format,$projet -> getApprobationAttribuaire());
    $approbationAC = DateTime::createFromFormat($format, $projet -> getApprobationAC());
    $approbationACGPMP = DateTime::createFromFormat($format, $projet -> getApprobationACGPMP());
    $approbationMEF = DateTime::createFromFormat($format, $projet -> getApprobationMEF());
    $typeProcedure = $projet -> getTypeProcedure() ;

    if ($typeProcedure == "AOI") {
        $delai = 45;
        $alert = 35 ; 
    } else {
        $delai = 30;
        $alert = 25 ; 
    }
 
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
    
   if ($dateReceptionDAO != false ) {
       // echo "la date de reception est differente de null <br/> " ;
        if($dateAnoSurDAO == false ) {
           // echo "la date ano est false <br/> " ;
             $interval_reception_today = date_diff($dateReceptionDAO, $today) -> days ;
             if($interval_reception_today < $reception_ano['autorise']) {
                 if($interval_reception_today < $reception_ano['alerte']) {
                     //pas de blem ici
                     $etat['OK'] = true;

                    } else {
                     //alerte jaune
                     $etat['OK'] = false;
                     $etat['ALERT'] = true ;
                     $etat['DEPASSE'] = false ;
                     $etat['MESSAGE'] = "la date d'anonce sur DAO de ce projet n'a pas encore été fournie alors que le delai approche " ;
                 }

             } else {
                //alerte rouge
                $etat['OK'] = false;
                $etat['ALERT'] = true ;
                $etat['DEPASSE'] = true ;
                $etat['MESSAGE'] = "le delai permis pour la date d'anonce sur DAO est depassé" ;
              }
        
        } else { //la date D'ano sur dao est fourni
            //echo " la date d'ano sur dao est fournie <br/>";
           if($datePublicationDAO == false) {
                $interval_ano_today = date_diff($dateAnoSurDAO, $today) -> days ;
                if($interval_ano_today  < $ano_publication['autorise']) {
                 if($interval_ano_today < $ano_publication['alerte']) {
                     //pas de blem ici
                     $etat['OK'] = true;

                 } else {
                     //alerte jaune
                     $etat['OK'] = false;
                     $etat['ALERT'] = true ;
                     $etat['DEPASSE'] = false ;
                     $etat['MESSAGE'] = "la date de publication DAO de ce projet n'a pas encore été fournie alors que le delai approche " ;
                 }

             } else {
                //alerte rouge
                $etat['OK'] = false;
                $etat['ALERT'] = true ;
                $etat['DEPASSE'] = true ;
                $etat['MESSAGE'] = "le delai permis pour la date de publication DAO est depassé" ;
              }

           } else { // la date de publication DAO est fournie
               // echo " la date de publication DAO est fournie <br/>";
               if($dateOuverturePlis == false) {
                   $interval_publication_today = date_diff($datePublicationDAO, $today) -> days ;
                   if($interval_publication_today < $publication_ouverture['autorise']) {
                    if($interval_publication_today < $publication_ouverture['alerte']) {
                        //pas de blem ici
                        $etat['OK'] = true;

                    } else {
                        //alerte jaune
                        $etat['OK'] = false;
                        $etat['ALERT'] = true ;
                        $etat['DEPASSE'] = false ;
                        $etat['MESSAGE'] = "la date d'ouverture du plis de ce projet n'a pas encore été fournie alors que le delai approche " ;
                    }

                } else {
                    //alerte rouge
                    $etat['OK'] = false;
                    $etat['ALERT'] = true ;
                    $etat['DEPASSE'] = true ;
                    $etat['MESSAGE'] = "le delai permis pour la date d'ouverture du plis est depassé" ;
                }
               
               } else { // la date d'ouverture du plis du contrat
                // echo " la date d'ouverture du plis du contrat <br/>";
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
                        $etat['MESSAGE'] = "la date du rapport d'evaluation de ce projet n'a pas encore été fournie alors que le delai approche " ;
                    }

                } else {
                    //alerte rouge
                    $etat['OK'] = false;
                    $etat['ALERT'] = true ;
                    $etat['DEPASSE'] = true ;
                    $etat['MESSAGE'] = "le delai permis pour la date de rapport d'evaluation des contrats est depassé" ;
                  }
                
                } else { // la date du rapport d'evaluation est fournie
                    //echo " la date du rapport d'evaluation est fournie <br/>";
                    if($dateAnoSurRapEval == false ) {
                        $interval_evaluation_today = date_diff($dateRapportEvaluation, $today) -> days ;
                        if($interval_evaluation_today < $attribuaire_ac['autorise']) {
                            if($interval_evaluation_today < $attribuaire_ac['alerte']) {
                                //pas de blem ici
                                $etat['OK'] = true;

                            } else {
                                //alerte jaune
                                $etat['OK'] = false;
                                $etat['ALERT'] = true ;
                                $etat['DEPASSE'] = false ;
                                $etat['MESSAGE'] = "la date d'annonce du rapport d'evaluation de ce projet n'a pas encore été fournie alors que le delai approche " ;
                            }

                        } else {
                            //alerte rouge
                            $etat['OK'] = false;
                            $etat['ALERT'] = true ;
                            $etat['DEPASSE'] = true ;
                            $etat['MESSAGE'] = "le delai permis pour la date d'annonce du rapport d'evaluation des contrats est depassé" ;
                        }

                    } else { // la date d'annonce du rapport evaluation est fournie
                       //echo " la date d'annonce du rapport evaluation est fournie <br/>";
                        if($dateNotifProvisoir == false ) {
                            $interval_anonce_today = date_diff($dateAnoSurRapEval, $today) -> days ;
                            
                            if($interval_anonce_today < $rapport_provisoir['autorise']) {
                            if($interval_anonce_today < $rapport_provisoir['alerte']) {
                                //pas de blem ici
                                $etat['OK'] = true;

                            } else {
                                //alerte jaune
                                $etat['OK'] = false;
                                $etat['ALERT'] = true ;
                                $etat['DEPASSE'] = false ;
                                $etat['MESSAGE'] = "la date de notification provisoire de ce projet n'a pas encore été fournie alors que le delai approche " ;
                            }
                        } else {
                            //alerte rouge
                            $etat['OK'] = false;
                            $etat['ALERT'] = true ;
                            $etat['DEPASSE'] = true ;
                            $etat['MESSAGE'] = "le delai permis pour la date de notification provisoir des contrats est depassé" ;
                           }
                        } else { // la date de notification provisoire est fournie
                         // echo " la date de notification provisoire est fournie <br/>";
                            if($projetNegoContrat == false) {
                                $interval_notif_today = date_diff($dateNotifProvisoir, $today) -> days ;
                                if($interval_notif_today < $provisoir_nego['autorise']) {
                                    if($interval_notif_today < $provisoir_nego['alerte']) {
                                        //pas de blem ici
                                        $etat['OK'] = true;

                                    } else {
                                        //alerte jaune
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = false ;
                                        $etat['MESSAGE'] = "la date de negociation de contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                    }

                                } else {
                                    //alerte rouge
                                    $etat['OK'] = false;
                                    $etat['ALERT'] = true ;
                                    $etat['DEPASSE'] = true ;
                                    $etat['MESSAGE'] = "le delai permis pour la negociation de contrat est depassé" ;
                                }
                           
                            } else {  //la date de projet de negociation de contrat est fournie
                             // echo " la date de projet de negociation de contrat est fournie <br/>";
                               if($dateAnoProjetContrat == false ) {
                                   $interval_nego_today = date_diff($projetNegoContrat, $today) -> days ;
                                    if($interval_nego_today < $nego_contrat['autorise']) {
                                        if($interval_nego_today < $nego_contrat['alerte']) {
                                            //pas de blem ici
                                            $etat['OK'] = true;

                                        } else {
                                            //alerte jaune
                                            $etat['OK'] = false;
                                            $etat['ALERT'] = true ;
                                            $etat['DEPASSE'] = false ;
                                            $etat['MESSAGE'] = "la date d'annonce du contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                        }

                                    } else {
                                        //alerte rouge
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = true ;
                                        $etat['MESSAGE'] = "le delai permis pour l'annonce du contrat est depassé" ;
                                    }
                               } else { // la date $dateAnoProjetContrat est fournie 
                                //  echo " la date dateAnoProjetContrat est fournie <br/>";
                                  if($approbationAttribuaire == false ) {
                                       $interval_ano_today = date_diff($dateAnoProjetContrat, $today) -> days ;
                                       if($interval_ano_today < $contrat_attribuaire['autorise']) {
                                         if($interval_ano_today < $contrat_attribuaire['alerte']) {
                                            //pas de blem ici
                                            $etat['OK'] = true ;
                                        } else {
                                            //alerte jaune
                                            $etat['OK'] = false;
                                            $etat['ALERT'] = true ;
                                            $etat['DEPASSE'] = false ;
                                            $etat['MESSAGE'] = "la date d'approbation attributiare du contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                        }
                                    } else {
                                        //alerte rouge
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = true ;
                                        $etat['MESSAGE'] = "le delai permis pour la date d'approbation attribuaire du contrat est depassé" ;
                                    }

                                  } else { // la date $approbationAttribuaire est fournie
                                  // echo " la date approbationAttribuaire est fournie <br/>";
                                    if ($approbationAC == false ) {
                                        $interval_attribuaire_today = date_diff($approbationAttribuaire, $today) -> days ;
                                        if($interval_attribuaire_today < $attribuaire_ac['autorise']) {
                                            if($interval_attribuaire_today < $attribuaire_ac['alerte']) {
                                                //pas de blem ici
                                                $etat['OK'] = true ;
                                            } else {
                                                //alerte jaune
                                                $etat['OK'] = false;
                                                $etat['ALERT'] = true ;
                                                $etat['DEPASSE'] = false ;
                                                $etat['MESSAGE'] = "la date d'approbation AC du contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                            }
                                        } else {
                                            //alerte rouge
                                            $etat['OK'] = false;
                                            $etat['ALERT'] = true ;
                                            $etat['DEPASSE'] = true ;
                                            $etat['MESSAGE'] = "le delai permis pour la date d'approbation AC du contrat est depassé" ;
                                        }
                                    } else { //approbation AC est fournie
                                     //echo "La date d' approbation AC est fournie <br/>";
                                      if($approbationACGPMP == false ) {
                                        $interval_ac_today = date_diff($approbationAC, $today) -> days ;
                                       if($interval_ac_today < $ac_acgpmp['autorise']) {
                                         if($interval_ac_today < $ac_acgpmp['alerte']) {
                                            //pas de blem ici
                                            $etat['OK'] = true ;
                                        } else {
                                            //alerte jaune
                                            $etat['OK'] = false;
                                            $etat['ALERT'] = true ;
                                            $etat['DEPASSE'] = false ;
                                            $etat['MESSAGE'] = "la date d'approbation ACGPMP du contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                        }
                                    } else {
                                        //alerte rouge
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = true ;
                                        $etat['MESSAGE'] = "le delai permis pour la date d'approbation ACGPMP du contrat est depassé" ;
                                    }
                                   } else { // approbation ACGPMP est fournie
                                     //echo "La date d' approbation ACGPMP est fournie <br/>";
                                     if($approbationMEF == false ) {
                                                                                 $interval_ac_today = date_diff($approbationAC, $today) -> days ;
                                       if($interval_acgpmp_today < $acgpmp_mef['autorise']) {
                                         if($interval_acgpmp_today < $acgpmp_mef['alerte']) {
                                            //pas de blem ici
                                            $etat['OK'] = true ;
                                        } else {
                                            //alerte jaune
                                            $etat['OK'] = false;
                                            $etat['ALERT'] = true ;
                                            $etat['DEPASSE'] = false ;
                                            $etat['MESSAGE'] = "la date d'approbation MEF du contrat de ce projet n'a pas encore été fournie alors que le delai approche " ;
                                        }
                                    } else {
                                        //alerte rouge
                                        $etat['OK'] = false;
                                        $etat['ALERT'] = true ;
                                        $etat['DEPASSE'] = true ;
                                        $etat['MESSAGE'] = "le delai permis pour la date d'approbation MEF du contrat est depassé" ;
                                      }

                                   } //approbation MEF est fournie tout est bon
                                    else {
                                       // echo "La date d' approbation MEF est fournie <br/>";
                                    }
                                   } // ACGPMP
                                 } //approbation AC

                                 }// Approbation attribuaire
                            } //projet de negociaion
                             // fin if mef
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
				// $res = etatProjet($id, $obj_bdd);
                $res['TOTALJOUR'] = rand(1,500);

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