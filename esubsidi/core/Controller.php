<?php

namespace APP\core;

class Controller
{
    public function view(String $view, array $data = [])
    {
        require_once "../". APP ."/views/{$view}.php";
    }
    public function model($model)
    {
        require_once "../". APP ."/models/{$model}.php";
        return new $model;
    }
}
