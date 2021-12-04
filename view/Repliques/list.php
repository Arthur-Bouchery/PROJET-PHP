
<?php
foreach ($tab_rep as $v)//c'est pas une erreur $tab_rep déclaré dans ControllerReplique
echo '<p> Replique d\'id ' . htmlspecialchars($v->getId()) . " <a href=?action=read&Id=".$v->getId().">Details</a> </p>";
?>
