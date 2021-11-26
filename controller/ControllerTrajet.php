<?php

require_once File::build_path(array("model","ModelTrajet.php"));
class ControllerTrajet {

    protected static $object='trajet';
    
    public static function readAll($args=null) {
        $view = 'list';
        $pagetitle = 'Liste des trajets';
        $tab_u = ModelTrajet::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    public static function read($args){

        $view = 'detail';
        $pagetitle = "Détail du trajet";
        $u = ModelTrajet::select($args['id']);
        if($u == false or $u == null){
            throw new Exception("Trajet introuvable", 1);
        }
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function error() {
        $view = 'error';
        $pagetitle = 'error';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function delete($args) {
        $view="deleted";
        $pagetitle='SUPRESSION';
        $id = $args['id'];
        ModelTrajet::delete($id);
        $tab_u = ModelTrajet::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create($args=null){
        $u = new ModelTrajet();
        foreach($args as $key => $value) {
            $u->set($key, $value);
        }
        $view = 'update';
        $pagetitle = 'Enregistrez un trajet';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function update($args) {

        $view="update";
        $pagetitle='Mise à jour';
        $id = $args['id'];
        $u = ModelTrajet::select($id);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated($args) {

        $view = 'updated';
        $pagetitle = 'Liste des trajets';
        $tab_u = ModelTrajet::selectAll();     //appel au modèle pour gerer la BD
        $id = $args['id'];
        $u = ModelTrajet::select($id);
        if($u) $u->update($args);
        require_once File::build_path(array('view','view.php'));
    }

    public static function created($args){

        $view = 'created';
        $pagetitle = 'Liste des trajets';
        $tab_u = ModelTrajet::selectAll();     //appel au modèle pour gerer la BD
        ModelTrajet::save($args);
        $u = ModelTrajet::select($args['id']);
        require_once File::build_path(array('view','view.php'));
    }
}

?>