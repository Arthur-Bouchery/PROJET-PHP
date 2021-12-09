<?php
$idReplique = htmlspecialchars($r->get('idReplique'));
$nomReplique = htmlspecialchars($r->get('nomReplique'));
$nomCategorie = htmlspecialchars($r->get('nomCategorie'));
$stockReplique = htmlspecialchars($r->get('stockRepliques'));
$rawUrlReplique = rawurlencode($r->get('idReplique'));

echo "<p>$nomReplique de catégorie $nomCategorie ($stockReplique en stock) ";
echo('<a href="?controller=panier&action=set&idReplique=' . $rawUrlReplique . '&qte=1">Ajouter au panier </a>');

if (isset($_SESSION['codeClient']) && $_SESSION['admin']) {
    echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '">Supprimer </a>');
    echo('<a href="?controller=repliques&action=update&idReplique=' . $rawUrlReplique . '">Modifier </a>');
}

echo "</p>";