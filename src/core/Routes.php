<?php

class Routes{
    public function run() {
        $router = new App();
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        $router->get('barang', ['Barang', 'index']);

        $router->run();
    }
}