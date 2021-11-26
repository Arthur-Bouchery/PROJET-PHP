<?php

require_once File::build_path(array("model","ModelUtilisateur.php"));
class ControllerUtilisateur {

    protected static $object='utilisateur';
    
    public static function readAll($args=null) {
        $view = 'list';
        $pagetitle = 'Liste des utilisateurs';
        $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    public static function read($args){

        $view = 'detail';
        $pagetitle = "Détail de l'utilisateur";
        $u = ModelUtilisateur::select($args['login']);
        if($u == false or $u == null){
            throw new Exception("Utilisateur introuvable", 1);
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
        $login = $args['login'];
        ModelUtilisateur::delete($login);
        $tab_u = ModelUtilisateur::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create($args=null){
        $u = new ModelUtilisateur();
        foreach($args as $key => $value) {
            $u->set($key, $value);
        }
        $view = 'update';
        $pagetitle = 'Enregistrez un utilisateur';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function update($args) {

        $view="update";
        $pagetitle='Mise à jour';
        $login = $args['login'];
        $u = ModelUtilisateur::select($login);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated($args) {

        $view = 'updated';
        $pagetitle = 'Liste des joueurs';
        $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        $login = $args['login'];
        $u = ModelUtilisateur::select($login);
        if($u) $u->update($args);
        require_once File::build_path(array('view','view.php'));
    }

    public static function created($args){

        $view = 'created';
        $pagetitle = 'Liste des utilisateurs';
        $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        ModelUtilisateur::save($args);
        $u = ModelUtilisateur::select($args['login']);
        require_once File::build_path(array('view','view.php'));
    }
}

?>