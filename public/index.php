<?php



require '../vendor/autoload.php';

error_reporting(0);



define('DEBUG_TIME', microtime(true));

define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');



define('ASSETS', 'https://russe64.fr/public/assets/');







//$whoops = new \Whoops\Run;

//$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

//$whoops->register();



if (isset($_GET['page']) && $_GET['page'] === '1') {

    // réécrir l'url sans le param ?page

    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

    $get = $_GET;

    unset($get['page']);

    $query = http_build_query($get);



    if (!empty($query)) {

        $uri = $uri . '?' . $query;

    }

    http_response_code(301);

    header('Locaion:' . $uri);

    exit();

}



$router = new App\Router(dirname(__DIR__) . '/views');

$router

    ->get('/', 'post/index', 'home')
    ->match('/contact', 'auth/contact', 'contact')

    ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')

    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')

    ->match('/login','auth/login','login')

    ->match('/register','auth/register','register')
    ->match('/confirme','auth/confirme','confirme')
    ->match('/forget','auth/forget','forget')
    ->match('/reset','auth/reset','reset')

    ->post('/logout','auth/logout','logout')



    //ADMIN

    //Gestion des articles

    ->get('/admin', 'admin/post/index', 'admin_posts')

    ->match('/admin/post/[i:id]', 'admin/post/edit', 'admin_post')

    ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin_post_delete')

    ->match('/admin/post/new', 'admin/post/new', 'admin_post_new')

    //Gestion des catégories

    ->get('/admin/categories', 'admin/category/index', 'admin_categories')

    ->match('/admin/category/[i:id]', 'admin/category/edit', 'admin_category')

    ->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin_category_delete')

    ->match('/admin/category/new', 'admin/category/new', 'admin_category_new')

    //Gestion des utilisateurs

    ->get('/admin/users', 'admin/users/index', 'admin_users')

    ->match('/admin/users/[i:id]', 'admin/users/edit', 'admin_user')

    ->post('/admin/users/[i:id]/delete', 'admin/users/delete', 'admin_user_delete')

    ->match('/admin/users/new', 'admin/users/new', 'admin_user_new')



    //USER

    //Gestion des articles

    ->get('/user/[i:id_user]', 'user/post/index', 'user_posts')

    ->match('/user/[i:id_user]/post/[i:id]', 'user/post/edit', 'user_post')

    ->post('/user/[i:id_user]post/[i:id]/delete', 'user/post/delete', 'user_post_delete')

    ->match('/user/[i:id_user]post/new', 'user/post/new', 'user_post_new')

    ->run();

