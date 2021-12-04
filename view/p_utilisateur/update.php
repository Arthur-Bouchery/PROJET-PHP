
<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
    <input type='hidden' name='controller' value='utilisateur'>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <?php
            echo('<label for="login_id">Login</label> :
                <input type="text" value="'.htmlspecialchars($u->get('login')).'" name="login" id="login_id" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
            echo '</p>
            <p>';
            echo ('<label for="prenom_id">Prenom</label> :
                <input type="text" value="'.htmlspecialchars($u->get('prenom')).'" name="prenom" id="prenom_id" required/>');
            echo '</p>
            <p>';
            echo ('<label for="nom_id">Nom</label> :
                <input type="text" value="'.htmlspecialchars($u->get('nom')).'" name="nom" id="nom_id" required/>');
            echo '</p>
            <p>';
            ?>
            <input type="submit" value="Envoyer" />
            
        </p>
    </fieldset> 
</form>
