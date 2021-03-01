<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Model\Post;
use App\Auth;
use App\Attachment\PostAttachment;

Auth::check();


$errors = [];
$post = new Post();
$pdo = Connection::getPDO();
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post->setCreatedAt(date('Y-m-d H:i:s'));
$post->setSlug(PostTable::str_random(5));
$post->setUserId($_SESSION['id_user']);
if (!empty($_POST)) {

    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $data, ['name', 'slug', 'content', 'created_at', 'image']);

    if ($v->validate()) {
        $pdo->beginTransaction();
        PostAttachment::upload($post);
        $postTable->createPost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        header('Location: ' . $router->url('user_posts', ['id_user' => $_SESSION['id_user'], 'id' => $post->getID()]) . '?created=1');
        exit();
    } else {
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
?>


<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        L'annonce n'a pas pu etre enregistré, merci de corriger vos erreurs
    </div>
<?php endif ?>

 <h1 style="color:#DA4453; font-family:'Merriweather',serif;font-size:28px;">Créer une annonce </h1> 

<?php require('_form.php') ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
        <script>
        $('select').select2();
        </script> 