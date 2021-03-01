<?php

use App\Connection;
use App\Table\PostTable;
use App\Auth;
use App\Model\Post;

Auth::check();


$title = "Administration";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();
?>

<?php if (isset($_GET['deleted'])) : ?>
    <div class="alert alert-success">
        L'article a bien été supprimé
    </div>
<?php endif ?>

<?php if (isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        L'article a bien été créé
    </div>
<?php endif ?>

<?php if (isset($_GET['updated'])) : ?>
    <div class="alert alert-success">
        L'article a bien été modifié
    </div>
<?php endif ?>

<table class="table">
    <thead style="font-size:18px;">
        <th>#</th>
        <th>Annonce</th>
        <th>Créé par</th>
        <th>Créé le</th>
        <th>Validé</th>
        <th>
            <a href=" <?= $router->url('admin_post_new') ?>" class="btn btn-outline-primary">Nouvelle annonce</a>
        </th>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><?= $post->getID() ?></td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>">
                        <?= e($post->getName()) ?>
                    </a>
                </td>
                <td><?= Post::getUName($post->getUserId()) ?></td>
                <td><?= $post->getCreatedAt()->format('d F Y ') ?></td>
                <td><?= $post->getValidated() ?></td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()]) ?>" class="btn btn-outline-warning">
                        Modifier
                    </a>
                    <form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiement effectuer cette action ?')" style="display:inline">
                        <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link); ?>
    <?= $pagination->nextLink($link); ?>
</div>