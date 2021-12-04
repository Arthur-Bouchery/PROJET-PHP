<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <header>
        <p style="border: 1px solid black;text-align:center;padding-right:1em;">
            <a href="index.php?action=readAll&controller=Replique">Magasin Repliques</a>
            <a href="index.php?action=readAll&controller=utilisateur">Acceuil Utilisateur</a>
            <a href="index.php?action=readAll&controller=trajet">Acceuil Trajet</a>
            <a href="index.php?&controller=clients">profil</a>
            <a href="view/preferences.html">preferences</a>
            <a href="index.php?action=readAll&controller=panier">Panier</a>
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