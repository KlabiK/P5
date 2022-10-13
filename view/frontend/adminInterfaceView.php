<?php $title = 'Interface Administrateur' ?>
<?php if ($_SESSION['lvl'] == 1) {
?>
    <?php ob_start(); ?>
    <?php
    if (isset($_SESSION['user'])) { ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
        </li>
    <?php } ?>
    <?php $menu = ob_get_clean(); ?>
    <?php ob_start(); ?>
    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center my-6">Interface Administrateur</h1>
                <a href="index.php?action=addGameInterface" class="btn btn-primary btnGlobal my-4">Ajouter un jeu</a>
                <table class="table ">
                    <thead class="thead-dark">
                        <th rows=6>Jeux</th>
                        <th>Categorie</th>
                        <th>Synopsis</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="">
                        <?php
                        foreach ($result as $game) {
                        ?>
                            <tr>
                                <td><?= $game['title'] ?></td>
                                <td><?= $game['categorie'] ?></td>
                                <td><?= $game['synopsis'] ?></td>
                                <td class="table-secondary">
                                    <a class="btn btn-primary btnGlobal my-2" href="index.php?action=editGame&id=<?= $game['id'] ?>">Modifier</a>
                                    <a class="btn btn-danger" href="index.php?action=deleteGame&id=<?= $game['id'] ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($signals) { ?>
            <div class="row">
                <div class="col-12">
                    <h2>Commentaires signalés :</h2>
                    <table class="table">
                        <thead>
                            <th>Jeu</th>
                            <th>Auteur</th>
                            <th>commentaire</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($signals as $signal) { ?>
                                <td><?= $signal->title ?></td>
                                <td><?= $signal->login ?></td>
                                <td><?= $signal->comment ?></td>
                                <td>
                                    <a class="btn btn-primary btnGlobal my-2" href="index.php?action=retraitSignal&id=<?= $signal->id ?>">Retrait du Signalement</a>
                                    <a class="btn btn-danger" href="index.php?action=deleteCom&id=<?= $signal->id ?>">Supprimer</a>
                                </td>
                        </tbody>
                    <?php } ?>
                    </table>
                </div>
            </div>
        <?php } ?>
    </main>
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