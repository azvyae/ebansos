<?php

namespace Esubsidi\core;

class Controller
{
    private $condition = 0;

    public function view(String $view, array $data = [])
    {
        require_once "../esubsidi/views/{$view}.php";
    }
    public function model($model)
    {
        require_once "../esubsidi/models/{$model}.php";
        return new $model;
    }
    // Check if user and tipe user cookie exist
    public function valid($data)
    {
        if (isset($data['tipeAkun'])) {
            if ($data['tipeAkun'] == hash('sha256', 1)) {
                $this->condition = 1;
            } else if ($data['tipeAkun'] == hash('sha256', 2)) {
                $this->condition = 2;
            } else if ($data['tipeAkun'] == hash('sha256', 3)) {
                $this->condition = 3;
            }
        }

        return $this->condition;
    }
}
