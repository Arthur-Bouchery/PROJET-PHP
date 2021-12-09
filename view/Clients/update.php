<form method="POST"
      action=<?php echo "index.php?controller=" . self::$object . "&action=" . $action . '>' ?>
    <legend><?php echo($_GET["action"] == "create" ? "Créer un client" : "Modifier un client"); ?></legend>
    <?php if ($_GET["action"] == "update") { ?>
        <p>
            <label for="login_id">Identifiant</label> :
            <input type="text" <?php if (isset($u)) {
                echo 'value="' . htmlspecialchars($u->get('codeClient'));
            } else if (isset($_POST['codeClient'])) {
                echo 'value="' . htmlspecialchars($_POST['codeClient']);
            }else {
                echo 'placeholder="numero client"';
            } ?>" name="codeClient"
            id="login_id" <?php echo $_GET["action"] != "create" ? "readonly" : "required"; ?> />
        </p>
    <?php } ?>
    <p>
        <label for="prenom_id">Prénom</label> :
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
        <label for="nom_id">Adresse mail</label> :
        <input type="text" <?php if (isset($u)) {
            echo 'value="' . htmlspecialchars($u->get('mailClient'));
        } else if (isset($_POST['mailClient'])) {
            echo 'value="' . htmlspecialchars($_POST['mailClient']);
        }else {
            echo 'placeholder="email@client"';
        } ?>" name="mailClient" id="mail_id" required/>
    </p>
    <p>
        <label for="nom_id">Numéro de téléphone</label> :
        <input type="text" <?php if (isset($u)) {
            echo 'value="' . htmlspecialchars($u->get('telClient'));
        } else if (isset($_POST['telClient'])) {
            echo 'value="' . htmlspecialchars($_POST['telClient']);
        }else {
            echo 'placeholder="téléphone client"';
        } ?>" name="telClient" id="nom_id" required/>
    </p>
    <p>
        <label for="nom_id">Mot de passe</label> :
        <input type="password" name="mdpClient"
               id="nom_id" <?php echo $_GET["action"] == "create" ? "required" : ""; ?>/>
    </p>
    <p>
        <label for="nom_id">Confirmation du mot de passe</label> :
        <input type="password" name="confirm_mdpClient"
               id="nom_id" <?php echo $_GET["action"] == "create" ? "required" : ""; ?>/>
    </p>
    <p>
        <label for="admin_id">Donner un rôle administrateur</label>
        <input type="checkbox" name="admin"
               value="1" <?php if (isset($u) && $u->get('admin') !== 0) echo "checked"; ?>>
    </p>
    <input type="submit" value="Envoyer"/>
    <?php
    echo '<p style="color:red">' . $message . '</p>';
    ?>
</form>
