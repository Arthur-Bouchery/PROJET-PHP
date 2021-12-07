<?php
foreach ($tab as $t) {
    $primary = $t->get('idReplique');
    $htmlPrimary = htmlspecialchars($primary);
    $urlPrimary = rawurlencode($primary);
    ?>
    <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) { ?>
    <p><a href="index.php?controller=repliques&action=delete&idReplique=<?php echo $urlPrimary ;?>">X</a> Réplique d'identifiant <a href="index.php?controller=repliques&action=read&idReplique=<?php echo $urlPrimary ;?>"><?php echo $htmlPrimary; ?> </a> </p>
<?php } else { ?>
        <p> Réplique de : <?php echo $t->get('nomReplique'); ?>
        <a href="index.php?controller=repliques&action=read&idReplique=<?php echo $urlPrimary ;?>">Voir l'article </a>
        </p>
    <?php } ?>
<?php } ?>
