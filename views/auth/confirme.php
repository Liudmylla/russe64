<?php

use App\Connection;

$pdo = Connection::getPDO();

$id_user = $_GET['id'];
$token = $_GET['token'];


$req = $pdo->prepare('SELECT * FROM user WHERE id_user = ? ');
$req->execute([$id_user]);
$user = $req->fetch();

if ($user && $user[4] == $token) {
  $pdo->prepare('UPDATE user SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_user = ?')->execute([$id_user]);
  session_start();
  $_SESSION['flash']['success'] = 'Votre compte a bien été validé, vous pouvez vous connecter';
 header('Location: ' . $router->url('login'));
 die();
} else {
  session_start();
  $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
 header('Location: ' . $router->url('login'));
die();
}
