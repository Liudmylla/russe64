<?php

use App\Model\Post;


$categories = [];
foreach ($post->getCategories() as $category) {
    $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    $categories[] = <<<HTML
 <a href="{$url}" >{$category->getName()}</a>
HTML;
}
?>

<?php if ($post->getValidated()) : ?>
    <div class="card mb-3">
        <?php if ($post->getImage()) : ?>
            <img src="<?= $post->getImageURL('small') ?>" class="card-img-top">
        <?php endif ?>
        <div class="card-body">
            <h5 style="text-transform:uppercase;color:#DA4453;font-family:Merriweather;font-size:18px;" class="card-title "><?= e($post->getName()) ?></h5>
            <p class="text-muted">
                <strong> Created</strong> : le
                <?= $post->getCreatedAt()->format('d F Y ') ?>
            </p>
            <p class="text-muted"> <?php if (!empty($post->getCategories())) : ?>
                    <strong> Catégory</strong>:
                    <?= implode(', ', $categories) ?>
                <?php endif ?>
            </p>
            <p class="text-muted"> <strong>Créé par :</strong>
                <?= Post::getUName($post->getUserId()) ?>
            </p>
            <p><?= $post->getExcerpt() ?></p>
            <p>
                <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-outline-primary">Voir plus</a>
            </p>
        </div>
    </div>
<?php endif ?>
<?php if (!($post->getValidated())) : ?>
    <div class="card mb-3 ">
        <div style="text-align:center;" class="card-body ">
            <img src=" <?= ASSETS ?>images/beauteFinal.png"> </div>
        <div style="text-transform:uppercase;color:#DA4453;font-family:Merriweather;font-size:18px;text-align:center;" class="card-body ">
            L'annonce est en attente de modération.
        </div>
    </div>
<?php endif ?>
<script src=" https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script>
    (function() {
        var maxHeight = 0;
        $('.card').each(function() {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });
        $('.card').each(function() {
            $(this).css('min-height', maxHeight);
        });
    })();
</script>