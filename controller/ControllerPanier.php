<?php

class ControllerPanier
{
    protected static $object = 'panier';

    public static function readAll($args=null) {
        $view = 'panier';
        $pagetitle = 'PANIER';
        $tab_panier = $_SESSION["panier"];     //Stocker le panier depuis la session
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }
    
    public static function set($args) {         
        $args["qte"] = $args["qte"] ?? 1;
        $sessionPanier = $_SESSION["panier"] ?? array();
        if ($args["qte"] <= 0) {
            if (isset($sessionPanier[$args["idReplique"]])) {
                unset($sessionPanier[$args["idReplique"]]);
            }
        } else { 
            $sessionPanier[$args["idReplique"]] = $args["qte"];
        }
        $_SESSION["panier"] = $sessionPanier;
        self::readAll();
    }
}