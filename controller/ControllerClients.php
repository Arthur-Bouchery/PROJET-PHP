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

    public static function signIn()
    {
        $view = "signIn";
        $pagetitle = 'Connexion';
        $wrongInformations = false;
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
        $mailClient = $_POST['mailClient'];
        $mdp_hash = Security::hacher($_POST['mdpClient']);
        $validUser = ModelClients::checkPassword($mailClient, $mdp_hash);

        if (!$validUser) {
            self::signInError();
        } else {
            //ouvrir la session du client
            $_SESSION['codeClient'] = ModelClients::getCodeClientByEmailAndPassword($mailClient, $mdp_hash);
            $_SESSION['mailClient'] = ModelClients::getMailClient($mailClient);
            $ad = ModelClients::select($_SESSION['codeClient']);
            $_SESSION['prenomClient'] = $ad->get('prenomClient');
            $admin = $ad->get('admin');
            if ($admin) {
                $_SESSION['admin'] = true;
            }

            $u = ModelClients::select($_SESSION['codeClient']);
            $view = "home";
            $pagetitle = 'Profil Utilisateur';
            require_once File::build_path(array('view', 'view.php')); // TODO ça serait pas mieux de redigirer vers la page principale ?
        }
    }

    public static function signOut()
    {
        if (isset($_SESSION['codeClient'])) {
            unset($_SESSION['codeClient']);
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

        $message = $m;
        $methodename = 'created';
        $view = 'update';
        $pagetitle = 'Inscription';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created()
    {
        if (!isset($_SESSION['codeClient']) || !$_SESSION['admin']) {
            self::errorConnecte();
            exit();
        }

        if ($_POST['mdpClient'] != $_POST['confirm_mdpClient']) {
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

        if ($_SESSION['admin'] && isset($_GET['codeClient'])) {
            $u = ModelClients::select($_GET['codeClient']);
            if ($u == false) {
                self::errorClientInexistant();
                exit();
            }
        } else {
            $u = ModelClients::select($_SESSION['codeClient']);
        }

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

    public
    static function errorPageIntrouvable()
    {
        $view = 'errorPageIntrouvable';
        $pagetitle = 'Page introuvable';
        require_once File::build_path(array('view', 'view.php'));
    }

    public
    static function errorClientInexistant()
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

