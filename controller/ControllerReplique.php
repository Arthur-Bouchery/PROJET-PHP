<?php
    require_once File::build_path(array("model","ModelRepliques.php"));
    // chargement du modèle
    class ControllerReplique {

        //on utilise ça ?
        protected static $object = 'Repliques';


        public static function readAll($args=null) {

            $view = 'list';
            $pagetitle = 'Liste des repliques';
            $tab_rep = ModelRepliques::selectAll();     //appel au modèle pour gerer la BD
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function read($args){

            $view = 'detail';
            $pagetitle = 'Détail de la Replique';
            $v = ModelRepliques::select($args['idReplique']);
            if($v == false or $v == null){
                throw new Exception("Replique introuvable", 1);
            }
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function create($args=null){
            $v = new ModelRepliques();
            foreach($args as $key => $value) {
                $v->set($key, $value);
            }
            $view = 'update';
            $pagetitle = 'Enregistrez une Replique';
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function created($args){

            $view = 'created';
            $pagetitle = 'Liste des Repliques';
            $tab_rep = ModelRepliques::selectAll();     //appel au modèle pour gerer la BD
            ModelRepliques::save($args);
            $v = ModelRepliques::select($args['idReplique']);
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
            $id = $args['idReplique'];
            ModelRepliques::delete($id);
            $tab_rep = ModelRepliques::selectAll();
            require_once File::build_path(array('view', 'view.php'));
        }
        public static function update($args) {
            $view="update";
            $pagetitle='Mise à jour';
            $id = $args['idReplique'];
            $v = ModelRepliques::select($id);
            require_once File::build_path(array('view', 'view.php'));
        }

        public static function updated($args) {

            $view = 'updated';
            $pagetitle = 'Liste des Repliques';
            $tab_rep = ModelRepliques::selectAll();     //appel au modèle pour gerer la BD
            $id = $args['idReplique'];
            $v = ModelRepliques::select($id);
            $v->update($args);
            require_once File::build_path(array('view','view.php'));
        }
    }