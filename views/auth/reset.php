<?php

use App\Connection;

if (isset($_GET['id']) && isset($_GET['token'])) {
    $pdo = Connection::getPDO();
    $req = $pdo->prepare('SELECT * FROM user WHERE id_user = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if ($user) {
        if (!empty($_POST)) {
            $errors = [];
            if (empty($_POST['password'])||
                $_POST['password'] != $_POST['password_confirm']
               || !preg_match('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,50})/', $_POST['password'])
            ) { 
                $errors['password'] = "Votre password n'est pas valide: 
        merci d'utilizer minimum 8 caractères : 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial";
            }  
            if(empty($errors)) 
            {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE user SET password = ?, reset_at = NULL, reset_token = NULL WHERE id_user= ?')->execute([$password, $user[0]]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                header('Location: ' . $router->url('login'));
                die();
            }
        }
    } else {
        session_start();
        $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
        header('Location:' . $router->url('login'));
        die();
    }
} else {
    header('Location:' . $router->url('home'));
    die();
}
?>
<div style="text-align: center">
    <h1 style="color:#DA4453;font-weight:400; font-family:'Merriweather',serif;font-size:22px;font-style:italic;">Mot de passe oublié</h1>
  <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <p>Votre mot de passe n'a pas pu etre enregistré, merci de corriger vos erreurs </p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="" method="POST" class="postcard">
        <div class="form-row">
            <label for="password">Votre nouveau mot de passe</label><input type="password" id="password" name="password" required>
        </div>
        <div class="form-row">
            <label for="password_confirm">Confirmer votre nouveau mot de passe</label><input type="password" id="password_confirm" name="password_confirm" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Confirmer</button>
    </form>
</div>