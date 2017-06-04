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
																				 autoriteContractante,
																				 description,
																				 sourceFinancement,
																				 typeProcedure,
																				 dateReceptionDAO,
																				 dateAnoSurDAO,
																				 datePublicationDAO, 
																				 dateOuverturePlis, 
																				 dateRapportEvaluation, 
																				 dateAnoSurRapEval,
																				 dateNotifProvisoir,
																				 projetNegoContrat,
																				 dateAnoProjetContrat, 
																				 attribuaire,
																				 approbationAttribuaire,
																				 montant,
																				 approbationAC,
																				 approbationACGPMP, 
																				 approbationMEF,
																				 enregistrementImpots,
																				 immatriculation,
																				 totalJour, 
																				 inferieur60, 
																				 inferieur90, 
																				 inferieur120, 
																				 superieur120, 
																				 commentaire, 
																				 dateInsertion 
																				)
															VALUES( '',
																			:autoriteContractante,
																			:description,
																			:sourceFinancement,
																			:typeProcedure,
																			:dateReceptionDAO,
																			:dateAnoSurDAO,
																			:datePublicationDAO, 
																			:dateOuverturePlis, 
																			:dateRapportEvaluation, 
																			:dateAnoSurRapEval,
																			:dateNotifProvisoir,
																			:projetNegoContrat,
																			:dateAnoProjetContrat, 
																			:attribuaire,
																			:approbationAttribuaire,
																			:montant,
																			:approbationAC,
																			:approbationACGPMP, 
																			:approbationMEF,
																			:enregistrementImpots,
																			:immatriculation,
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
							'autoriteContractante' => $projet -> getautoriteContractante(),
							'description' => $projet -> getdescription(),
							'sourceFinancement' => $projet -> getsourceFinancement(),
							'typeProcedure' => $projet -> gettypeProcedure(),
							'dateReceptionDAO' => $projet -> getdateReceptionDAO(),
							'dateAnoSurDAO' => $projet -> getdateAnoSurDAO(),
							'datePublicationDAO' => $projet -> getdatePublicationDAO(), 
							'dateOuverturePlis' => $projet -> getdateOuverturePlis(), 
							'dateRapportEvaluation' => $projet -> getdateRapportEvaluation(), 
							'dateAnoSurRapEval' => $projet -> getdateAnoSurRapEval(),
							'dateNotifProvisoir' => $projet -> getdateNotifProvisoir(),
							'projetNegoContrat' => $projet -> getprojetNegoContrat(),
							'dateAnoProjetContrat' => $projet -> getdateAnoProjetContrat(), 
							'attribuaire' => $projet -> getattribuaire(),
							'approbationAttribuaire' => $projet -> getApprobationAttribuaire(),
							'montant' => $projet -> getmontant(),
							'approbationAC' => $projet -> getapprobationAC(),
							'approbationACGPMP' => $projet -> getapprobationACGPMP(), 
							'approbationMEF' => $projet -> getapprobationMEF(),
							'enregistrementImpots' => $projet -> getenregistrementImpots(),
							'immatriculation' => $projet -> getimmatriculation(),
							'totalJour' => $projet -> gettotalJour(), 
							'inferieur60' => $projet -> getinferieur60(), 
							'inferieur90' => $projet -> getinferieur90(), 
							'inferieur120' => $projet -> getinferieur120(), 
							'superieur120' => $projet -> getsuperieur120(), 
							'commentaire' => $projet -> getcommentaire ()
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
		

	public function updateProjet(Projet $projet) {
					$req = $this->bdd->prepare('UPDATE projet 
										SET
											autoriteContractante = :autoriteContractante,
											description = :description,
											sourceFinancement = :sourceFinancement,
											typeProcedure = :typeProcedure,
											dateReceptionDAO = :dateReceptionDAO,
											dateAnoSurDAO = :dateAnoSurDAO,
											datePublicationDAO = :datePublicationDAO, 
											dateOuverturePlis = :dateOuverturePlis, 
											dateRapportEvaluation = :dateRapportEvaluation, 
											dateAnoSurRapEval = :dateAnoSurRapEval,
											dateNotifProvisoir = :dateNotifProvisoir,
											projetNegoContrat = :projetNegoContrat,
											dateAnoProjetContrat = :dateAnoProjetContrat, 
											attribuaire = :attribuaire,
											approbationAttribuaire = :approbationAttribuaire,
											montant = :montant,
											approbationAC = :approbationAC,
											approbationACGPMP = :approbationACGPMP, 
											approbationMEF = :approbationMEF,
											enregistrementImpots = :enregistrementImpots,
											immatriculation = :immatriculation,
											totalJour = :totalJour, 
											inferieur60 = :inferieur60, 
											inferieur90 = :inferieur90, 
											inferieur120 = :inferieur120, 
											superieur120 = :superieur120, 
											commentaire = :commentaire
										WHERE idProjet = :id
										');
			$req->execute(
				   array(
							'autoriteContractante' => $projet -> getautoriteContractante(),
							'description' => $projet -> getdescription(),
							'sourceFinancement' => $projet -> getsourceFinancement(),
							'typeProcedure' => $projet -> gettypeProcedure(),
							'dateReceptionDAO' => $projet -> getdateReceptionDAO(),
							'dateAnoSurDAO' => $projet -> getdateAnoSurDAO(),
							'datePublicationDAO' => $projet -> getdatePublicationDAO(), 
							'dateOuverturePlis' => $projet -> getdateOuverturePlis(), 
							'dateRapportEvaluation' => $projet -> getdateRapportEvaluation(), 
							'dateAnoSurRapEval' => $projet -> getdateAnoSurRapEval(),
							'dateNotifProvisoir' => $projet -> getdateNotifProvisoir(),
							'projetNegoContrat' => $projet -> getprojetNegoContrat(),
							'dateAnoProjetContrat' => $projet -> getdateAnoProjetContrat(), 
							'attribuaire' => $projet -> getattribuaire(),
							'approbationAttribuaire' => $projet -> getApprobationAttribuaire(),
							'montant' => $projet -> getmontant(),
							'approbationAC' => $projet -> getapprobationAC(),
							'approbationACGPMP' => $projet -> getapprobationACGPMP(), 
							'approbationMEF' => $projet -> getapprobationMEF(),
							'enregistrementImpots' => $projet -> getenregistrementImpots(),
							'immatriculation' => $projet -> getimmatriculation(),
							'totalJour' => $projet -> gettotalJour(), 
							'inferieur60' => $projet -> getinferieur60(), 
							'inferieur90' => $projet -> getinferieur90(), 
							'inferieur120' => $projet -> getinferieur120(), 
							'superieur120' => $projet -> getsuperieur120(), 
							'commentaire' => $projet -> getcommentaire (),
							'id' => $projet -> getIdProjet()
					   )
					  ); 
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

	public function selectProjetByIdImport($idImport) {
			$requete = $this -> bdd ->prepare('SELECT * FROM projet
												WHERE idImport = :idImport
												LIMIT 1
												');
			$requete-> execute( array( 
						'idImport' => $idImport
								));
		
			if($requete ->rowCount() > 0){ //ya des resultat
				$tmp = $requete -> fetch();
				$result = new Projet($tmp);
				return $result;
			} else return null; 
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
										levelUser = :level,
										recevoirEmail = :recevoirEmail
									WHERE idUser =:id
									');
		$req->execute(array(
						'nom' => $user -> getNomUser(),
						'prenom' => $user -> getPrenomUser(),
						'email' => $user -> getEmailUser(),
						'pass' => $user -> getPassUser(),
						'telephone' => $user -> getTelephoneUser(),
						'level' => $user -> getLevelUser(),
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
			
			$requete = $this -> bdd ->prepare('SELECT * FROM alert
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
			
			$requete = $this -> bdd ->prepare('SELECT * FROM alert
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