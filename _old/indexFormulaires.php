<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//FR">
<html>
    <head>
        <title>Formulaires</title>
        <link rel="stylesheet" type="text/css" href="../ihm/css/Navigation-with-Button1.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/boutons.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/footer.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/menu.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/slideshowJeuT.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/styles.css">
        <link rel="stylesheet" type="text/css" href="../ihm/css/widget.css">


        <?php
        include '../job/class/Compte.php';
        include '../job/class/Individu.php';
        include '../job/class/ProduitCulturel.php';
        include '../job/class/Jeu_T.php';
        include '../job/class/Jeu_P.php';
        include '../job/class/Message.php';
        include '../job/class/Expedition.php';
        include '../job/class/Pret.php';

        include '../job/dao/fonctions_dao.php';
        include '../job/dao/Connexion_DataBase.php';
        
        include '../job/dao/Pret_Dao.php';
        
        $pret = select ("where idPret = 6295")[0];
        ?>


    </head>   
    <body>
        <div class="container" id="wrap">
            <div class="row">
                <!--                <div class="col-md-6 col-md-offset-3">-->
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
        ETAPE 1 : 1_demande_emprunt
        <br>
        <br>
        <!-- Premiere demande de la part de l'emprunteur  -->
<?php include ('../ihm/pret/1_demande_emprunt.php'); ?>
        <br>
        <br>

        ETAPE 2 : 2_reponse_emprunt
        <br>
        <br>
        <!-- Ici le prêteur verifie si les dates lui conviennent. il peut accepter/refuser/proposer
        de nouvelles dates -->
<?php include ('../ihm/pret/2_reponse_emprunt.php'); ?>
        <br>
        <br>

        ETAPE 3 : 3_proposition_nouvelles_dates
        <br>
        <br>
        <!-- Nouvelle proposition de la part du prêteur si les dates de l'emprunteur ne lui conviennent pas : 
        les propositions de dates s'arrêtes ici-->
<?php include ('../ihm/pret/3_proposition_nouvelles_dates.php'); ?>
        <br>
        <br>

        ETAPE 4 : 4_reponse_nouvelles_dates
        <br>
        <br>
        <!-- dernier echange: l'emprunteur accepte ou refuse les dates proposées par le prêteur -->
<?php include ('../ihm/pret/4_reponse_nouvelles_dates.php'); ?>
        <br>
        <br>

        ETAPE 5 : 5_preteur_envoie_jeu
        <br>
        <br>
        <!-- Form d'envoi du jeu coté prêteur: date d'envoi / commentaire a destination de l'emprunteur -->
<?php include ('../ihm/pret/5_preteur_envoie_jeu.php'); ?>
        <br>
        <br>

        ETAPE 6 : 6_emprunteur_recoit_jeu
        <br>
        <br>
        <!-- Form de retour du jeu côté prêteur: état du jeu rendu / date de reception / commentaire 
        a destination de l'emprunteur -->
<?php include ('../ihm/pret/6_emprunteur_recoit_jeu.php'); ?>
        <br>
        <br>

        ETAPE 7 : 7_emprunt_renvoie_jeu
        <br>
        <br>
        <!-- Form de renvoi du jeu côte emprunteur: interet sur le jeu / date de renvoi / commentaire sur le
        jeu / commentaire pour le prêteur -->
<?php include ('../ihm/pret/7_emprunt_renvoie_jeu.php'); ?>
        <br>
        <br>

        ETAPE 8 : 8_preteur_recoit_jeu
        <br>
        <br>
        <!-- Form de retour coté prêteur: avis etat du jeu / date de reception / commentaire -->
<?php include ('../ihm/pret/8_preteur_recoit_jeu.php'); ?>
        <br>
        <br>


                </div></div></div>



    </body>
</html>