<?php

require_once File::build_path(array("config","Conf.php"));
require_once File::build_path(array("model","Model.php"));

class ModelCommandes extends Model
{
    private $codeCommande;
    private $dateCommande;
    private $codeClient;
    private $idReplique_qte; //array(array('id','qte'), ...)


    protected static $object = 'commandes';

    protected static $primary = 'codeCommande';

    public function __construct($iR = NULL, $cC = NULL, $dC = NULL, $cCl = NULL, $q = NULL)
    {
        if (!is_null($iR) && !is_null($dC) && !is_null($cC) && !is_null($cCl) && !is_null($q)) {
            // Si aucun de $m, $c et $i sont nuls,
            // c'est forcement qu'on les a fournis
            // donc on retombe sur le constructeur à 3 arguments
            $this->codeCommande = $cC;
            $this->idReplique_qte = $iR;
            $this->dateCommande = $dC;
            $this->codeClient = $cCl;
        }
    }

    static public function select($codeCommande)
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);
            $primary_key = static::$primary;

            $req_prep = Model::getPDO()->prepare("SELECT idReplique, quantite, dateCommande, codeClient FROM $table_name WHERE $primary_key=:nom_tag");
            $values = array(
                "nom_tag" => $codeCommande,
            );
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();

            $c = new ModelCommandes();
            $panier = array();
            $i = 0;
            foreach ($tab as $item) {
                $temp['idReplique'] = $item['idReplique'];
                $temp['qte'] = $item['quantite'];
                $panier[$i] = $temp;
                $i++;
            }
            $c->set('idReplique_qte', $panier);
            $c->set('codeCommande', $codeCommande);
            $c->set('dateCommande', $tab[0]['dateCommande']);
            $c->set('codeClient', $tab[0]['codeClient']);

            return $c;
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

    static public function selectAll()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT DISTINCT codeCommande, dateCommande FROM $table_name");
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

    static public function selectByCodeClient()
    {
        try {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst($table_name);

            $req_prep = Model::getPDO()->prepare("SELECT DISTINCT codeCommande, dateCommande FROM $table_name WHERE codeClient=:codeClient");
            $values = array(
                "codeClient" => $_SESSION['codeClient'],
            );
            $req_prep->execute($values);
            return $req_prep->fetchAll();
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

    public static function getLastCode()
    {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $sql = "SELECT max(codeCommande) FROM commandes";
        $req_prep = Model::getPDO()->prepare($sql);

        //on execute la requete
        try {
            $req_prep->execute();
            $tab = $req_prep->fetchAll();
            if (sizeof($tab) >= 1) { //si on a un ou plusieurs résultat
                return $tab[0][0];
            } else return -1; //si aucunz commande
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $sql;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public function get($nom_attribut)
    {
        return $this->$nom_attribut;
    }

    public function set($nom_attribut, $valeur)
    {
        $this->$nom_attribut = $valeur;
    }

    public function enregistrer()
    {
        foreach ($this->idReplique_qte as $item => $value) {
            $data['codeCommande'] = $this->codeCommande;
            var_dump($item);
            var_dump($value);
            $data['idReplique'] = $item;
            $data['quantite'] = $value;
            $data['dateCommande'] = $this->dateCommande;
            $data['codeClient'] = $this->codeClient;
            ModelCommandes::save($data);
        }
    }


//    public function afficher(){
//    	echo "numéro de commande : ".$this->codeCommande;
//    	echo "date de la Commande ".$this->marque;
//    	echo "code du client ".$this->couleur;
//        echo ""
//    	echo '<br>';
//    }

    public static function deleteByCC($codeCommande)
    {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);

        $sql = "DELETE FROM commandes WHERE codeCommande=$codeCommande";
        $req_prep = Model::getPDO()->prepare($sql);
        try {
            $req_prep->execute();
        } catch (PDOException $e) {
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