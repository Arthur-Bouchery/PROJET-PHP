<?php
    echo ('Login:'.htmlspecialchars($u->get('login')).'<br>');
    echo ('Nom: '.htmlspecialchars(' '.$u->get('nom')).'<br>');
    echo ('prenom: '.htmlspecialchars(' '.$u->get('prenom')).'<br>');
    echo ('<a href="?action=delete&&controller=utilisateur&&login='.$u->get('login').'"">supprimer</a>'.'<br>');
    echo ('<a href="?action=update&&controller=utilisateur&&login='.$u->get('login').'"">Mettre a jour</a>'.'<br>');
    echo '<br>';
?>