<?php 
class Projet {

	private $idProjet ;
	//private $idImport ;
	private $autoriteContractante ; 
	private $description ; 
	private $sourceFinancement ; 
	private $typeProcedure ; 
	private $dateReceptionDAO ; 
	private $dateAnoSurDAO ;
	private $datePublicationDAO; 
	private $dateOuverturePlis ; 
	private $dateRapportEvaluation ; 
	private $dateAnoSurRapEval ;
	private $dateNotifProvisoir ;
	private $projetNegoContrat ;
	private $dateAnoProjetContrat ;
	private $attribuaire ;
	private $approbationAttribuaire ;
	private $montant ;
	private $approbationAC ;
	private $approbationACGPMP ;
	private $approbationMEF ;
	private $enregistrementImpots ;
	private $immatriculation ;
	private $totalJour ;
	private $inferieur60 ;
	private $inferieur90 ;
	private $inferieur120 ;
	private $superieur120 ;
	private $commentaire ;
	private $dateInsertion ;

		
	// les getteurs
	public function getIdProjet () { return $this -> idProjet; }
	//public function getIdImport () { return $this -> idImport; }
	public function getSourceFinancement () { return $this -> sourceFinancement; }
	public function getAutoriteContractante () { return $this -> autoriteContractante; }
	public function getDescription () { return $this -> description; }
	public function getTypeProcedure () { return $this -> typeProcedure; }
	public function getDateReceptionDAO () { return $this -> dateReceptionDAO; }
	public function getDateAnoSurDAO () { return $this -> dateAnoSurDAO; }
	public function getDatePublicationDAO () { return $this -> datePublicationDAO; }
	public function getDateOuverturePlis () { return $this -> dateOuverturePlis; }
	public function getDateRapportEvaluation () { return $this -> dateRapportEvaluation; }
	public function getDateAnoSurRapEval () { return $this -> dateAnoSurRapEval; }
	public function getDateNotifProvisoir () { return $this -> dateNotifProvisoir; }
	public function getprojetNegoContrat() { return $this -> projetNegoContrat ; }
	public function getDateAnoProjetContrat() { return $this -> dateAnoProjetContrat ; }
	public function getAttribuaire() { return $this -> attribuaire ; }
	public function getApprobationAttribuaire() { return $this -> approbationAttribuaire ; }
	public function getMontant() { return $this -> montant ; }
	public function getApprobationAC() { return $this -> approbationAC ; }
	public function getApprobationACGPMP() { return $this -> approbationACGPMP ; }
	public function getApprobationMEF() { return $this -> approbationMEF ; }
	public function getEnregistrementImpots() { return $this -> enregistrementImpots ; }
	public function getImmatriculation() { return $this -> immatriculation ; }
	public function getTotalJour() { return $this -> totalJour ; }
	public function getInferieur60() { return $this -> inferieur60 ; }
	public function getInferieur90() { return $this -> inferieur90 ; }
	public function getInferieur120() { return $this -> inferieur120 ; }
	public function getSuperieur120() { return $this -> superieur120 ; }
	public function getCommentaire() { return $this -> commentaire ; }
	public function getDateInsertion() { return $this -> dateInsertion ; }
	
	//les setters
	public function setIdProjet($p) { $this -> idProjet = $p ; }
	public function setIdImport($p) { $this -> idImport = $p ; }
	public function setSourceFinancement($p) { $this -> sourceFinancement = $p ; }
	public function setAutoriteContractante($p) { $this -> autoriteContractante = $p ; }
	public function setDescription($p) { $this -> description = $p ; }
	public function setTypeProcedure($p) { $this -> typeProcedure = $p ; }
	public function setDateReceptionDAO($p) { $this -> dateReceptionDAO = $p ; }
	public function setDateAnoSurDAO($p) { $this -> dateAnoSurDAO = $p ; }
	public function setDatePublicationDAO($p) { $this -> datePublicationDAO = $p ; }
	public function setDateOuverturePlis($p) { $this -> dateOuverturePlis = $p ; }
	public function setDateRapportEvaluation($p) { $this -> dateRapportEvaluation = $p ; }
	public function setDateAnoSurRapEval($p) { $this -> dateAnoSurRapEval = $p ; }
	public function setDateNotifProvisoir($p) { $this -> dateNotifProvisoir = $p ; }
	
