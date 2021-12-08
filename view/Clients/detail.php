<?php
echo htmlspecialchars($u->get('codeClient'));
echo htmlspecialchars(' ' . $u->get('nomClient'));
echo htmlspecialchars(' ' . $u->get('prenomClient') . ' ');
echo('<a href="?controller=clients&action=delete&codeClient=' . $u->get('codeClient') . '">Supprimer le compte</a>');
echo '<br>';
/*echo('<a href="?controller=clients&action=updatePassword&codeClient=' . $u->get('codeClient') . '">Modifier le mot de passe</a>');
echo '<br>';*/
echo('<a href="?controller=clients&action=update&codeClient=' . $u->get('codeClient') . '">Modifier informations</a>');
echo '<br>';