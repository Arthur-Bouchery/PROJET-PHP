
<?php
foreach ($tab_rep as $v)
echo '<p> Replique d\'id ' . htmlspecialchars($v->getId()) . " <a href=?action=read&Id=".$v->getId().">Details</a> </p>";
?>
