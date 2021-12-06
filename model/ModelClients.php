
<?php
require_once File::build_path(array("config","Conf.php"));
require_once File::build_path(array("model","Model.php"));
class ModelClients extends Model{
    
    private $codeClient;
    private $nomClient;
    private $prenomClient;
    private $mailClient;
    private $telClient;
    private $mdpClient;
    protected static $object = 'clients';
    protected static $primary='codeClient';

    public function __construct($l = NULL, $n = NULL, $p = NULL) {
        if (!is_null($l) && !is_null($n) && !is_null($p)) {
          // Si aucun de $m, $c et $i sont nuls,
          // c'est forcement qu'on les a fournis
          // donc on retombe sur le constructeur à 3 arguments
          $this->codeClient = $l;
          $this->nomClient = $n;
          $this->prenomClient = $p;
        }
    }

    public static function checkEmail($emailClient){
        $table_name = static::$object;
        $class_name = 'Model'.ucfirst($table_name);

        $sql="SELECT DISTINCT codeClient FROM p_Clients WHERE mailClient=$emailClient";
        $req_prep = Model::getPDO()->prepare($sql);

        //on execute la requete
        try{
            $req_prep->execute();
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            if (sizeof($tab)>=1){ //si on a un ou plusieurs résultat
                return true;
            }else return false; //si aucun compte avec cet email
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

    public static function checkPassword($emailClient, $mdp_hash){
        $table_name = static::$object;
        $class_name = 'Model'.ucfirst($table_name);

        $sql="SELECT codeClient FROM clients WHERE mailClient=:mail AND mdpClient=:mdp";
        $req_prep = Model::getPDO()->prepare($sql);


        //on execute la requete
        try{
            $req_prep->execute(array('mail' => $emailClient, 'mdp' => $mdp_hash));
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
            if (sizeof($tab)==1){ //si on a un résultat, la connexion peut se poursuivre;
                return true;
            }else return false; //si la requête renvoie plus d'une ligne ou si elle est vide, alors problème
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

    public static function getCodeClientByEmailAndPassword($emailClient, $mdp_hash){
        $sql="SELECT DISTINCT codeClient FROM clients WHERE mailClient='$emailClient' AND mdpClient='$mdp_hash'";
        $req_prep = Model::getPDO()->prepare($sql);


        //on execute la requete
        try{
            $req_prep->execute();
            $tab = $req_prep->fetchAll();
            if (sizeof($tab)==1) { //si on a un résultat, la connexion peut se poursuivre
                return $tab[0]['codeClient'];
            }
        }catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function getCodeClient() {
        return $this->codeClient;
    }

    public function set($nom_attribut, $valeur) {
        $this->$nom_attribut = $valeur;
    }


}
?>

            
