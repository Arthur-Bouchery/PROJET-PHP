<?php
session_start();
require_once File::build_path(array("controller","ControllerReplique.php"));
require_once File::build_path(array("controller","ControllerClients.php"));
require_once File::build_path(array("controller","ControllerTrajet.php"));
require_once File::build_path(array("controller","ControllerPanier.php"));

//implementation des preferences du cookie
if(!isset($_COOKIE['pagePref'])){
    $controller_default='clients';
}else{
    $controller_default=$_COOKIE['pagePref'];

}

//gestion du controlleur a utiliser: 
if (!isset($_GET['controller'])) {
    $controller = $controller_default;
} else {
    $controller = $_GET['controller'];
}

$controller_class = 'Controller'.ucfirst($controller);

if (!class_exists($controller_class)) {
    ControllerReplique::error();
    exit();
}

// On teste si une action a été spécifiée
if (!isset($_GET['action'])) {
    $action = 'readAll';
}
else if(in_array($_GET['action'], get_class_methods(new $controller_class()))) {
    // On recupère l'action passée dans l'URL
    $action = $_GET['action'];
    //on récupère tous les arguments passés
    $args = $_GET;
}
else {
    $controller_class::error();
    exit();
}
// Appel de la méthode statique $action de ControllerVoiture
$controller_class::$action($_GET);
?>
