<?php

namespace App\controller;

use App\model\PostManager;
use App\model\UserManager;
use App\model\CommentManager;


function home() //Page d'accueil
{
    require('view/frontend/homeView.php');
}
function homeGames() // retourne tous les jeux , 5 par page
{
    $categorie = null;
    $postManager = new PostManager();
    $pag = $postManager->pagination($categorie);
    $startPage = $pag['startPage'];
    $perPage = $pag['perPage'];
    $games = $postManager->getHomeGames($startPage, $perPage);
    return ["games" => $games, "pag" => $pag];
}

function game($id) //Page d'un jeu avec ses commentaires
{
    $postManager = new PostManager();
    $game = $postManager->getGame($id);
    $commentManager = new CommentManager();
    $comments = $commentManager->comments($id);
    $commentManager = new CommentManager();
    $result = $commentManager->rate($id);
    require('view/frontend/gameView.php');
}

function getGame($id) //renvoie données d'un jeu
{
    $postManager = new PostManager();
    $game = $postManager->getGame($id);
    return $game;
}
function categorieGames($categorie) //Pages des differentes categories
{
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
function addGame($title, $categorie, $image, $synopsis, $content, $positif, $negatif)
{
    $postManager = new PostManager();
    $game = $postManager->addGame($title, $categorie, $image, $synopsis, $content, $positif, $negatif);
}
function editGame($id)
{
    $postManager = new PostManager();
    $game = $postManager->getGame($id);
    require('view/frontend/editView.php');
}
function edit($id, $title, $categorie, $image, $synopsis, $content, $positif, $negatif)
{
    $postManager = new PostManager();
    $game = $postManager->edit($id, $title, $categorie, $image, $synopsis, $content, $positif, $negatif);
}
function gameToSuppr($id)
{
    $postManager = new PostManager();
    $game = $postManager->gameToSuppr($id);
    require('view/frontend/deleteView.php');
    return $game;
}
function supprGame($id)
{
    $postManager = new PostManager();
    $game = $postManager->supprGame($id);
}
// FIN DE LA SECTION ADMINISTRATEUR

// SECTION COMPTE
function registerPage()
{
    require('view/frontend/registerPageView.php');
}
function register($login, $password, $image, $email)
{
    $userManager = new UserManager();
    $user = $userManager->userRegister($login, $password, $image, $email);
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
function connect($login)
{
    $userManager = new UserManager();
    $user = $userManager->user($login);

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
function accountUpdate($id, $pseudo, $img)
{
    $userManager = new UserManager();
    $update = $userManager->updateUser($id, $pseudo, $img);
    $_SESSION['user'] = $pseudo;
    $_SESSION['img'] = $img;
}
// COMMENTAIRES
function verifCom($userId, $articleId) //verifie si un message de l'user existe pour ce jeu et le remplace par le nouveau
{
    $commentManager = new CommentManager();
    $note = $commentManager->verifCom($userId, $articleId);
}
function addCom($gameId, $user, $note, $comment) // ajout de l'avis + note
{
    $commentManager = new CommentManager();
    $com = $commentManager->addCom($gameId, $user, $note, $comment);
}
function signaler($commentId)
{
    $commentManager = new CommentManager();
    $signals = $commentManager->signal($commentId);
}
function retraitSignal($commentId)
{
    $commentManager = new CommentManager();
    $retraitSignal = $commentManager->retraitSignal($commentId);
}
function deleteCom($comId)
{
    $commentManager = new CommentManager();
    $deleteCom = $commentManager->deleteCom($comId);
}
function logout()
{
    session_start();
    session_destroy();
    header('Location: index.php?action=loginPage');
}
