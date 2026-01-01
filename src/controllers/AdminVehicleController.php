<?php

class AdminVehicleController extends BaseController {
    private $vehicleModel;
    private $regionModel;
    public function __construct()
    {
        $this->vehicleModel = $this->model('VehicleModel');
        $this->regionModel = $this->model('RegionModel');
        if (!isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
            $this->redirect('login');
        } else if ($_SESSION['user']['role'] != 'admin') {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }
    }

    public function index() {
        $data = [
            'title' => 'Kelola Kendaraan',
            'data' => $this->vehicleModel->getAll(),
        ];
        // var_dump($data); die;
        $this->view('admin/template/header');
        $this->view('admin/vehicle/index', $data);
        $this->view('admin/template/footer');
    }

    public function create() {
        $data = [
            'title' => 'Daftarkan Kendaraan Baru',
            'vehicle' => null,
            'regions' => $this->regionModel->getAll()
        ];
        $this->view('admin/template/header');
        $this->view('admin/vehicle/form', $data);
        $this->view('admin/template/footer');
    }

    public function store() {
        $fields = [
            'region_id' => 'int | required',
            'vehicle_code' => 'string | required',
            'vehicle_name' => 'string | required',
            'type' => 'string | required',
            'capacity_kg' => 'int | required',
            'is_active' => 'int | required',
            'notes' => 'string | required',
        ];
        [$inputs, $errors] = $this->filter($_POST, $fields);
        
        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_vehicles/create');
        }

        $proc = $this->vehicleModel->store([
            'region_id' => trim($inputs['region_id']),
            'vehicle_code' => trim($inputs['vehicle_code']),
            'vehicle_name' => trim($inputs['vehicle_name']),
            'type' => trim($inputs['type']),
            'capacity_kg' => trim($inputs['capacity_kg']),
            'is_active' => trim($inputs['is_active']),
            'notes' => trim($inputs['notes']),
        ]);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Kendaraan baru berhasil ditambahkan');
            $this->redirect('manage_vehicles');
        }
    }

    public function edit($id) {
        $data = [
            'title' => 'Edit Data Kendaraan',
            'vehicle' => $this->vehicleModel->getById($id),
            'id' => $id,
            'regions' => $this->regionModel->getAll()
        ];
        $this->view('admin/template/header');
        $this->view('admin/vehicle/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($id) {
        $this->vehicleModel->update($id, [
            'region_id' => trim($_POST['region_id']),
            'vehicle_code' => trim($_POST['vehicle_code']),
            'vehicle_name' => trim($_POST['vehicle_name']),
            'type' => trim($_POST['type']),
            'capacity_kg' => trim($_POST['capacity_kg']),
            'is_active' => trim($_POST['is_active']),
            'notes' => trim($_POST['notes']),
        ]);

        Message::setFlash('success', 'Berhasil!', 'Kendaraan berhasil diperbarui');
        $this->redirect('manage_vehicles');
    }

    public function delete($id)
    {
        $user = $this->vehicleModel->getById($id);

        if (!$user) {
            Message::setFlash('error', 'Gagal!', 'Kendaraan tidak ditemukan');
            $this->redirect('manage_vehicles');
        }

        $this->vehicleModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Kendaraan berhasil dihapus');
        $this->redirect('manage_vehicles');
    }
}