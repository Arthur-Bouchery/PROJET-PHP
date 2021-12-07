<form method="POST" action="index.php?controller=" . self::$object . "&action=" . $_GET['action'] ."d") . '"><fieldset>
    <legend><?php echo($_GET["action"] == "create" ? "Créer une réplique" : "Modifier une réplique"); ?></legend>
    <?php
    if ($_GET['action'] !== 'create') { ?>
        <p>
            <label for="id_id">Identifiant</label> :
            <input type="text" value="<?php echo htmlspecialchars($r->get('idReplique')); ?>" name="idReplique"
                   id="id_id "' . ($_GET["action"] != "create" ? "readonly" : "required") . '/>
        </p>
    <?php }
    ?>

    <p>
        <label for="nom_id">Nom</label> :
        <input type="text" value="<?php echo htmlspecialchars($r->get('nomReplique')); ?>" name="nomReplique"
               id="nom_id" required/>
    </p>
    <p>
        <label for="categorie_id">Catégorie</label>
        <input type="text" value="<?php echo htmlspecialchars($r->get('nomCategorie')); ?>" name="nomCategorie"
               id="categorie_id" required/>
    </p>
    <p>
        <label for="stock_id">Quantité en stock</label>
        <input type="number" value="<?php echo htmlspecialchars($r->get('stockRepliques')) ?>" name="stockRepliques"
               id="stock_id" required/>
    </p>
    <p>
        <input type="submit"
               value="<?php echo($_GET["action"] == "create" ? "Créer la réplique" : "Mettre à jour"); ?>"/>
    </p>
</fieldset>
</form>



