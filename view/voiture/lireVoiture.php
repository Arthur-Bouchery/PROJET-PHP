
        <?php
            // On inclut les fichiers de classe PHP avec require_once
            // pour éviter qu'ils soient inclus plusieurs fois
            require_once 'Voiture.php';

            //On récupère toutes les voitures dans un tableau
            //$tab_voit = Voiture::getAllVoitures();


            //foreach ($tab_voit as $value) {
                // code...
            //    echo $value->afficher();
            //}
            $v = new Voiture('0EZAGAIN','tesla','blanche');
            $v->save();
        ?>