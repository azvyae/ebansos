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

    public function runMethod($object, $method, $args)
    {
        if (method_exists($object, $method)) {
            if (is_bool($args[0] ?? false) && (($args[0] ?? false) == true)) {
                return true;
            } else {
                call_user_func_array([$object, $method], $args);
            }
        } else {
            return false;
        }
    }

    public function __call($name, $arg)
    {
        if ($name == 'setSession') {
            switch (count($arg)) {
                case 5:
                    if (end($arg)) {
                        if ($arg[2] != null) {
                            setcookie('rw', $arg[2], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        }
                        if ($arg[3] != null) {
                            setcookie('rt', $arg[3], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        }
                        setcookie('nama', $arg[0], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        setcookie('tipeAkun', $arg[1], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                    } else {

                        if ($arg[2] != null) {
                            $_SESSION['user']['rw'] = $arg[2];
                        }
                        if ($arg[3] != null) {
                            $_SESSION['user']['rt'] = $arg[3];
                        }
                        $_SESSION['user']['nama'] = $arg[0];
                        $_SESSION['user']['tipeAkun'] = $arg[1];
                    }
                    break;
                default:
                    header('Location: ' . BASEURL);
                    break;
            }
        }

        header('Location: ' . BASEURL);
    }
}
