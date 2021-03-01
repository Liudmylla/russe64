<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

if (!empty($_POST)) {
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields);
    if ($v->validate()) {
        $table->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug()
        ], $item->getID());
        $success = true;
        // header('Location: ' . $router->url('admin_posts', ['id' => $post->getID()]) . '?updated=1');
        //exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($item, $errors);
?>
<?php if (($success)) : ?>
    <div class="alert alert-success">
        La catégorie a bien été modifié
    </div>
<?php endif ?>

<?php if (isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        La catégorie a bien été créé
    </div>
<?php endif ?>


<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        La catégorie n'a pas pu etre modifié, merci de corriger vos erreurs
    </div>
<?php endif ?>

<h1>Editer la catégorie <?= e($item->getName()) ?></h1>

<?php require('_form.php') ?>