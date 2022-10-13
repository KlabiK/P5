<?php $title = 'Page de Suppression'; ?>
<?php if ($_SESSION['lvl'] == 1) {
?>
    <?php ob_start(); ?>
    <?php if ($_SESSION['lvl'] == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=admin">Interface Administrateur</a>
        </li>
    <?php }
    if (isset($_SESSION['user'])) { ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
        </li>
    <?php } ?>
    <?php $menu = ob_get_clean(); ?>
    <?php ob_start(); ?>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Suppression du jeu : <?= $game['title'] ?></h1>
                <form method="POST" action="index.php?action=delete&id=<?= $_GET['id'] ?>">
                    <div class="imgList">
                        <img src="<?= $game['image'] ?>">
                    </div>
                    <p><?= $game['content'] ?></p>
                    <label><input type="checkbox" class="suppr" name="suppr" required>Êtes vous certain de vouloir supprimer ce jeu ?</label>
                    <button class="btn btn-danger my-4">Supprimer le Jeu</button>
                </form>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>
    <?php ob_start() ?>
    <ul class="list-inline ">
        <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
        <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
    </ul>
    <?php $footer = ob_get_clean(); ?>
    <?php require('template.php'); ?>
<?php } else {
    header('Location: index.php?action=home');
    $_SESSION['erreur'] = 'Vous n\'êtes pas autorisé à accéder à cette page.';
} ?>