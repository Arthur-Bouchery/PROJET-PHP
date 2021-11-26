<?php
    echo htmlspecialchars($u->get('id'));
    echo htmlspecialchars(' '.$u->get('depart'));
    echo htmlspecialchars(' '.$u->get('arrivee'));
    echo htmlspecialchars(' '.$u->get('dateT'));
    echo htmlspecialchars(' '.$u->get('nbplaces'));
    echo htmlspecialchars(' '.$u->get('prix'));
    echo htmlspecialchars(' '.$u->get('conducteur_login').' ');
    echo ('<a href="?controller=trajet&action=delete&id='.$u->get('id').'"     >Supprimer</a>');
    echo '<br>';
    echo ('<a href="?controller=trajet&action=update&id='.$u->get('id').'"     >Modifier</a>');
    echo '<br>';
    
?>