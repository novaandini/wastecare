<?php

class DefaultApp extends BaseController {
    public function index() {
        $this->view('default/index');
    }
}