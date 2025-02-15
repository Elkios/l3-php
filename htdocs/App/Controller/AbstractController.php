<?php


namespace App\Controller;


abstract class AbstractController
{

    const TEMPLATE_PATH = "/templates/";

    function render(String $template, array $args = [])
    {
        extract($args);
        include_once(BASE_DIR . self::TEMPLATE_PATH . $template);
    }

}