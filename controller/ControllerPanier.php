<?php

class ControllerPanier
{
    protected static $object = 'panier';

    public static function readAll() {
        $view = 'panier';
        $pagetitle = 'PANIER';
        $tab_panier = $_SESSION["panier"];     //Stocker le panier depuis la session
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    
    public static function set() {
        $_GET["qte"] = $_GET["qte"] ?? 1;
        $sessionPanier = $_SESSION["panier"] ?? array();
        if ($_GET["qte"] <= 0) {
            if (isset($sessionPanier[$_GET["idReplique"]])) {
                unset($sessionPanier[$_GET["idReplique"]]);
            }
        } else { 
            $sessionPanier[$_GET["idReplique"]] = $_GET["qte"];
        }
        $_SESSION["panier"] = $sessionPanier;
        self::readAll();
    }
}