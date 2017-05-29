<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta charset="UTF-8" />
    <link rel="stylesheet" href="/ihm/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ihm/css/MUSA_carousel-extended.css">
    <link rel="stylesheet" href="/ihm/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="/ihm/css/styles.css">
    
<title>Ludotheque BTS</title>

<style> 
    #listejeu{
        height: 90%;
        overflow:auto;
        margin: 10%;
    }

h1{
    text-align: center;
}

table {
 border-collapse:collapse;
 width:100%;
 }
th, td {
 border:1px solid black;
 width:20%;
 }
td {
 text-align:center;
 }
caption {
 font-weight:bold
 }
</style>


</head>


<body>

<?php
include ('ihm/header/header.php');

//require_once('ihm/menus/menuAdmin.php');//
include ('ihm/footer/footer.php');
include ('job/class/Jeu_T.php'); //j'inclu la classe au début car j'en 

echo '<br><br><br><br>';
include ('job/dao/Jeu_T_Dao.php');
select('');

include ('job/dao/dao_generique_join.php');
echo selectJoin('produit_culturel_t','jeu_t','jeu_a_pour_genre','idPC');


/* charlotte : empty ne fonctionne pas car il vérifie si $_GET['page']=null, hors $_GET['page'] n'existe pas
 * in_array ne fonctionne pas non plus, pour une raison indéterminée
 * isset (is set) vérifie non =null mais vérifie si la variable existe ou pas avec une valeur
 */

/*

if (!(isset($_GET['page']))){
    include('ihm/pages/accueil.php');
}
else {
    include'ihm/pages/'.$_GET['page'].'.php';
}
?>


    <script src="../ihm/js/boostrap.js"></script>
    <script src="../ihm/js/jquery-3.1.1.min.js"></script>
     <script src="ihm/js/jquery.min.js"></script>
    <script src="ihm/js/bootstrap.min.js"></script>
    <script src="ihm/js/MUSA_carousel-extended.js"></script>
*/
include ('ihm/recherche/jeu_t.php')
?>

 <div id=listejeu>
        <?php
    // On recupere la calss Jeu_T pour instancier de nouveaux jeux que l'on va rajouter à une liste de jeux


    $jeuT1 = new Jeu_T(2,6,"Contrast","Pink Monkey Games","Chaque joueur ne dispose que de 8 des 12 symboles pour faire son choix. Les 4 autres sont placés devant lui, visibles de tous.","facile","8+","20 cartes","15 minutes",2016,"cool",1);
    $jeuT2 = new Jeu_T(2,8,"Giraformetre","Lifestyle Boardgames Ltd","Chaque carte du jeu décrit une information étonnante et drôle correspondante à un chiffre. Essayez de trouver celle dont la réponse chiffrée est la plus haute ou la plus basse parmi les cartes piochées...","moyen", "10 à 100 ans","10 cartes, 3 pions","30 minutes",2015,"facile",1);
    $jeuT3 = new Jeu_T(2,6,"POM POM","Jeux Opla","Compter les pommes","facile", "6 à 100 ans", "plateau de fruits", "15 minutes",2016,"huuu",1);
    
    $listGames=[$jeuT1,$jeuT2,$jeuT3];

    include ('ihm/resultat/_old/resultsGames.php');
    $afficheListeJeuT = screenGame($listGames);
    //echo $afficheListeJeuT;
    
    $jeuTOne = array('nbJoueursMin'=>2,
                    'nbJoueursMax'=>2,
                    'nom'=>"Popote",
                    'editeur'=>"moonful",
                    'regles'=>"Chaque carte du jeu décrit une information étonnante et drôle correspondante à un chiffre. Essayez de trouver celle dont la réponse chiffrée est la plus haute ou la plus basse parmi les cartes piochées...",
                    'difficulte'=>"Moyen",
                    'public'=>"Pour tous",
                    'listePieces'=>"10 cartes, 3 pions",
                    'dureePartie'=>"30 minutes",
                    'anneeSortie'=>2015,
                    'description'=>"Un jeu bien sympa en famille",
                    'typePC'=>"Jeux de société",
                    'idPC'=>4);
    $jeuTTwo = array(2,2,"Giraformetre","Lifestyle Boardgames Ltd","Chaque carte du jeu décrit une information étonnante et drôle correspondante à un chiffre. Essayez de trouver celle dont la réponse chiffrée est la plus haute ou la plus basse parmi les cartes piochées...","moyen", "10 à 100 ans","10 cartes, 3 pions","30 minutes",2015,"facile",1);
    $jeuTThree = array(2,6,"POM POM","Jeux Opla","Compter les pommes","facile", "6 à 100 ans", "plateau de fruits", "15 minutes",2016,"huuu",1);
    
    echo screenGame(select("SELECT * FROM ".TABLEJEUT." jt JOIN ".TABLEPCT." pct ON pct.idPC=jt.idPC;"));
    //insert($jeuTOne);
    //update($jeuTOne);
    //delete(5);
    ?>
</div>
    </body>


</html>
