<?php

class BaseController extends Filter {
    public function view($view, $data = []) {
        if (count($data)) {
            extract($data);
        }

        require_once '../src/views/'.$view.'.php';
    }

    protected function redirect($path)
    {
        header("Location: " . BASEURL . '/' . ltrim($path, '/'));
        exit;
    }


    public function model($model) {
        require_once '../src/models/'.$model.'.php';
        return new $model;
    }
}