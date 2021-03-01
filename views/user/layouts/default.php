<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? e($title) : 'Les amis de la culture russe' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css">
    <link rel="shortcut icon" type="image/png" href="<?= ASSETS; ?>images/kokoshnikFinal.png" />
</head>

<body>

    <div class="container  mt-2 mb-2">

        <div class=" d-flex flex-row bd-highlight justify-content-between ">
         <!-- style=" background: no-repeat top url('<?= ASSETS; ?>images/base@2x.jpg')"> -->

            <div class="p-2 bd-highlight ">

                <h1 style="text-transform:capitalize;color:#DA4453; font-family:'Merriweather',serif;font-size:36px;">Bienvenue <?= $_SESSION['auth']; ?></h1>

            </div>
            <div class="p-2 bd-highlight ">
                <form action="<?= $router->url('logout') ?>" method="post" onsubmit="return confirm('Voulez vous vraiement se déconnecter ?')">
                    <button class="btn btn-outline-primary mt-1" type="submit">Se déconnecter</button>
                </form>

            </div>

        </div>

    </div>
    <div class="container mt-4">
        <?= $content ?>

    </div>

    <footer class="container mb-0" style="margin-top:330px;">
   

        <div class="p-1">
            L'association "Les amis de la culture russe" de la ville de Biarritz.

            Président: <a href="https://www.linkedin.com/in/nina-eugénie-missan-78b658b4/" target="_blank">Nina-Eugénie Missan</a>
        </div>

        <div class="p-1  ">
            Contact: <a href="<?= $router->url('contact') ?>" title="Contact" target="_blank">info@russe64.fr</a>
            Site internet <a href="<?= $router->url('home') ?>" target="_blank">russe64.fr</a> Réalisé par

            <a href="https://www.linkedin.com/in/liudmyla-duvivier-05570b15a/" target="_blank">Liudmyla Duvivier</a>

            2019 - 2020
        </div>
    </footer>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>

</html>