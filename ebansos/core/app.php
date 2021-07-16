<?php

namespace Ebansos\core;

class App
{
    protected $controllerFile = 'beranda';
    protected $controller = 'beranda';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->initializeSession();
        $url = $this->parseURL();
        // Check if controller class exist
        if (isset($url[0])) {
            if (file_exists("../ebansos/controllers/{$url[0]}.php")) {
                $this->controllerFile = $this->controller = $url[0];
                unset($url[0]);
                require_once "../ebansos/controllers/{$this->controllerFile}.php";
                if (isset($_SESSION['user']) && class_exists($this->controller . 'Auth')) {
                    $this->controller .= 'Auth';
                }
            } else {
                $this->handlingErrorPage('404');
            }
        }
        $this->prepareController();

        // Check if method in that controller exist
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
            } else {
                $this->handlingErrorPage('404');
                $this->prepareController();
            }
            unset($url[1]);
        }

        // Check if parameter is exist
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = strtolower($_GET['url']);
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    public function initializeSession()
    {
        if (!session_id()) {
            session_start();
        }

        // COOKIES ARE DISABLED
        // if (isset($data['nama']) && isset($data['tipeAkun'])) {
        //     if ($data['tipeAkun'] == hash('sha256', 1)) {
        //         $_SESSION['user']['rw'] = $data['rw'];
        //         $_SESSION['user']['rt'] = $data['rt'];
        //     } else if ($data['tipeAkun'] == hash('sha256', 2)) {
        //         $_SESSION['user']['rw'] = $data['rw'];
        //     }
        //     $_SESSION['user']['nama'] = $data['nama'];
        //     $_SESSION['user']['tipeAkun'] = $data['tipeAkun'];
        //     unset($_COOKIE['tipeAkun']);
        // }
    }

    public function handlingErrorPage($data)
    {
        $this->controller = $this->controllerFile = 'errorpage';
        $this->method = 'error' . $data;
    }

    public function prepareController()
    {
        require_once "../ebansos/controllers/{$this->controllerFile}.php";
        if (isset($_SESSION['user']) && class_exists($this->controller . 'Auth')) {
            $this->controller .= 'Auth';
        }
        $this->controller = new $this->controller;
    }
}
