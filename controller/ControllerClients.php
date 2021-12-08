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
        $emailClient = $_POST['mailClient'];
        $mdp_hash = Security::hacher($_POST['mdpClient']);
        $validUser = ModelClients::checkPassword($emailClient, $mdp_hash);

        if (!$validUser) {
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
        $view = 'list';
        $pagetitle = 'Liste des Clients';
        $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function read()
    {
        $view = 'detail';
        $pagetitle = "Détail du client";
        $u = ModelClients::select($_GET['codeClient']);
        if ($u == false) {
            self::errorClientInexistant();
            exit();
        }
        require File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }




    public static function error()
    {
        $view = 'error';
        $pagetitle = 'error';
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function delete()
    {
        $view = "deleted";
        $pagetitle = 'SUPRESSION';
        $login = $_GET['codeClient'];
        ModelClients::delete($login);
        $tab_u = ModelClients::selectAll();
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function create()
    {
        $view = 'update';
        $pagetitle = 'Enregistrez un Client';
        require File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function update()
    {

        $view = "update";
        $pagetitle = 'Mise à jour des informations de profil';
        $login = $_GET['codeClient'];
        $u = ModelClients::select($login);
        require_once File::build_path(array('view', 'view.php'));
    }

    public static function updated()
    {
        unset($_GET['action']);
        unset($_GET['controller']);
        if ($_GET['mdpClient'] == "") {
            $view = 'updated';
            $pagetitle = 'Liste des joueurs';
            $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
            $login = $_GET['codeClient'];
            $u = ModelClients::select($login);
            //récup ancien mdp
            $_GET['mdpClient'] = $u->get('mdpClient');
            //fin récup
            unset($_GET['confirm_mdpClient']);
            if ($u) $u->update($_GET);
            require_once File::build_path(array('view', 'view.php'));
        } else if ($_GET['mdpClient'] == $_GET['confirm_mdpClient']) {
            $view = 'updated';
            $pagetitle = 'Liste des joueurs';
            $tab_u = ModelClients::selectAll();     //appel au modèle pour gerer la BD
            $login = $_GET['codeClient'];
            $u = ModelClients::select($login);
            //encodage du mdp
            $_GET['mdpClient'] = Security::hacher($_GET['mdpClient']);
            //fin encodage
            unset($_GET['confirm_mdpClient']);
            if ($u) $u->update($_GET);
            require_once File::build_path(array('view', 'view.php'));
        }
    }

    public static function created()
    {
        if ($_GET['mdpClient'] == $_GET['confirm_mdpClient']) {
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

    public static function errorClientInexistant()
    {
        $view = 'errorClient';
        $pagetitle = 'Client inexistant';
        require File::build_path(array("view", "view.php"));
    }
}

