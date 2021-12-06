<?php
foreach ($tab_panier as $k => $v) {
    ?>
    <p> Replique d'ID <?php echo htmlspecialchars($k); ?> de quantité <?php echo htmlspecialchars($v); ?> </p>
    <a href="?controller=replique&action=read&idReplique=<?php echo $k ?>">Detail</a>
    <a href="?controller=panier&action=set&idReplique=<?php echo $k; ?>&qte=0">Supprimer</a>
    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="set" />
        <input type="hidden" name="controller" value="panier" />
        <input type="hidden" name="idReplique" value="<?php echo $k; ?>" />
        <input type="number" name="qte" value="<?php echo $v; ?>" />
        <input type="submit" value="Mettre à jour" />
    </form>
    <hr>
    <?php
}
?>
