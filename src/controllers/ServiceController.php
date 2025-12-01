<?php

class ServiceController extends BaseController {
    public function index() {
        $this->view('services/index');
    }

    public function detail() {
        $this->view('services/detail');
    }
}