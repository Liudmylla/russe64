<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Auth;

Auth::check();


$title = "Géstion des catégories";
$pdo = Connection::getPDO();
$link = $router->url('admin_categories');
$items = (new CategoryTable($pdo))->all();
?>

<?php if (isset($_GET['delete'])) : ?>
    <div class="alert alert-success">
        La catégorie a bien été supprimé
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
    <thead>
        <th>N*</th>
        <th>Catégorie</th>
        <th>URL</th>
        <th>
            <a href="<?= $router->url('admin_category_new') ?>" class="btn btn-outline-primary">Nouvelle catégorie</a>
        </th>
    </thead>
    <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td>N*<?= $item->getID() ?></td>
                <td>
                    <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>">
                        <?= e($item->getName()) ?>
                    </a>
                </td>
                <td>
                    <?= $item->getSlug() ?>
                </td>
                <td>
                    <a href="<?= $router->url('admin_category', ['id' => $item->getID()]) ?>" class="btn btn-outline-warning">
                        Modifier
                    </a>
                    <form action="<?= $router->url('admin_category_delete', ['id' => $item->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiement effectuer cette action ?')" style="display:inline">
                        <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
