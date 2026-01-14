<?php

class subscriptionController extends BaseController {
    private $subscriptionModel;
    private $servicePackageModel;
    private $userModel;
    private $serviceModel;
    private $vehicleModel;
    private $weeklyRouteModel;
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        $this->subscriptionModel = $this->model('SubscriptionModel');
        $this->servicePackageModel = $this->model('ServicePackageModel');
        $this->userModel = $this->model('UserModel');
        $this->serviceModel = $this->model('ServiceModel');
        $this->vehicleModel = $this->model('VehicleModel');
        $this->weeklyRouteModel = $this->model('WeeklyRouteModel');
        if (!isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
            $this->redirect('login');
        } else if ($_SESSION['user']['role'] != 'user') {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }
    }

    public function index() {
        $subscriptions = $this->subscriptionModel->getByUser($_SESSION['user']['user_id']);
        
        foreach ($subscriptions as &$subscription) {
            $package = $this->servicePackageModel->getById($subscription['service_package_id']);
            $subscription['package'] = $package ?? null;
            
            $service = $this->serviceModel->findById($subscription['service_id']);
            $subscription['service'] = $service ?? null;
        }
        unset($subscription); // WAJIB
        // var_dump($subscriptions); die;

        $data = [
            'status' => $status ?? null,
            'title' => 'List Subscription',
            'subscriptions' => $subscriptions
        ];
        // var_dump($data); die;
        $this->view('template/header');
        $this->view('subscription/index', $data);
        $this->view('template/footer');
    }

    public function detail($id)
    {
        $subscription = $this->subscriptionModel->getById($id);

        if (!$subscription) {
            // redirect / error handling
            die('Subscription tidak ditemukan');
        }

        // Package
        $subscription['package'] = $this->servicePackageModel
            ->getById($subscription['service_package_id']);

        // Service
        $subscription['service'] = $this->serviceModel
            ->findById($subscription['service_id']);

        // Weekly routes (array)
        $weekly_routes = $this->weeklyRouteModel->getBySubscription($id);
        $subscription['weekly_routes'] = $weekly_routes;

        // Ambil user & vehicle dari route pertama (jika ada)
        if (!empty($weekly_routes)) {
            $firstRoute = $weekly_routes[0];

            $subscription['user'] = isset($firstRoute['user_id'])
                ? $this->userModel->findById($firstRoute['user_id'])
                : null;

            $subscription['vehicle'] = isset($firstRoute['vehicle_id'])
                ? $this->vehicleModel->getById($firstRoute['vehicle_id'])
                : null;
        } else {
            $subscription['user'] = null;
            $subscription['vehicle'] = null;
        }

        // var_dump($subscription); die;

        $data = [
            'title' => 'Detail Subscription',
            'data'  => $subscription
        ];

        $this->view('template/header');
        $this->view('subscription/detail', $data);
        $this->view('template/footer');
    }

    public function edit($status, $id) {
        $subscription = $this->subscriptionModel->getById($id);
        $package = $this->servicePackageModel->getById($subscription['service_package_id']);
        $subscription['package'] = $package ?? null;

        $user = $this->userModel->findById($subscription['user_id']);
        $subscription['user'] = $user ?? null;

        $service = $this->serviceModel->findById($subscription['service_id']);
        $subscription['service'] = $service ?? null;

        $data = [
            'status' => $status,
            'title' => 'Subscription Data',
            'vehicles' => $this->vehicleModel->getAll(),
            'staffs' => $this->userModel->getByRole('staff'),
            'subscription' => $subscription,
        ];
        $this->view('admin/template/header');
        $this->view('admin/subscription/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($status, $id) {
        $this->db->beginTransaction();

        try {
            $this->subscriptionModel->update($id, [
                'status' => $_POST['status'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
            ]);
    
            $this->weeklyRouteModel->update($id, [
                'vehicle_id' => $_POST['vehicle_id'],
                'user_id' => $_POST['user_id'],
            ]);

            $this->db->commit();
    
            Message::setFlash('success', 'Berhasil!', 'Langganan berhasil diperbarui');
            $this->redirect('admin/subscription/'.$status);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}