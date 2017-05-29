

<!-- Paragraphe d'accueil -->
<p class="paragraphe_accueil" >
    <?php if (empty($_SESSION)): ?>
        <a href="index.php?page=creation/individu.php">
            Bienvenue dans la Ludothèque du BTS,<br/>
            première plate-forme d'échange de jeux !<br/>
            Partagez vos jeux et jouez avec les autres,<br/>
            Rejoignez-nous !
        </a>
    <?php else: ?>
        Bienvenue dans votre Ludothèque, <?= $_SESSION["monProfil"]->getPseudo() ?> !
    <?php endif; ?>
</p>

<!-- Caroussel -->
<?php
$repertoireCarrousel = "data/images/";
$carrousel = [
    ["carte.jpg", "Jeu de carte"],
    ["jeu.jpg", "Jamaïca"],
    ["roll.jpg", "text1"],
    ["jeu1.jpg", "text1"],
    ["monopoly.jpg", "Monopoly"],
    ["pc.jpg", "text1"],
    ["poker.jpg", "text1"],
    ["uno.jpg", "Uno"]
];
?>
<div id="slide" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?php for ($indexCarrousel = 0; $indexCarrousel < count($carrousel) - 1; $indexCarrousel++) : ?>
            <?php if ($indexCarrousel == 0) : ?>
                <div class="item active">
                <?php else : ?>
                    <div class="item">
                    <?php endif; ?>
                    <img class="center-block" src="<?= $repertoireCarrousel . $carrousel[$indexCarrousel][0] ?>" alt="jeu">
                    <div class="carousel-caption texte_carrousel">
                        <?= $carrousel[$indexCarrousel][1]; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>



    <br/><br/><br/>

    <!-- 3 widgets -->
    <div class="widget">
        <!--AhMaD: premier widget-->
        <div class="collection-accueil">
            <a href="#" class="collection-accueil-item">
                <h2 class="collection-accueil-title">Jeux Cartes</h2>
                <div class="collection-accueil-item-image" style="background-image: url(data/images/poker.jpg ) ">
                </div>
                <div class="collection-accueil-item-content">
                    <div class="collection-accueil-item-content-limiter">
                        <div class="collection-accueil-item-title">Poker</div>
                        <div class="collection-accueil-item-type">Jeux de cartes</div>

                        <div class="collection-accueil-item-text">Le poker est une famille de jeux de cartes
                            comprenant de nombreuses formules et variantes. Il se pratique à plusieurs joueurs avec un jeu
                            généralement de cinquante-deux cartes et des jetons représentant les sommes misées.</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- AhMaD:deuxième widget-->
        <div class="collection-accueil">
            <a href="#" class="collection-accueil-item">
                <h2 class="collection-accueil-title">Jeux de plateau</h2>
                <div class="collection-accueil-item-image" style="background-image: url(data/images/video.jpg ) ">
                </div>
                <div class="collection-accueil-item-content">
                    <div class="collection-accueil-item-content-limiter">
                        <div class="collection-accueil-item-title">Super Mario</div>
                        <div class="collection-accueil-item-type">Mario en vrai !</div>

                        <div class="collection-accueil-item-text">Mario sort en jeu de plateau pour le plus grand bonheur de ses (très) nombreux fans.</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- AhMaD:troisième widget-->
        <div class="collection-accueil">
            <a href="#" class="collection-accueil-item">
                <h2 class="collection-accueil-title">jeux sportif</h2>
                <div class="collection-accueil-item-image" style="background-image: url(data/images/Boules.jpg ) ">
                </div>
                <div class="collection-accueil-item-content">
                    <div class="collection-accueil-item-content-limiter">
                        <div class="collection-accueil-item-title">Boule bretonne</div>
                        <div class="collection-accueil-item-type">jeux sportif social</div>

                        <div class="collection-accueil-item-text">La boule bretonne est un sport populaire en Bretagne qui s'apparente plus
                            à la boule lyonnaise qu'à la pétanque. La principale caractéristique de la boule bretonne est la grande variété dans sa pratique.
                            Bien qu’ayant la même base.</div>
                    </div>
                </div>
            </a>
        </div>
    </div>




