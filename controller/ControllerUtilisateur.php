<?php
    require_once File::build_path(array("model","ModelUtilisateur.php"));
    // chargement du modèle
    class ControllerUtilisateur {
        public static function readAll($args=null) {
            $controller = 'utilisateur';
            $view = 'list';
            $pagetitle = 'Liste des Utilisateurs';
            $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            require File::build_path(array('view',$controller,'view.php'));  //"redirige" vers la vue
        }

        public static function read($args){
            $controller = 'utilisateur';
            $view = 'detail';
            $pagetitle = 'Détail de la Utilisateur';
            $u = ModelUtilisateur::select($args['login']);
            if($u == false or $u == null){
                throw new Exception("Utilisateur introuvable", 1);
                
            }
            require File::build_path(array('view',$controller,'view.php'));  //"redirige" vers la vue
        }

        public static function create($args=null){
            $controller = 'utilisateur';
            $view = 'create';
            $pagetitle = 'Enregistrez une Utilisateur';
            require File::build_path(array('view',$controller,'view.php'));  //"redirige" vers la vue
        }

        public static function created($args){
            $controller = 'utilisateur';
            $view = 'created';
            $pagetitle = 'Liste des Utilisateurs';
            $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $u = new ModelUtilisateur($args['immatriculation'],$args['marque'],$args['couleur']);
            $u->save();
            require_once File::build_path(array('view',$controller,'view.php'));

        }

        public static function delete($args){
            $controller = 'utilisateur';
            $view = 'deleted';
            $pagetitle = 'Supprimer Utilisateur';
            $log = $args['login'];
            ModelUtilisateur::delete($log);
            $tab_u = ModelUtilisateur::selectAll();
            require File::build_path(array('view',$controller,'view.php'));  //"redirige" vers la vue
            
        }

        public static function update($args){
            $controller = 'utilisateur';
            $view = 'update';
            $pagetitle = 'MAJ Utilisateur';
            $immat = $args['immatriculation'];
            $v = ModelUtilisateur::select($immat);
            require_once File::build_path(array('view',$controller,'view.php'));//"redirige" vers la vue
        }
        public static function updated($args){
            $controller = 'utilisateur';
            $view = 'updated';
            $pagetitle = 'Liste des Utilisateurs';
            $log = $args['login'];
            $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $u = new ModelUtilisateur($args['immatriculation'], $args['marque'], $args['couleur']);
            $u->update();
            require_once File::build_path(array('view',$controller,'view.php'));
        }

        public static function error(){
            $controller = 'utilisateur';
            $view = 'error';
            $pagetitle = 'error';
            require_once File::build_path(array('view',$controller,'view.php'));
        }
    }
?>