<?php

class AboutController extends BaseController {
    public function index() {
        $this->view('template/header');
        $this->view('about/index');
        $this->view('template/footer');
    }
}