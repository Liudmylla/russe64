<?php

use App\Connection;
use App\Table\PostTable;
use App\Auth;

Auth::check();


$title = "Espace membre";
$pdo = Connection::getPDO();
$posts = (new PostTable($pdo))->allUserPosts($_SESSION['id_user']);
?>

<?php if (isset($_GET['deleted'])) : ?>
    <div class="alert alert-success">
        Votre annonce a bien été supprimé
    </div>
<?php endif ?>

<?php if (isset($_GET['created'])) : ?>
    <div class="alert alert-success">
        Votre annonce sera publiée dans les meilleurs délais
    </div>
<?php endif ?>

<?php if (isset($_GET['updated'])) : ?>
    <div class="alert alert-success">
        Votre annonce sera modifié dans les meilleurs délais
    </div>
<?php endif ?>
<div class="container mt-4">
    <h3 style="color:#DA4453; font-family:'Merriweather',serif;font-size:26px;"> Consultez la météo de la journée</h3>
    <p>Taper le nom de votre ville et cliquer sur le bouton " Météo" pour voir la météo actuelle</p>
    <form id="weather" class="mb-2">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="city" class="sr-only">ville</label>
                    <input type="text" class="form-control" id="city" value="Biarritz" placeholder="Ville
                        ">
                    <div class="invalid-feedback">Merci de renseigner une ville valide.</div>
                </div>
            </div>
            <div class="col-8">
                <button type="submit" class="btn btn-outline-primary">Meteo</button>
            </div>
        </div>
    </form>


    <div class="card mb-2" style="width: 18rem;">
        <div class="text-center">
            <img src="" class="image-weather " alt="" height="50" width="50">
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="card-text">
                <p class="description-weather"> </p>
                <p>
                    <strong>Température :</strong> <span class="temp-weather"></span><br />
                    <strong>Max :</strong> <span class="temp-max-weather"></span>
                    <strong>Min :</strong> <span class="temp-min-weather"></span>
                </p>
            </div>
        </div>

    </div>
    <h3 style="color:#DA4453; font-family:'Merriweather',serif;font-size:26px;">Déposez vos annonces </h3>
    <p>Pour créer votre annonce cliquer sur le bouton "Nouvelle annonce"</p>
    <table class="table">
        <thead>
            <!-- <th></th> -->
            <th>Titre d'annonce</th>
            <th>Date de création</th>
            <th>
                <a href="<?= $router->url('user_post_new', ['id_user' => $_SESSION['id_user']]) ?>" class="btn btn-outline-success">Nouvelle annonce</a>
            </th>

        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <!-- <td><?= $post->getID() ?></td> -->
                    <td>
                        <a href="<?= $router->url('user_post', ['id_user' => $_SESSION['id_user'], 'id' => $post->getID()]) ?>">
                            <?= e($post->getName()) ?>
                        </a>
                    </td>
                    <td><?= $post->getCreatedAt()->format('d F Y ') ?></td>
                    <td>
                        <a href="<?= $router->url('user_post', ['id_user' => $_SESSION['id_user'], 'id' => $post->getID()]) ?>" class="btn btn-outline-warning">
                            Modifier
                        </a>
                        <form action="<?= $router->url('user_post_delete', ['id_user' => $_SESSION['id_user'], 'id' => $post->getID()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiement effectuer cette action ?')" style="display:inline">
                            <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
     <script src=" https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?= ASSETS; ?>js/meteo.js"></script>