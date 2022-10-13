<?php $title = "Page de connexion" ?>
<?php ob_start() ?>
<li class="nav-item">
    <a class="nav-link" href="index.php?action=Apropos">À propos</a>
</li>
<?php if ($_SESSION['lvl'] == 1) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=admin">Interface Administrateur</a>
    </li>
<?php } ?>
<?php if (!isset($_SESSION['user'])) { ?>

    <li class="nav-item">
        <a class="nav-link" href="index.php?action=registerPage">S'inscrire</a>
    </li>
<?php }
if (isset($_SESSION['user'])) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
    </li>
<?php } ?>
<?php $menu = ob_get_clean(); ?>
<?php ob_start() ?>
<div class="container" id="accountPage">
    <h1 class="text-center my-4">Bonjour <?= $_SESSION['user'] ?></h1>
    <div id="account">
        <form method="POST" action="index.php?action=accountUpdate" enctype="multipart/form-data">
            <div class="row col-12">
                <div class="form-group col-md-6 col-sm-12">
                    <h3>Photo de profil</h3>
                    <img src="<?= $_SESSION['img']?>">
                    <input type="file" name="image" class="form-control my-12 imgComs" value="<?= $_SESSION['img']  ?>">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <h3 for="pseudo">Pseudo</h3>
                    <input type="text" name="pseudo" class="form-control" value="<?= $_SESSION['user'] ?>">
                    <button class="btn btn-secondary" id="updateBtn" type="submit">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean() ?>
<?php ob_start() ?>
<ul class="list-inline ">
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
</ul>
<?php $footer = ob_get_clean(); ?>
<?php require('template.php'); ?>