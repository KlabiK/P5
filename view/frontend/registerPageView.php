<?php $title = "Page de création de compte"; ?>
<?php ob_start(); ?>
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
        <a class="nav-link" href="index.php?action=loginPage">Connexion</a>
    </li>
<?php }
if (isset($_SESSION['user'])) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
    </li>
<?php } ?>
<?php $menu = ob_get_clean(); ?>
<?php ob_start() ?>
<div class="container" id="registerPage">
    <h1 class="my-4 text-center">Inscription</h1>
    <form action="index.php?action=register" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="login" placeholder="Identifiant" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Adresse e-mail" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password_retype" placeholder="Re-tapez votre mot de passe" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Photo de profil</label>
            <input type="file" id="image" name="image" class="form-control" accept=".png, .jpeg, .jpg" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btnGlobal">Envoyer</button>
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start() ?>
<ul class="list-inline ">
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
</ul>
<?php $footer = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>