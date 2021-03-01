<?php
Use App\Connection;
use App\Table\UserTable;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new UserTable($pdo);
$table->deleteUser($params['id']);
header('Location:' . $router->url('admin_users') . '?delete=1');
?>
<h1>Suppression de <?= $params['id'] ?></h1>