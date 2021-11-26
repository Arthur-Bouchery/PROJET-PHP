
        <?php
        	require_once File::build_path(array("config","Conf.php"));
		    require_once File::build_path(array("model","Model.php"));
            class ModelTrajet extends Model{
            	// On inclut les fichiers de classe PHP avec require_once
		        // pour éviter qu'ils soient inclus plusieurs fois

            	private $conducteur_login;
				private $prix;
				private $nbPlaces;
                private $dateT;
                private $arrivee;
                private $depart;
                private $id;
                protected static $object = 'trajet'; 
                protected static $primary='id';

                // La syntaxe ... = NULL signifie que l'argument est optionel
				// Si un argument optionnel n'est pas fourni,
				//   alors il prend la valeur par défaut, NULL dans notre cas
				public function __construct($id = NULL, $prix = NULL, $nbPlaces = NULL, $dateT = NULL, 
                $arrivee = NULL, $depart = NULL, $conducteur_login = NULL) {
				  if (!is_null($conducteur_login) && !is_null($prix) && !is_null($nbPlaces)
                  && !is_null($dateT) && !is_null($arrivee) && !is_null($depart) && !is_null($id)) {
				    // Si aucun de $m, $c et $i sont nuls,
				    // c'est forcement qu'on les a fournis
				    // donc on retombe sur le constructeur à 3 arguments
				    $this->conducteur_login = $conducteur_login;
				    $this->prix = $prix;
				    $this->nbPlaces = $nbPlaces;
                    $this->dateT = $dateT;
                    $this->arrivee = $arrivee;
                    $this->depart = $depart;
                    $this->id = $id;
				  }
				}

				public function get($nom_attribut){
                    return $this->$nom_attribut;
                }

				//public function afficher(){
				//	echo $this->immatriculation;
                //	echo ' '.$this->marque;
                //	echo ' '.$this->couleur;
                //	echo '<br>';
				//}

				static public function getAlleTrajets(){
					

		            // On demande la table voiture a la bdd
		            $pdo = Model::getPDO();
		            $rep =$pdo->query('SELECT * FROM trajet');

		            //tableau d'objets de classe voiture
		            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelTrajet');
		            return $rep->fetchAll();
				}

				public static function getTrajetById($id) {
				    $sql = "SELECT * from trajet WHERE id=:nom_tag";
				    // Préparation de la requête
				    $req_prep = Model::getPDO()->prepare($sql);

				    $values = array(
				        "nom_tag" => $id,
				        //nomdutag => valeur, ...
				    );
				    // On donne les valeurs et on exécute la requête	 
				    $req_prep->execute($values);

				    // On récupère les résultats comme précédemment
				    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelTrajet');
				    $tab_voit = $req_prep->fetchAll();
				    // Attention, si il n'y a pas de résultats, on renvoie false
				    if (empty($tab_voit))
				        return false;
				    return $tab_voit[0];
				}

				public function getId(){
					return $this->id;
				}

                public static function deleteById($id) {
                    $sql = "DELETE FROM trajet WHERE id=:nom_tag";
				    // Préparation de la requête
				    $req_prep = Model::getPDO()->prepare($sql);

                    
				    $values =array("nom_tag" => $id);
				        //nomdutag => valeur, ...
				
				    // On donne les valeurs et on exécute la requête	 
				    $req_prep->execute($values);

				    // On récupère les résultats comme précédemment
				    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelTrajet');
                }
            }
        ?>
