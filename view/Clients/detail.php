<<<<<<< HEAD
<?php
    echo htmlspecialchars($u->get('login'));
    echo htmlspecialchars(' '.$u->get('nom'));
    echo htmlspecialchars(' '.$u->get('prenom').' ');
    echo ('<a href="?controller=Clients&action=delete&login='.$u->get('login').'"     >Supprimer</a>');
    echo '<br>';
    echo ('<a href="?controller=Clients&action=update&login='.$u->get('login').'"     >Modifier</a>');
    echo '<br>';

?>