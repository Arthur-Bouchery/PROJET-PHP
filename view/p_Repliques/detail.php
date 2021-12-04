<?php
    echo htmlspecialchars($v->get('idReplique'));
    echo htmlspecialchars(' '.$v->get('nomReplique'));
    echo htmlspecialchars(' '.$v->get('nomCategorie'));
    echo htmlspecialchars(' '.$v->get('stockRepliques').' ');
    echo ('<a href="?controller=replique&action=delete&idReplique='.$v->get('idReplique').'"     >Supprimer</a>');
    echo '<br>';
    echo ('<a href="?controller=replique&action=update&idReplique='.$v->get('idReplique').'"     >Modifier</a>');
    echo '<br>';
    echo ('<a href="?controller=panier&action=set&idReplique='.$v->get('idReplique').'&qte=1"     >Ajouter</a>');
    
?>