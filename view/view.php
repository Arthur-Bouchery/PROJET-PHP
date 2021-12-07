<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="view/style.css">
</head>
<body>
<header>
    <a href="index.php?action=readAll&controller=repliques">Repliques</a>
    <a href="index.php?&controller=clients&action=home"> <?php if (isset($_SESSION['prenomClient'])) {
            echo $_SESSION['prenomClient'];
        } else {
            echo "Profil";
        } ?></a>
    <a href="view/preferences.html">Préférences</a>
    <a href="index.php?action=readAll&controller=panier">Panier</a>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
        <br>Pannel administrateur :
        <a href="index.php?action=readAll&controller=clients">Gestion des clients</a>
        <a href="index.php?action=create&controller=clients">Créer un client</a>
        <a href="index.php?action=create&controller=repliques">Créer une réplique</a>
    <?php } ?>
</header>
<main>
    <?php
    // Si $controleur='voiture' et $view='list',
    // alors $filepath="/chemin_du_site/view/voiture/list.php"
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
    ?>
</main>
<footer>
    Site de vente de Repliques d'armes à feu (pour petit enfant)
</footer>
</body>
</html>