<?php
	require_once File::build_path(array("config","Conf.php"));
    require_once File::build_path(array("model","Model.php"));
    class ModelRepliques extends Model{
    	// On inclut les fichiers de classe PHP avec require_once
        // pour éviter qu'ils soient inclus plusieurs fois

    	private $idReplique;
		private $nomReplique;
		private $nomCategorie;

		private $stockReplique;
		private $idMunitions;
        protected static $object = 'p_Repliques';

        protected static $primary='idReplique';

        // La syntaxe ... = NULL signifie que l'argument est optionel
		// Si un argument optionnel n'est pas fourni,
		//   alors il prend la valeur par défaut, NULL dans notre cas
		public function __construct($i = NULL, $n = NULL, $p = NULL, $s = NULL) {
		  if (!is_null($i) && !is_null($p) && !is_null($n) && !is_null($s)) {
		    // Si aucun de $m, $c et $i sont nuls,
		    // c'est forcement qu'on les a fournis
		    // donc on retombe sur le constructeur à 3 arguments
		    $this->idReplique = $i;
		    $this->nomReplique = $n;
		    $this->stockRepliques = $s;
			$this->nomCategorie = $p;
		  }
		}

		public function get($nom_attribut){
            return $this->$nom_attribut;
        }

        public function set($nom_attribut, $valeur) {
            $this->$nom_attribut = $valeur;
        }

		//public function afficher(){
		//	echo $this->immatriculation;
        //	echo ' '.$this->marque;
        //	echo ' '.$this->couleur;
        //	echo '<br>';
		//}


    }
?>