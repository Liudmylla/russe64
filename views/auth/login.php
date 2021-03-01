 <?php

     use App\Connection;
     use App\Model\User;
     use App\HTML\Form;
     use App\Table\Exception\NotFoundException;
    use App\Table\UserTable;

  $user = new User();

     $errors = [];
     if (!empty($_POST)) {
         $user->setUsername($_POST['username']);
         $errors['password'] = 'Identifiant ou mot de passe incorrect';
         if (!empty($_POST['username']) && !empty($_POST['password'])) {
             $table = new UserTable(Connection::getPDO());

             try {
                 $u = $table->findByUsername($_POST['username']);
                if (password_verify($_POST['password'], $u->getPassword()) === true) {
                     session_start();
                     $_SESSION['auth'] = $u->getUsername();
                     $_SESSION['id_user'] = $u->getIdUser();
                     if ($_SESSION['auth'] !== 'admin') {
                         header('Location: ' . $router->url('user_posts', ['id_user' => $_SESSION['id_user']]));
                         die();
                     }
                     if ($_SESSION['auth'] === 'admin') {
                         header('Location: ' . $router->url('admin_posts'));
                         die();
                    }
                 };
             } catch (NotFoundException $e) {
             }
        }
     }

     $form = new Form($user, $errors);
    // if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    //     $pdo= Connection::getPDO();
    //     $req = $pdo->prepare('SELECT * FROM user WHERE (username = :username OR email = :username)
    //     --  AND confirmed_at IS NOT NULL'
    //      );
    //     $req->execute(['username' => $_POST['username']]);
    //     $user = $req->fetch();
    //     dd($user);
    //     if ($user == null) {
    //         $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    //     } elseif (password_verify($_POST['password'], $user->password)) {
    //         $_SESSION['auth'] = $user;
    //         dd($user);
    //         $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
    //         header('Location: ' . $router->url('user_posts', ['id_user' => $_SESSION['id_user']]));
    //         exit();
    //     } else {
    //         $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    //     }
    // }
    ?>
 <?php if (isset($_GET['forbidden'])) : ?>
     <div class="alert alert-danger">
         Vous ne pouvez pas accéder à cette page
     </div>
 <?php endif ?>


 <div id="container">
     <div id="wrapper">
         <div id="login" class="animate form">
             <form action="" method="POST">
                 <h1>Se connecter</h1>
                 <p>
                     <?= $form->input('username', 'Votre pseudo ou email', 'my_pseudo ou mymail@gmail.com'); ?>
                 </p>
                 <p>
                     <?= $form->input('password', 'Votre mot de passe', 'ex. Min8car!'); ?>
                 </p>
                 <p class="keeplogin">
                     <a href="<?= $router->url('forget') ?>">J'ai oublié mon mot de passe</a>
                 </p>
                 <p class="login button">
                     <input type="submit" value="Se connecter" />
                 </p>
                 <p class="change_link">
                     Vous étes nouveau ici?
                     <a href="<?= $router->url('register') ?>" class="to_register">Inscrivez-vous</a>
                 </p>
             </form>
         </div>
     </div>
 </div> 
