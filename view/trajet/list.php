<body>
        <?php
        foreach ($tab_u as $u)
        echo '<p> id : ' . htmlspecialchars($u->getId()) . " <a href=?controller=trajet&action=read&id=".$u->getId().">Details</a> </p>";
        ?>
    </body>