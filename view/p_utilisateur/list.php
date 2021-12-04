<?php
foreach ($tab_u as $u)
echo '<p> Login : ' . htmlspecialchars($u->getLogin()) . " <a href=?controller=p_utilisateur&action=read&login=".$u->getLogin().">Details</a> </p>";
?>
