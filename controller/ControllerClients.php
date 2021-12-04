<?php

require_once File::build_path(array("model","ModelClients.php"));
class ControllerClients {

    protected static $object='Clients';

    public static function home(){
        //renvoyer sur l'affichage du compte si connecté
        //proposer la connexion et l'inscription si non
    }

    public static function signUp(){
        //creer un Client en vérifiant les informations
        //signIn()
    }

    public static function signIn(){
        //ouvrir la session
    }

    public static function signOut(){
        //fermer la session
    }
    
    public static function readAll($args=null) {
        $view = 'list';
        $pagetitle = 'Liste des Clients';
        $tab_u = Model_Clients::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    public static function read($args){

        $view = 'detail';
        $pagetitle = "Détail de l'Clients";
        $u = Model_Clients::select($args['login']);
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
        Model_Clients::delete($login);
        $tab_u = Model_Clients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create($args=null){
        $u = new Model_Clients();
        foreach($args as $key => $value) {
            $u->set($key, $value);
        }
        $view = 'update';
        $pagetitle = 'Enregistrez un Clients';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function update($args) {

        $view="update";
        $pagetitle='Mise à jour';
        $login = $args['login'];
        $u = Model_Clients::select($login);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated($args) {

        $view = 'updated';
        $pagetitle = 'Liste des joueurs';
        $tab_u = Model_Clients::selectAll();     //appel au modèle pour gerer la BD
        $login = $args['login'];
        $u = Model_Clients::select($login);
        if($u) $u->update($args);
        require_once File::build_path(array('view','view.php'));
    }

    public static function created($args){

        $view = 'created';
        $pagetitle = 'Liste des utilisateurs';
        $tab_u = Model_Clients::selectAll();     //appel au modèle pour gerer la BD
        Model_Clients::save($args);
        $u = Model_Clients::select($args['login']);
        require_once File::build_path(array('view','view.php'));
    }
}

