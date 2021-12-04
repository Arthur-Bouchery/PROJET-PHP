
    <body>
        <form method="GET" action="./index.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="id_Replique">idReplique</label> :
                <input type="text" placeholder="256AB34" name="idReplique" id="id_Replique" required/>
            </p>
            <p>
                <label for="id_nomReplique">nom de la réplique</label> :
                <input type="text" placeholder="Arbalète cassée" name="nomReplique" id="id_nomReplique" required/>
            </p>
            <p>
                <label for="id_nomCat">nom de la Catégorie</label> :
                <input type="text" placeholder="pétée" name="nomCategorie" id="id_nomCat" required/>
            </p>
            <p>
                <label for="id_stock">stock de la réplique</label> :
                <input type="text" placeholder="0" name="stockRepliques" id="id_stock" required/>
            </p>
            <p>
                <input type="submit" value="Envoyer" />
                <input type='hidden' name='action' value='created'>
            </p>
        </fieldset> 
</form>


    </body>
