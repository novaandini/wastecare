<?php

class AdminServiceDetailController extends BaseController {
    private $serviceDetailModel;
    public function __construct()
    {
        $this->serviceDetailModel = $this->model('ServiceDetailModel');
        if (!isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
            $this->redirect('login');
        } else if ($_SESSION['user']['role'] != 'admin') {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }
    }

    public function index($service_id) {
        $data = [
            'title' => 'Detail Layanan',
            'data' => $this->serviceDetailModel->getByService($service_id),
            'service_id' => $service_id,
        ];
        // var_dump($data); die;
        $this->view('admin/template/header');
        $this->view('admin/service_detail/index', $data);
        $this->view('admin/template/footer');
    }

    public function create($service_id) {
        $data = [
            'title' => 'Tambah Detail Layanan',
            'data' => null,
            'service_detail' => null,
            'service_id' => $service_id,
        ];
        $this->view('admin/template/header');
        $this->view('admin/service_detail/form', $data);
        $this->view('admin/template/footer');
    }

    public function store($service_id) {
        $fields = [
            'title' => 'string | required',
            'content' => 'string',
        ];

        $message = [
            'title' => [
                'required' => 'Nama harus diisi',
            ]
        ];
        [$inputs, $errors] = $this->filter($_POST, $fields, $message);
        
        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_service_details/create');
        }

        $proc = $this->serviceDetailModel->store([
            'service_id' => $service_id,
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content']),
        ]);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Detail layanan berhasil ditambahkan');
            $this->redirect('manage_service_details/'.$service_id);
        }
    }

    public function edit($service_id, $id) {
        $data = [
            'title' => 'Edit Detail Layanan',
            'service_detail' => $this->serviceDetailModel->getById($id),
            'service_id' => $service_id,
            'id' => $id,
        ];
        $this->view('admin/template/header');
        $this->view('admin/service_detail/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($service_id, $id) {
        $this->serviceDetailModel->update($id, [
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content'])
        ]);

        Message::setFlash('success', 'Berhasil!', 'Detail layanan berhasil diperbarui');
        $this->redirect('manage_service_details/'.$service_id);
    }

    public function delete($service_id, $id)
    {
        $service_detail = $this->serviceDetailModel->getById($id);

        if (!$service_detail) {
            Message::setFlash('error', 'Gagal!', 'Detail layanan tidak ditemukan');
            $this->redirect('manage_service_details');
        }

        $this->serviceDetailModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Detail layanan berhasil dihapus');
        $this->redirect('manage_service_details/'.$service_id);
    }
}