<?php

namespace App\controller;

use App\model\PostManager;
use App\model\UserManager;
use App\model\CommentManager;


function home() //Page d'accueil*
{
    require('view/frontend/homeView.php');
}
function homeGames() // retourne tous les jeux , 5 par page*
{
    $categorie = null;
    $postManager = new PostManager();
    $pag = $postManager->pagination($categorie);
    $startPage = $pag['startPage'];
    $perPage = $pag['perPage'];
    $games = $postManager->getHomeGames($startPage, $perPage);
    return ["games" => $games, "pag" => $pag];
}

function game() //Page d'un jeu avec ses commentaires*
{
    if (!isset($_GET['id']) or !is_numeric($_GET['id'])) :
        home();
    else :
        $id = strip_tags($_GET['id']);
        $postManager = new PostManager();
        $game = $postManager->getGame($id);
        $commentManager = new CommentManager();
        $comments = $commentManager->comments($id);
        $commentManager = new CommentManager();
        $result = $commentManager->rate($id);
        require('view/frontend/gameView.php');

    endif;
}

function getGame() //renvoie données d'un jeu
{

    $id = $_GET['id'];
    $postManager = new PostManager();
    $game = $postManager->getGame($id);
    return $game;
}
function categorieGames() //Pages des differentes categories *
{
    $categorie = $_GET['categorie'];
    $postManager = new PostManager();
    $pag = $postManager->pagination($categorie);
    $startPage = $pag['startPage'];
    $perPage = $pag['perPage'];
    $games = $postManager->categorieGames($categorie, $perPage, $startPage);
    switch ($categorie) {
        case "initie":
            require('view/frontend/initieView.php');
            break;
        case "solo":
            require('view/frontend/soloView.php');
            break;
        case "famille":
            require('view/frontend/familyView.php');
            break;
        case "ambiance":
            require('view/frontend/ambianceView.php');
            break;
    }
    return $pag;
}
function apropos()
{
    require('view/frontend/aproposView.php');
}
function mentions()
{
    require('view/frontend/mentionsView.php');
}
// SECTION ADMINISTRATEUR

function admin() // Interface Administrateur
{
    $postManager = new PostManager();
    $result = $postManager->arrayGames();
    $commentManager = new CommentManager();
    $signals = $commentManager->signalsComments();
    require('view/frontend/adminInterfaceView.php');
}
function addGameInterface()
{
    require('view/frontend/addGameView.php');
}
function addGame()
{
    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_POST['synopsis']) && !empty($_POST['synopsis']) && isset($_POST['positif']) && !empty($_POST['positif']) && isset($_POST['negatif']) && !empty($_POST['negatif'])) :
        $title = strip_tags($_POST['title']);
        $title = stripslashes($_POST['title']);
        $content = strip_tags($_POST['content']);
        $content = htmlentities($_POST['content']);
        $content = stripslashes(nl2br($_POST['content']));
        $categorie = strip_tags($_POST['categorie']);
        $arrayImage = $_FILES['image'];
        $image = '/public/images/' . $arrayImage['name'];
        $synopsis = strip_tags($_POST['synopsis']);
        $synopsis = htmlentities($_POST['synopsis']);
        $synopsis = stripslashes(nl2br($_POST['synopsis']));
        $positif = strip_tags($_POST['positif']);
        $positif = htmlentities($_POST['positif']);
        $positif = stripslashes(nl2br($_POST['positif']));
        $negatif = strip_tags($_POST['negatif']);
        $negatif = htmlentities($_POST['negatif']);
        $negatif = stripslashes(nl2br($_POST['negatif']));
        $imgType = $arrayImage['type'];
        $image = '/public/images/' . $arrayImage['name'];
        $dossier = "/kunden/homepages/32/d779462273/htdocs/P5/public/images/";
        if ($imgType === "image/jpg" or $imgType === "image/JPG" or $imgType === "image/png" or $imgType === "image/PNG" or $imgType === "image/jpeg" or $imgType === "image/JPEG") :
            $postManager = new PostManager();
            $game = $postManager->addGame($title, $categorie, $image, $synopsis, $content, $positif, $negatif);
            move_uploaded_file($arrayImage['tmp_name'], $dossier . $arrayImage['name']);
            admin();
        else :
            $_SESSION['erreur'] = "Veuillez selectionner une image valide";
        endif;
    endif;
}
function editGame()
{
    if (isset($_GET['id']) && !empty($_GET['id'])) :
        $id = strip_tags($_GET['id']);
        $postManager = new PostManager();
        $game = $postManager->getGame($id);
        require('view/frontend/editView.php');
        if (!$id) :
            $_SESSION['erreur'] == "Le jeu demandé est introuvable";
        endif;
    endif;
}
function edit() //Modifications des données , analyse et envoie en BDD
{
    if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['categorie']) && !empty($_POST['categorie']) && isset($_POST['synopsis']) && !empty($_POST['synopsis']) && isset($_POST['positif']) && !empty($_POST['positif']) && isset($_POST['negatif']) && !empty($_POST['negatif'])) :
        //Netoyage des données
        $id = strip_tags($_POST['id']);
        $title = strip_tags($_POST['title']);
        $title = stripslashes($_POST['title']);
        $content = strip_tags($_POST['content']);
        $content = htmlentities($_POST['content']);
        $content = stripslashes(nl2br($_POST['content']));
        $categorie = strip_tags($_POST['categorie']);
        $arrayImage = $_FILES['image'];
        $imgType = $arrayImage['type'];
        $image = '/public/images/' . $arrayImage['name'];
        $dossier = "/kunden/homepages/32/d779462273/htdocs/P5/public/images/";

        if ($arrayImage['name'] != "" && ($imgType === "image/jpg" or $imgType === "image/JPG" or $imgType === "image/png" or $imgType === "image/PNG" or $imgType === "image/jpeg" or $imgType === "image/JPEG")) :
            $image = '/public/images/' . $arrayImage['name'];
            move_uploaded_file($arrayImage['tmp_name'], $dossier . $arrayImage['name']);
        else :
            $game = getGame($id);
            $image =  $game->image;
        endif;
        $synopsis = strip_tags($_POST['synopsis']);
        $synopsis = htmlentities($_POST['synopsis']);
        $synopsis = stripslashes(nl2br($_POST['synopsis']));
        $positif = strip_tags($_POST['positif']);
        $positif = htmlentities($_POST['positif']);
        $positif = stripslashes(nl2br($_POST['positif']));
        $negatif = strip_tags($_POST['negatif']);
        $negatif = htmlentities($_POST['negatif']);
        $negatif = stripslashes(nl2br($_POST['negatif']));

        $postManager = new PostManager();
        $game = $postManager->edit($id, $title, $categorie, $image, $synopsis, $content, $positif, $negatif);
        admin();
    else :
        $_SESSION['erreur'] = "Veuillez completer tous les champs";
    endif;
}
function deleteGame()
{
    extract($_GET);
    $id = strip_tags($_GET['id']);
    $postManager = new PostManager();
    $game = $postManager->gameToSuppr($id);
    require('view/frontend/deleteView.php');
    return $game;
}
function delete()
{
    extract($_GET);
    $id = strip_tags($_GET['id']);
    if (isset($_GET['id']) && !empty($_GET['id'])) :
        if (isset($_POST['suppr'])) :
            $postManager = new PostManager();
            $game = $postManager->supprGame($id);
            header('Location: index.php?action=admin');
            $_SESSION['message'] = "Jeu supprimé avec succès";
            die();
        else :
            header('Location: index.php?action=admin');
            $_SESSION['erreur'] = "Veuillez cocher la case pour valider la suppression";
            die();
        endif;
    else :
        $_SESSION['erreur'] = "ID invalide";
        die();
    endif;
}
// FIN DE LA SECTION ADMINISTRATEUR

