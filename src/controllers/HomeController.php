<?php

class HomeController extends BaseController {
    private $serviceModel;
    public function __construct()
    {
        $this->serviceModel = $this->model('ServiceModel');
    }

    public function index() {
        $data = [
            'services' => $this->serviceModel->getAll(),
        ];
        $this->view('home/index', $data);
    }
}