<?php

use function App\controller\homeGames; ?>
<?php $title = "La K-verne du Jeu"; ?>

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
<div class="container">
    <div id="carousel1">
        <div class="item row col-12">
            <div class="item_img col-7">
                <img src="/public/images/JDS.webp" alt="image d'une table de jeux de societe">
            </div>
            <div class="item_body col-5">
                <div class="item_title">
                    La passion du jeu de société
                </div>
                <div class="item_description">
                    Venez decouvrir un large choix de jeux pour les amoureux des jeux d'ambiances , en passant par les jeux un peu plus velu.
                </div>
            </div>
        </div>
        <div class="item row col-12">
            <div class="item_img col-7">
                <img src="/public/images/tapisAbyss.jpg" alt="tapis du jeu Abyss">
            </div>
            <div class="item_body col-5">
                <div class="item_title">
                    Des jeux pour les plus corriaces
                </div>
                <div class="item_description">
                    Venez nous donner votre avis sur les jeux que vous avez eu la chance d'essayer.
                </div>
            </div>
        </div>
        <div class="item row col-12">
            <div class="item_img col-7">
                <img src="/public/images/whenIDream.webp" alt="materiel du jeu When I Dream">
            </div>
            <div class="item_body col-5">
                <div class="item_title">
                    Passez un bon moment avec vos proches
                </div>
                <div class="item_description">
                    Besoin d'un jeu pour animer une soirée ? Vous êtes au bon endroit
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class=" form-group text-center">
            <h2 class="my-4">Tous les jeux</h2>
            <hr>
            <div class="listGames">
                <?php
                $datas = homeGames();
                $games = $datas["games"];
                $pag = $datas['pag'];
                foreach ($games as $game) : ?>
                    <div class="list col-10  my-4">
                        <h3><?= $game->title ?></h3>
                        <?= $game->synopsis ?>
                        <a class="form-control buttonList" href="index.php?action=game&id=<?= $game->id ?>">Voir le Jeu</a>
                        <hr>
                    </div>
                <?php endforeach; ?>
                <div class="container paginationHome">
                    <?php for ($i = 1; $i <= $pag['nbPage']; $i++) {
                        if ($i == $pag['currentPage']) { ?>
                            <a id="paginationActive"><?= $i ?></a>
                        <?php } else { ?>
                            <a class="paginationItem" href="index.php?p=<?= $i ?>"><?= $i ?></a>
                    <?php  }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start() ?>
<ul class="list-inline ">
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
</ul>
<script src="/public/js/carousel.js" async></script>
<?php $footer = ob_get_clean(); ?>

<?php require('template.php'); ?>