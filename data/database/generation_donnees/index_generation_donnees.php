<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Ludothèque</title>
    </head>
    <body>
        <?php
        // stefan : fichiers et méthodes de génération de données en masse
        include '../../../job/dao/Connexion_DataBase.php';
        include '../../../_old/saveTexte.php';
        // individu
        include '31_32_individu.php';
        include '33_genre_jeu_individu.php';
// jeu_t
        include '41_42_generation_donnees_jeu_t.php';
        include '43_genre_jeu.php';
        include '44_jeu_a_pour_image.php';

        include '51_commentaires_jeu_t.php';

// jeu_p

        include '61_jeu_p.php';


        // message
        include '71_message.php';

// pret
        include '81_prets.php';




        include '../renommage_recadrage_images.php';

        //renommerReduireDeplacerFichier($repertoireTemp, $repertoireVignettes, $dimensionsImageReduite)
        // stefan : on créé les données en partant des tables dont les autres tables dépendantes
        $aujourdhui = "2017-04-20";



        $nombreIndividus = 1000; //1000
        $nombreMessages = 3000; //3000
        $nombreJeuxP = 5000; //5000
        $nombreJeuxT = 200; //200
        $nombreGenreIndividu = 3000; //3000
        $nombreGenreJeu = 500; //500

        $dimensionsImageReduite = [640, 640];
        $repertoireTemp = "../../images/temp/";
        $repertoireVignettes = "../../images/vignettes/";


        $nombreCommentaires_pc = 800;

        //
        generer_donnees_individu($nombreIndividus);
        //generer_donnees_genre_individu($nombreGenreIndividu,$nombreIndividus);
        //generer_donnees_jeu_t($nombreJeuxT);
        //generer_donnees_genre_jeu($nombreJeuxT);
        //generation_donnees_jeu_t_aPourImage($nombreJeuxT, $repertoireVignettes);
        //generer_commentaires_pc($nombreCommentaires_pc, $nombreJeuxT, $nombreIndividus);
        //generer_donnees_jeu_p($nombreJeuxP, $nombreJeuxT, $nombreIndividus);
        //generer_donnees_message($nombreMessages, $nombreIndividus, $aujourdhui);



        //generer_prets($nombreIndividus, $nombreJeuxP, $aujourdhui, $nombreMessages);


        ?>
    </body>
</html>

