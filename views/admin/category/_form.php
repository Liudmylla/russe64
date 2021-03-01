<form action="" method="POST">
    <?= $form->input('name', 'Titre'); ?>
    <?= $form->input('slug', 'URL'); ?>
    <button class="btn btn-outline-primary">
        <?php if ($item->getID() !== null) : ?>
            Editer
        <?php else : ?>
            Créer
        <?php endif ?>
    </button>
  
        <a href="<?= $router->url('admin_categories') ?>">Revenir à la liste des categories</a>
    
</form>