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
<div class="container" id="loginPage">
    <div>
        <div class="form-group text-center">
            <h1 class="my-4">Connexion</h1>
            <form method="POST" action="index.php?action=login">
                <div class="form-group">
                    <input type="text" name="login" placeholder="Identifiant" class="form-control" autocomplete="on">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mot de passe" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btnGlobal">Se connecter</button>
                </div>
            </form>

        </div>
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