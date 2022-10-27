<?php

use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');
require_once 'App/controller/frontend.php';
if (session_status() == PHP_SESSION_NONE) :
  session_start();
  if (!isset($_SESSION['lvl'])) :
    $_SESSION['lvl'] = 'notLoged';
  endif;
endif;
$action = $_GET['action'] ?? "home";
$page = 'App\controller\\' . $action;


if (function_exists($page)) :
  $page();
else :
  $pageErreur = $_GET['action'];
  header('Location: index.php?action=home');
  $_SESSION['erreur'] = "La page $pageErreur est introuvable";
endif;
