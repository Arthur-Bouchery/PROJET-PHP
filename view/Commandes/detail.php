<?php
echo htmlspecialchars($u->get('codeClient'));
echo htmlspecialchars(' '.$u->get('nomClient'));
echo htmlspecialchars(' '.$u->get('prenomClient').' ');
echo ('<a href="?controller=clients&action=delete&codeClient='.$u->get('codeClient').'"     >Supprimer</a>');
echo '<br>';
echo ('<a href="?controller=clients&action=update&codeClient='.$u->get('codeClient').'"     >Modifier</a>');
echo '<br>';
?>