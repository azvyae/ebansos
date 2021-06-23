<?php

namespace APP\core;

class App
{
    protected $controller = 'Beranda';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $url = $this->parseURL();

        // Check if controller class exist
        if (isset($url[0])) {
            if (file_exists("../". APP ."/controllers/{$url[0]}.php")) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'ErrorPage';
            }
        }

        require_once "../". APP . "/controllers/{$this->controller}.php";
        $this->controller = new $this->controller;

        // Check if method in that controller exist
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Check if parameter is exist
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
