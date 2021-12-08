<form method="POST" action=<?php echo "index.php?controller=" . self::$object . "&action=signedIn>"; ?>
<fieldset>
    <legend>Connexion :</legend>
    <p>
        <label for="login_id">Adresse mail</label> :
        <input type="text" name="mailClient" id="login_id" required/>
        <br>
        <label for="login_id">Mot de Passe</label> :
        <input type="password" name="mdpClient" id="mdpClient_id" required/>
        <br>
        <?php
        if ($wrongInformations == true)
            echo '<p style="color:red">L\'adresse mail ou le mot de passe entrés sont incorrects</p>';
        ?>
        <input type="submit" value="Envoyer"/>
    </p>
    </fieldset>
</form>
