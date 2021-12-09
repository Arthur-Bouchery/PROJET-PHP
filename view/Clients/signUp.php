<form method="POST" action="./index.php?action=signedUp&controller=clients">
<!--    <input type='hidden' name='action' value="signedUp">-->
<!--    <input type='hidden' name='controller' value='clients'>-->
    <fieldset>
        <legend>Mon formulaire :</legend>
        <?php
        if ($wrongInformations == true)
            echo '<p style="color:red">'.$messageErreur.'</p>';
        ?>
        <p>
            <label for="prenom_id">Prenom</label> :
            <input type="text" <?php if (isset($u)) {
                echo 'value="' . htmlspecialchars($u->get('prenomClient'));
            } else if (isset($_POST['prenomClient'])) {
                echo 'value="' . htmlspecialchars($_POST['prenomClient']);
            }else {
                echo 'placeholder="prenom client"';
            } ?>" name="prenomClient" id="prenom_id" required/>
        </p>
        <p>
            <label for="nom_id">Nom</label> :
            <input type="text" <?php if (isset($u)) {
                echo 'value="' . htmlspecialchars($u->get('nomClient'));
            } else if (isset($_POST['nomClient'])) {
                echo 'value="' . htmlspecialchars($_POST['nomClient']);
            }else {
                echo 'placeholder="nom client"';
            } ?>" name="nomClient" id="nom_id" required/>
        </p>
        <p>
            <label for="nom_id">eMail</label> :
            <input type="email" <?php if (isset($u)) {
                echo 'value="' . htmlspecialchars($u->get('mailClient'));
            } else if (isset($_POST['mailClient'])) {
                echo 'value="' . htmlspecialchars($_POST['mailClient']);
            }else{
                echo 'placeholder="email@client"';
            } ?>" name="mailClient" id="mail_id" required/>
        </p>
        <p>
            <label for="nom_id">telephone</label> :
            <input type="text" <?php if (isset($u)) {
                echo 'value="' . htmlspecialchars($u->get('telClient'));
            } else if (isset($_POST['telClient'])) {
                echo 'value="' . htmlspecialchars($_POST['telClient']);
            }else {
                echo 'placeholder="téléphone client"';
            } ?>" name="telClient" id="nom_id" required/>
        </p>
        <p>
            <label for="nom_id">mot de passe</label> :
            <input type="password" name="mdpClient"
                   id="nom_id" <?php echo $_GET["action"] == "create" ? "required" : ""; ?>/>
        </p>
        <p>
            <label for="nom_id">Confirmation mot de passe</label> :
            <input type="password" name="confirm_mdpClient"
                   id="nom_id" <?php echo $_GET["action"] == "create" ? "required" : ""; ?>/>
        </p>
        <input type="submit" value="Envoyer"/>
    </fieldset>
</form>
