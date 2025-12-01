<?php

class AdminServiceController extends BaseController {
    private $serviceModel;
    public function __construct()
    {
        $this->serviceModel = $this->model('ServiceModel');
    }

    public function index() {
        $data = [
            'title' => 'Service',
            'data' => $this->serviceModel->getAll()
        ];
        $this->view('admin/template/header');
        $this->view('admin/services/index', $data);
        $this->view('admin/template/footer');
    }

    public function create() {
        $data = [
            'title' => 'Create New Service'
        ];
        $this->view('admin/template/header');
        $this->view('admin/services/form', $data);
        $this->view('admin/template/footer');
    }

    public function store() {
        var_dump($_REQUEST);
        $fields = [
            'name' => 'string | required |',
            'user_id' => 'int',
            'harga' => 'float',
            'kategori' => 'string',
            'status' => 'int',
            'description' => 'string',
        ];

        $message = [
            'name'
        ];
        [$inputs] = $this->filter($_POST, $fields, $message);
    }
}