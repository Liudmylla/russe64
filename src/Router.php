<?php

namespace App;



use App\Security\ForbiddenException;



class Router {

    /**

     * @var string

     * dirname(__DIR__) . '/views'

     */

    private $viewPath;

/**

 * @var AltoRouter

 */

    private $router;



    public function __construct(string $viewPath){

        $this->viewPath =$viewPath;

        $this->router= new \AltoRouter();

    }

    public function get(string $url, string $view,?string $name = null):self

    {

        $this->router->map('GET',$url,$view,$name);

        return $this;

    }

    public function post(string $url, string $view, ?string $name = null): self

    {

        $this->router->map('POST', $url, $view, $name);

        return $this;

    }

    public function match(string $url, string $view, ?string $name = null): self

    {

        $this->router->map('GET|POST', $url, $view, $name);

        return $this;

    }



    public function url (string $name, array $params=[])

    {

        return $this->router->generate($name,$params);

    }



    public function run ():self

    {



        $match = $this->router->match();

  

        $view= $match['target'];

      

        $params= $match['params'];

      

        $router= $this;

      

        $isAdmin= strpos($view, 'admin/') !== false;

        $isUser =strpos($view, 'user/') !== false;

        if(!$isAdmin && !$isUser){

            $layout =  'layouts/default';

        }

        if($isUser){

            $layout = 'user/layouts/default';

        }

        if ($isAdmin) {

            $layout = 'admin/layouts/default';

        }

        try{

            ob_start();

            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';

           

            $content = ob_get_clean();

            

            

            require $this->viewPath . DIRECTORY_SEPARATOR . $layout . '.php';

        } catch (ForbiddenException $e) {

            header('Location: ' . $this->url('login') . '?forbidden=1');

            die();

        }

        return $this;

        

    }

}