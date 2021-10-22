<?php
require_once File::build_path(array("controller","ControllerReplique.php"));
// On teste si une action a été spécifiée
if (!isset($_GET['action'])){
	$action='readAll';
}else if (in_array($GET_['action'], get_class_methods(ControllerReplique))){ 
	// On recupère l'action passée dans l'URL
	$action = $_GET['action'];
	//on récupère tous les arguments passés
	$args = $_GET;
	// Appel de la méthode statique $action de ControllerReplique
}else{
	ControllerReplique::error();
}
ControllerReplique::$action($_GET);
?>
