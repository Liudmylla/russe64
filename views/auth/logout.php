<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes maitenant déconnecté";
// session_destroy();
header('Location:' . $router->url('home'));
exit();