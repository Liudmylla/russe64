 <?php

    use App\Connection;

    use App\Table\UserTable;


    if (!empty($_POST) && !empty($_POST['email'])) {
        $pdo = Connection::getPDO();
        $req = $pdo->prepare('SELECT * FROM user WHERE email = ?
        --  AND confirmed_at IS NOT NULL'
         );
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            session_start();
            $reset_token = UserTable::str_random(60);
            $id_user = $user[0];
            $pdo->prepare('UPDATE user SET reset_token = ?, reset_at = NOW() WHERE id_user = ?')->execute([$reset_token, $user[0]]);
            $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par email';
            mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://russe64.fr/reset?id=$id_user&token=$reset_token");
            header('Location:' . $router->url('login'));
            exit();
    }else{
            session_start();
            $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse email';
            header('Location:' . $router->url('login'));
            exit();
    }
}
    ?>
 <div style="text-align: center">
         <h1 style="color:#DA4453;font-weight:400; font-family:'Merriweather',serif;font-size:22px;font-style:italic;">Mot de passe oublié</h1>
         <form action="" method="POST" class='postcard'>
             <div class="form-row">
                 <label for="email">Votre email</label><input type="email" id="email" name="email" required>
             </div>
             <div class="form-row">
                 <input type="submit" name="send" value="Envoyer">
             </div>
         </form>
 </div>