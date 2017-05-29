<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Ludothèque</title>
        <?php
        // stefan : Cette ligne permet d'activer et d'entretenir la session ($_SESSION) avec ses variables
        // stefan : on est obligé de déclarer les classes avant de pouvoir les utiliser
        // stefan : on ne peut pas faire une lecture de répertoire car les class doivent être déclarées dans un ordre précis
        include 'job/class/Compte.php';
        include 'job/class/Individu.php';
        include 'job/class/ProduitCulturel.php';
        include 'job/class/Jeu_T.php';
        include 'job/class/Jeu_P.php';
        include 'job/class/Message.php';
        include 'job/class/Expedition.php';
        include 'job/class/Pret.php';

        include 'job/dao/fonctions_dao.php';
        include 'ihm/css/css.php';
        include 'job/dao/Connexion_DataBase.php';

        session_start();
        ?>  




        <!-- ************************************************************************************************ -->
        <!-- ************************************** CONTROLEUR (DEBUT) ************************************** -->
        <!-- ************************************************************************************************ -->

        <?php
        /* stefan : On récupère par $_REQUEST['page'],
         * - ou bien une page à afficher directement
         * - ou bien un appel au contrôleur si la chaine contient "+"
         * par ex : Individu+selectOne
         * On récupère par $_REQUEST["connexion"]
         * les demandes de connexions (avec pseudo et mdp)
         * et de déconnexion
         * $_REQUEST est une variable globale
         * qui inclue $_POST et $_GET
         */
        if (!empty($_REQUEST['connexion'])) {
            include 'controller/controllerConnexion.php';
        } else if (!empty($_REQUEST['objectToWorkWith'])) {
            include 'controller/controllerRequete.php';
        } else if (!empty($_REQUEST['user']) && empty($_REQUEST['idPret'])) {
            include 'controller/controllerUser.php';
        } else if (!empty($_REQUEST['formulaire'])) {
            include 'controller/controllerFormulaire.php';
        } else if (!empty($_REQUEST['pret'])) {
            include 'controller/controllerPret.php';
        } else if (!empty($_REQUEST['page'])) {
            $pageAAfficher = 'ihm/' . $_REQUEST['page'];
        }
// si jamais il n'y a rien à afficher, on affiche la page d'accueil
        if (empty($pageAAfficher)) {
            $pageAAfficher = 'ihm/pages/accueil.php';
        }
        //unset($_REQUEST); enlevé pour pouvoir récupérer la variable dans le REQUEST lors de la recherche d'un exemplaire de jeu
        ?>

        <!-- ************************************************************************************************ -->
        <!-- *************************************** CONTROLEUR (FIN) *************************************** -->
        <!-- ************************************************************************************************ -->      

    </head>


    <body>
        <!-- ************************************************************************************************ -->
        <!-- **************************************** HEADER (DEBUT) **************************************** -->
        <!-- ************************************************************************************************ -->

        <div id='div_header'><?php
            include ('ihm/header/header.php');
            ?></div>

        <!-- ************************************************************************************************ -->
        <!-- ***************************************** HEADER (FIN) ***************************************** -->
        <!-- ************************************************************************************************ -->




        <!-- ************************************************************************************************ -->
        <!--  ********************* MENU A GAUCHE (AFFICHE QU'EN MODE CONNECTE) (DEBUT) ********************* -->
        <!-- ************************************************************************************************ -->

        <!-- stefan : S'il y a une session d'ouverte, on affiche le menu -->
        <?php if (!empty($_SESSION)): ?>
            <div id='div_menu'><?php
                include ('ihm/menu/menu.php');
                ?></div>
        <?php endif; ?>

        <!-- ************************************************************************************************ -->
        <!--  ********************** MENU A GAUCHE (AFFICHE QU'EN MODE CONNECTE) (FIN) ********************** -->
        <!-- ************************************************************************************************ -->





        <!-- ************************************************************************************************ -->
        <!-- ************************************ CONTENU CENTRAL (DEBUT) *********************************** -->
        <!-- ************************************************************************************************ -->


        <div class="container" id="wrap">
            <div class="row">
                <!--                <div class="col-md-6 col-md-offset-3">-->
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
                    <?php include $pageAAfficher; ?>
                </div>
            </div>
        </div>

        <!-- ************************************************************************************************ -->
        <!-- ************************************* CONTENU CENTRAL (FIN) ************************************ -->
        <!-- ************************************************************************************************ -->





        <!-- ************************************************************************************************ -->
        <!-- **************************************** FOOTER (DEBUT) **************************************** -->
        <!-- ************************************************************************************************ -->

        <div id='div_footer'><?php
            include 'ihm/footer/footer.php';
            ?></div>

        <!-- ************************************************************************************************ -->
        <!-- ***************************************** FOOTER (FIN) ***************************************** -->
        <!-- ************************************************************************************************ -->






        <?php
        include 'ihm/js/js.php';
        ?>

    </body>
</html>

