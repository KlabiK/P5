<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/carousel.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/images/website/Logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/6880787951.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                <div class="container-fluid">
                    <a class="navbar-brand align-items-center" href="index.php"><img src="/public/images/website/Logo.png" alt="logo de la societe" id="logo"> La K-verne du Jeu </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarToggler">
                        <ul class="navbar-nav  mr-4 mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class=" nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="index.php?action=categorieGames&categorie=solo">Jeux solo</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?action=categorieGames&categorie=famille">Jeux familiaux</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?action=categorieGames&categorie=initie">Jeux initiés</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?action=categorieGames&categorie=ambiance">Jeux d'Ambiance</a>
                                </div>
                            </li>
                            <?= $menu ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <?php if (!empty($_SESSION['message'])) {
            echo '<div class=" col-10 container-fluid align-items-center"> <div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div></div>';
            $_SESSION['message'] = "";
        }
        if (!empty($_SESSION['erreur'])) {
            echo '<div class=" col-10 container-fluid align-items-center"> <div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div></div>';
            $_SESSION['erreur'] = "";
        } ?>
        <?= $content ?>
    </main>
    <div class="jumbotron footer" id="jumbotron">
        <div class="container">
            <div class="row mt-3">
                <div class="col text-center " id="footerList">
                    <?= $footer ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>