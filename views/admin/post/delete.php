<?php
Use App\Connection;
use App\Table\PostTable;
use App\Auth;
use App\Attachment\PostAttachment;

Auth::check();

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
PostAttachment::detach($post);
$table->delete($params['id']);
header('Location:' . $router->url('admin_posts') . '?delete=1');
