<?php

require_once File::build_path(array("model", "ModelClients.php"));

class ControllerClients
{

    protected static $object = 'Clients';

    public static function home()
    {
        //renvoyer sur l'affichage du compte si connecté
        //proposer la connexion et l'inscription si non
        $view = 'home';
        $pagetitle = 'Connexion';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function signUp(){
        $view = 'signUp';
        $pagetitle = 'Inscription';
        $wrongInformations = false;
        require File::build_path(array('view', 'view.php'));
    }

    public static function signUpError($message){
        $_GET['action']='signUp';
        $view = "signUp";
        $pagetitle = 'Inscription';
        $wrongInformations = true;
        $messageErreur = $message;
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function signedUp(){
        $mailClient = $_POST['mailClient'];
        //encodage du mdp
        $mdp_hash = Security::hacher($_POST['mdpClient']);
        //fin encodage
//        $validMail = ModelClients::checkEmail($mailClient);
//        if (!$validMail){
//            self::signUpError(' L\'eMail spécifié est déjà affecté à un compte airsoft :/ ');
        if ($_POST['mdpClient'] != $_POST['confirm_mdpClient']) {
            self::signUpError(' Les mots de passe ne correspondent pas ! ');
        }else{
            //Génération du nonce
            $nonce = Security::generateRandomHex();
            //Fin de génération du nonce

            //préparation $data
            $data = array(
                'prenomClient' => $_POST['prenomClient'],
                'nomClient' => $_POST['nomClient'],
                'mailClient' => $_POST['mailClient'],
                'telClient' => $_POST['telClient'],
                'mdpClient' => $mdp_hash,
                'admin' => 0,
//                //le nonce
//                'nonce' => $nonce,
            ) ;

            ModelClients::save($data);
//            //Rédaction et envoi du mail
//            $mail = "<a href='https://webinfo.iutmontp.univ-montp2.fr/~marceronl/PROJET-PHP/?controller=clients&action=validate&nonce=".$nonce."&codeClient=".ModelClients::getCodeClientByEmailAndPassword($_POST['mailClient'],$mdp_hash)."'>Cliquez ici pour valider votre eMail</a>";
//            $headers = "MIME-Version: 1.0" . "\r\n";
//            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//            mail($_POST['mailClient'],"confirmation mail airsoft",$mail, $headers);
//            //Fin d'envoi
            //$tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
            //$u = ModelClients::select($_GET['codeClient']); je m'en carre le fion de cette ligne
            Self::signIn();
        }
    }

    public static function signIn()
    {
        $view = "signIn";
        $pagetitle = 'Connexion';
        $wrongInformations = false;
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function validate() {
        if (ModelClients::getNonceByCC($_GET['codeClient']) == $_GET['nonce']) {
            ModelClients::setNonceNullByCC($_GET['codeClient']);
            self::validated();
        } else {
            self::errorPageIntrouvable();
        }
    }

    public static function validated(){
        $view = "validated";
        $pagetitle = 'Email vérifié !';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function signInError()
    {
        $view = "signIn";
        $pagetitle = 'Connexion';
        $wrongInformations = true;
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function signedIn()
    {
        $emailClient = $_POST['mailClient'];
        $mdp_hash = Security::hacher($_POST['mdpClient']);
        $validUser = ModelClients::checkPassword($emailClient, $mdp_hash);
//        $codeClient = ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash);
        if (!$validUser){//|| !ModelClients::checkNonce(ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash))) {
            self::signInError();
        } else {
            $view = "home";
            $pagetitle = 'Profil Utilisateur';
            //ouvrir la session du client
            $_SESSION['codeClient'] = ModelClients::getCodeClientByEmailAndPassword($emailClient, $mdp_hash);
            $ad = ModelClients::select($_SESSION['codeClient']);
            $_SESSION['prenomClient'] = $ad->get('prenomClient');
            $admin = $ad->get('admin');
            if ($admin) {
                $_SESSION['admin'] = true;
            }
            $u = ModelClients::select($_SESSION['codeClient']);
            require_once File::build_path(array('view', 'view.php'));
        }
    }

    public static function signOut()
    {
        if (isset($_SESSION['codeClient'])) {
            unset($_SESSION['codeClient']);
            unset($_SESSION['prenomClient']);
            unset($_SESSION['admin']);
            session_destroy();
        }
        return static::home();
    }

    public static function readAll()
    {
        if (!isset($_SESSION['codeClient']) || !$_SESSION['admin']) {
            self::errorConnecte();
            exit();
        }

        $view = 'list';
        $pagetitle = 'Liste des Clients';
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function read()
    {
        if (!isset($_SESSION['codeClient'])) {
            self::errorConnecte();
            exit();
        }

        if ($_SESSION['admin'] && isset($_GET['codeClient'])) { // Si un administrateur veut lire les informations d'un client
            $u = ModelClients::select($_GET['codeClient']);
            if ($u == false) {
                self::errorClientInexistant();
                exit();
            }
        } else { // Dans le cas échéant cela veut dire que c'est un admin / client qui veut lire son propre profil
            $u = ModelClients::select($_SESSION['codeClient']);
        }

        $view = 'detail';
        $pagetitle = "Détail du client";
        require File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function delete()
    {
        if (!isset($_SESSION['codeClient']) || !$_SESSION['admin']) {
            self::errorConnecte();
            exit();
        }

        if (!isset($_GET['codeClient'])) {
            self::errorPageIntrouvable();
            exit();
        }

        if (ModelClients::select($_GET['codeClient']) == false) {
            self::errorClientInexistant();
            exit();
        }

        ModelClients::delete($_GET['codeClient']);
        $tab_u = ModelClients::selectAll();
        $view = "deleted";
        $pagetitle = 'Suppression d\'un client';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create($m = "")
    {
        if (!isset($_SESSION['codeClient']) || !$_SESSION['admin']) {
            self::errorConnecte();
            exit();
        }
        $action='created';
        $message = $m;
        $methodename = 'created';
        $view = 'update';
        $pagetitle = 'Création';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created()
    {
        if (!isset($_SESSION['codeClient']) || !$_SESSION['admin']) {
            self::errorConnecte();
            exit();
        }

        if ($_POST['mdpClient'] != $_POST['confirm_mdpClient']) {
            $action ='create';
            self::create("Les deux mot de passe ne correspondent pas");
            exit();
        }

        $data = array(
            'mdpClient' => Security::hacher($_POST['mdpClient']),
            'nomClient' => $_POST['nomClient'],
            'prenomClient' => $_POST['prenomClient'],
            'mailClient' => $_POST['mailClient'],
            'telClient' => $_POST['telClient']
        );

        if (ModelClients::save($data) == false) {
            self::errorExisteDeja();
            exit();
        }

        $view = 'created';
        $pagetitle = 'Liste des utilisateurs';
        $tab_u = ModelClients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }


    public static function update($m = "")
    {
        if (!isset($_SESSION['codeClient'])) {
            self::errorConnecte();
            exit();
        }

        if(isset($_POST['codeClient'])) {
            $_GET['codeClient'] = $_POST['codeClient'];
        }

        if ($_SESSION['admin'] && isset($_GET['codeClient'])) {
            $u = ModelClients::select($_GET['codeClient']);
            if ($u == false) {
                self::errorClientInexistant();
                exit();
            }
        } else {
            $u = ModelClients::select($_SESSION['codeClient']);
        }
        $action = 'updated';
        $message = $m;
        $methodename = 'updated';
        $view = "update";
        $pagetitle = 'Mise à jour des informations du profil';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated()
    {
        if (!isset($_SESSION['codeClient'])) {
            self::errorConnecte();
            exit();
        }

        if ($_POST['mdpClient'] != $_POST['confirm_mdpClient']) {
            $_GET['action']='update';
            self::update("Les deux mot de passe ne correspondent pas");
            exit();
        }

        $data = array(
            'nomClient' => $_POST['nomClient'],
            'prenomClient' => $_POST['prenomClient'],
            'mailClient' => $_POST['mailClient'],
            'telClient' => $_POST['telClient']
        );

        if (!$_POST['mdpClient'] == "")
            $data['mdpClient'] = Security::hacher($_POST['mdpClient']);

        if ($_SESSION['admin'] && isset($_POST['codeClient'])) {
            $data['codeClient'] = $_POST['codeClient'];
        } else {
            $data['codeClient'] = $_SESSION['codeClient'];
        }

        ModelClients::update($data);

        $view = 'updated';
        $pagetitle = 'Liste des clients';
        $tab_u = ModelClients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function errorPageIntrouvable()
    {
        $view = 'errorPageIntrouvable';
        $pagetitle = 'Page introuvable';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function errorClientInexistant()
    {
        $view = 'errorClient';
        $pagetitle = 'Client inexistant';
        require File::build_path(array("view", "view.php"));
    }

    public
    static function errorConnecte()
    {
        $view = 'errorConnecte';
        $pagetitle = 'Accès impossible';
        require File::build_path(array("view", "view.php"));
    }
}

