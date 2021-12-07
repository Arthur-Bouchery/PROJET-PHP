<?php
foreach ($tab as $t) {
    $urlPrimary = rawurlencode($t->get('idReplique'));
    $htmlPrimary = htmlspecialchars($t->get('idReplique'));
    $htmlNom = htmlspecialchars($t->get('nomReplique'));
    $htmlCategorie = htmlspecialchars($t->get('nomCategorie'));
    ?>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
        <p><a href="index.php?controller=repliques&action=delete&idReplique=<?php echo $urlPrimary; ?>">X</a> Réplique
            d'identifiant <a
                    href="index.php?controller=repliques&action=read&idReplique=<?php echo $urlPrimary; ?>"><?php echo $htmlPrimary; ?> </a>
        </p>
    <?php } else { ?>
        <a href="index.php?controller=repliques&action=read&idReplique=<?php echo $urlPrimary; ?>"><?php echo $htmlNom; ?></a>
    <?php } ?>
<?php } ?>
