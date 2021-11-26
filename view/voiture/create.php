
    <body>
        <form method="GET" action="./index.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="immat_id">Immatriculation</label> :
                <input type="text" placeholder="256AB34" name="immatriculation" id="immat_id" required/>
            </p>
            <p>
                <label for="m_id">Marque</label> :
                <input type="text" placeholder="renault" name="marque" id="m_id" required/>
            </p>
            <p>
                <label for="c_id">Couleur</label> :
                <input type="text" placeholder="noir" name="couleur" id="c_id" required/>
            </p>
            <p>
                <input type="submit" value="Envoyer" />
                <input type='hidden' name='action' value='created'>
            </p>
        </fieldset> 
</form>


    </body>
