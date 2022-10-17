<?php $title = "A propos" ?>
<?php ob_start(); ?>
<?php if ($_SESSION['lvl'] == 1) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=admin">Interface Administrateur</a>
    </li>
<?php } ?>
<?php if (!isset($_SESSION['user'])) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=loginPage">Connexion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=registerPage">S'inscrire</a>
    </li>
<?php }
if (isset($_SESSION['user']) && $_SESSION['lvl'] == 0) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=account">Mon Compte</a>
    </li>
<?php }
if (isset($_SESSION['user'])) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
    </li>
<?php } ?>
<?php $menu = ob_get_clean(); ?>
<?php ob_start(); ?>
<div class="container containerGlobal">
    <div class="row">
        <div class="divDesc form-group text-center">
            <h1 class="my-4">A propos</h1>
            <hr>
            <p class="aproposDesc">Vous êtes nouveau dans le milieu du jeu de société ? Ne vous inquietez pas, nous sommes là pour vous aider.
                A travers notre blog vous pourrez trouver chaussure à votre pied. A l'aide de cette carte vous pourrez trouver une boutique pour vous initier aux jeux de sociêté.
                Tapez le nom de votre ville pour voir apparaitre les points de vente Fnac, Cultura et autres boutiques pour faire de nouvelles acquisitions.
            </p>
        </div>
        <div id="map"></div>
        <div id="searchCity">
            <form>
                <input type="text" id="ville" placeholder="Ville">
                <input type="button" id="envoyer" value="rechercher" class="btn btn-secondary">
            </form>
        </div>
    </div>
</div>
<script src="/public/js/request.js"></script>
<script src="/public/js/map.js"></script>
<?php $content = ob_get_clean(); ?>
<?php ob_start() ?>
<ul class="list-inline ">
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
</ul>
<?php $footer = ob_get_clean(); ?>
<?php require('template.php'); ?>