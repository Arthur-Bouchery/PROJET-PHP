<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" type="text/css" href="view/style.css">
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
                <a href="index.php?action=readAll&controller=repliques">Repliques</a>
                <a href="index.php?&controller=clients&action=home"> <?php if (isset($_SESSION['prenomClient'])) {
                        echo $_SESSION['prenomClient'];
                    } else {
                        echo "Profil";
                    } ?></a>
                <a href="view/preferences.html">Préférences</a>
                <a href="index.php?action=readAll&controller=panier">Panier</a>
            </div>
        </div>
        <div id="boxRight">
            <a href="index.php?action=signIn&controller=clients">Connexion</a>
        </div>
    </div>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
        <div id="headerBottom">
            <a href="index.php?action=readAll&controller=clients">Gestion des clients</a>
            <a href="index.php?action=create&controller=clients">Créer un client</a>
            <a href="index.php?action=create&controller=repliques">Créer une réplique</a>
        </div>
    <?php } ?>
</header>
<main>
    <svg width="288" height="72.9" viewBox="0 0 288 72.9" class="css-1j8o68f">
        <defs id="SvgjsDefs1337"></defs>
        <g id="SvgjsG1340" featurekey="nameFeature-0"
           transform="matrix(2.1433751583099365,0,0,2.1433751583099365,84.56991541793707,-19.720667629838033)"
           fill="#ffffff">
            <path d="M22.518 21.279 c0 5.1164 -4.162 9.2784 -9.2776 9.2784 l-4.6035 0 l5.0756 5.8008 c0.79856 0.913 0.70604 2.3004 -0.20668 3.099 c-0.41644 0.36453 -0.93196 0.54324 -1.4453 0.54324 c-0.61104 0 -1.2191 -0.25363 -1.6534 -0.74996 l-8.2628 -9.4432 c-0.56768 -0.64868 -0.70332 -1.5691 -0.34726 -2.3536 s1.1381 -1.2885 1.9998 -1.2885 l9.4428 0 c2.6943 0 4.8864 -2.192 4.8864 -4.8864 s-2.1922 -4.8864 -4.8864 -4.8864 l-4.1412 0 l4.5136 4.5136 c0.85756 0.85756 0.85756 2.248 0 3.1056 c-0.85784 0.85784 -2.248 0.85784 -3.1058 0 l-8.2628 -8.2628 c-0.62808 -0.62808 -0.81584 -1.5726 -0.47576 -2.3932 s1.1408 -1.3555 2.0289 -1.3555 l9.4428 0 c5.1164 0 9.2784 4.1624 9.2784 9.2784 z M38.126999999999995 27.509999999999998 c3.4434 0 6.2452 2.8016 6.2452 6.2452 s-2.8016 6.2452 -6.2452 6.2452 l-8.098 0 c-1.2128 0 -2.196 -0.98328 -2.196 -2.196 s0.98328 -2.196 2.196 -2.196 l8.098 0 c1.0217 0 1.8529 -0.8312 1.8529 -1.8529 s-0.8312 -1.8529 -1.8529 -1.8529 l-8.098 0 c-3.4434 0 -6.2452 -2.8016 -6.2452 -6.2452 s2.8016 -6.2452 6.2452 -6.2452 l8.098 0 c1.2128 0 2.196 0.98328 2.196 2.196 s-0.98328 2.196 -2.196 2.196 l-8.098 0 c-1.0217 0 -1.8529 0.8312 -1.8529 1.8529 s0.8312 1.8529 1.8529 1.8529 l8.098 0 z M55.942 19.412 c5.6764 0 10.294 4.6176 10.294 10.294 s-4.6176 10.294 -10.294 10.294 s-10.294 -4.6176 -10.294 -10.294 s4.6176 -10.294 10.294 -10.294 z M55.942 35.608 c3.2543 0 5.902 -2.6476 5.902 -5.902 s-2.6476 -5.902 -5.902 -5.902 s-5.902 2.6476 -5.902 5.902 s2.6476 5.902 5.902 5.902 z M78.371 27.509999999999998 c1.2128 0 2.196 0.98332 2.196 2.1961 s-0.98328 2.196 -2.196 2.196 l-6.0666 0 l0 5.902 c0 1.2128 -0.98328 2.196 -2.196 2.196 s-2.196 -0.98328 -2.196 -2.196 l0 -15.345 c0 -5.7668 4.692 -10.459 10.459 -10.459 c1.2128 0 2.196 0.98328 2.196 2.196 s-0.98328 2.196 -2.196 2.196 c-3.3452 0 -6.0668 2.7215 -6.0668 6.0668 l0 5.051 l6.0666 0 z M92.715 35.608 c1.2128 0 2.1961 0.98332 2.1961 2.1961 s-0.98328 2.196 -2.196 2.196 c-5.7668 0 -10.459 -4.692 -10.459 -10.459 l0 -15.345 c0 -1.2128 0.98328 -2.196 2.196 -2.196 s2.196 0.98328 2.196 2.196 l0 5.2217 l6.0666 0 c1.2128 0 2.196 0.98328 2.196 2.196 s-0.98328 2.196 -2.196 2.196 l-6.0666 0 l0 5.7312 c0 3.3452 2.7215 6.0668 6.0668 6.0668 z"></path>
        </g>
    </svg>
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