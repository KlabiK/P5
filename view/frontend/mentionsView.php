<?php $title = "Mentions Légales"; ?>
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
                <h1 class="my-4">Mentions Légales</h1>
                <hr>
                <h2>IDENTITÉ</h2>
                <ul class="list-group-flush">
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Nom du site web :</div>La K-verne du jeu
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Adresse du site :</div>https://www.k-vernedujeu.fr
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Propriétaire :</div>DUPONT Pierre
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Responsable de publication :</div>Durand Patrick
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Hébergement :</div> IONOS , 7 Pl. de la Gare, 57200 Sarreguemines
                    </li>
                </ul>
                <h2>ENTREPRENEUR INDIVIDUEL</h2>
                <hr>
                <ul class="list-group-flush">
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">Indentité :</div>KLABI Kamel
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">RCS :</div>124 456 789 R.C.S Paris
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">TVA :</div>FR 00 44786548 217
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">téléphone :</div>0601020304
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">adresse mail :</div>klabikamelpro@gmail.com
                    </li>
                    <li class="list-group-item">
                        <div style="text-decoration: underline;">adresse postale :</div>8 rue du 8 mai 1945 PARIS 75004
                    </li>
                </ul>
                <h2>CONDITIONS D'UTILISATION</h2>
                <hr>
                <p>L’utilisation du présent site implique l’acceptation pleine et entière des conditions générales d’utilisation décrites ci-après. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment.</p>
                <h2>INFORMATIONS</h2>
                <hr>
                <p>Les informations et documents du site sont présentés à titre indicatif, sans de caractère exhaustif, et ne peuvent engager la responsabilité du propriétaire du site.
                    Le propriétaire du site ne peut être tenu responsable des dommages directs et indirects consécutifs à l’accès au site.</p>
                <hr>
                <h2>INTERACTIVITÉ</h2>
                <p>Les utilisateurs du site peuvent y déposer du contenu, apparaissant sur le site dans des espaces dédiés (notamment via les commentaires). Le contenu déposé reste sous la responsabilité de leurs auteurs, qui en assument pleinement l’entière responsabilité juridique.
                    Le propriétaire du site se réserve néanmoins le droit de retirer sans préavis et sans justification tout contenu déposé par les utilisateurs qui ne satisferait pas à la charte déontologique du site ou à la législation en vigueur.</p>
                <hr>
                <h2>PROPRIÉTÉ INTELLECTUELLE</h2>
                <p>Sauf mention contraire, tous les éléments accessibles sur le site (textes, images, graphismes, logo, icônes, sons, logiciels, etc.) restent la propriété exclusive de leurs auteurs, en ce qui concerne les droits de propriété intellectuelle ou les droits d’usage. 1
                    Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de l’auteur.23
                    Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient est considérée comme constitutive d’une contrefaçon et passible de poursuites. 4
                    Les marques et logos reproduits sur le site sont déposés par les sociétés qui en sont propriétaires.</p>
                <hr>
                <h2>LIENS</h2>
                <h3>Liens sortants</h3>
                <p>Le propriétaire du site décline toute responsabilité et n’est pas engagé par le référencement via des liens hypertextes, de ressources tierces présentes sur le réseau Internet, tant en ce qui concerne leur contenu que leur pertinence.</p>
                <h3>Liens entrants</h3>
                <p>Le propriétaire du site autorise les liens hypertextes vers l’une des pages de ce site, à condition que ceux-ci ouvrent une nouvelle fenêtre et soient présentés de manière non équivoque afin d’éviter :</p>
                  <ul>
                    <li>tout risque de confusion entre le site citant et le propriétaire du dit site</li>
                    <li>ainsi que toute présentation tendancieuse, ou contraire aux lois en vigueur</li>
                  </ul> 
                  <p>Le propriétaire du site se réserve le droit de demander la suppression d’un lien s’il estime que le site source ne respecte pas les règles ainsi définies.</p>                 
                <hr>
                <h2>CONFIDENTIALITÉ</h2>
                <p>Tout utilisateur dispose d’un droit d’accès, de rectification et d’opposition aux données personnelles le concernant, en effectuant sa demande écrite et signée, accompagnée d’une preuve d’identité. 5678
                    Le site ne recueille pas d’informations personnelles, et n’est pas assujetti à déclaration à la CNIL.</p>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php ob_start() ?>
<ul class="list-inline ">
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
    <li class="list-inline-item font-weight-bold nav-item"><a class="nav-link" href="index.php?action=Apropos">À propos</a></li>
</ul>
<?php $footer = ob_get_clean(); ?>
<?php require('template.php'); ?>