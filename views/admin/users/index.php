<?php



use App\Connection;

use App\Table\UserTable;

use App\Auth;



Auth::check();





$title = "Géstion des utilisateurs";

$pdo = Connection::getPDO();

$items = (new UserTable($pdo))->allUsers();



?>



<?php if (isset($_GET['delete'])) : ?>

    <div class="alert alert-success">

        L'utilisateur a bien été supprimé

    </div>

<?php endif ?>








<table class="table">

    <thead style="font-size:18px;">

        <th>Id</th>

        <th>Pseudo</th>

     

        <th>Email</th>

    </thead>

    <tbody>

        <?php foreach ($items as $item) : ?>

            <tr>

                <td><?= $item->getIdUser() ?></td>

                <td><?= e($item->getUserName()) ?></td>

             

                <td><?= $item->getEmail() ?></td>

                <td>

                    <form action="<?= $router->url('admin_user_delete', ['id' => $item->getIdUser()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiement effectuer cette action ?')" style="display:inline">

                        <button type="submit" class="btn btn-outline-danger">Supprimer</button>

                    </form>

                </td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>