<?php

require_once File::build_path(array("model","ModelClients.php"));
class ControllerClients {

    protected static $object='Clients';

    public static function home(){
        //renvoyer sur l'affichage du compte si connecté
        //proposer la connexion et l'inscription si non
        $view = 'home';
        $pagetitle = 'Connexion';
        require_once File::build_path(array('view','view.php'));
    }

    public static function signUp(){
        //creer un Client en vérifiant les informations
        //signIn()
    }

    public static function signIn(){
        $view="signIn";
        $pagetitle='Connexion';
        require_once File::build_path(array('view', 'view.php'));
    }
    public static function signedIn($args){
        //ouvrir la session du client
    }

    public static function signOut(){
        //fermer la session
    }
    
    public static function readAll($args=null) {
        $view = 'list';
        $pagetitle = 'Liste des Clients';
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    public static function read($args){

        $view = 'detail';
        $pagetitle = "Détail de l'Clients";
        $u = ModelClients::select($args['login']);
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
        ModelClients::delete($login);
        $tab_u = ModelClients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create($args=null){
        $u = new ModelClients();
        foreach($args as $key => $value) {
            $u->set($key, $value);
        }
        $view = 'update';
        $pagetitle = 'Enregistrez un Clients';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function update($args) {

        $view="update";
        $pagetitle='Mise à jour des informations de profil';
        $login = $args['idClient'];
        $u = ModelClients::select($login);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated($args) {

        $view = 'updated';
        $pagetitle = 'Liste des joueurs';
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        $login = $args['codeClient'];
        $u = ModelClients::select($login);
        //encodage du mdp
        $args['mdpClient'] = Security::hacher($args['mdpClient']);
        //fin encodage
        if($u) $u->update($args);
        require_once File::build_path(array('view','view.php'));
    }

    public static function created($args){

        $view = 'created';
        $pagetitle = 'Liste des utilisateurs';
        //encodage du mdp
        $args['mdpClient'] = Security::hacher($args['mdpClient']);
        //fin encodage
        ModelClients::save($args);
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        $u = ModelClients::select($args['codeClient']);
        require_once File::build_path(array('view','view.php'));
    }
}

