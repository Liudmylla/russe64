<?php

use App\Connection;
use App\Table\PostTable;

$title = "Les amis de la culture russe";
$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('home');
?>
<?php if (!$_GET): ?>
<?php require '_main.php' ?>

<div class="container">
    <h5 style="color:#007BFF;text-align:center;"> <span style="text-transform:uppercase;line-height: 3em;color:#DA4453;font-family:Merriweather;">
            Découvrir la culture russe à Biarritz <br></span>avec les danses folkloriques, les chants traditionnels, les soirées thématiques, les cours de russe, les échanges culturels.</h5>
    <div class=" d-flex justify-content-around  ">
        <div class="p-2 "><img src="<?= ASSETS; ?>images/resto40.png" alt=""></div>
        <div class="p-2 "><img src="<?= ASSETS; ?>images/loisir40.png" alt=""></div>
        <div class="p-2 "><img src="<?= ASSETS; ?>images/beaute40.png" alt=""></div>
        <div class="p-2 "><img src="<?= ASSETS; ?>images/langues40.png" alt=""></div>
    </div>
</div>
<?php endif ?>
<div class="row">
    <?php foreach ($posts as $post) : ?>
        <div class="col-md-3 mt-2 ">
            <?php require 'card.php' ?>
        </div>
    <?php endforeach ?>
</div>
<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link); ?>
    <?= $pagination->nextLink($link); ?>
</div>