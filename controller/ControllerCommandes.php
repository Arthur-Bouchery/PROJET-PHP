<?php

require_once File::build_path(array("model", "ModelCommandes.php"));

class ControllerCommandes
{
    protected static $object = 'Commandes';

    public static function read()
    {
        if (!isset($_SESSION['codeClient'])) {
            self::errorNotConnected();
            exit();
        }

        $c = ModelCommandes::select($_GET['codeCommande']);
        if ($c == false) {
            self::errorCommandeInexistante();
            exit();
        }

        $view = 'detail';
        $pagetitle = "Détail de la commande";
        require File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function readAll(){
        if (!isset($_SESSION['codeClient'])) {
            self::errorNotConnected();
            exit();
        }

        $view = 'list';
        $pagetitle = 'Liste des Commandes';
        $tab_commande = ModelCommandes::selectAll();     //appel au modèle pour gerer la BD
        require_once File::build_path(array('view', 'view.php'));  //"redirige" vers la vue

    }


    public static function commander() {
        if(!isset($_SESSION['codeClient'])){
            self::errorNotConnected();
        }else if(sizeof($_SESSION['panier']) <= 0){
            self::panierIsEmpty();
        }else{
            $c = new ModelCommandes();
            $c->set('dateCommande', date("Y-m-d H:i:s"));
            $old = ModelCommandes::getLastCode();
            if($old==null){
                $c->set('codeCommande', 1);
            }else{$c->set('codeCommande', $old+1);}
            $c->set('codeClient', $_SESSION['codeClient']);
            $c->set('idReplique_qte', $_SESSION['panier']);
            $c->enregistrer();
        }
        unset($_SESSION['panier']);
        self::historique();
    }

    public static function historique() {
        if (!isset($_SESSION['codeClient'])) {
            self::errorNotConnected();
            exit();
        }

        $view = 'list';
        $pagetitle = 'Liste des Commandes';
        if (isset($_SESSION['codeClient'])) {
            $tab_commande = ModelCommandes::selectByCodeClient();
        }
        //appel au modèle pour gerer la BD
        require_once File::build_path(array('view', 'view.php'));  //"redirige" vers la vue
    }

    public static function errorCommandeInexistante() {
        $view = 'errorCommande';
        $pagetitle = 'Commande inexistante';
        require File::build_path(array("view", "view.php"));
    }

    public static function errorNotConnected() {
        $view = 'errorNotConnected';
        $pagetitle = 'Déconnecté';
        require File::build_path(array("view", "view.php"));
    }

    public static function panierIsEmpty() {
        $view = 'panierVide';
        $pagetitle = 'Le panier est vide';
        require File::build_path(array("view", "view.php"));
    }

    public static function delete() {
        ModelCommandes::deleteByCC($_GET['codeCommande']);
        self::historique();

    }

}

?>