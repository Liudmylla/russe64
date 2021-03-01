<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>

<html lang="fr" class="h-100">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="reply-to" content="info@russe64.fr">
    <meta name="date" content="Apr 19 2020 10:12 GMT">
    <meta name="author" content="Liudmyla Duvivier">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="keywords" content="les amis de la culture russe de la ville de Biarritz,les amis de la culture russe,les amis de la culture russe à Biarritz,russe64,sport,danse,danse russe,cours de russe Biarritz, langue russe, cours de russe, centre de la langue russe, soirée russe, les russes a Biarritz, traduction en russe, accompagnement des groupes en russe, enseignement en russe, traduction en russe, soutient scolaire en russe, formation en russe, voyage associatif en Russie ">

    <meta name="description" content="Site de l'association Les amis de la culture russe à Biarritz">

    <title><?= isset($title) ? e($title) : 'Les amis de la culture russe à Biarritz' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="<?= ASSETS; ?>images/kokoshnikFinal.png" />
    <link rel="stylesheet" href="<?= ASSETS; ?>css/form.css">
    <link rel="stylesheet" href="<?= ASSETS; ?>css/login.css">
</head>

<body class="d-flex flex-column ">
    <div class=" d-flex flex-row justify-content-center align-items-center " style=" background: center url('<?= ASSETS; ?>images/base.jpg')">
        <div class="p-2 pb-4">
            <img src="<?= ASSETS; ?>images/logo.png" width=35% alt="Logo">
        </div>
        <div class="p-2  ">
            <h1 style="color:#DA4453;font-style:italic; font-family:'Merriweather',serif;font-size:26px;"><span style="font-size:14px;">L'association </span> « LES AMIS DE LA CULTURE RUSSE » </h1>
        </div>
        <div class="p-2  ">
            <a href="<?= $router->url('home') ?>" title="Accueil">
                <img src="<?= ASSETS; ?>images/kremlin40.png" alt="Home">
            </a>
        </div>
        <div class="p-2  ">
            <a href="<?= $router->url('contact') ?>" title="Contact">
                <img src="<?= ASSETS; ?>images/kokoshnik40.png" alt="Espace membre" />
            </a>
        </div>
        <div class="p-2 ">
            <a href="<?= $router->url('login') ?>" title="Se connecter">
                <button class="btn btn-outline-primary p-1 ">Login</button>
            </a>
        </div>
        <div class="p-2  ">
            <a href="<?= $router->url('register') ?>" title="S'inscrire">
                <button class="btn btn-outline-primary p-1 ">Join us</button>
            </a>
        </div>
    </div>
    <div class="container mt-2" style="text-align: center">

        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class=" alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
    </div>
    <div class="container mt-4">
        <?= $content ?>

    </div>

    <footer class="bg-light py-4 footer " style="margin-top:250px; background: no-repeat top url('<?= ASSETS; ?>images/base.jpg')">

        <div class="container ">
            L'association "Les amis de la culture russe" de la ville de Biarritz.

            Président: <a href="https://www.linkedin.com/in/nina-eugénie-missan-78b658b4/" target="_blank">Nina-Eugénie Missan</a>
        </div>
        <div class="container ">

            Contact: <a href="<?= $router->url('contact') ?>" title="Contact" target="_blank">info@russe64.fr</a>
            Site internet <a href="<?= $router->url('home') ?>">russe64.fr</a> Réalisé par

            <a href="https://www.linkedin.com/in/liudmyla-duvivier-05570b15a/" target="_blank">Liudmyla Duvivier</a>

            2019 - 2020
        </div>

        <!-- <div class="container">

            <?php if (defined('DEBUG_TIME')) : ?>

                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms.

            <?php endif ?>

        </div> -->

    </footer>

</body>

</html>