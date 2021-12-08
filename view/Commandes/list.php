<?php
foreach ($tab_commande as $com)
echo '<p> code Commande : ' . htmlspecialchars($com[0]) .' date de la commande : '. htmlspecialchars($com[1]) . " <a href=?controller=Commandes&action=read&codeCommande=".$com[0].">Details</a> </p>";
?>
