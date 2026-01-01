<?php

class AdminDashboardController extends BaseController {
    private $regionModel;
    public function __construct()
    {
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
            'title' => 'Dashboard',
            // 'data' => $this->regionModel->getAll()
        ];
        // var_dump($data); die;
        $this->view('admin/template/header');
        $this->view('admin/dashboard/index', $data);
        $this->view('admin/template/footer');
    }

    public function create() {
        $data = [
            'title' => 'Tambah Wilayah',
            'data' => null,
            'region' => null
        ];
        $this->view('admin/template/header');
        $this->view('admin/region/form', $data);
        $this->view('admin/template/footer');
    }

    public function store() {
        $fields = [
            'region_name' => 'string | required',
            'province' => 'string',
        ];

        $message = [
            'region_name' => [
                'required' => 'Nama harus diisi',
            ]
        ];
        [$inputs, $errors] = $this->filter($_POST, $fields, $message);
        
        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_regions/create');
        }

        $proc = $this->regionModel->store($inputs);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Wilayah berhasil ditambahkan');
            $this->redirect('manage_regions');
        }
    }

    public function edit($id) {
        $data = [
            'title' => 'Edit Wilayah',
            'region' => $this->regionModel->getById($id),
        ];
        $this->view('admin/template/header');
        $this->view('admin/region/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($id) {
        $this->regionModel->update($id, [
            'region_name' => $_POST['region_name'],
            'province' => $_POST['province']
        ]);

        Message::setFlash('success', 'Berhasil!', 'Wilayah berhasil diperbarui');
        $this->redirect('manage_regions');
    }

    public function delete($id)
    {
        $region = $this->regionModel->getById($id);

        if (!$region) {
            Message::setFlash('error', 'Gagal!', 'Data wilayah tidak ditemukan');
            $this->redirect('manage_regions');
        }

        $this->regionModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Wilayah berhasil dihapus');
        $this->redirect('manage_regions');
    }
}