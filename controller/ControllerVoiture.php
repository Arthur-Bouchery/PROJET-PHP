<?php
    require_once File::build_path(array("model","ModelVoiture.php"));
    // chargement du modèle
    class ControllerVoiture {
        public static function readAll($args=null) {
            $controller = 'voiture';
            $view = 'list';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::getAllVoitures();     //appel au modèle pour gerer la BD
            require File::build_path(array('view','voiture','view.php'));  //"redirige" vers la vue
        }

        public static function read($args){
            $controller = 'voiture';
            $view = 'detail';
            $pagetitle = 'Détail de la voiture';
            $v = ModelVoiture::getVoitureByImmat($args['immatriculation']);
            if($v == false or $v == null){
                throw new Exception("Voiture introuvable", 1);
                
            }
            require File::build_path(array('view','voiture','view.php'));  //"redirige" vers la vue
        }

        public static function create($args=null){
            $controller = 'voiture';
            $view = 'create';
            $pagetitle = 'Enregistrez une voiture';
            require File::build_path(array('view','voiture','view.php'));  //"redirige" vers la vue
        }

        public static function created($args){
            $controller = 'voiture';
            $view = 'created';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::getAllVoitures();     //appel au modèle pour gerer la BD
            $v = new ModelVoiture($args['immatriculation'],$args['marque'],$args['couleur']);
            $v->save();
            require_once File::build_path(array('view','voiture','view.php'));

        }
        
        public static function error(){
            $controller = 'voiture';
            $view = 'error';
            $pagetitle = 'error';
            require_once File::build_path(array('view','voiture','view.php'));
        }
    }
?>