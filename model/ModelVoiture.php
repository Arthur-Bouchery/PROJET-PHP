
        <?php
        	require_once File::build_path(array("config","Conf.php"));
		    require_once File::build_path(array("model","Model.php"));
            class ModelVoiture extends Model {
            	// On inclut les fichiers de classe PHP avec require_once
		        // pour éviter qu'ils soient inclus plusieurs fois

            	private $marque;
				private $couleur;
				private $immatriculation;

				//variables utilisées pour les fonction génériques de Model
				protected static $object = 'voiture';
				protected static $primary = 'immatriculation';

                // La syntaxe ... = NULL signifie que l'argument est optionel
				// Si un argument optionnel n'est pas fourni,
				//   alors il prend la valeur par défaut, NULL dans notre cas
				public function __construct($i = NULL, $m = NULL, $c = NULL) {
				  if (!is_null($m) && !is_null($c) && !is_null($i)) {
				    // Si aucun de $m, $c et $i sont nuls,
				    // c'est forcement qu'on les a fournis
				    // donc on retombe sur le constructeur à 3 arguments
				    $this->marque = $m;
				    $this->couleur = $c;
				    $this->immatriculation = $i;
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

				

				public function getImmatriculation(){
					return $this->immatriculation;
				}

				public function save(){
					$m = $this->marque;
				    $c = $this->couleur;
				    $i = $this->immatriculation;
					$sql="INSERT INTO voiture (immatriculation, marque, couleur) VALUES (:nom_tag, :marque_tag, :couleur_tag)";
					$req_prep = Model::getPDO()->prepare($sql);

					$values = array(
						"nom_tag" => $i,
						"marque_tag" => $m,
						"couleur_tag" => $c
					);

					//on execute la requete
					try{
						$req_prep->execute($values);
					}catch (PDOException $e) {
	                  if (Conf::getDebug()) {
	                    echo $e->getMessage(); // affiche un message d'erreur
	                  } else {
	                    echo 'Une erreur est survenue <a href="https://webinfo.iutmontp.univ-montp2.fr/~boucherya/td-php/TD6/"> retour a la page d\'accueil </a>';
	                  }
	                  die();
	                }
				}

				public function update(){
					$m = $this->marque;
				    $c = $this->couleur;
				    $i = $this->immatriculation;
					$sql="UPDATE voiture SET marque= :marque_tag, couleur= :couleur_tag WHERE immatriculation= :immat_tag";
					$req_prep = Model::getPDO()->prepare($sql);

					$values = array(
						"immat_tag" => $i,
						"marque_tag" => $m,
						"couleur_tag" => $c
					);

					//on execute la requete
					try{
						$req_prep->execute($values);
					}catch (PDOException $e) {
	                  if (Conf::getDebug()) {
	                    echo $e->getMessage(); // affiche un message d'erreur
	                  } else {
	                    echo 'Une erreur est survenue <a href="https://webinfo.iutmontp.univ-montp2.fr/~boucherya/td-php/TD6/"> retour a la page d\'accueil </a>';
	                  }
	                  die();
	                }
				}
            }
        ?>