// SECTION COMPTE
function registerPage()
{
    require('view/frontend/registerPageView.php');
}
function register($login, $password, $image, $email)
{
    if (isset($_POST)) {

        $login = htmlspecialchars($_POST['login']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordRetype = htmlspecialchars($_POST['password_retype']);
        $arrayImage = $_FILES['image'];
        $arrayType = $arrayImage['type'];
        $image = '.\public/images/users/' . $arrayImage['name'];
        $dossier = "/kunden/homepages/32/d779462273/htdocs/P5/public/images/users/";

        if (!empty($login) && preg_match('#^[a-zA-Z0-9_]{4,10}$#', $login)) {
            if (existUser($login) == 0 && existMail($email) == 0) {
                if (!empty($email) && preg_match('#[a-zA-Z0-9@]#', $email)) {
                    if (!empty($password) && $password == $passwordRetype) {
                        if ($arrayType === "image/jpg" or $arrayType === "image/JPG" or $arrayType === "image/png" or $arrayType === "image/PNG" or $arrayType === "image/jpeg" or $arrayType === "image/JPEG") {
                            $userManager = new UserManager();
                            $user = $userManager->userRegister($login, $password, $image, $email);
                            move_uploaded_file($arrayImage['tmp_name'], $dossier . $arrayImage['name']);
                            header('Location: index.php?action=loginPage');
                            $_SESSION['message'] = "Votre compte à bien été créé";
                        } else {
                            header('Location:index.php?action=registerPage');
                            $_SESSION['erreur'] = "Le format de l'image est invalide";
                        }
                    } else {
                        header('Location:index.php?action=registerPage');
                        $_SESSION['erreur'] = "Les mots de passe ne sont pas identique, Veuillez les saisir à nouveau";
                    }
                } else {
                    header('Location: index.php?action=registerPage');
                    $_SESSION['erreur'] = "Votre adresse mail est incorrecte";
                }
            } else {
                header('Location:index.php?action=registerPage');
                $_SESSION['erreur'] = "Cet Identifiant n'est pas disponible";
            }
        } else {
            header('Location: index.php?action=registerPage');
            $_SESSION['erreur'] = "L'identifiant saisi n'est pas valide";
        }
    } else {
        header('Location: index.php?action=registerPage');
    }
}
function existUser($login)
{
    $userManager = new UserManager();
    $user = $userManager->user($login);
    return $user;
}
function existMail($email)
{
    $userManager = new UserManager();
    $user = $userManager->mail($email);
    return $user;
}
function loginPage()
{
    require('view/frontend/loginPageView.php');
}
function login()
{
    if (isset($_POST['login']) && isset($_POST['password'])) :
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $userManager = new UserManager();
        $user = $userManager->user($login);
    endif;
    if (isset($user)) {
        $passwordVerified = password_verify($_POST['password'], $user['password']);
        if ($passwordVerified == true) {
            $_SESSION['user'] = $user['login'];
            $_SESSION['img'] = $user['image'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['lvl'] = $user['type'];

            if ($user['type'] == '1') {
                header('Location: index.php?action=admin');
            } else {
                home();
            }
        } else {
            header('Location: index.php?action=loginPage');
            $_SESSION['erreur'] = "Identifiants incorrects";
        }
    } else {
        header('Location: index.php?action=loginPage');
        $_SESSION['erreur'] = "Identifiants incorrects";
    }
}
function account()
{
    require('view/frontend/accountView.php');
}
function accountUpdate() //update du pseudo et de l'img de profil *
{
    $id = strip_tags($_SESSION['id']);
    $pseudo = strip_tags($_POST['pseudo']);
    $imgToTest = $_FILES['image'];
    $imgType = $imgToTest['type'];
    $image = '/public/images/users/' . $imgToTest['name'];
    $dossier = "/kunden/homepages/32/d779462273/htdocs/P5/public/images/users/";

    if (isset($pseudo) && !empty($pseudo) && preg_match('#^[a-zA-Z0-9_]{4,10}$#', $pseudo)) :
        if (isset($imgToTest['name']) && is_string($imgToTest['name']) && $imgToTest['name'] != "") :
            $img = '/public/images/users/' . $imgToTest['name'];
        else :
            $user = existUser($_SESSION['user']);
            $img =  $user['image'];
        endif;
        if ($imgType === "image/jpg" or $imgType === "image/JPG" or $imgType === "image/png" or $imgType === "image/PNG" or $imgType === "image/jpeg" or $imgType === "image/JPEG") :
            $userManager = new UserManager();
            $update = $userManager->updateUser($id, $pseudo, $img);
            $_SESSION['user'] = $pseudo;
            $_SESSION['img'] = $img;
            move_uploaded_file($imgToTest['tmp_name'], $dossier . $imgToTest['name']);
            header('Location: index.php?action=account');
            $_SESSION['message'] = "Vos données ont été modifier avec succès";
        else :
            header('Location: index.php?action=account');
            $_SESSION['erreur'] = "Veuillez selectionner une image valide";
        endif;

    else :
        header('Location: index.php?action=account');
        $_SESSION['erreur'] = "Veuillez saisir un identifiant valide : uniquement des lettres et '_'";
    endif;
}
// COMMENTAIRES
function verifCom($userId, $articleId) //verifie si un message de l'user existe pour ce jeu et le remplace par le nouveau
{
    $commentManager = new CommentManager();
    $note = $commentManager->verifCom($userId, $articleId);
}
function addCom() // ajout de l'avis + note
{
    $userId = $_SESSION['id'];
    $articleId = $_GET['id'];
    verifCom($userId, $articleId);
    if (isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['userNote']) && !empty($_POST['userNote'])) :
        $comment = strip_tags($_POST['comment']);
        $comment = stripslashes(nl2br($_POST['comment']));
        $comment = htmlentities($_POST['comment']);
        $user = intval($_SESSION['id']);
        $gameId = intval($_GET['id']);
        $note = intval($_POST['userNote']);
        $commentManager = new CommentManager();
        $com = $commentManager->addCom($gameId, $user, $note, $comment);
        $_SESSION['message'] = 'Le commentaire à bien été posté';
        header("Location: index.php?action=game&id=$gameId");
        unset($gameId);
    endif;
}
function signaler()
{
    $gameId = intval($_GET['gameId']);
    $commentId = intval($_GET['commentId']);
    $commentManager = new CommentManager();
    $signals = $commentManager->signal($commentId);
    $_SESSION['erreur'] = 'Le commentaire à été signalé.';
    header("Location: index.php?action=game&id=$gameId");
}
function retraitSignal()
{
    $commentId = intval($_GET['id']);
    $commentManager = new CommentManager();
    $retraitSignal = $commentManager->retraitSignal($commentId);
    $_SESSION['message'] = 'Signalement retiré avec succès';
    admin();
}
function deleteCom()
{
    $comId = intval($_GET['id']);
    $commentManager = new CommentManager();
    $deleteCom = $commentManager->deleteCom($comId);
    $_SESSION['erreur'] = 'Le commentaire à bien été supprimé';
    admin();
}
function logout()
{
    session_start();
    session_destroy();
    header('Location: index.php?action=loginPage');
    $_SESSION['message'] = 'Déconnexion efféctuée avec succès';
}
