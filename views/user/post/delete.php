<?php

use App\Attachment\PostAttachment;
Use App\Connection;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
PostAttachment::detach($post);
$table->delete($params['id']);
header('Location:' . $router->url('user_posts',['id_user' => $_SESSION['id_user']]) . '?delete=1');
