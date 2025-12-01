<?php

class Routes{
    public function run() {
        $router = new App();
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        $router->get('index', ['HomeController', 'index']);
        $router->get('about', ['AboutController', 'index']);
        $router->get('services', ['ServiceController', 'index']);
        $router->get('service/detail', ['ServiceController', 'detail']);

        $router->get('login', ['LoginController', 'index']);
        $router->post('login/verify', ['LoginController', 'verify']);

        $router->get('manage_services', ['AdminServiceController', 'index']);
        $router->get('manage_services/create', ['AdminServiceController', 'create']);
        $router->post('manage_services/store', ['AdminServiceController', 'store']);

        $router->run();
    }
}