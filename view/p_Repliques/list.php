
<?php
foreach ($tab_rep as $v)
echo '<p> Replique d\'id ' . htmlspecialchars($v->get("idReplique")) . " <a href=?controller=replique&action=read&idReplique=".$v->get("idReplique").">Details</a> </p>";
?>
