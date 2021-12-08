<?php
echo htmlspecialchars($r->get('idReplique'));
echo htmlspecialchars(' ' . $r->get('nomReplique'));
echo htmlspecialchars(' ' . $r->get('nomCategorie'));
echo htmlspecialchars(' ' . $r->get('stockRepliques') . ' ');
$rawUrlReplique = rawurlencode($r->get('idReplique'));
echo '<br>';

    echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '"     >Supprimer</a>');
    echo '<br>';
    echo('<a href="?controller=repliques&action=update&idReplique=' . $rawUrlReplique . '"     >Modifier</a>');
    echo '<br>';

echo('<a href="?controller=panier&action=set&idReplique=' . $rawUrlReplique . '&qte=1"     >Ajouter au panier</a>');