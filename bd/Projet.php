<?php 
class Projet {

	private $idProjet ;
	private $numContrat ; 
	private $autoriteContractante ; 
	private $description ; 
	private $beneficiaire ; 
	private $phase ; 
	private $montant ;
	private $dateReceptionDAO; 
	private $dateOuverturePlis ; 
	private $dateRapportEvaluation ; 
	private $datePublicationAttribution ;
	private $projetCeContrat ;
	private $approbationAttribuaire ;
	private $approbationAC ;
	private $approbationACGPMP ;
	private $approbationMEF ;
	private $totalJour ;
	private $inferieur60 ;
	private $inferieur90 ;
	private $inferieur120 ;
	private $superieur120 ;
	private $commentaire ;
	private $dateInsertion ;
	
	
	// les getteurs
	public function  getIdProjet  () { return $this ->  idProjet; }
	public function  getNumContrat  () { return $this ->  numContrat; }
	public function  getAutoriteContractante  () { return $this ->  autoriteContractante; }
	public function  getDescription  () { return $this ->  description; }
	public function  getBeneficiaire  () { return $this ->  beneficiaire; }
	public function  getPhase  () { return $this ->  phase; }
	public function  getMontant  () { return $this ->  montant; }
	public function  getDateReceptionDAO  () { return $this ->  dateReceptionDAO; }
	public function  getDateOuverturePlis  () { return $this ->  dateOuverturePlis; }
	public function  getDateRapportEvaluation  () { return $this ->  dateRapportEvaluation; }
	public function  getDatePublicationAttribution  () { return $this ->  datePublicationAttribution; }
	public function getProjetCeContrat() { return $this ->  projetCeContrat ; }
	public function getApprobationAttribuaire() { return $this -> approbationAttribuaire ; }
	public function getApprobationAC() { return $this -> approbationAC ; }
	public function getApprobationACGPMP() { return $this -> approbationACGPMP ; }
	public function getApprobationMEF() { return $this -> approbationMEF ; }
	public function getTotalJour() { return $this -> totalJour ; }
	public function getInferieur60() { return $this -> inferieur60 ; }
	public function getInferieur90() { return $this -> inferieur90 ; }
	public function getInferieur120() { return $this -> inferieur120 ; }
	public function getSuperieur120() { return $this -> superieur120 ; }
	public function getCommentaire() { return $this -> commentaire ; }
	public function getDateInsertion() { return $this ->  dateInsertion ; }
	
	//les setters
	public function setIdProjet($p) { $this -> idProjet = $p ; }
	public function setNumContrat($p) { $this -> numContrat = $p ; }
	public function setAutoriteContractante($p) { $this -> autoriteContractante = $p ; }
	public function setDescription($p) { $this -> description = $p ; }
	public function setBeneficiaire($p) { $this -> beneficiaire = $p ; }
	public function setPhase($p) { $this -> phase = $p ; }
	public function setMontant($p) { $this -> montant = $p ; }
	public function setDateReceptionDAO($p) { $this -> dateReceptionDAO = $p ; }
	public function setDateOuverturePlis($p) { $this -> dateOuverturePlis = $p ; }
	public function setDateRapportEvaluation($p) { $this -> dateRapportEvaluation = $p ; }
	public function setDatePublicationAttribution($p) { $this -> datePublicationAttribution = $p ; }
	public function setProjetCeContrat($p) { $this -> projetCeContrat = $p ; }
	public function setApprobationAttribuaire($p)  { $this -> approbationAttribuaire  = $p ; }
	public function setApprobationAC($p) {  $this -> approbationAC = $p ; }
	public function setapprobationACGPMP($p) {  $this -> approbationACGPMP  = $p ; }
	public function setApprobationMEF($p) { $this -> approbationMEF  = $p ; }
	public function setTotalJour($p) { $this -> totalJour  = $p ; }
	public function setInferieur60($p) { $this -> inferieur60  = $p ; }
	public function setInferieur90($p) { $this -> inferieur90  = $p ; }
  public function setInferieur120($p) { $this -> inferieur120  = $p ; }
	public function setSuperieur120($p) { $this -> superieur120  = $p ; }
	public function setCommentaire($p) { $this -> commentaire  = $p ; }
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