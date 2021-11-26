<body>
    <form method="GET" action="./index.php">
        <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
        <input type='hidden' name='controller' value='voiture'>
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <?php
                echo('<label for="immat_id">Immatriculation</label> :
                    <input type="text" value="'.htmlspecialchars($v->get('immatriculation')).'" name="immatriculation" id="immat_id" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
                echo '</p>
                <p>';
                echo ('<label for="m_id">Marque</label> :
                    <input type="text" value="'.htmlspecialchars($v->get('marque')).'" name="marque" id="m_id" required/>');
                echo '</p>
                <p>';
                echo ('<label for="c_id">Couleur</label> :
                    <input type="text" value="'.htmlspecialchars($v->get('couleur')).'" name="couleur" id="c_id" required/>');
                echo '</p>
                <p>';
                ?>
                <input type="submit" value="Envoyer" />
                
            </p>
        </fieldset> 
    </form>
</body>