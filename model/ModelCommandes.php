<?php

require_once File::build_path(array("config","Conf.php"));
require_once File::build_path(array("model","Model.php"));

class ModelCommandes extends Model
{
    private $codeCommande;
    private $idReplique;
    private $dateCommande;
    private $codeClient;
    private $quantite;

    protected static $object = 'repliques';

    protected static $primary='codeCommande';

    public function __construct($iR = NULL, $cC = NULL, $dC = NULL, $cCl = NULL, $q = NULL) {
        if (!is_null($iR) && !is_null($dC) && !is_null($cC) && !is_null($cCl) && !is_null($q)) {
            // Si aucun de $m, $c et $i sont nuls,
            // c'est forcement qu'on les a fournis
            // donc on retombe sur le constructeur à 3 arguments
            $this->codeCommande = $cC;
            $this->idReplique = $iR;
            $this->dateCommande = $dC;
            $this->codeClient = $cCl;
            $this->quantite = $q;
        }
    }

    public function get($nom_attribut){
        return $this->$nom_attribut;
    }

    public function set($nom_attribut, $valeur) {
        $this->$nom_attribut = $valeur;
    }

    public function enregistrer(){
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
}

?>