<?php
require_once File::build_path(array("model", "ModelRepliques.php"));

class ControllerRepliques
{
    protected static $object = 'repliques';

    public static function readAll()
    {
        $tab = ModelRepliques::selectAll();
        $view = 'list';
        $pagetitle = 'Liste des répliques';
        require File::build_path(array("view", "view.php"));
    }

    public static function read()
    {
        $r = ModelRepliques::select($_GET['idReplique']);
        if ($r == false) {
            self::errorRepliqueInexistante();
            exit();
        }

        $view = 'detail';
        $pagetitle = 'Détails de la réplique';
        require File::build_path(array("view", "view.php"));
    }

    public static function create()
    {
        $r = new ModelRepliques('', '', '', '');
        $methodename = 'created';
        $view = 'update';
        $pagetitle = 'Créer une réplique';
        require File::build_path(array("view", "view.php"));
    }

    public static function created()
    {
        $data = array(
            'idReplique' => $_POST['idReplique'],
            'nomReplique' => $_POST['nomReplique'],
            'nomCategorie' => $_POST['nomCategorie'],
            'stockRepliques' => $_POST['stockRepliques']
        );

        if (ModelRepliques::save($data) == false) {
            self::errorExisteDeja();
            exit();
        }

        $view = 'created';
        $pagetitle = 'Réplique créée';
        $tab = ModelRepliques::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function delete()
    {
        if (ModelRepliques::select($_GET['idReplique']) == false) {
            self::errorRepliqueInexistante();
            exit();
        }

        ModelRepliques::delete($_GET['idReplique']);
        $view = 'deleted';
        $pagetitle = 'Réplique suprimée';
        $tab = ModelRepliques::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function update()
    {
        $r = ModelRepliques::select($_GET['idReplique']);
        if ($r == false) {
            self::errorRepliqueInexistante();
            exit();
        }

        $methodename = 'updated';
        $view = 'update';
        $pagetitle = 'Modifier une voiture';
        require File::build_path(array("view", "view.php"));
    }

    public static function updated()
    {
        $data = array(
            'idReplique' => $_POST['idReplique'],
            'nomReplique' => $_POST['nomReplique'],
            'nomCategorie' => $_POST['nomCategorie'],
            'stockRepliques' => $_POST['stockRepliques']
        );
        ModelRepliques::update($data);

        $view = 'updated';
        $pagetitle = 'Réplique mise à jour';
        $tab = ModelRepliques::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function error()
    {
        $view = 'error';
        $pagetitle = 'Erreur';
        require File::build_path(array("view", "view.php"));
    }

    public static function errorRepliqueInexistante()
    {
        $view = 'errorReplique';
        $pagetitle = 'Immatriculation inexistante';
        require File::build_path(array("view", "view.php"));
    }

    public static function errorExisteDeja()
    {
        $view = 'errorExisteDeja';
        $pagetitle = 'La voiture existe déjà';
        require File::build_path(array("view", "view.php"));
    }
}
