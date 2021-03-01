<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre de votre annonce *'); ?>
    <div class="row">
        <div class="col-md-9 ">
            <?= $form->file('image', 'Vous pouvez télécharger une image en format png,jpeg ou jpg'); ?>
        </div>
        <div class="col-md-3 ">
            <?php if ($post->getImage()) : ?>
                <img src="<?= $post->getImageURL('small') ?>" alt="image" style="width: 100%;">
            <?php endif ?>
        </div>
    </div>
    

    <?= $form->textarea('content', 'Contenu de votre annonce *'); ?>

    <div hidden><?= $form->input('created_at', 'Date de création'); ?></div>
    <div hidden> <?= $form->input('slug', 'Slug'); ?></div>
   <div><?= $form->select('categories_ids', 'Choisissez une ou plusieurs catégorie(s) *', $categories); ?></div>
    <button class="btn btn-outline-success ">
        <?php if ($post->getID() !== null) : ?>
            Modifier
        <?php else : ?>
            Confirmer
        <?php endif ?>
    </button>
    <a href="<?= $router->url('user_posts', ['id_user' => $_SESSION['id_user']]) ?>">Annuler</a>
</form>