<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (!isset($_SESSION['lvl'])) {
    $_SESSION['lvl'] = 'notLoged';
  }
}

use function App\controller\{
  home,
  categorieGames,
  game,
  getGame,
  addGameInterface,
  admin,
  addGame,
  editgame,
  edit,
  gameToSuppr,
  supprGame,
  registerPage,
  register,
  existUser,
  existMail,
  loginPage,
  connect,
  addCom,
  verifCom,
  signaler,
  retraitSignal,
  deleteCom,
  logout,
  apropos,
  account,
  accountUpdate,
  mentions,
};

require('App/controller/frontend.php');
require('vendor/autoload.php');

if (isset($_GET['action'])) :
  if ($_GET['action'] == 'home') :
    home();
  elseif ($_GET['action'] == 'solo') : //categorie jeux solo
    categorieGames('solo');
  elseif ($_GET['action'] == 'family') : //categorie jeux familiaux
    categorieGames('famille');
  elseif ($_GET['action'] == 'initie') : //categorie jeux initié
    categorieGames('initie');
  elseif ($_GET['action'] == 'ambiance') : //categorie jeux d'ambiance
    categorieGames('ambiance');
  elseif ($_GET['action'] == 'game') : //charge page du jeu selectionné
    if (!isset($_GET['id']) or !is_numeric($_GET['id'])) :
      header('Location: index.php?action=home');
    else :
      extract($_GET);
      $id = strip_tags($_GET['id']);
      game($id);

      if (!empty($_POST)) :
        extract($_POST);
        $errors = array();

        if (count($errors) == 0) :
          $gameId = $_GET['id'];
          header("Location: index.php?action=game&id=$gameId");
          unset($gameId);
        endif;
      endif;
    endif;
  elseif ($_GET['action'] == "Apropos") : // page à propos
    apropos();
  elseif ($_GET['action'] == "mentions") : // page mentions légales
    mentions();
  elseif ($_GET['action'] == "account") : // charge Vue Account
    account();
  elseif ($_GET['action'] == "accountUpdate") :
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
        accountUpdate($id, $pseudo, $img);
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
  elseif ($_GET['action'] == 'admin') :
    admin();
  elseif ($_GET['action'] == "addGameInterface") : //ajout d'un article Jeu
    addGameInterface();
  elseif ($_GET['action'] == "addGame") :
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
        addGame($title, $categorie, $image, $synopsis, $content, $positif, $negatif);
        move_uploaded_file($arrayImage['tmp_name'], $dossier . $arrayImage['name']);
        admin();
      else:
        $_SESSION['erreur'] = "Veuillez selectionner une image valide";
      endif;
    endif;
  elseif ($_GET['action'] == 'editGame') :
    if (isset($_GET['id']) && !empty($_GET['id'])) :
      $id = strip_tags($_GET['id']);
      $game = editgame($id);
      if (!$id) :
        $_SESSION['erreur'] == "Le jeu demandé est introuvable";
      endif;
    endif;
  elseif ($_GET['action'] == 'edit') : //Modifications des données , analyse et envoie en BDD
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

      edit($id, $title, $categorie, $image, $synopsis, $content, $positif, $negatif);
      admin();
    else :
      $_SESSION['erreur'] = "Veuillez completer tous les champs";
    endif;
  elseif ($_GET['action'] == 'deleteGame') : //Page de suppression du jeu
    extract($_GET);
    $id = strip_tags($_GET['id']);
    $game = gameToSuppr($id);
  elseif($_GET['action'] == 'delete') :
    extract($_GET);
    $id = strip_tags($_GET['id']);
    if (isset($_GET['id']) && !empty($_GET['id'])) :
      if (isset($_POST['suppr'])) :
        supprGame($id);
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
  elseif ($_GET['action'] == 'registerPage') :
    registerPage();
  elseif ($_GET['action'] == 'register') :
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
                register($login, $password, $image, $email);
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
  elseif ($_GET['action'] == 'loginPage') :
    loginPage();
  elseif ($_GET['action'] == 'login') :
    if (isset($_POST['login']) && isset($_POST['password'])) :
      $login = htmlspecialchars($_POST['login']);
      $password = htmlspecialchars($_POST['password']);
      connect($login);
    endif;
  elseif ($_GET['action'] == 'addCom') :
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
      addCom($gameId, $user, $note, $comment);
      $_SESSION['message'] = 'Le commentaire à bien été posté';
      header("Location: index.php?action=game&id=$gameId");
      unset($gameId);
    endif;
  elseif ($_GET['action'] == 'signaler') :
    $gameId = intval($_GET['gameId']);
    $commentId = intval($_GET['commentId']);
    signaler($commentId);
    $_SESSION['erreur'] = 'Le commentaire à été signalé.';
    header("Location: index.php?action=game&id=$gameId");
  elseif ($_GET['action'] == 'retraitSignal') :
    $commentId = intval($_GET['id']);
    retraitSignal($commentId);
    $_SESSION['message'] = 'Signalement retiré avec succès';
    admin();
  elseif ($_GET['action'] == 'deleteCom') :
    $comId = intval($_GET['id']);
    deleteCom($comId);
    $_SESSION['erreur'] = 'Le commentaire à bien été supprimé';
    admin();
  elseif ($_GET['action'] == 'logout') :
    $_SESSION['message'] = 'Déconnexion efféctuée avec succès';
    logout();
  endif;
else :
  home();
endif;
