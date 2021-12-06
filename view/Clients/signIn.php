<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="signedIn">
    <input type='hidden' name='controller' value='clients'>
    <fieldset>
        <legend>Connexion :</legend>
        <p>
            <label for="login_id">Email</label> :
            <input type="email" placeholder="xxxx.xxxx@xxx.xx" name="emailClient" id="login_id" required/>

            <label for="login_id">Mot De Passe</label> :
            <input type="password" placeholder="password" name="mdpClient" id="mdpClient_id" required/>

            <input type="submit" value="Envoyer" />

        </p>
    </fieldset>
</form>
