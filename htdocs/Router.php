<?php


class Router
{

    private $map_uri_controller;

    public function __construct()
    {
        $this->map_uri_controller = array();
        $json_file = file_get_contents("routes.json");
        $json = json_decode($json_file, true);
        foreach ($json as $route) {
            if(isset($route["path"]) && isset($route["controller"])){
                $this->map_uri_controller[$route["path"]] = $route["controller"];
            }
        }
    }

    public function process()
    {
        $uri = $_SERVER["REQUEST_URI"];
        if(isset($uri) && isset($this->map_uri_controller[$uri])) {
            $controller_method = $this->map_uri_controller[$uri];
            list($controller, $method) = explode("@", $controller_method, 2);
            $controller = "App\Controller\\" . $controller;
            (new $controller())->$method();
        }else {
            http_response_code(404);
            echo "404";
        }
    }
}