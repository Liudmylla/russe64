<?php

use App\Connection;
use App\Table\PostTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Auth;
use App\Table\CategoryTable;
use App\Attachment\PostAttachment;

Auth::check();

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable =new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;

$errors = [];

if (!empty($_POST)) {
   $data= array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $data, ['name', 'slug', 'content', 'created_at','image','validated']);
    if ($v->validate()) {
        $pdo->beginTransaction();
        PostAttachment::upload($post);
        $postTable->updatePostAdmin($post);
        $postTable->attachCategories($post->getID(),$_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
        $success = true;
        header('Location: ' . $router->url('admin_posts', ['id' => $post->getID()]) . '?updated=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
?>



<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        L'article n'a pas pu etre modifié, merci de corriger vos erreurs
    </div>
<?php endif ?>

<h1>Editer l'article <?= e($post->getName()) ?></h1>

<?php require('_form.php') ?>