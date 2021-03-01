<form action="" method="POST">
    <?= $form->input('username', 'username'); ?>
    <?= $form->input('password', 'password'); ?>
    <button class="btn btn-primary">
        <?php if ($item->getIdUser() !== null) : ?>
            Modifier
        <?php else : ?>
            Créer
        <?php endif ?>
    </button>
</form>