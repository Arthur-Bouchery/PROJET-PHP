<?php
require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model", "Model.php"));

class ModelRepliques extends Model
{
    protected static $object = 'repliques';
    protected static $primary = 'idReplique';

    private $idReplique;
    private $nomReplique;
    private $nomCategorie;
    private $stockRepliques;
    // private $idMunitions; // TODO idMunitions

    public function __construct($i = NULL, $n = NULL, $c = NULL, $s = NULL)
    {
        if (!is_null($i) && !is_null($c) && !is_null($n) && !is_null($s)) {
            $this->idReplique = $i;
            $this->nomReplique = $n;
            $this->stockRepliques = $s;
            $this->nomCategorie = $c;
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
}
