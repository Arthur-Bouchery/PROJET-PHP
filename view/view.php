<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
</head>
<header>
    <p style="border: 1px solid black;text-align:center;padding-right:1em;">
        <a href="index.php?action=readAll&controller=repliques">Repliques</a>
        <a href="index.php?&controller=clients&action=home"> <?php if(isset($_SESSION['prenomClient'])) {echo $_SESSION['prenomClient'];}
            else {echo "Profil";}?></a>
        <a href="view/preferences.html">Préférences</a>
        <a href="index.php?action=readAll&controller=panier">Panier</a>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
        <br>Pannel administrateur :
        <a href="index.php?action=readAll&controller=clients">Gestion des clients</a>
        <a href="index.php?action=create&controller=clients">Créer un client</a>
        <a href="index.php?action=create&controller=repliques">Créer une réplique</a>
        <?php } ?>
    </p>
</header>
<body>
<?php
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("view", static::$object, "$view.php"));
require $filepath;
?>
</body>
<footer>
    <p style="border: 1px solid black;text-align:center;padding-right:1em;">
        Site de vente de Repliques d'armes à feu (pour petit enfant)
    </p>
</footer>
</html>