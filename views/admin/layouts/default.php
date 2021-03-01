<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? e($title) : 'Espace admin' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="<?= ASSETS; ?>images/kokoshnikFinal.png" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <nav class=" navbar-brand ">Espace admin</nav>
            <ul class=" navbar-nav">
                <li class="nav-item">
                    <a href="<?= $router->url('admin_posts') ?>" class="nav-link">Annonces</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->url('admin_categories') ?>" class="nav-link">Catégories</a>
                </li>
                <li class="nav-item">
                    <a href="<?= $router->url('admin_users') ?>" class="nav-link">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <form action="<?= $router->url('logout') ?>" method="post" style="display:inline">
                        <button type="submit" class="nav-link" style="background:transparent; border:none;">Se déconnecter</button>
                    </form>
                </li>
            </ul>
        </nav>
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
            Site internet <a href="<?= $router->url('home') ?>" target="_blank">russe64.fr</a> Réalisé par

            <a href="https://www.linkedin.com/in/liudmyla-duvivier-05570b15a/" target="_blank">Liudmyla Duvivier</a>

            2019 - 2020
        </div>
    </footer>
</body>

</html>