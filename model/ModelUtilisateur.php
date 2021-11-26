<?php
        	require_once File::build_path(array("config","Conf.php"));
		    require_once File::build_path(array("model","Model.php"));
            class ModelUtilisateur extends Model{
                
                private $login;
                private $nom;
                private $prenom;
                protected static $object = 'utilisateur'; 
                protected static $primary='login';

                public function __construct($l = NULL, $n = NULL, $p = NULL) {
                    if (!is_null($l) && !is_null($n) && !is_null($p)) {
                      // Si aucun de $m, $c et $i sont nuls,
                      // c'est forcement qu'on les a fournis
                      // donc on retombe sur le constructeur à 3 arguments
                      $this->login = $l;
                      $this->nom = $n;
                      $this->prenom = $p;
                    }
                }

                public function get($nom_attribut){
                    return $this->$nom_attribut;
                }

                public function getLogin() {
                    return $this->login;
                }

                public function set($nom_attribut, $valeur) {
                    $this->$nom_attribut = $valeur;
                }


            }

            

?>