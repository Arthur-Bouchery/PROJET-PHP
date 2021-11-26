<?php
    require_once File::build_path(array("model","ModelReplique.php"));
    // chargement du modèle
    class ControllerReplique {


        protected static $object = 'p_Repliques';


        public static function readAll($args=null) {

            $view = 'list';
            $pagetitle = 'Liste des repliques';
            $tab_rep = ModelReplique::selectAll();     //appel au modèle pour gerer la BD
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function read($args){

            $view = 'detail';
            $pagetitle = 'Détail de la Replique';
            $v = ModelReplique::select($args['idReplique']);
            if($v == false or $v == null){
                throw new Exception("Replique introuvable", 1);
            }
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function create($args=null){
            $v = new ModelReplique();
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
            $tab_rep = ModelReplique::selectAll();     //appel au modèle pour gerer la BD
            ModelReplique::save($args);
            $v = ModelReplique::select($args['idReplique']);
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
            ModelReplique::delete($id);
            $tab_rep = ModelReplique::selectAll();
            require_once File::build_path(array('view', 'view.php'));
        }
        public static function update($args) {

            $view="update";
            $pagetitle='Mise à jour';
            $id = $args['idReplique'];
            $v = ModelReplique::select($id);
            require_once File::build_path(array('view', 'view.php'));
        }

        public static function updated($args) {

            $view = 'updated';
            $pagetitle = 'Liste des Repliques';
            $tab_rep = ModelReplique::selectAll();     //appel au modèle pour gerer la BD
            $id = $args['idReplique'];
            $v = ModelReplique::select($id);
            $v->update($args);
            require_once File::build_path(array('view','view.php'));
        }
    }
