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

    public static function signedIn(){
        $emailClient = $_GET['emailClient'];
        $mdp_hash = Security::hacher($_GET['mdpClient']);
        $validUser = ModelClients::checkPassword($emailClient,$mdp_hash);
        if(!$validUser){
            //si non valide on renvoie sur la page de connexion
            //todo: afficher un message d'erreursur la page connexion
            self::signIn();
        }else {
            $view="detail";
            $pagetitle='Profil Utilisateur';
            //ouvrir la session du client
            $_SESSION['codeClient']=ModelClients::getCodeClientByEmailAndPassword($emailClient,$mdp_hash);
            require_once File::build_path(array('view','view.php'));
        }
    }

    public static function signOut(){
        //fermer la session
    }
    
    public static function readAll() {
        $view = 'list';
        $pagetitle = 'Liste des Clients';
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    public static function read(){

        $view = 'detail';
        $pagetitle = "Détail du Clients";
        $u = ModelClients::select($_GET['codeClient']);
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

    public static function delete() {
        $view="deleted";
        $pagetitle='SUPRESSION';
        $login = $_GET['login'];
        ModelClients::delete($login);
        $tab_u = ModelClients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create(){
        $u = new ModelClients();
        foreach($_GET as $key => $value) {
            $u->set($key, $value);
        }
        $view = 'update';
        $pagetitle = 'Enregistrez un Clients';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function update() {

        $view="update";
        $pagetitle='Mise à jour des informations de profil';
        $login = $_GET['codeClient'];
        $u = ModelClients::select($login);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated() {
        if($_GET['mdpClient']==$_GET['confirm_mdpClient']) {
            $view = 'updated';
            $pagetitle = 'Liste des joueurs';
            $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
            $login = $_GET['codeClient'];
            $u = ModelClients::select($login);
            //encodage du mdp
            $_GET['mdpClient'] = Security::hacher($_GET['mdpClient']);
            //fin encodage
            if ($u) $u->update($_GET);
            require_once File::build_path(array('view', 'view.php'));
        }
    }

    public static function created(){
        if($_GET['mdpClient']==$_GET['confirm_mdpClient']) {
            unset($_GET['confirm_mdpClient']);
            $view = 'created';
            $pagetitle = 'Liste des utilisateurs';
            //encodage du mdp
            $_GET['mdpClient'] = Security::hacher($_GET['mdpClient']);
            //fin encodage
            unset($_GET['confirm_mdpClient']);
            unset($_GET['action']);
            unset($_GET['controller']);
            ModelClients::save($_GET);
            $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
            //$u = ModelClients::select($_GET['codeClient']); je m'en carre le fion de cette ligne
            require_once File::build_path(array('view', 'view.php'));
        }
    }
}

