<?php session_start(); ?>
<?php 
 if((!isset($_SESSION['idUser']) || empty($_SESSION['idUser'])) ||
	  (!isset($_SESSION['emailUser']) || empty($_SESSION['emailUser'])) ||
		(!isset($_SESSION['levelUser']) || empty($_SESSION['levelUser']))
   ) {
	   header('location:index.php');
   } else {

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Projets </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
  <!--menu vertical -->

    <div class="main-panel">
      <?php
      if(isset($_GET['action']) && $_GET['action'] == 'new') {
           if(isset($_SESSION['id'])) {
               unset($_SESSION['id']);
           }
                
           $action = "Insert";

      } elseif(isset($_GET['id']) && !empty($_GET['id'])) {
            $_SESSION['id'] = htmlspecialchars($_GET['id']);
            $isEdition = true ;
            $page_title = "Details du projet";
            $action = "Update";

        } else {
            $isEdition = false ;
            $page_title = "Nouveau Projet";
            $action = "Insert";
        }
        $page_active = 2;
        ?>
		  
          <!--menu top-->
		   <?php 
			require_once('inc/menu.top.php');

			require_once('bd/Projet.php');
			require_once('bd/connection_bd.php');
            require_once('bd/fonctions.inc.php');
			require_once('bd/CRUD.php');
			$obj_bdd = new CRUD ($bdd);

            // creation du projet old
            $projet = new Projet ();
			
         if(isset($_SESSION['id']) && $_SESSION['id'] != null) {
			$projet = $obj_bdd -> selectProjetById($_SESSION['id']);
            $res = etatProjet($_SESSION['id'], $obj_bdd);
            $totalJour  = (int) totalJour($_SESSION['id'], $obj_bdd);

            $inferieur60 = ($totalJour < 60 ) ? 'OUI' : 'NON' ;
            $inferieur90 = ($totalJour < 90 ) ? 'OUI' : 'NON' ;
            $inferieur120 = ($totalJour < 120 ) ? 'OUI' : 'NON' ;
            $superieur120 = ($totalJour > 120 ) ? 'OUI' : 'NON' ;

			 } else {
                $totalJour  = 0;
                $inferieur60 = 'NON' ;
                $inferieur90 = 'NON' ;
                $inferieur120 = 'NON' ;
                $superieur120 ='NON' ;
                }
			
	
			$autoriteContractante = ((isset($_POST['autoriteContractante']) && !empty($_POST['autoriteContractante'])) ? htmlspecialchars($_POST['autoriteContractante']) : ((isset($projet) && !empty($projet)) ? $projet -> getAutoriteContractante() : '' ));
            $description = ((isset($_POST['description']) && !empty($_POST['description'])) ? htmlspecialchars($_POST['description']) : ((isset($projet) && !empty($projet)) ? $projet -> getDescription() : '' ));
            $sourceFinancement = ((isset($_POST['sourceFinancement']) && !empty($_POST['sourceFinancement'])) ? htmlspecialchars($_POST['sourceFinancement']) : ((isset($projet) && !empty($projet)) ? $projet -> getsourceFinancement() : '' ));
            $typeProcedure = ((isset($_POST['typeProcedure']) && !empty($_POST['typeProcedure'])) ? htmlspecialchars($_POST['typeProcedure']) : ((isset($projet) && !empty($projet)) ? $projet -> gettypeProcedure() : '' ));
            
            $dateReceptionDAO = ((isset($_POST['dateReceptionDAO']) && !empty($_POST['dateReceptionDAO'])) ? htmlspecialchars($_POST['dateReceptionDAO']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateReceptionDAO() : '' ));
            $dateAnoSurDAO = ((isset($_POST['dateAnoSurDAO']) && !empty($_POST['dateAnoSurDAO'])) ? htmlspecialchars($_POST['dateAnoSurDAO']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateAnoSurDAO() : '' ));
            $datePublicationDAO = ((isset($_POST['datePublicationDAO']) && !empty($_POST['datePublicationDAO'])) ? htmlspecialchars($_POST['datePublicationDAO']) : ((isset($projet) && !empty($projet)) ? $projet -> getdatePublicationDAO() : '' ));
            $dateOuverturePlis = ((isset($_POST['dateOuverturePlis']) && !empty($_POST['dateOuverturePlis'])) ? htmlspecialchars($_POST['dateOuverturePlis']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateOuverturePlis() : '' ));
            $dateRapportEvaluation = ((isset($_POST['dateRapportEvaluation']) && !empty($_POST['dateRapportEvaluation'])) ? htmlspecialchars($_POST['dateRapportEvaluation']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateRapportEvaluation() : '' ));
            $dateAnoSurRapEval = ((isset($_POST['dateAnoSurRapEval']) && !empty($_POST['dateAnoSurRapEval'])) ? htmlspecialchars($_POST['dateAnoSurRapEval']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateAnoSurRapEval() : '' ));
            $dateNotifProvisoir = ((isset($_POST['dateNotifProvisoir']) && !empty($_POST['dateNotifProvisoir'])) ? htmlspecialchars($_POST['dateNotifProvisoir']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateNotifProvisoir() : '' ));
            $projetNegoContrat = ((isset($_POST['projetNegoContrat']) && !empty($_POST['projetNegoContrat'])) ? htmlspecialchars($_POST['projetNegoContrat']) : ((isset($projet) && !empty($projet)) ? $projet -> getProjetNegoContrat() : '' ));
            $dateAnoProjetContrat = ((isset($_POST['dateAnoProjetContrat']) && !empty($_POST['dateAnoProjetContrat'])) ? htmlspecialchars($_POST['dateAnoProjetContrat']) : ((isset($projet) && !empty($projet)) ? $projet -> getDateAnoProjetContrat() : '' ));
            $attribuaire = ((isset($_POST['attribuaire']) && !empty($_POST['attribuaire'])) ? htmlspecialchars($_POST['attribuaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getattribuaire() : '' ));
            $approbationAttribuaire = ((isset($_POST['approbationAttribuaire']) && !empty($_POST['approbationAttribuaire'])) ? htmlspecialchars($_POST['approbationAttribuaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationAttribuaire() : '' ));
            $montant = ((isset($_POST['montant']) && !empty($_POST['montant'])) ? htmlspecialchars($_POST['montant']) : ((isset($projet) && !empty($projet)) ? $projet -> getMontant() : '' ));
            $approbationAC = ((isset($_POST['approbationAC']) && !empty($_POST['approbationAC'])) ? $_POST['approbationAC'] : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationAC() : '' ));
            $approbationACGPMP = ((isset($_POST['approbationACGPMP']) && !empty($_POST['approbationACGPMP'])) ? htmlspecialchars($_POST['approbationACGPMP']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationACGPMP() : '' ));
            $approbationMEF = ((isset($_POST['approbationMEF']) && !empty($_POST['approbationMEF'])) ? htmlspecialchars($_POST['approbationMEF']) : ((isset($projet) && !empty($projet)) ? $projet -> getApprobationMEF() : '' ));
            $enregistrementImpots = ((isset($_POST['enregistrementImpots']) && !empty($_POST['enregistrementImpots'])) ? htmlspecialchars($_POST['enregistrementImpots']) : ((isset($projet) && !empty($projet)) ? $projet -> getEnregistrementImpots() : '' ));
            $immatriculation = ((isset($_POST['immatriculation']) && !empty($_POST['immatriculation'])) ? htmlspecialchars($_POST['immatriculation']) : ((isset($projet) && !empty($projet)) ? $projet -> getImmatriculation() : '' ));
           
		   // $totalJour = ((isset($_POST['totalJour']) && !empty($_POST['totalJour'])) ? htmlspecialchars($_POST['totalJour']) : ((isset($projet) && !empty($projet)) ? $projet -> getTotalJour() : '' ));
           // $inferieur60 = ((isset($_POST['inferieur60']) && !empty($_POST['inferieur60'])) ? htmlspecialchars($_POST['inferieur60']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur60() : '' ));
           // $inferieur90 = ((isset($_POST['inferieur90']) && !empty($_POST['inferieur90'])) ? htmlspecialchars($_POST['inferieur90']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur90() : '' ));
           // $inferieur120 = ((isset($_POST['inferieur120']) && !empty($_POST['inferieur120'])) ? htmlspecialchars($_POST['inferieur120']) : ((isset($projet) && !empty($projet)) ? $projet -> getInferieur120() : '' ));
           // $superieur120 = ((isset($_POST['superieur120']) && !empty($_POST['superieur120'])) ? htmlspecialchars($_POST['superieur120']) : ((isset($projet) && !empty($projet)) ? $projet -> getSuperieur120() : '' ));
            $commentaire = ((isset($_POST['commentaire']) && !empty($_POST['commentaire'])) ? htmlspecialchars($_POST['commentaire']) : ((isset($projet) && !empty($projet)) ? $projet -> getCommentaire() : '' ));
  			
			if(isset($_POST['action']) && $_POST['action']){
                
               // $projet = new Projet ();
                $projet -> setautoriteContractante($autoriteContractante);
                $projet -> setdescription($description);
                $projet -> setsourceFinancement($sourceFinancement);
                $projet -> settypeProcedure($typeProcedure);
                $projet -> setdateReceptionDAO($dateReceptionDAO);
                $projet -> setDateAnoSurDAO($dateAnoSurDAO);
                $projet -> setDatePublicationDAO($datePublicationDAO);
                $projet -> setdateOuverturePlis($dateOuverturePlis);
                $projet -> setdateRapportEvaluation($dateRapportEvaluation);
                $projet -> setDateAnoSurRapEval($dateAnoSurRapEval);
                $projet -> setDateNotifProvisoir($dateNotifProvisoir);
                $projet -> setprojetNegoContrat($projetNegoContrat);
                $projet -> setDateAnoProjetContrat($dateAnoProjetContrat);
                $projet -> setattribuaire($attribuaire);
				$projet -> setApprobationAttribuaire($approbationAttribuaire);
				$projet -> setmontant($montant);
                $projet -> setapprobationAC($approbationAC);
				$projet -> setapprobationACGPMP($approbationACGPMP);
                $projet -> setapprobationMEF($approbationMEF);
                $projet -> setEnregistrementImpots($enregistrementImpots);
                $projet -> setImmatriculation($immatriculation);
                $projet -> settotalJour($totalJour);
                $projet -> setInferieur60($inferieur60);
                $projet -> setInferieur90($inferieur90);
                $projet -> setInferieur120($inferieur120);
                $projet -> setSuperieur120($inferieur120);
                $projet -> setCommentaire($commentaire);

                 $projet -> setIdProjet($_SESSION['id']);

               if ($_POST['action']=='Update') {
                    // echo "......update <br/>";
                   $data_updated = $obj_bdd -> updateProjet($projet) ;
                     $id = $_SESSION['id'];
                     unset($_SESSION['id']);
                     $_SESSION['data_updated'] = true;
                     header('location:projet.php?id='.$id);


                } elseif ($_POST['action']=='Insert') {
                    echo "......insert <br/>";
                    $data_inserted = $obj_bdd -> insertProjet($projet) ;
                    $_SESSION['data_inserted'] = true;
                    header('location:projet.php?action=new');

                }		
			}
			
			?>
        <div class="content">
		 <div class="container-fluid" style="margin-left:25%;" >	
		<?php

            if(isset($_SESSION['data_updated']) && $_SESSION['data_updated'] == true){
				 echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span> Les données du projet ont été mise à jour avec succès</strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> Le formulaire a été rechargé avec succès</strong>
						</div>
					</div>
				</div>";
                unset($_SESSION['data_updated']);
			} elseif(isset($_SESSION['data_inserted']) && $_SESSION['data_inserted'] == true) {
                 echo"
				   <div class='col-lg-8 col-md-push-1'>
					<div class='col-md-12'>
						<div class='alert alert-success'>
							<strong><span class='glyphicon glyphicon-ok'></span> Les données du projet ont été inserées avec succès</strong><br/>
							<strong><span class='glyphicon glyphicon-ok'></span> Le formulaire a été vidé avec succès</strong>
						</div>
					</div>
				</div>";
                unset($_SESSION['data_inserted']);
            }
            
		?>
		<form role="form" action = 'projet.php' method='POST'>
            <div class="col-lg-8 center">
             <?php 
                    $droits = array(
                        'autoriteContractante' => 'readonly', // creation
                        'description' => 'readonly',  // creation 
                        'sourceFinancement' => 'readonly', // creation
                        'typeProcedure' => 'readonly',
                        'dateReceptionDAO' => 'readonly',
                        'dateAnoSurDAO' => 'readonly',
                        'datePublicationDAO' => 'readonly',
                        'dateOuverturePlis' => 'readonly',
                        'dateRapportEvaluation' => 'readonly',
                        'dateAnoSurRapEval' => 'readonly',
                        'dateNotifProvisoir' => 'readonly',
                        'projetNegoContrat' => 'readonly',
                        'dateAnoProjetContrat' => 'readonly',
                        'attribuaire' => 'readonly',
                        'approbationAttribuaire' => 'readonly',
                        'montant' => 'readonly',
                        'approbationAC' => 'readonly',
                        'approbationACGPMP' => 'readonly',
                        'approbationMEF' => 'readonly',
                        'enregistrementImpots' => 'readonly',
                        'immatriculation' => 'readonly',
                        'commentaire' => ''
                        );

                    if (isset($_SESSION['levelUser'])) {
                        // user level 1
                        if($_SESSION['levelUser'] == 1) {
                         if(!empty($autoriteContractante) &&
                             !empty($description) &&
                                !empty($sourceFinancement) &&
                                 !empty($typeProcedure) &&
                                 !empty($dateReceptionDAO)) {
                            
                         
                           $droits ['dateAnoSurDAO'] = '';
                           $droits ['dateAnoSurRapEval'] = '';
                           $droits ['dateNotifProvisoir'] = '';
                           $droits ['dateAnoProjetContrat'] = '';
                         }

                           $droits ['autoriteContractante'] = '';
                           $droits ['description'] = '';
                           $droits ['sourceFinancement'] = '';
                           $droits ['typeProcedure'] = '';
                           $droits ['dateReceptionDAO'] = '';
   
                       }
                        if($_SESSION['levelUser'] == 2 ) {

                          if(!empty($autoriteContractante) &&
                             !empty($description) &&
                                !empty($sourceFinancement) &&
                                 !empty($typeProcedure) &&
                                 !empty($dateReceptionDAO)) {
    
                            $droits ['dateReceptionDAO'] = '';
                            $droits ['dateAnoSurDAO'] = '';
                            $droits ['dateAnoSurRapEval'] = '';
                            $droits ['dateAnoProjetContrat'] = '';
                            $droits ['approbationACGPMP'] = '';
                         }

                           $droits ['autoriteContractante'] = '';
                           $droits ['description'] = '';
                           $droits ['sourceFinancement'] = '';
                           $droits ['typeProcedure'] = '';
                           $droits ['dateReceptionDAO'] = '';
                           
                       }
                        if($_SESSION['levelUser'] == 3 ) {
                           $droits ['dateOuverturePlis'] = '';
                           $droits ['dateRapportEvaluation'] = '';
                           $droits ['immatriculation'] = '';

                       }
                      if($_SESSION['levelUser'] == 4 ) {
                           $droits ['datePublicationDAO'] = '';
                           $droits ['projetNegoContrat'] = '';
                           $droits ['attribuaire'] = '';
                           $droits ['approbationAttribuaire'] = '';
                           $droits ['approbationAC'] = '';
                           $droits ['enregistrementImpots'] = '';
                       }
                        if($_SESSION['levelUser'] == 5 ) {
                           $droits ['approbationMEF'] = '';
                       }

                    }
                       

                ?>




              <div class="form-group">
                    <label for="autoriteContractante">Autorité Contractante</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="autoriteContractante" id="autoriteContractante" placeholder="Autorité Contractante " 
                             <?php echo"value='$autoriteContractante'" ;?>
                             <?php echo $droits['autoriteContractante']; ?>
                              />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Desciption"
                          <?php echo"value='$description'" ;?> 
                          <?php echo $droits['description']; ?>
                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label for="sourceFinancement">Source de financement</label>
                    <div class="input-group"> <input type="text" class="form-control" name="sourceFinancement" id="sourceFinancement" placeholder="sourceFinancement"
                       <?php echo"value='$sourceFinancement'" ;?>
                       <?php echo $droits['sourceFinancement']; ?>
                       />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="typeProcedure">type Procedure</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="typeProcedure" id="typeProcedure" placeholder="typeProcedure"
                          <?php echo"value='$typeProcedure'" ;?> 
                           <?php echo $droits['typeProcedure']; ?>

                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
               

                <div class="form-group">
                    <label for="dateReceptionDAO">Date Reception DAO</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateReceptionDAO" id="dateReceptionDAO" 
                            <?php echo"value='$dateReceptionDAO'" ; ?> 
                             <?php echo $droits['dateReceptionDAO']; ?>
                            />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				 <div class="form-group">
                    <label for="dateAnoSurDAO">Date Ano sur DAO</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateAnoSurDAO" id="dateAnoSurDAO" placeholder="date ano sur DAO"
                           <?php echo"value='$dateAnoSurDAO'" ;?> 
                           <?php echo $droits['dateAnoSurDAO']; ?>                           
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datePublicationDAO">Date Publication DAO </label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="datePublicationDAO" id="datePublicationDAO"   
                            <?php echo"value='$datePublicationDAO'" ;?> 
                            <?php echo $droits['datePublicationDAO']; ?> 
                            />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="dateOuverturePlis">Date Ouverture Plis</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateOuverturePlis" id="dateOuverturePlis"
                           <?php echo"value='$dateOuverturePlis'";?> 
                             <?php echo $droits['dateOuverturePlis']; ?>                                                      
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>               
                <div class="form-group">
                    <label for="dateRapportEvaluation">Date Rapport Evaluation</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateRapportEvaluation" id="dateRapportEvaluation"
                           <?php echo"value='$dateRapportEvaluation'" ;?>
                           <?php echo $droits['dateRapportEvaluation']; ?>   
                            />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="dateAnoSurRapEval">Date Ano Rapport Evaluation</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateAnoSurRapEval" id="dateAnoSurRapEval"
                           <?php echo"value='$dateAnoSurRapEval'" ;?>
                            <?php echo $droits['dateAnoSurRapEval']; ?>   
                            />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="dateNotifProvisoir">Date Notification Provisoire</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateNotifProvisoir" id="dateNotifProvisoir"  
                          <?php echo"value='$dateNotifProvisoir'" ; ?> 
                          <?php echo $droits['dateNotifProvisoir']; ?>
                          
                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>  
                 <div class="form-group">
                    <label for="projetNegoContrat">Date Reception et Negociation Projet  Contrat</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="projetNegoContrat" id="projetNegoContrat" 
                          <?php echo"value='$projetNegoContrat'" ;?> 
                          <?php echo $droits['projetNegoContrat']; ?>
                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dateAnoProjetContrat">Projet Ano Projet de Contrat</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dateAnoProjetContrat" id="dateAnoProjetContrat" 
                          <?php echo"value='$dateAnoProjetContrat'" ;?> 
                          <?php echo $droits['dateAnoProjetContrat']; ?>
                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="attribuaire">Attributaire</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="attribuaire" id="attribuaire"
                           <?php echo"value='$attribuaire'" ;?>
                           <?php echo $droits['attribuaire']; ?>
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationAttribuaire">Signature Attributaire</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="approbationAttribuaire" id="approbationAttribuaire"
                           <?php echo"value='$approbationAttribuaire'" ;?> 
                           <?php echo $droits['approbationAttribuaire']; ?>
                        />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="montant" id="montant" placeholder="Montant"
                           <?php echo"value='$montant'" ;?>
                           <?php echo $droits['montant']; ?>                           
                          />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="approbationAC">Signature AC</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="approbationAC" id="approbationAC"
                           <?php echo"value='$approbationAC'" ;?> 
                           <?php echo $droits['approbationAC']; ?> 
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationACGPMP">Signature ACGPMP</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="approbationACGPMP" id="approbationACGPMP"
                           <?php echo"value='$approbationACGPMP'" ;?> 
                           <?php echo $droits['approbationACGPMP']; ?>                            
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="approbationMEF">Signature MEF</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="approbationMEF" id="approbationMEF"
                           <?php echo"value='$approbationMEF'" ;?>
                           <?php echo $droits['approbationMEF']; ?>                            
                            />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="enregistrementImpots">Enregistrement Impots</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="enregistrementImpots" id="enregistrementImpots"
                           <?php echo"value='$enregistrementImpots'" ;?> 
                           <?php echo $droits['enregistrementImpots']; ?> 
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="immatriculation" id="immatriculation" 
                          <?php echo"value='$immatriculation'" ;?>
                           <?php echo $droits['immatriculation']; ?> 
                           />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="totalJour">Total Jour</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="totalJour" id="totalJour" disabled="disabled"  <?php echo"value='$totalJour'" ;?> >
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inferieur60"> Inferieur 60 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur60" id="inferieur60" placeholder="inferieur 60" disabled="disabled" <?php echo"value='$inferieur60'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inferieur90"> Inferieur 90 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur90" id="inferieur90" placeholder="inferieur 90" disabled="disabled" <?php echo"value='$inferieur90'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inferieur120"> Inferieur 120 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="inferieur120" id="inferieur120" placeholder="inferieur 120" disabled="disabled"  <?php echo"value='$inferieur120'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="superieur120"> Superieur 120 </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="superieur120" id="superieur120" placeholder="superieur 120" disabled="disabled" <?php echo"value='$superieur120'" ;?>>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
				<div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="commentaire" id="commentaire" placeholder="commentaire"  
                        <?php echo"value='$commentaire'" ;?> 
                        <?php echo $droits['commentaire']; ?> 
                        />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
								
				<input type ='hidden' name = 'action' <?php echo"value='$action'" ;?> />
                <?php
                    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
                        echo "<a href='alertes.php?projet=$_SESSION[id]' class='btn btn-info pull-right' style ='margin-left:10px;'>
                            Voir l'historique des alertes
                        </a> ";
                    }
                ?> 
               <input type="submit" name="submit" id="submit" value="Soumettre " class="btn btn-info pull-right">
               
           
            </div>
        </form>
			
			
			
			
		 </div>
        </div>


       <!--footer -->
	    <?php 
		require_once('inc/footer.inc.php');
		?>

    </div>
</div>

</body>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

 
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
</html>
<?php 
   }
 ?>