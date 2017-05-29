<nav class="navbar navbar-inverse navigation-clean-button"  >
    <div class="container-fluid" >
        <div class="navbar-header"  >
            <a class="navbar-brand navbar-link" href="index.php">Ludothèque </a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav" >
                <li role="presentation"><a href="index.php?page=recherche/jeu_t.php">Rechercher un jeu</a></li>
                <li role="presentation"><a href="index.php?page=recherche/jeu_p.php">Rechercher un exemplaire de jeu</a></li>
                <?php if (!empty($_SESSION)): ?>
                    <li role="presentation"><a href="index.php?page=recherche/individu.php">Rechercher un utilisateur</a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  href="index.php?page=pages/informations.php">
                        Informations Pratiques
                        <span class="caret">
                        </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="index.php?page=pages/informations.php#about">A Propos</a></li>
                        <li role="presentation"><a href="index.php?page=pages/informations.php#mentions">Mentions légales</a></li>
                        <li role="presentation"><a href="index.php?page=pages/informations.php#aide">Aide </a></li>
                        <li role="presentation"><a href="index.php?page=pages/informations.php#contact">Contact </a></li>
                    </ul>
                </li>
            </ul>
            <p class="navbar-text navbar-right actions">
                <!-- stefan : S'il n'y a pas de session ouverte, affichage inscription et connexion -->
                <?php if (empty($_SESSION)): ?>
                    <a class="navbar-link login" href="index.php?page=creation/individu.php">S'inscrire</a>
                    <a class="boutonBleu" role="button" href="index.php?page=connexion/connexion.php">Se connecter</a>
                     <!-- stefan : sinon affichage déconnexion -->
                <?php else: ?>
                    <a class="boutonBleu" role="button" href="index.php?connexion=off">Se déconnecter</a>
                <?php endif; ?>
            </p>

        </div>
    </div>
</nav>




