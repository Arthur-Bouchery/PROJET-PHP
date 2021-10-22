<?php
    require_once File::build_path(array("config","Conf.php"));
	require_once File::build_path(array("model","Model.php"));
	// On inclut les fichiers de classe PHP avec require_once
	// pour éviter qu'ils soient inclus plusieurs fois
	class ModelRelpique{

		private $codeReplique;
		private $nomReplique;
		private $nomCategorie;
		private $stockReplique;// trouver un moyen pour update de maniere dynamique 
		private $codeMunition;

		// La syntaxe ... = NULL signifie que l'argument est optionel
		// Si un argument optionnel n'est pas fourni,
		//   alors il prend la valeur par défaut, NULL dans notre cas

		public function __construct($codeReplique = NULL, $nomReplique = NULL, $nomCategorie = NULL, $stockReplique = NULL, $codeMunition = NULL) {
			if (!is_null($codeReplique) && !is_null($nomReplique) && !is_null($nomCategorie && !is_null($stockReplique) && !is_null($codeMunition))) {
				// Si aucun de $m, $c et $i sont nuls,
				// c'est forcement qu'on les a fournis
				// donc on retombe sur le constructeur à 3 arguments
				$this->codeReplique = $codeReplique;
				$this->nomReplique = $nomReplique;
				$this->stockReplique = $stockReplique;
				$this->nomCategorie = $nomCategorie;
				$this->codeMunition = $codeMunition;

				

			}
		}

		public function get($nom_attribut){
			return $this->$nom_attribut;
		}

		static public function getAllReplique(){
			

			// On demande la table replique a la bdd
			$pdo = Model::getPDO();
			$rep =$pdo->query('SELECT * FROM p_Replique');

			//tableau d'objets de classe Replique
			$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelReplique');
			return $rep->fetchAll();
		}

		public static function getRepliqueByCodeReplique($codeReplique) {
			$sql = "SELECT * from p_Replique WHERE codeReplique=:nom_tag";
			// Préparation de la requête
			$req_prep = Model::getPDO()->prepare($sql);

			$values = array(
				"nom_tag" => $codeReplique,
				//nomdutag => valeur, ...
			);
			// On donne les valeurs et on exécute la requête	 
			$req_prep->execute($values);

			// On récupère les résultats comme précédemment
			$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelReplique');
			$tab_voit = $req_prep->fetchAll();
			// Attention, si il n'y a pas de résultats, on renvoie false
			if (empty($tab_voit))
				return false;
			return $tab_voit[0];
		}

		public function getCodeReplique(){
			return $this->codeReplique;
		}

		public function save(){
			//definir les attributs a sauvegarder

			/** A COMPLETER */
			
			$sql="INSERT INTO Replique (/**A COMPLETER*/) VALUES ( /**A COMPLETER*/)"; 
			$req_prep = Model::getPDO()->prepare($sql);

			$values = array(
				/** A COMPLETER */
			);

			//on execute la requete
			try{
				$req_prep->execute($values);
			}catch (PDOException $e) {
			  if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			  } else {
				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			  }
			  die();
			}
		}
	}
?>
