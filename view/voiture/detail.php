<?php
    echo ('Immatriculation:'.htmlspecialchars($v->get('immatriculation')).'<br>');
    echo ('Marque: '.htmlspecialchars(' '.$v->get('marque')).'<br>');
    echo ('couleurleur: '.htmlspecialchars(' '.$v->get('couleur')).'<br>');
    echo ('<a href="?action=delete&&immatriculation='.$v->get('immatriculation').'"">supprimer</a>'.'<br>');
    echo ('<a href="?action=update&&immatriculation='.$v->get('immatriculation').'"">Mettre a jour</a>'.'<br>');
    echo '<br>';
?>