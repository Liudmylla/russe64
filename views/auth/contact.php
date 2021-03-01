<?php


if (isset($_POST['send'])) {

    if (isset($_POST['name']) and isset($_POST['email'])) {
     
        $name = $_POST['name'];
        $email = $_POST['email'];
        $content = $_POST['content'];
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $content = htmlspecialchars($content);
        $name = urldecode($name);
        $email = urldecode($email);
        $content = urldecode($content);
        $name = trim($name);
        $email = trim($email);
        $content = trim($content);
    }
    
    if ($name != " " && $email != " " && $content != " ") {

        $header = "Content-type:text/plain; charset = UTF-8\r\nFrom:$name <$email>"; 
       
        mail('info@russe64.fr', $name, $content, $header);
        session_start();
        $_SESSION['flash']['success'] = 'Merci d\'avoir pris le temps de nous contacter.Nous vous répondrons dans les plus brefs délais. ';
        header('Location:' . $router->url('home'));
        exit();
    }
}
?>
<div style="text-align: center">
    <h1 style="color:#DA4453;font-weight:400; font-family:'Merriweather',serif;font-size:22px;font-style:italic;">Nous contacter</h1>
    <form method="post" action="" class="postcard">
        <div class="form-row">
            <label for="name">Votre nom</label><input type="text" id="name" name="name" required>
        </div>
        <div class="form-row">
            <label for="email">Votre email</label><input type="text" id="email" name="email" required>
        </div>
        <div class="form-row">
            <label for="content">Votre message</label><textarea rows="5" id="content" name="content" required></textarea>
        </div>
        <div class="form-row">
            <input type="submit" name="send" value="Envoyer">
        </div>
        <a href="<?= $router->url('home') ?>">Revenir a l'accueil</a>
    </form>

</div>