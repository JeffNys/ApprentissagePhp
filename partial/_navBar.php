<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Jeff Nys</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Accueil
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/test.php">test</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/exercices.php">Exo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/notes.php">notes</a>
                </li>
                <?php if ($_SESSION["user"]) :
                    if (in_array("ROLE_ADMIN", $_SESSION["user"]["role"])) : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin.php">page admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-secondary text-dark" href="/deconnexion.php">déconnexion</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/inscription.php">inscription</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-success" href="/connexion.php">connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>