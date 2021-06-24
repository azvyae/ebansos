<?php

namespace APP\core;

class Controller
{
    private $condition = 0;

    public function view(String $view, array $data = [])
    {
        require_once "../". APP ."/views/{$view}.php";
    }
    public function model($model)
    {
        require_once "../". APP ."/models/{$model}.php";
        return new $model;
    }
    // Check if user and tipe user cookie exist
    public function valid($data) 
    {
        if (isset($data['userId'])) {
            if(isset($data['tipeAkun'])) {
                if ($data['tipeAkun'] == 1) {
                    $this->condition = 1;
                } else if ($data['tipeAkun'] == 2) {
                    $this->condition = 2;
                }
            }
        }
        return $this->condition;
    }
}
