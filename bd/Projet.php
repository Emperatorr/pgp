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
