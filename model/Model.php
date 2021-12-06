<?php
require_once File::build_path(array("config", "Conf.php"));

class Model
{
    static private $pdo = NULL;

    static public function init()
    {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $password = Conf::getPassword();
        $login = Conf::getLogin();

        try {
            // Connexion à la base de données
            // Le dernier argument sert à ce que toutes les chaines de caractères
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }
    }

    public static function getPDO()
    {
        if (is_null(self::$pdo))
            self::init();
        return self::$pdo;
    }

    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM $table_name");
            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }
        return $tab;
    }

    public static function select($primary_value)
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $req_prep = Model::getPDO()->prepare("SELECT * FROM $table_name WHERE $primary_key=:nom_tag");
            $values = array(
                "nom_tag" => $primary_value,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $req_prep->fetchAll();
        } catch (PDOException $e) {
            if (Conf::getDebug())
                echo $e->getMessage();
            else {
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            }
            die();
        }

        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function delete($primary_value)
    {
        try {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $req_prep = Model::getPDO()->prepare("DELETE FROM $table_name WHERE $primary_key=:nom_tag");
            $values = array("nom_tag" => $primary_value);
            $req_prep->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            die();
        }
    }

    public static function update($data)
    {
        try {
            $set = ' ';
            foreach ($data as $key => $value) {
                $set = $set . "$key = :$key, ";
            }
            $set = rtrim($set, ", ");

            $o = static::$object;
            $p = static::$primary;

            $pdo = Model::getPDO()->prepare("UPDATE $o SET $set WHERE $p = :$p ;");
            $pdo->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            die();
        }
    }

    public static function save($data)
    {
        try {
            $table_name = static::$object;
            $primary_key = static::$primary;

            $insert = '';
            $values = '';
            foreach ($data as $key => $value) {
                $insert = $insert . "$key, ";
                $values = $values . ":$key, ";
            }
            $insert = rtrim($insert, ", ");
            $values = rtrim($values, ", ");

            $pdo = Model::getPDO()->prepare("INSERT INTO $table_name ($insert) VALUES ($values);");
            $pdo->execute($data);
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) // S'il y a déjà cet objet dans la BDD
                return false;
            else if (Conf::getDebug()) {
                echo $e->getMessage();
            } else
                echo '<br>Une erreur est survenue - <a href="">Retour à la page d\'accueil</a>';
            die();
        }
    }
}