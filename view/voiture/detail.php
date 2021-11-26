<?php
    echo htmlspecialchars($v->get('immatriculation'));
    echo htmlspecialchars(' '.$v->get('marque'));
    echo htmlspecialchars(' '.$v->get('couleur').' ');
    echo ('<a href="?action=delete&&immatriculation='.$v->get('immatriculation').'"     >Supprimer</a>');
    echo '<br>';
    echo ('<a href="?action=update&&immatriculation='.$v->get('immatriculation').'"     >Modifier</a>');
    echo '<br>';
?>