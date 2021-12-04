<form method="GET" action="./index.php">
    <input type='hidden' name='action' value="signedIn">
    <input type='hidden' name='controller' value='utilisateur'>
    <fieldset>
        <legend>Connexion :</legend>
        <p>
            <label for="login_id">Email</label> :
            <input type="email" placeholder="xxxx.xxxx@xxx.xx" name="login" id="login_id" required/>


            <input type="submit" value="Envoyer" />

        </p>
    </fieldset>
</form>
