<body>
    <?php
    foreach ($tab_u as $u)
            echo ('<p> Utilisateur de login: ' . htmlspecialchars($u->getlogin()) . ' <a href=?action=read&&controller=utilisateur&&login='.$u->getlogin().'>Details</a> </p>');
    ?>
</body>