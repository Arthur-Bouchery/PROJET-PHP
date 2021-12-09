<?php
echo 'Id de la commande : ' . htmlspecialchars($c->get('codeCommande'));
echo '<br>';
echo 'Date de la commande : ' . htmlspecialchars(' '.$c->get('dateCommande'));
echo '<br>';
echo 'Code client : ' . htmlspecialchars(' '.$c->get('codeClient').' ');
echo '<br>';
echo '<br>';
echo 'contenu de la commande : ';
echo '<br>';
echo '<br>';
foreach ($c->get('idReplique_qte') as $item) {
    foreach ($item as $key => $value){

        if ($key == 'qte') { echo 'Quantité : ';}else{echo 'Id Replique : ';}
        echo htmlspecialchars(' ' . $value . ' ');
        echo '<br>';
    }
}
echo ('<a href="?controller=commandes&action=delete&codeCommande='.$c->get('codeCommande').'"     >Annuler la commande</a>');
echo '<br>';
?>