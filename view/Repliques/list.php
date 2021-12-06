<?php
foreach ($tab as $t) {
    $primary = $t->get('idReplique');
    $htmlPrimary = htmlspecialchars($primary);
    $urlPrimary = rawurlencode($primary);
    echo '<p><a href="index.php?controller=repliques&action=delete&idReplique=' . $urlPrimary . '">X</a> Réplique d\'identifiant <a href="index.php?controller=repliques&action=read&idReplique=' . $urlPrimary . '">' . $htmlPrimary . '</a> </p>';
}