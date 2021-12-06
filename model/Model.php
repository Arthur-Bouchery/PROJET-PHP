<?php
            require_once File::build_path(array("config","Conf.php"));
            class Model {
               
              static private $pdo = NULL;

              static public function init() {
                $hostname = Conf::getHostname();
                $database_name = Conf::getDatabase();
                $password = Conf::getPassword();
                $login = Conf::getLogin();

                try{
                  // Connexion à la base de données            
                  // Le dernier argument sert à ce que toutes les chaines de caractères 
                  // en entrée et sortie de MySql soit dans le codage UTF-8
                  self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                                       array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                  // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
                  self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch (PDOException $e) {
                  if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                  } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                  }
                  die();
                }
              }

              public static function getPDO(){
                if(self::$pdo==null){
                  self::init();
                }
                return self::$pdo;
              }



              static public function selectAll(){

                $table_name = static::$object;

                $class_name = 'Model'.ucfirst($table_name);

                // On demande la table voiture a la bdd
                $pdo = Model::getPDO();
                $rep =$pdo->query("SELECT * FROM $table_name");

                //tableau d'objets de classe voiture
                $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                return $rep->fetchAll();
              }

              public static function select($primary_value) {

                    $table_name = static::$object;
                    $class_name = 'Model'.ucfirst($table_name);
                    $primary_key = static::$primary;


				    $sql = "SELECT * from $table_name WHERE $primary_key=:nom_tag";
				    // Préparation de la requête
				    $req_prep = Model::getPDO()->prepare($sql);

				    $values = array(
				        "nom_tag" => $primary_value,
				        //nomdutag => valeur, ...
				    );
				    // On donne les valeurs et on exécute la requête	 
				    $req_prep->execute($values); //todo: trycatch les amis

				    // On récupère les résultats comme précédemment
				    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
				    $tab = $req_prep->fetchAll();
				    // Attention, si il n'y a pas de résultats, on renvoie false
				    if (empty($tab))
				        return false;
				    return $tab[0];
              }
              public static function delete($primary_value) {
                    
                    $table_name = static::$object;
                    $class_name = 'Model'.ucfirst($table_name);
                    $primary_key = static::$primary;

                    $sql = "DELETE FROM $table_name WHERE $primary_key=:nom_tag";
				    // Préparation de la requête
				    $req_prep = Model::getPDO()->prepare($sql);

                    
				    $values =array("nom_tag" => $primary_value);
				        //nomdutag => valeur, ...
				
				    // On donne les valeurs et on exécute la requête	 
				    $req_prep->execute($values);

				    // On récupère les résultats comme précédemment
				    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                }

              public function update($data){

                    $table_name = static::$object;
                    $primary_key = static::$primary;

                    $set = "";

                    foreach($data as $key => $value) {
                        if ($key != $primary_key) {
                        $set = $set."$key=:$key, ";
                        }
                    }
                    $set = rtrim($set, ", ");

                    $sql="UPDATE $table_name SET $set WHERE $primary_key=:$primary_key";
                    $req_prep = Model::getPDO()->prepare($sql);


                    //on execute la requete
                    try{
                        $req_prep->execute($data);
                    }catch (PDOException $e) {
                      if (Conf::getDebug()) {
                        echo $e->getMessage(); // affiche un message d'erreur
                      } else {
                        echo 'Une erreur est survenue <a href="https://webinfo.iutmontp.univ-montp2.fr/~bessej/td-php/TD5R/"> retour a la page d\'accueil </a>';
                      }
                      die();
                    }
                }

              public static function save($data){
					$table_name = static::$object;
                    $primary_key = static::$primary;

                    $insert = "";

                    $value = "";



                    foreach($data as $key => $val) {
                        $insert = $insert."$key, ";
                        $value = $value.":$key, ";
                    }
                    $insert = rtrim($insert, ", ");
                    $value = rtrim($value, ", ");

					$sql="INSERT INTO $table_name ($insert) VALUES ($value)";
					$req_prep = Model::getPDO()->prepare($sql);


					//on execute la requete
					try{
						$req_prep->execute($data);
					}catch (PDOException $e) {
	                  if (Conf::getDebug()) {
                          echo $sql;
	                    echo $e->getMessage(); // affiche un message d'erreur
	                  } else {
	                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
	                  }
	                  die();
	                }
				}

            }
?>
