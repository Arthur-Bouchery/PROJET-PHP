<?php
  require_once File::build_path(array("config","Conf.php"));
  class Model {
     
    static private $pdo = NULL;

    static public function selectAll(){
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);

      // On demande la table voiture a la bdd
      $pdo = Model::getPDO();
      $rep =$pdo->query('SELECT * FROM '.$table_name);

      //tableau d'objets de classe voiture
      $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      return $rep->fetchAll();
    }

    public static function select($primary_value) {
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      $primary = static::$primary;
        //echo $table_name.$class_name.$primary.'<br>';
        $sql = "SELECT * from ".$table_name." WHERE ".$primary."= :nom_tag";
        //echo $sql;
        // Préparation de la requête
        $req_prep = Model::getPDO()->prepare($sql);
        //echo $primary_value;
        $values = array(
            "nom_tag" => $primary_value,
            ///"table_name" => $table_name,
            //"primary" => $primary,
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_voit = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_voit))
            return false;
        return $tab_voit[0];
    }

    public static function delete($primary_value){
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      $primary = static::$primary;

      $sql="DELETE FROM ".$table_name." WHERE ".$primary."= :value";
      $req_prep = Model::getPDO()->prepare($sql);

      $values = array(
        "value" => $primary_value,
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
  }
?>
