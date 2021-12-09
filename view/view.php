<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="view/style.css">
    <link rel="icon" href="view/images/favicon.png">
</head>
<body>
<header>
    <div id="headerTop">
        <div>
            <div id="boxLeft">
                <a href="index.php">
                    <img src="view/images/logo.png" alt="logo">
                </a>
            </div>
            <div id="boxCenter">
                <a href="index.php?action=readAll&controller=repliques">Répliques</a>
                <a href="index.php?action=readAll&controller=panier">Panier</a>
                <a href="index.php?&controller=clients&action=home">
                    <?php if (isset($_SESSION['prenomClient'])) {
                        echo $_SESSION['prenomClient'];
                    } else {
                        echo "Profil";
                    } ?></a>
            </div>
        </div>
        <div id="boxRight">
            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                echo '<a href="index.php?action=signOut&controller=clients">Se déconnecter</a>';
            else {
                echo '<a href="index.php?action=signedUp&controller=clients">Inscription</a>';
                echo '<a href="index.php?action=signIn&controller=clients">Connexion</a>';
            }

            ?>
        </div>
    </div>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
        echo '<div id="headerBottom">
        <a href="index.php?action=readAll&controller=clients">Gestion des clients</a>
        <a href="index.php?action=create&controller=clients">Créer un client</a>
        <a href="index.php?action=create&controller=repliques">Créer une réplique</a>
        <a href="index.php?action=readAll&controller=commandes">Gestion des commandes</a>
    </div>';
    } ?>

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
    <p>
        Rsoft 2021 - ne convient pas aux enfants de moins de 7 ans
    </p>
</footer>
</body>
</html>