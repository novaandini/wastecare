<?php

class ServiceController extends BaseController {
    private $serviceModel;
    private $servicePackageModel;
    private $subscriptionModel;
    private $db;
    private $weeklyRouteModel;
    private $regionModel;
    public function __construct()
    {
        $this->db = new Database();
        $this->weeklyRouteModel = $this->model('WeeklyRouteModel');
        $this->regionModel = $this->model('RegionModel');
        $this->serviceModel = $this->model('ServiceModel');
        $this->subscriptionModel = $this->model('SubscriptionModel');
        $this->servicePackageModel = $this->model('ServicePackageModel');
    }

    public function index() {
        $data = [
            'services' => $this->serviceModel->getAll(),
            'regions' => $this->regionModel->getAll()
        ];

        $this->view('template/header');
        $this->view('services/index', $data);
        $this->view('template/footer');
    }

    public function detail($id) {
        $data = [
            'data' => $this->serviceModel->findById($id),
            'packages' => $this->servicePackageModel->getByService($id),
            'regions' => $this->regionModel->getAll(),
            'isLoggedIn' => isset($_SESSION['user'])
        ];
        $this->view('template/header');
        $this->view('services/detail', $data);
        $this->view('template/footer');
    }

    public function subscribe() {
        // var_dump($_POST); die;
        $this->db->beginTransaction();

        try {
            $fields = [
                'service_id' => 'int | required',
                'service_package_id' => 'int | required',
                'total_kk' => 'int | required',
                'contact_name' => 'string | required',
                'contact_phone' => 'string | required',
                'contact_address' => 'string | required',
                'pickup_days' => 'string[] | required',
                'village_name' => 'string | required',
                'district_name' => 'string | required',
                'city_name' => 'string | required'
            ];

            $message = [
                'contact_name' => [
                    'required' => 'Nama harus diisi',
                ]
            ];
            [$inputs, $errors] = $this->filter($_POST, $fields, $message);
            
            if ($errors) {
                Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
                $this->redirect('manage_service_details/create');
            }

            $price_per_kk = $this->servicePackageModel->getById($inputs['service_package_id'])['price_per_kk'];
            $total_price = $inputs['total_kk'] * $price_per_kk;

            $proc = $this->subscriptionModel->store([
                'user_id' => $_SESSION['user']['user_id'],
                'service_id' => trim($inputs['service_id']),
                'service_package_id' => trim($inputs['service_package_id']),
                'total_kk' => trim($inputs['total_kk']),
                'price_per_kk' => trim($price_per_kk),
                'total_price' => $total_price,
                'contact_name' => trim($inputs['contact_name']),
                'contact_phone' => trim($inputs['contact_phone']),
                'contact_address' => trim($inputs['contact_address']),
                'village_name' => trim($inputs['village_name']),
                'district_name' => trim($inputs['district_name']),
                'city_name' => trim($inputs['city_name']),
            ]);

            foreach ($inputs['pickup_days'] as $day) {
                $this->weeklyRouteModel->store([
                    'subscription_id' => $proc,
                    'weekday' => $day
                ]);
            }

            $this->db->commit();
            
            Message::setFlash('success', 'Berhasil!', 'Permohonan langganan diterima, mohon cek status transaksi berkala!');
            $this->redirect('service/detail/'.trim($inputs['service_id']));
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}