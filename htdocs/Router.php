<?php


class Router
{

    /*
     *
     * Todo :
     * exemple 1 : http://local.project.com/
     *
     * $uri = /
     *
     * exemple 2 : http://local.project.com/catalog
     *
     * $uri = /catalog
     *
     *
     * exemple 3 : http://local.project.com/catalog
     *
     * $uri = catalog/product
     *
     *
     * mapping entre $uri et routes.json
     * ( prévoir route non connu => 404
     *
     * -> instance controller de la route avec appel de la méthode
     *
     *
     */

    private $map_uri_controller;

    public function __construct()
    {
        $this->map_uri_controller = array();
        $json_file = file_get_contents("routes.json");
        $json = json_decode($json_file, true);
        foreach ($json as $key => $value) $this->map_uri_controller[$value["path"]] = $value["controller"];
    }


    public function process()
    {
        $uri = $_SERVER["REQUEST_URI"];
        if($uri != NULL && isset($this->map_uri_controller[$uri])) {
            $controller_method = $this->map_uri_controller[$uri];
            list($controller, $method) = explode("@", $controller_method, 2);
            echo call_user_func_array(array('App\Controller\\' . $controller, $method), array());
        }else {
            http_response_code(404);
            echo "404";
        }

    }

}