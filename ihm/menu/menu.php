<?php $droitsUser = $_SESSION["monProfil"]->getDroit(); ?>
<section>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-3 col-sm-3 menu">
                <div class="left-navigation">
                    <ul class="list">
                        <?php if ($droitsUser == "Administrateur" ): ?>
                        <p class="titre_menu">Menu administrateur</p><hr/>
                            <a href='index.php?page=administrateur/config.php'><li>Configuration</li></a>
<!--                            <a href='index.php?page=pages/_old/_enCours.php'><li>Administrer les utilisateurs</li></a>-->
                        <?php endif; ?>
                        <?php if ($droitsUser == "Modérateur" || $droitsUser == "Administrateur"): ?>
                            <p class="titre_menu">Menu modérateur</p><hr/>
                            <a href='index.php?page=pages/_old/_enCours.php'><li>Valider un jeu</li></a>
                            <a href='index.php?page=pages/_old/_enCours.php'><li>Modifier un jeu</li></a>
                        <?php endif; ?>
                        <p class="titre_menu">Menu utilisateur</p><hr/>
                        <a href='index.php?user=monProfil'><li>Mon profil</li></a>
                        <a href='index.php?user=maLudotheque'><li>Ma ludothèque</li></a>
                        <a href='index.php?user=mesPrets'><li>Mes prêts</li></a>
                        <a href='index.php?user=mesEmprunts'><li>Mes emprunts</li></a>
                        <a href='index.php?user=mesMessagesEnvoyes'><li>Mes messages envoyés</li></a>
                        <a href='index.php?user=mesMessagesRecus'><li>Mes messages reçus</li></a>
                        <a href='index.php?page=creation/jeu_t.php'><li>Proposer un nouveau jeu</li></a>
<!--                        <a href='index.php?page=creation/message.php'><li>Envoyer un message</li></a>-->
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
