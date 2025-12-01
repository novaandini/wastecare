<?php

class LoginController extends BaseController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function index() {
        $data = [
            'title' => 'Login'
        ];
        $this->view('login/index', $data);
    }

    public function verify() {
        
    }
}