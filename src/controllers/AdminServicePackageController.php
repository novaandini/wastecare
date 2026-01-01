<?php

class AdminServicePackageController extends BaseController {
    private $servicePackageModel;
    private $serviceModel;
    public function __construct()
    {
        $this->servicePackageModel = $this->model('ServicePackageModel');
        $this->serviceModel = $this->model('ServiceModel');
        if (!isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
            $this->redirect('login');
        } else if ($_SESSION['user']['role'] != 'admin') {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }
    }

    public function index($service_id) {
        $service_name = $this->serviceModel->findById($service_id);
        $data = [
            'title' => 'Package Layanan '.$service_name['name'],
            'data' => $this->servicePackageModel->getByService($service_id),
            'service_id' => $service_id,
        ];
        // var_dump($data); die;
        $this->view('admin/template/header');
        $this->view('admin/service_package/index', $data);
        $this->view('admin/template/footer');
    }

    public function create($service_id) {
        $data = [
            'title' => 'Tambah Package Layanan',
            'data' => null,
            'service_package' => null,
            'service_id' => $service_id,
        ];
        $this->view('admin/template/header');
        $this->view('admin/service_package/form', $data);
        $this->view('admin/template/footer');
    }

    public function store($service_id) {
        $fields = [
            'package_name' => 'string | required',
            'duration_type' => 'string | required',
            'duration_value' => 'int',
            'price_per_kk' => 'int',
            'is_active' => 'int'
        ];
        [$inputs, $errors] = $this->filter($_POST, $fields);
        
        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_service_packages/'.$service_id.'/create');
        }

        $proc = $this->servicePackageModel->store([
            'service_id' => $service_id,
            'package_name' => trim($_POST['package_name']),
            'duration_type' => trim($_POST['duration_type']),
            'duration_value' => trim($_POST['duration_value']),
            'price_per_kk' => trim($_POST['price_per_kk']),
            'is_active' => trim($_POST['is_active']),
        ]);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Package layanan berhasil ditambahkan');
            $this->redirect('manage_service_packages/'.$service_id);
        }
    }

    public function edit($service_id, $id) {
        $data = [
            'title' => 'Edit Package Layanan',
            'service_package' => $this->servicePackageModel->getById($id),
            'service_id' => $service_id,
            'id' => $id,
        ];
        $this->view('admin/template/header');
        $this->view('admin/service_package/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($service_id, $id) {
        $this->servicePackageModel->update($id, [
            'package_name' => trim($_POST['package_name']),
            'duration_type' => trim($_POST['duration_type']),
            'duration_value' => trim($_POST['duration_value']),
            'price_per_kk' => trim($_POST['price_per_kk']),
            'is_active' => trim($_POST['is_active']),
        ]);

        Message::setFlash('success', 'Berhasil!', 'Package layanan berhasil diperbarui');
        $this->redirect('manage_service_packages/'.$service_id);
    }

    public function delete($service_id, $id)
    {
        $service_Package = $this->servicePackageModel->getById($id);

        if (!$service_Package) {
            Message::setFlash('error', 'Gagal!', 'Package layanan tidak ditemukan');
            $this->redirect('manage_service_Packages');
        }

        $this->servicePackageModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Package layanan berhasil dihapus');
        $this->redirect('manage_service_packages/'.$service_id);
    }
}