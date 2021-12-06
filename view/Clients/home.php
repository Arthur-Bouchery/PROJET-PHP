<?php
    if (isset($_SESSION['codeClient'])) {
        ?>
        <p>Vous êtes beau</p>
        <p><a href=?controller=Clients&action=signOut>J'veux plus me co</a> </p>
        <?php
    } else {
        ?>
        <p><a href=?controller=Clients&action=signIn>Se connecter</a> </p>

        <p><a href=?controller=Clients&action=create>s'inscrire</a> </p>
        <?php
    }
?>
