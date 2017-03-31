<?php
class CRUD{
	private $bdd ;
	public function __construct($bdd) {
			$this->setDb($bdd); 
			}

	public function setDb($p) {
			$this -> bdd = $p ; 
		}

	public function insertProjet(Projet $projet) {
				$req = $this -> bdd -> prepare("INSERT IGNORE INTO projet (
																					idProjet,
																					numContrat,
																					autoriteContractante,
																					description,
																					beneficiaire,
																					phase,
																					montant,
																					dateReceptionDAO,
																					dateOuverturePlis,
																					dateRapportEvaluation,
																					datePublicationAttribution,
																					projetCeContrat,
																					approbationAttribuaire,
																					approbationAC,
																					approbationACGPMP,
																					approbationMEF,
																					totalJour,
																					inferieur60,
																					inferieur90,
																					inferieur120,
																					superieur120,
																					commentaire,
																					dateInsertion
																				)
															VALUES(
																			'',
																			:numContrat,
																			:autoriteContractante,
																			:description,
																			:beneficiaire,
																			:phase,
																			:montant,
																			:dateReceptionDAO,
																			:dateOuverturePlis,
																			:dateRapportEvaluation,
																			:datePublicationAttribution,
																			:projetCeContrat,
																			:approbationAttribuaire,
																			:approbationAC,
																			:approbationACGPMP,
																			:approbationMEF,
																			:totalJour,
																			:inferieur60,
																			:inferieur90,
																			:inferieur120,
																			:superieur120,
																			:commentaire,
																			NOW()
																)
							");
				$req->execute(
					array(
							'numContrat' => $projet -> getNumContrat(),
							'autoriteContractante' => $projet -> getAutoriteContractante(),
							'description' => $projet -> getDescription(),
							'beneficiaire' => $projet -> getBeneficiaire(),
							'phase' => $projet -> getPhase(),
							'montant' => $projet -> getMontant(),
							'dateReceptionDAO' => $projet -> getDateReceptionDAO(),
							'dateOuverturePlis' => $projet -> getDateOuverturePlis(),
							'dateRapportEvaluation' => $projet -> getDateRapportEvaluation(),
							'datePublicationAttribution' => $projet -> getDatePublicationAttribution(),
							'projetCeContrat' => $projet -> getProjetCeContrat(),
							'approbationAttribuaire' => $projet -> getApprobationAttribuaire(),
							'approbationAC' => $projet -> getApprobationAC(),
							'approbationACGPMP' => $projet -> getApprobationACGPMP(),
							'approbationMEF' => $projet -> getApprobationMEF(),
							'totalJour' => $projet -> getTotalJour(),
							'inferieur60' => $projet -> getInferieur60(),
							'inferieur90' => $projet -> getInferieur90(),
							'inferieur120' => $projet -> getInferieur120(),
							'superieur120' => $projet -> getSuperieur120(),
							'commentaire' => $projet -> getCommentaire()
					)
				);
			return true;
			}
		
