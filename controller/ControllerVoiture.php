<?php
    require_once File::build_path(array("model","ModelVoiture.php"));
    // chargement du modèle
    class ControllerVoiture {


        protected static $object = 'voiture';


        public static function readAll($args=null) {

            $view = 'list';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::selectAll();     //appel au modèle pour gerer la BD
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function read($args){

            $view = 'detail';
            $pagetitle = 'Détail de la voiture';
            $v = ModelVoiture::select($args['immatriculation']);
            if($v == false or $v == null){
                throw new Exception("Voiture introuvable", 1);
            }
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function create($args=null){
            $v = new ModelVoiture();
            foreach($args as $key => $value) {
                $v->set($key, $value);
            }
            $view = 'update';
            $pagetitle = 'Enregistrez une voiture';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function created($args){

            $view = 'created';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::selectAll();     //appel au modèle pour gerer la BD
            ModelVoiture::save($args);
            $v = ModelVoiture::select($args['immatriculation']);
            require_once File::build_path(array('view','view.php'));
        }
        public static function error() {
;
            $view = 'error';
            $pagetitle = 'error';
            require_once File::build_path(array('view', 'view.php'));
        }
        public static function delete($args) {

            $view="deleted";
            $pagetitle='SUPRESSION';
            $immat = $args['immatriculation'];
            ModelVoiture::delete($immat);
            $tab_v = ModelVoiture::selectAll();
            require_once File::build_path(array('view', 'view.php'));
        }
        public static function update($args) {

            $view="update";
            $pagetitle='Mise à jour';
            $immat = $args['immatriculation'];
            $v = ModelVoiture::select($immat);
            require_once File::build_path(array('view', 'view.php'));
        }

        public static function updated($args) {

            $view = 'updated';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::selectAll();     //appel au modèle pour gerer la BD
            $immat = $args['immatriculation'];
            $v = ModelVoiture::select($immat);
            $v->update($args);
            require_once File::build_path(array('view','view.php'));
        }
    }
