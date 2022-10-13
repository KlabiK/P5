<?php $title = "Jeux Initié"; ?>
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
<div class="container containerGlobal">
    <div class="row">
        <div class=" form-group text-center">
            <h1 class="my-4">Jeux Initiés</h1>
            <hr>
            <div>
                <?php
                foreach ($games as $game) : ?>
                    <div class="row col-12 my-5 categoryList">
                        <div class="col-4 imgList">
                            <img alt="image du jeu <?= $game->title?>" src="<?= $game->image ?>">
                        </div>
                        <div class="col-8">
                            <h2><?= $game->title ?></h2>
                            <?= $game->synopsis ?>
                            <a class="form-control" href="index.php?action=game&id=<?= $game->id ?>">Voir le Jeu</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if ($pag['nbPage'] > 1) { ?>
                    <div class="container paginationHome">
                        <?php for ($i = 1; $i <= $pag['nbPage']; $i++) {
                            if ($i == $pag['currentPage']) { ?>
                                <a id="paginationActive"><?= $i ?></a>
                            <?php } else { ?>
                                <a class="paginationItem" href="index.php?action=initie&p=<?= $i ?>"><?= $i ?></a>
                        <?php  }
                        } ?>
                    </div>
                <?php    } ?>
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
<?php $footer = ob_get_clean(); ?>
<?php require('template.php'); ?>