<?php
    require_once File::build_path(array("model","ModelVoiture.php"));
    // chargement du modèle
    class ControllerReplique{
        public static function readAll($args=null) {
            $controller = 'replique';
            $view = 'list';
            $pagetitle = 'Liste des voitures';
            $tab_v = ModelVoiture::getAllVoitures();     //appel au modèle pour gerer la BD
            require File::build_path(array('view','view.php'));  //"redirige" vers la vue
        }
        public static function error(){
            $controller = 'replique';
            $view = 'error';
            $pagetitle = 'error';
            require_once File::build_path(array('view','view.php'));
        }
    }