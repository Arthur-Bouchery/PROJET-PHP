<body>
    <form method="GET" action="./index.php">
        <input type='hidden' name='action' value="<?php echo($_GET['action']."d"); ?>">
        <input type='hidden' name='controller' value='trajet'>
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <?php
                echo('<label for="id_id">Id</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('id')).'" name="id" id="id_id" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
                echo '</p>
                <p>';
                echo ('<label for="depart_id">départ</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('depart')).'" name="depart" id="depart_id" required/>');
                echo '</p>
                <p>';
                echo ('<label for="nom_id">arrivée</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('arrivee')).'" name="arrivee" id="arrivee_id" required/>');
                echo '</p>
                <p>';
                echo('<label for="date_id">date</label> :
                    <input type="date" value="'.htmlspecialchars($u->get('dateT')).'" name="dateT" id="date_id" required/>');
                echo '</p>
                <p>';
                echo('<label for="nbp_id">nombre de places</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('nbplaces')).'" name="nbplaces" id="nbp_id" required />');
                echo '</p>
                <p>';
                echo('<label for="prix_id">prix</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('prix')).'" name="prix" id="prix_id" required />');
                echo '</p>
                <p>';
                echo('<label for="cdl_id">Conducteur LOGIN</label> :
                    <input type="text" value="'.htmlspecialchars($u->get('conducteur_login')).'" name="conducteur_login" id="cdl_id" '.($_GET["action"] != "create" ? "readonly" : "required").'/>');
                echo '</p>
                <p>';
                ?>
                <input type="submit" value="Envoyer" />
                
            </p>
        </fieldset> 
    </form>
</body>