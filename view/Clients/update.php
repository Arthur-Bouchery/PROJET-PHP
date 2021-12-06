
<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="<?php echo $_GET["action"] == "create" ? "created" : "updated";?>">
    <input type='hidden' name='controller' value='clients'>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <?php if($_GET["action"] == "update") { ?>
        <p>
        <label for="login_id">codeClient</label> :
            <input type="text" <?php if (isset($u)){echo 'value="'.htmlspecialchars($u->get('codeClient'));}else{echo 'placeholder="numero client"';} ?>" name="codeClient" id="login_id" <?php echo $_GET["action"] != "create" ? "readonly" : "required";?> />
        </p>
        <?php } ?>
        <p>
        <label for="prenom_id">Prenom</label> :
            <input type="text" <?php if (isset($u)){echo 'value="'.htmlspecialchars($u->get('prenomClient'));}else{echo 'placeholder="numero client"';} ?>" name="prenomClient" id="prenom_id" required/>
        </p>
        <p>
        <label for="nom_id">Nom</label> :
            <input type="text" <?php if (isset($u)){ echo 'value="'.htmlspecialchars($u->get('nomClient'));} ?>" name="nomClient" id="nom_id" required/>
        </p>
        <p>
            <label for="nom_id">eMail</label> :
            <input type="text" <?php if (isset($u)){ echo 'value="'.htmlspecialchars($u->get('mailClient'));} ?>" name="mailClient" id="mail_id" required/>
        </p>
        <p>
            <label for="nom_id">telephone</label> :
            <input type="text" <?php if (isset($u)){ echo 'value="'.htmlspecialchars($u->get('telClient'));} ?>" name="telClient" id="nom_id" required/>
        </p>
        <?php if($_GET["action"] == "create") { ?>
        <p>
            <label for="nom_id">mot de passe</label> :
            <input type="text" <?php if (isset($u)){ echo 'value="'.htmlspecialchars($u->get('mdpClient'));} ?>" name="mdpClient" id="nom_id" required/>
        </p>
        <p>
            <label for="nom_id">Confirmation mot de passe</label> :
            <input type="text" <?php if (isset($u)){ echo 'value="'.htmlspecialchars($u->get('mdpClient'));} ?>" name="confirm_mdpClient" id="nom_id" required/>
        </p>
        <?php } ?>

        <input type="submit" value="Envoyer" />
    </fieldset> 
</form>
