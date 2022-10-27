<?php $title = "Fiche du jeu " ?>
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
    <div class="row col-12  text-center" id="gamePage">
        <div class="col-md-6 col-sm-12 my-5 resumeContent">
            <img src="<?= $game->image ?>">
        </div>
        <div class="col-md-6 col-sm-12 resumeContent">
            <h1 class="my-4"><?= $game->title ?></h1>
            <h3 class="my-4">Categorie : <?= $game->categorie ?></h3>
            <?php if ($result > 0) { ?> <h3 class="my-4">Note : <?= $result['result'] ?>/5 (sur <?= $result['count'] ?> avis) </h3> <?php } ?>
            <hr>
        </div>
    </div>
    <div class="row col-12 notes" id="notes">
        <div class="col-md-5 positif col-sm-12">
            <div class="row col-12 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="col-sm-2 col-md-3">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M54.63 246.6L192 109.3l137.4 137.4C335.6 252.9 343.8 256 352 256s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25l-160-160c-12.5-12.5-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25S42.13 259.1 54.63 246.6zM214.6 233.4c-12.5-12.5-32.75-12.5-45.25 0l-160 160c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0L192 301.3l137.4 137.4C335.6 444.9 343.8 448 352 448s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L214.6 233.4z" />
                </svg>
                <h4 class="col-sm-10 col-md-9">Les Avantages :</h4>
            </div>
            <div id="positifList" class="listNumber"><?= $game->positif ?></div>
        </div>
        <div class="col-md-5 col-sm-12 negatif">
            <div class="row col-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="col-sm-2 col-xs-1 col-md-3">
                    <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M169.4 278.6C175.6 284.9 183.8 288 192 288s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0L192 210.8L54.63 73.38c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L169.4 278.6zM329.4 265.4L192 402.8L54.63 265.4c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25l160 160C175.6 476.9 183.8 480 192 480s16.38-3.125 22.62-9.375l160-160c12.5-12.5 12.5-32.75 0-45.25S341.9 252.9 329.4 265.4z" />
                </svg>
                <h4 class="col-sm-10 col-md-9">Les Inconvénients :</h4>
            </div>
            <div id="negatifList" class="listNumber"><?= $game->negatif ?></div>
        </div>
    </div>

    <?php if ($comments) { ?>
        <div>

            <h3>Avis :</h3>

            <div class="row">
                <?php foreach ($comments as $comment) { ?>
                    <div class="row col-12 align-items-start commentaires">
                        <div class="col-md-2 col-sm-2 divImg">
                            <img src="<?= $comment->image ?>" class="profilImg">
                        </div>
                        <div class="col-md-9 col-sm-10">
                            <div class="row align-items-start col-10">
                                <div>
                                    <h4 class="loginComs"><?= $comment->login ?></h4>
                                </div>
                                <div>
                                    <p class="note"><?php switch ($comment->note) {
                                                        case 0:
                                                            echo "<i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i>";
                                                            break;
                                                        case 1:
                                                            echo "<i class='fa-solid fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i>";
                                                            break;
                                                        case 2:
                                                            echo "<i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i>";
                                                            break;
                                                        case 3:
                                                            echo "<i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-regular fa-heart'></i><i class='fa-regular fa-heart'></i>";
                                                            break;
                                                        case 4:
                                                            echo "<i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-regular fa-heart'></i>";
                                                            break;
                                                        case 5:
                                                            echo "<i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i><i class='fa-solid fa-heart'></i>";
                                                            break;
                                                    } ?></p>
                                </div>
                                <?php if (isset($_SESSION['user']) && $_SESSION['lvl'] == 0 && $_SESSION['user'] !== $comment->login) {
                                    if ($comment->alert == 1) { ?>
                                        <div>
                                            <button class="signal">signalé</button>
                                        </div>
                                    <?php  } else { ?>
                                        <div>
                                            <a class="signalBtn" href="index.php?action=signaler&commentId=<?= $comment->id ?>&gameId=<?= $game->id ?>">Signaler</a>
                                        </div>
                                    <?php } ?>


                                <?php } ?>
                            </div>
                            <div>
                                <p><?= $comment->comment ?></p>
                            </div>
                        </div>
                    </div>

                <?php    } ?>
            </div>

        <?php       } ?>
        </div>
</div>
<?php if (isset($_SESSION['user']) && $_SESSION['lvl'] == 0) {
?>
    <div class="addComArea">
        <form method="POST" action="index.php?action=addCom&id=<?= $id ?>">
            <div class="form-group">
                <div class="row col-12">
                    <img src="<?= $_SESSION['img'] ?>" class="imgComs" class="col-2">
                    <div class="col-7">
                        <label for="userNote">Votre note de 0 à 5:</label><br>
                        <select name="userNote" id="userNote">
                            <option value=0>Zero</option>
                            <option value="1">Un</option>
                            <option value=2>Deux</option>
                            <option value="3">Trois</option>
                            <option value="4">Quatre</option>
                            <option value="5">Cinq</option>
                        </select>
                    </div>
                </div>
                <label for="comment">Votre avis :</label><br>
                <textarea name="comment" id="comment" rows="9" cols="90" required></textarea>
            </div>
            <p class="warning">Un seul avis par utilisateur, en cas de doublon le nouveau message remplacera le precedent.</p>
            <button class="btn btn-secondary" type="submit">Envoyer</button>

        </form>
    <?php } ?>
    </div>
    <?php $content = ob_get_clean(); ?>
    <?php ob_start() ?>
    <ul class="list-inline ">
        <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
        <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=mentions">Mentions légales</a></li>
    </ul>
    <?php $footer = ob_get_clean(); ?>
    <?php require('template.php'); ?>