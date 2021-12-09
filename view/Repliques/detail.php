<?php
$idReplique = htmlspecialchars($r->get('idReplique'));
$nomReplique = htmlspecialchars($r->get('nomReplique'));
$nomCategorie = htmlspecialchars($r->get('nomCategorie'));
$stockReplique = htmlspecialchars($r->get('stockRepliques'));
$rawUrlReplique = rawurlencode($r->get('idReplique'));
if(isset($_SESSION['admin']) && $_SESSION['admin']==1) {
    echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '"     >Supprimer</a>');
    echo '<br>';
    echo('<a href="?controller=repliques&action=update&idReplique=' . $rawUrlReplique . '"     >Modifier</a>');
    echo '<br>';
}
echo('<a href="?controller=panier&action=set&idReplique=' . $rawUrlReplique . '&qte=1"     >Ajouter au panier</a>');