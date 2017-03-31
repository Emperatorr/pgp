<?php 
class Alert {

	private $idAlert ;
	private $dateAlert ; 
	private $typeAlert ; 
	private $idProjet ; 
	private $messageAlert ; 
	
	// les getteurs
	public function  getIdAlert  () { return $this ->  idAlert; }
	public function  getDateAlert  () { return $this -> dateAlert ; }
	public function  getTypeAlert  () { return $this -> typeAlert ; }
	public function  getIdProjet  () { return $this -> idProjet ; }
	public function  getMessageAlert  () { return $this -> messageAlert ; }
	
	//les setters
	public function  setIdAlert($p) { $this -> idAlert = $p ; }
	public function  setDateAlert ($p) { $this -> dateAlert = $p ; }
	public function  setTypeAlert ($p) { $this -> typeAlert = $p ; }
	public function  setIdProjet ($p) { $this -> idProjet = $p ; }
	public function  setMessageAlert ($p) { $this -> messageAlert = $p ; }
	
	
		public function __construct(){
	   if(func_num_args() >0)
		  $this -> initialise(func_get_arg(0));
	}
	
	private function initialise(array $donnee){
		$this -> hydrate($donnee);   
	}
	
	
	//fonction d'arrosage
	public function hydrate(array $tab) {
		foreach ($tab as $cle => $valeur){
			  // echo"la cle $cle et la valeur $valeur <br/>";
				$methode = 'set'.ucfirst($cle);
				if (method_exists($this, $methode)){
				   	$this -> $methode($valeur);
				}else {
					// echo "la methode : $methode n'existe pas <br/>";
				}
			}
	}
	
}//class

?>