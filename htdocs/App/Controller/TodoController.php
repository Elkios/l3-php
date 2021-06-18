<?php

namespace App\Controller;

class TodoController extends AbstractController
{

    public function view()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos');

        if($response->getStatusCode() != 200) {
            new \Exception("Failed to call API");
        }

        $todos = json_decode($response->getBody()->getContents());
        $this->render("todos/view.phtml", ['pageName' => 'Todo List', "todos" => $todos]);
    }

}