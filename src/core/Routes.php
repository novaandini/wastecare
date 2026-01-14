<?php

class Routes {
    public function run() {
        $router = new App();
        $router->setDefaultController('DefaultApp');
        $router->setDefaultMethod('index');

        // Public routes
        $router->get('', ['HomeController', 'index']);
        $router->get('about', ['AboutController', 'index']);
        $router->get('services', ['ServiceController', 'index']);
        $router->post('service/subscribe', ['ServiceController', 'subscribe']);
        $router->get('service/detail/(:id)', ['ServiceController', 'detail']);

        $router->get('login', ['AuthController', 'login_form']);
        $router->post('login/verify', ['AuthController', 'verify_login']);

        $router->get('user/register', ['AuthController', 'user_form']);
        $router->post('register/store', ['AuthController', 'user_register']);

        $router->get('institution/register', ['AuthController', 'institution_form']);
        $router->post('institution/register/store', ['AuthController', 'institution_register']);
        
        $router->get('subscription', ['SubscriptionController', 'index']);
        $router->get('subscription/detail/(:id)', ['SubscriptionController', 'detail']);

        $router->get('logout', ['AuthController', 'logout']);

        // Admin routes
        $router->get('admin/dashboard', ['AdminDashboardController', 'index']);

        $router->get('admin/subscription/(:id)/edit/(:id)', ['AdminSubsciptionController', 'edit']);
        $router->post('admin/subscription/(:id)/update/(:id)', ['AdminSubsciptionController', 'update']);
        $router->get('admin/subscription/(:id)', ['AdminSubsciptionController', 'index']);

        $router->get('manage_vehicles', ['AdminVehicleController', 'index']);
        $router->get('manage_vehicles/create', ['AdminVehicleController', 'create']);
        $router->post('manage_vehicles/store', ['AdminVehicleController', 'store']);
        $router->get('manage_vehicles/edit/(:id)', ['AdminVehicleController', 'edit']);
        $router->post('manage_vehicles/update/(:id)', ['AdminVehicleController', 'update']);
        $router->post('manage_vehicles/delete/(:id)', ['AdminVehicleController', 'delete']);

        $router->get('manage_users/(:id)/create', ['AdminUserController', 'create']);
        $router->post('manage_users/(:id)/store', ['AdminUserController', 'store']);
        $router->get('manage_users/(:id)/edit/(:id)', ['AdminUserController', 'edit']);
        $router->post('manage_users/(:id)/update/(:id)', ['AdminUserController', 'update']);
        $router->post('manage_users/(:id)/delete/(:id)', ['AdminUserController', 'delete']);
        $router->get('manage_users/(:id)', ['AdminUserController', 'index']);

        $router->get('manage_services', ['AdminServiceController', 'index']);
        $router->get('manage_services/create', ['AdminServiceController', 'create']);
        $router->post('manage_services/store', ['AdminServiceController', 'store']);
        $router->get('manage_services/edit/(:id)', ['AdminServiceController', 'edit']);
        $router->post('manage_services/update/(:id)', ['AdminServiceController', 'update']);
        $router->post('manage_services/delete/(:id)', ['AdminServiceController', 'delete']);

        $router->get('manage_service_details/(:id)', ['AdminServiceDetailController', 'index']);
        $router->get('manage_service_details/(:id)/create', ['AdminServiceDetailController', 'create']);
        $router->post('manage_service_details/(:id)/store', ['AdminServiceDetailController', 'store']);
        $router->get('manage_service_details/(:id)/edit/(:id)', ['AdminServiceDetailController', 'edit']);
        $router->post('manage_service_details/(:id)/update/(:id)', ['AdminServiceDetailController', 'update']);
        $router->post('manage_service_details/(:id)/delete/(:id)', ['AdminServiceDetailController', 'delete']);

        $router->get('manage_service_packages/(:id)', ['AdminServicePackageController', 'index']);
        $router->get('manage_service_packages/(:id)/create', ['AdminServicePackageController', 'create']);
        $router->post('manage_service_packages/(:id)/store', ['AdminServicePackageController', 'store']);
        $router->get('manage_service_packages/(:id)/edit/(:id)', ['AdminServicePackageController', 'edit']);
        $router->post('manage_service_packages/(:id)/update/(:id)', ['AdminServicePackageController', 'update']);
        $router->post('manage_service_packages/(:id)/delete/(:id)', ['AdminServicePackageController', 'delete']);

        $router->get('manage_regions', ['AdminRegionController', 'index']);
        $router->get('manage_regions/create', ['AdminRegionController', 'create']);
        $router->post('manage_regions/store', ['AdminRegionController', 'store']);
        $router->get('manage_regions/edit/(:id)', ['AdminRegionController', 'edit']);
        $router->post('manage_regions/update/(:id)', ['AdminRegionController', 'update']);
        $router->post('manage_regions/delete/(:id)', ['AdminRegionController', 'delete']);

        $router->run();
    }
}