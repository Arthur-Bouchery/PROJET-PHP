
<?php
foreach ($tab_v as $v)
echo '<p> Voiture d\'immatriculation ' . htmlspecialchars($v->getImmatriculation()) . " <a href=?action=read&immatriculation=".$v->getImmatriculation().">Details</a> </p>";
?>
