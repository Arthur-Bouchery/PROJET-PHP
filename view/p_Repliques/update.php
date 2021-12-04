<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
    <input type='hidden' name='controller' value='replique'>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <?php
            echo('<label for="id_Replique">idReplique</label> :
                <input type="text" value="'.htmlspecialchars($v->get('idReplique')).'" name="idReplique" id="id_Replique" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
            echo '</p>
            <p>';
            echo ('<label for="id_nomReplique">nom de la réplique</label> :
                <input type="text" value="'.htmlspecialchars($v->get('nomReplique')).'" name="nomReplique" id="id_nomReplique" required/>');
            echo '</p>
            <p>';
            echo ('<label for="id_nomCat">nom de la catégorie</label> :
                <input type="text" value="'.htmlspecialchars($v->get('nomCategorie')).'" name="nomCategorie" id="id_nomCat" required/>');
            echo '</p>
            <p>';
            echo ('<label for="id_stock">quantité en stock</label> :
                <input type="text" value="'.htmlspecialchars($v->get('stockRepliques')).'" name="stockRepliques" id="id_stock" required/>');
            echo '</p>
            <p>';
            ?>
            <input type="submit" value="Envoyer" />
            
        </p>
    </fieldset> 
</form>
