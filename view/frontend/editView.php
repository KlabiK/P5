<?php $title = "Modifications du jeu"; ?>
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
    <div class="container col-8 mt-4">
        <h1 class="text-center">Modification du jeu : <?= $game->title ?></h1>
        <form method="POST" action="index.php?action=edit" enctype="multipart/form-data">
            <div class="form-group">
                <h3>Nom du jeu</h3>
                <label for="title"></label>
                <input type="text" name="title" class="form-control col-8" value="<?= $game->title ?>">
            </div>
            <div class="form-group">
                <h3>Categorie</h3>
                <label for="categorieSelect"></label>
                <br>
                <select name="categorie" id="categorieSelect">
                    <?php if ($game->categorie == "famille") { ?>
                        <option value="famille" selected>Jeu familial</option>
                    <?php } else { ?>
                        <option value="famille">Jeu familial</option>
                    <?php } ?>
                    <?php if ($game->categorie == "initie") { ?>
                        <option value="initie" selected>Jeu initié</option>
                    <?php } else { ?>
                        <option value="initie">Jeu initié</option>
                    <?php } ?>
                    <?php if ($game->categorie == "solo") { ?>
                        <option value="solo" selected>Jeu solo</option>
                    <?php } else { ?>
                        <option value="solo">Jeu solo</option>
                    <?php } ?>
                    <?php if ($game->categorie == "ambiance") { ?>
                        <option value="ambiance" selected>Jeu d'ambiance</option>
                    <?php } else { ?>
                        <option value="ambiance">Jeu d'ambiance</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <h3>Image du jeu</h3>
                <img src="<?= $game->image ?>">
                <input type="file" id="imageUpdate" name="image" class="form-control  col-8" value="<?= $game->image ?>">
            </div>
            <div class="form-group">
                <h3>Description</h3>
                <textarea type="text" name="content" class="form-control">
             <?= $game->content ?>
            </textarea>
            </div>
            <div class="form-group">
                <h3>Synopsis</h3>
                <textarea type="text" name="synopsis" class="form-control">
              <?= $game->synopsis ?>
            </textarea>
            </div>
            <div class="form-group">
                <h3>Points Forts</h3>
                <textarea type="text" name="positif" class="form-control">
                <?= $game->positif ?>
            </textarea>
            </div>
            <div class="form-group">
                <h3>Points Faibles</h3>
                <textarea type="text" name="negatif" class="form-control">
                <?= $game->negatif ?>
            </textarea>
            </div>
            <input type="hidden" name="id" value="<?= $game->id ?>">
            <button class="btn btn-primary">Enregistrer</button>
        </form>
        <a class="btn btn-secondary my-4" href="index.php?action=admin">Page Admin</a>

    </div>
    <script src="https://cdn.tiny.cloud/1/py0pjsyd3dnwtiz4cmlg58l6awx363bocz2lblfyzwcu7kv6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'fr_FR',
            content_style:  "body { background: #5D4E6D; color: white; font-size: 14pt; font-family: Verdana; }",
            height: 400,
        });
    </script>
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