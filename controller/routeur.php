<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}
require_once File::build_path(array("controller", "ControllerRepliques.php"));
require_once File::build_path(array("controller", "ControllerClients.php"));
require_once File::build_path(array("controller", "ControllerPanier.php"));
require_once File::build_path(array("controller", "ControllerCommandes.php"));

// Implémentation des préférences du cookie (code non utilisé)
/* if (!isset($_COOKIE['pagePref'])) {
    $controller_default = 'repliques';
} else {
    $controller_default = $_COOKIE['pagePref'];
}*/

$controller_default = 'repliques';

// Récupération de la variable controller
$controller = $controller_default; // Controller par défaut si rien n'a été spécifié
if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
}

// Vérification que le controller existe
$controller_class = 'Controller' . ucfirst($controller);
if (!class_exists($controller_class)) {
    ControllerRepliques::errorPageIntrouvable();
    exit();
}

$action = 'readAll';
 
// Récupération de la variable action
if (isset($_GET['action'])) { // Actions par défaut si rien n'a été spécifié
    $action = $_GET['action'];
}

// Vérification que l'action existe dans la classe
$methodes = get_class_methods($controller_class);
if (!in_array($action, $methodes)) {
    $controller_class::errorPageIntrouvable();
    exit();
}

$controller_class::$action();