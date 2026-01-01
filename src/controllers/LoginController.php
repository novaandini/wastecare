<?php

class LoginController extends BaseController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }


    public function verify() {
        
    }
}