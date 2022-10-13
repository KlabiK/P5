<?php $title = "Ajouter un Jeu" ?>
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
    <?php $menu = ob_get_clean() ?>
    <?php ob_start() ?>
    <main class="container">
        <div class="row">
            <div class="col-10">
                <h1 class="text-center my-6">Ajouter un jeu</h1>
                <form method="POST" action="index.php?action=addGame" enctype="multipart/form-data">
                    <div class="form-group">
                        <h3>Nom du Jeu</h3>
                        <input type="text" id="title" name="title" class="form-control text-center my-12" placeholder="saisir le nom du jeu" require>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h3>Categorie</h3>
                        <label for="categorieSelect"></label>
                        <select name="categorie" id="categorieSelect">
                            <option value="famille">Jeu familial</option>
                            <option value="initie">Jeu initié</option>
                            <option value="solo">Jeu solo</option>
                            <option value="ambiance">Jeu d'ambiance</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h3>Image de présentation</h3>
                        <input type="file" id="image" name="image" class="form-control text-center my-12" placeholder="Image du Jeu" require>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h3>Description</h3>
                        <textarea id="content" name="content" required>
                        </textarea>
                    </div>
                    <hr>
                    <h3>Synopsis</h3>
                    <div class="form-group">
                        <textarea id="synopsis" name="synopsis" required>
                        </textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h3>Points Forts</h3>
                        <textarea id="positif" name="positif" required>
                        </textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <h3>Points Faibles</h3>
                        <textarea id="negatif" name="negatif" required>
                        </textarea>
                    </div>
                    <hr>
                    <button class="btn btn-primary my-4" type="submit">Poster</button>
                    <a class="btn btn-secondary my-4" href="index.php?action=admin">Page Admin</a>
                </form>
            </div>
        </div>
    </main>
  <script src="https://cdn.tiny.cloud/1/py0pjsyd3dnwtiz4cmlg58l6awx363bocz2lblfyzwcu7kv6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
        tinymce.init({
            selector: 'textarea',
            language: 'fr_FR',
            language_url: "./public/js/fr_FR.js",
            content_style:  "body { background: #5D4E6D; color: white; font-size: 14pt; font-family: Verdana; }",
             height: "400",
        });
    </script>
    <?php $content = ob_get_clean() ?>
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