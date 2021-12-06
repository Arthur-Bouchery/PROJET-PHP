<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
    <input type='hidden' name='controller' value='replique'>
    <fieldset>
        <legend>Mon formulaire :</legend>

            <?php if($v->get('idReplique') !== null) { ?>
                <label for="id_id">idReplique : </label>
                    <input type="text" value="<?php echo htmlspecialchars($v->get('idReplique')) ;?>" name="idReplique" id="id_id" readonly/>
            <p>
            <?php } ?>

                <label for="n_id">nom de la réplique :</label>
                    <input type="text" value="<?php echo htmlspecialchars($v->get('nomReplique')) ;?>" name="nomReplique" id="n_id" required/>
            </p>
            <p>
                <label for="nc_id">nom de la catégorie :</label>
                    <input type="text" value="<?php echo htmlspecialchars($v->get('nomCategorie')) ;?>" name="nomCategorie" id="nc_id" required/>
            </p>
            <p>
                <label for="id_stock">Stock de la réplique :</label>
                    <input type="text" value="<?php echo htmlspecialchars($v->get('stockRepliques')); ?>" name="stockRepliques" id="id_stock" required/>
            <p>
            <input type="submit" value="Envoyer" />
            
        <p>
    </fieldset> 
</form>

