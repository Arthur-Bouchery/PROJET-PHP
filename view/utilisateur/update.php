
    <body>
        <form method="GET" action="./index.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <?php
                echo('<label for="immat_id">Immatriculation</label> :
                    <input type="text" value="'.$immatriculation.'" name="immatriculation" id="immat_id"'.$val.' required/>');
                echo '</p>
                <p>';
                echo ('<label for="m_id">Marque</label> :
                    <input type="text" value="'.$marque.'" name="marque" id="m_id" required/>');
                echo '</p>
                <p>';
                echo ('<label for="c_id">Couleur</label> :
                    <input type="text" value="'.$couleur.'" name="couleur" id="c_id" required/>');
                echo '</p>
                <p>';
                 ?>
                <input type="submit" value="Envoyer" />
                <input type='hidden' name='action' value=<?php echo "'".$action."'"?>>
            </p>
        </fieldset>
</form>


    </body>
