
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
    protected static $object = 'p_Clients';
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

            
