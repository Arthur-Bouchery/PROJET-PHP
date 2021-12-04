<?php
foreach ($tab_panier as $k => $v)
echo '<p> Replique d\'id ' . htmlspecialchars($k) . " de quantité ".htmlspecialchars($v)." <a href=?controller=replique&action=read&idReplique=".$k.">Details</a> <a href=?controller=panier&action=set&idReplique=$k&qte=0>Supprimer</a> </p>";
?>
