<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
    <input type='hidden' name='controller' value='replique'>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <?php
            echo('<label for="id_id">idReplique</label> :
                <input type="text" value="'.htmlspecialchars($v->get('idreplique')).'" name="idReplique" id="id_id" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
            echo '</p>
            <p>';
            echo ('<label for="n_id">Marque</label> :
                <input type="text" value="'.htmlspecialchars($v->get('nomReplique')).'" name="nomReplique" id="n_id" required/>');
            echo '</p>
            <p>';
            echo ('<label for="nc_id">Couleur</label> :
                <input type="text" value="'.htmlspecialchars($v->get('nomCategorie')).'" name="nomCategorie" id="nc_id" required/>');
            echo '</p>
            <p>';
            ?>
            <input type="submit" value="Envoyer" />
            
        </p>
    </fieldset> 
</form>