		public function insertUser(User $user){
			$req = $this -> bdd -> prepare(
									'INSERT IGNORE INTO user (nomUser,prenomUser,emailUser,passUser,telephoneUser,dateInscription) 
											VALUES(:nomUser,:prenomUser,:emailUser,:passUser,:telephoneUser,NOW())
								');
					$req->execute(
						array(
							'nomUser' => $user -> getNomUser(),
							'prenomUser' => $user -> getPrenomUser(),
							'emailUser' => $user -> getEmailUser(),
							'passUser' => $user -> getPassUser(),
							'telephoneUser' => $user -> getTelephoneUser()
						)
					);
			}
		
		
			public function insertSubstance(Substance $substance){
				$req = $bdd->prepare ('INSERT IGNORE INTO substance (substance,nomSubstance)
										VALUES (:substance,:nomSubstance) 
									');
				$req->execute(
					array(
						'substance' => $substance -> getSubstance(),
						'nomSubstance' => $substance -> getNomSubstance()
					)
				);
			}//fct
			
			public function insertPrefecture(Prefecture $prefecture){
				$req = $bdd->prepare ('INSERT IGNORE INTO substance (idPrefecture,nomPrefecture)
										VALUES (:idPrefecture, :nomPrefecture)
									');
				$req->execute(
					array(
						'idPrefecture' => $prefecture -> getIdPrefecture(),
						'nomPrefecture' => $prefecture -> getNomPrefecture()
					)
				);
		}//fct

	public function updateProjet(Projet $projet) {
					$req = $this->bdd->prepare('UPDATE projet 
										SET 
											numContrat = :numContrat,	
											autoriteContractante = :autoriteContractante,
											description = :description,
											beneficiaire = :beneficiaire,
											phase = :phase,
											montant = :montant,
											dateReceptionDAO = :dateReceptionDAO,
											dateOuverturePlis = :dateOuverturePlis,
											dateRapportEvaluation = :dateRapportEvaluation,
											datePublicationAttribution = :datePublicationAttribution,
											projetCeContrat = :projetCeContrat,
											approbationAttribuaire = :approbationAttribuaire,
											approbationAC = :approbationAC,
											approbationACGPMP = :approbationACGPMP,
											approbationMEF = :approbationMEF,
											totalJour = :totalJour,
											inferieur60 = :inferieur60,
											inferieur90 = :inferieur90,
											inferieur120 = :inferieur120,
											superieur120 = :superieur120,
											commentaire = :commentaire
										WHERE idProjet = :idProjet
										');
			$req->execute( array(
							'numContrat' => $projet -> getNumContrat(),
							'autoriteContractante' => $projet -> getAutoriteContractante(),
							'description' => $projet -> getDescription(),
							'beneficiaire' => $projet -> getBeneficiaire(),
							'phase' => $projet -> getPhase(),
							'montant' => $projet -> getMontant(),
							'dateReceptionDAO' => $projet -> getDateReceptionDAO(),
							'dateOuverturePlis' => $projet -> getDateOuverturePlis(),
							'dateRapportEvaluation' => $projet -> getDateRapportEvaluation(),
							'datePublicationAttribution' => $projet -> getDatePublicationAttribution(),
							'projetCeContrat' => $projet -> getProjetCeContrat(),
							'approbationAttribuaire' => $projet -> getApprobationAttribuaire(),
							'approbationAC' => $projet -> getApprobationAC(),
							'approbationACGPMP' => $projet -> getApprobationACGPMP(),
							'approbationMEF' => $projet -> getApprobationMEF(),
							'totalJour' => $projet -> getTotalJour(),
							'inferieur60' => $projet -> getInferieur60(),
							'inferieur90' => $projet -> getInferieur90(),
							'inferieur120' => $projet -> getInferieur120(),
							'superieur120' => $projet -> getSuperieur120(),
							'commentaire' => $projet -> getCommentaire(),
							'idProjet'  => $projet -> getIdProjet()
					)); 
			return true; 
		}//fct

	public function selectProjetAll() {
			$requete = $this -> bdd ->query('SELECT * FROM projet
											ORDER BY dateInsertion DESC
										');	  
			$results = array();		
			if($requete ->rowCount()>0){ //ya des resultat
					while($tmp = $requete -> fetch()){
						$results[] = new Projet($tmp);
				}
				return $results;
			}else return null; 
		}//fct
		
	public function selectProjet($debut, $fin) {
			$debut = (int) $debut;
			$fin = (int) $fin;
			$requete = $this -> bdd ->prepare('SELECT * FROM projet
												ORDER BY dateInsertion DESC
												LIMIT :debut,:fin ');
			$requete->bindValue(':debut', $debut, PDO::PARAM_INT);
			$requete->bindValue(':fin', $fin, PDO::PARAM_INT);
			$requete->execute();
					
			$results = array();		
			if($requete ->rowCount()>0){ //ya des resultat
					while($tmp = $requete -> fetch()){
						$results[] = new Projet($tmp);
				}
				return $results;
			}else return null; 
		}//fct
		
	public function selectProjetById($id) {
			$id = (int) $id;
			$requete = $this -> bdd ->prepare('SELECT * FROM projet
												WHERE idProjet = :id
												ORDER BY dateInsertion DESC
												LIMIT 1
												');
			$requete->bindValue(':id', $id, PDO::PARAM_INT);
			$requete->execute();
					
			$result = array();	
			if($requete ->rowCount()>0){ //ya des resultat
				$tmp = $requete -> fetch();
				$result = new Projet($tmp);
				return $result;
			}else return null; 
		}//fct
		
	public function selectUserByEmailPass($email,$pass) {
			$email = htmlspecialchars($email);
			$pass = htmlspecialchars($pass);
			
			$requete = $this -> bdd ->prepare('SELECT * FROM user
												WHERE emailUser = :email AND passUser = :pass
												LIMIT 1
										');
			
			$requete->execute(array(
							'email' => $email,
							'pass' => $pass
							));
					
			$users = array();		
			if($requete ->rowCount()>0){ 
				while($tmp = $requete -> fetch()){
						$users[] = new User($tmp);
				}
				return $users;
			}else return null; 
		}//fct
		
	public function selectUserById($id) {
			$id = htmlspecialchars($id);
			
			$requete = $this -> bdd ->prepare('SELECT * FROM user
												WHERE idUser = :id
												LIMIT 1
												');
			$requete->execute(array(
							'id' => $id
							));
							
			if($requete ->rowCount()>0){ 
				$tmp = $requete -> fetch();
				$user = new User($tmp);
				return $user;
			}else return null; 
		}//fct

			
		//seule fonction de modification des infos et du password
	public function updateUser(User $user) {
        $req = $this->bdd->prepare('UPDATE user 
									SET 
										nomUser = :nom,	
										prenomUser = :prenom, 
										emailUser = :email, 
										passUser = :pass, 
										telephoneUser = :telephone,
										recevoirEmail = :recevoirEmail
									WHERE idUser =:id
									');
		$req->execute(array(
						'nom' => $user -> getNomUser(),
						'prenom' => $user -> getPrenomUser(),
						'email' => $user -> getEmailUser(),
						'pass' => $user -> getPassUser(),
						'telephone' => $user -> getTelephoneUser(),
						'recevoirEmail' => $user -> getRecevoirEmail(),
						'id' => $user -> getIdUser()
				)); 
		return true; 
  }//fct

	public function selectUsersForAlerte() {
			$requete = $this -> bdd -> query ('SELECT * FROM user
												WHERE recevoirEmail = 1
										');
			$users = array();		
			if($requete ->rowCount() > 0){ 
				while($tmp = $requete -> fetch()){
						$users[] = new User($tmp);
				}
				return $users;
			}else return null; 
		}//fct


   /////
  // fonction d'alerte'
	////

	public function insertAlert(Alert $alert){
			$req = $this -> bdd -> prepare(
									"INSERT IGNORE INTO alert (idAlert, dateAlert, typeAlert, idProjet, messageAlert) 
											VALUES('', NOW(), :typeAlert, :idProjet, :messageAlert)
								   ");
					$req->execute(
						array(
							'typeAlert' => $alert -> getTypeAlert(),
							'idProjet' => $alert -> getIdProjet(),
							'messageAlert' => $alert -> getMessageAlert()
						)
					);
			}

	public function selectAlertAll() {
			$requete = $this -> bdd ->query('SELECT * FROM alert
											ORDER BY idProjet ASC
										');	  
			$results = array();		
			if($requete ->rowCount() > 0){ //ya des resultat
					while($tmp = $requete -> fetch()){
						$results[] = new Alert($tmp);
				}
				return $results;
			}else return null; 
		}//fct

	public function selectAlertById($id) {
			$id = htmlspecialchars($id);
			
			$requete = $this -> bdd ->prepare('SELECT * FROM Alert
												WHERE idAlert = :id
												LIMIT 1
												');
			$requete->execute(array(
							'id' => $id
							));
							
			if($requete ->rowCount()>0){ 
				$tmp = $requete -> fetch();
				$Alert = new Alert($tmp);
				return $Alert;
			} else return null; 
		}//fct

		//selectionne les alertes d'un projet'
		public function selectAlertByIdProjet($id) {
			$id = htmlspecialchars($id);
			
			$requete = $this -> bdd ->prepare('SELECT * FROM Alert
												WHERE idProjet = :id
												');
			$requete->execute(array(
							'id' => $id
							));
			$results = array();				
				if($requete ->rowCount() > 0){ //ya des resultat
					while($tmp = $requete -> fetch()){
						$results[] = new Alert($tmp);
				}
				return $results;
			}else return null;
		}//fct


	//seule fonction de modification des infos et du password
	  public function updateAlert(Alert $alert) {
        $req = $this->bdd->prepare('UPDATE Alert
									SET 
										dateAlert = :dateAlert,	
										typeAlert = :typeAlert, 
										idProjet = :idProjet,
										messageAlert = :messageAlert
									WHERE idAlert =:id
									');
		$req->execute(array(
						'dateAlert' => $alert -> getDateAlert(),
						'typeAlert' => $alert -> getTypeAlert(),
						'idProjet' => $alert -> getIdProjet(),
						'messageAlert' => $alert -> getMessageAlert(),
						'id' => $alert -> getIdAlert()
				)); 
		return true; 
  }//fct
	
}//class


?>