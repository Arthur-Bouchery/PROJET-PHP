<?php
	require_once File::build_path(array("controller","ControllerVoiture.php"));
	require_once File::build_path(array("controller","ControllerUtilisateur.php"));
	//implementation des preferences du cookie
	if(!isset($_COOKIE['pagePref'])){
		$controller_default='voiture';
	}else{
		$controller_default=$_COOKIE['pagePref'];
	}

	//gestion du controlleur a utiliser:
	if(!isset($_GET['controller'])){
		$controller=$controller_default;
		$controller_class = 'Controller'.ucfirst($controller);
	}else{

		$controller= $_GET['controller'];
		$controller_class = 'Controller'.ucfirst($controller);
		if(class_exists($controller_class)){//on passe a la suite du code si le controlleur existe
		}
		else{
			ControllerVoiture::error();
		}
	}

	// On teste si une action a été spécifiée
	if (!isset($_GET['action'])){
		$action='readAll';
	}else if (in_array($_GET['action'], get_class_methods(new $controller_class()))){ 
		// On recupère l'action passée dans l'URL
		$action = $_GET['action'];
		//on récupère tous les arguments passés
		$args = $_GET; //on s'en sert pour recuperer les autres informations passees dsna l'url
		// Appel de la méthode statique $action de ControllerVoiture
	}else{
		ControllerVoiture::error();
	}
	$controller_class::$action($_GET);
?>