<?php
foreach ($tab_u as $u)
echo '<p> code Client : ' . htmlspecialchars($u->getCodeClient()) . " <a href=?controller=Clients&action=read&codeClient=".$u->getCodeClient().">Details</a> </p>";
?>