	public function setprojetNegoContrat($p) { $this -> projetNegoContrat = $p ; }
	public function setDateAnoProjetContrat($p) { $this -> dateAnoProjetContrat = $p ;}
	public function setAttribuaire($p) { $this -> attribuaire = $p ; }
	public function setApprobationAttribuaire($p) { $this -> approbationAttribuaire = $p ; }
	public function setMontant($p) { $this -> montant = $p ; }
	public function setApprobationAC($p) { $this -> approbationAC = $p ; }
	public function setapprobationACGPMP($p) { $this -> approbationACGPMP = $p ; }
	public function setapprobationMEF($p) { $this -> approbationMEF = $p ; }
	public function setEnregistrementImpots($p) { $this -> enregistrementImpots = $p ; }
	public function setImmatriculation($p) { $this -> immatriculation = $p ; }
	public function setTotalJour($p) { $this -> totalJour = $p ; }
	public function setInferieur60($p) { $this -> inferieur60 = $p ; }
	public function setInferieur90($p) { $this -> inferieur90 = $p ; }
	public function setInferieur120($p) { $this -> inferieur120 = $p ; }
	public function setSuperieur120($p) { $this -> superieur120 = $p ; }
	public function setCommentaire($p) { $this -> commentaire = $p ; }
	public function setDateInsertion($p) { $this -> dateInsertion = $p ; }

	// les dates excedentaires

	public function getDateReceptionDAOEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this ->getDateReceptionDAO(), $this -> getDateAnoSurDAO());
		 $autorise =  (int) $reception_ano['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function getDateAnoSurDAOEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this ->getDateAnoSurDAO(), $this -> getDatePublicationDAO());
		 $autorise =  (int) $ano_publication['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function getDatePublicationDAOEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this ->getDatePublicationDAO(), $this -> getDateOuverturePlis());
		 $autorise =  (int) $publication_ouverture['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getDateOuverturePlisEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getDateOuverturePlis(), $this -> getDateRapportEvaluation());
		 $autorise =  (int) $ouverture_evaluation['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	
	public function  getDateRapportEvaluationEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getDateRapportEvaluation(), $this -> getDateAnoSurRapEval());
		 $autorise =  (int) $evaluation_rapport['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getDateAnoSurRapEvalEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getDateAnoSurRapEval(), $this -> getDateNotifProvisoir());
		 $autorise =  (int) $rapport_provisoir['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	/////
	public function  getDateNotifProvisoirEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getDateNotifProvisoir(), $this -> getprojetNegoContrat());
		 $autorise =  (int) $provisoir_nego['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
		public function  getprojetNegoContratEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getprojetNegoContrat(), $this -> getDateAnoProjetContrat());
		 $autorise =  (int) $nego_contrat['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getDateAnoProjetContratEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getDateAnoProjetContrat(), $this ->getApprobationAttribuaire());
		 $autorise =  (int) $contrat_attribuaire['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	} //////
	public function  getApprobationAttribuaireEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getApprobationAttribuaire(), $this ->getApprobationAC());
		 $autorise =  (int) $attribuaire_ac['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getApprobationACEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getApprobationAC(), $this ->getApprobationACGPMP());
		 $autorise =  (int) $ac_acgpmp['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getApprobationACGPMPEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getApprobationACGPMP(), $this ->getApprobationMEF());
		 $autorise =  (int) $acgpmp_mef['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getApprobationMEFEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getApprobationMEF(), $this ->getEnregistrementImpots());
		 $autorise =  (int) $mef_impot['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}
	public function  getEnregistrementImpotsEx(){
		 require('inc/array_interval.inc.php');
		 $res = (int) $this -> calculateInterval($this -> getEnregistrementImpots(), $this ->getImmatriculation());
		 $autorise =  (int) $impot_immatriculation['autorise'] ;
		 if( $res > $autorise) {
			 return $res - $autorise;
		 } else {
			 return 0 ;
		 }
	}

 public function calculateInterval ($date1, $date2) {
	 // le format des dates 
	  $format = 'Y-m-d';
		$dif = 0 ;

	 if(!empty($date1) && !empty($date2)){
		 $d1 =  DateTime::createFromFormat($format, $date1);
		 $d2 =  DateTime::createFromFormat($format, $date2);
		
		 if($d1 != false ){
			  if($d2 != false ) {
					$dif = date_diff($d1, $d2) -> days ;
				}else {
					// si la date suivante n'est pas fourni on prend la date actuelle
					$today = DateTime::createFromFormat($format, date ($format)) ;
					$dif =  date_diff($d1, $today) -> days ;
				}
		 }
	 }
	 return $dif;
 }



	public function __construct(){
	  if(func_num_args() >0)
		 $this -> initialiseProjet(func_get_arg(0));
	}
	
	private function initialiseProjet(array $donnee){
		$this -> hydrate($donnee);  
	}
	
	//approbationACGPMP d'arrosage
	public function hydrate(array $tab) {
		foreach ($tab as $cle => $valeur){
				$methode = 'set'.ucfirst($cle);
				if (method_exists($this, $methode)){
				  	$this -> $methode($valeur);
				}
			}
	}
	
}//class

?>