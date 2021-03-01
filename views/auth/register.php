<?php

use App\Connection;
use App\Table\UserTable;


$pdo = Connection::getPDO();

if (!empty($_POST)) {
    $errors = [];

    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        $sql = $pdo->prepare("SELECT id_user from user WHERE username = ?");
        $sql->execute([$_POST['username']]);
        $user = $sql->fetch();
        if ($user) {
            $errors['username'] = 'Ce pseudo est deja pris';
        }
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $sql = $pdo->prepare("SELECT id_user from user WHERE email = ?");
        $sql->execute([$_POST['email']]);
        $user = $sql->fetch();
        if ($user) {
            $errors['email'] = 'Cet email est deja utilisé pour un autre compte';
        }
    }
    // regex validation password:1 minuscule 1 majuscule 1 chiffre 1 caractère spécial mini 6 caractères /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,50})/
    if (
        empty($_POST['password'])
        || !preg_match('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,50})/', $_POST['password'])
        || $_POST['password'] != $_POST['password_confirm']
    ) {
        $errors['password'] = "Votre password n'est pas valide: 
        merci d'utilizer minimum 8 caractères : 1 minuscule, 1 majuscule, 1 chiffre, 1 caractère spécial";
    }

    if (empty($errors)) {

       
        $req = $pdo->prepare("INSERT INTO user SET username = ?, password=?,email=?,confirmation_token=?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = UserTable::str_random(60);
        $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
        session_start();
        
        $id_user = $pdo->lastInsertId();
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien:  https://russe64.fr/confirme?id=$id_user&token=$token");
        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location:'. $router->url('login'));
        exit();
    } 
}
?>
<div style="text-align: center">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <p>Votre compte n'a pas pu etre enregistré, merci de corriger vos erreurs </p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<div id="container">
    <div id="wrapper">
        <div id="login" class="animate form">
            <form action="" method="POST">
                <h1> S'inscrire </h1>
                <p>
                    <label for="username" class="uname">Pseudo</label>
                    <input id="username" name="username" required="required" type="text" placeholder="my_username1">
                </p>
                <p>
                    <label for="email" class="youmail"> E-mail</label>
                    <input id="email" name="email" required="required" type="email" placeholder="mymail@mail.com">
                </p>
                <p>
                    <label for="password" class="youpasswd">Choisissez votre mot de passe </label>
                    <input id="password" name="password" required="required" type="password" placeholder="ex. Min8car!">
                </p>
                <p>
                    <label for="password_confirm" class="youpasswd">Confirmez votre mot de passe </label>
                    <input id="password_confirm" name="password_confirm" required="required" type="password" placeholder="eg. Min8car!">
                </p>
                <p class="login button">
                    <input type="submit" onsubmit="return confirm('Merci de vérifier votre email')" value="S'inscrire">
                </p>
                <p class="change_link">
                    Déjà inscrit?
                    <a href="<?= $router->url('login') ?>">Connectez-vous ici</a>
                </p>
            </form>
        </div>
    </div>
</div>