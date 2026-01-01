<?php

class AdminServiceController extends BaseController {
 
    private $db;
    private $serviceModel;
    private $regionModel;
    private $serviceRegionModel;
    public function __construct()
    {
        $this->db = new Database();
        $this->serviceModel = $this->model('ServiceModel');
        $this->regionModel = $this->model('RegionModel');
        $this->serviceRegionModel = $this->model('ServiceRegionModel');
        // cek login
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
            'title' => 'Service',
            'data'  => $this->serviceModel->getAll($_SESSION['user']['user_id']),
        ];
        $this->view('admin/template/header');
        $this->view('admin/services/index', $data);
        $this->view('admin/template/footer');
    }

    public function create() {
        $data = [
            'title' => 'Create New Service',
            'service' => null,
            'regions' => $this->regionModel->getAll()
        ];
        $this->view('admin/template/header');
        $this->view('admin/services/form', $data);
        $this->view('admin/template/footer');
    }

    public function store() {
        // var_dump($_POST); die;
        $fields = [
            'name' => 'string | required|min:3|max:100',
            'description'  => 'string | required|min:10',
            'is_active'    => 'int',
            'image'        => 'string',
            'region_id'    => 'int[]',
        ];

        $messages = [
            'name' => ['required' => 'Nama layanan wajib diisi'],
            'description'  => ['required' => 'Deskripsi wajib diisi'],
        ];

        [$inputs, $errors] = $this->filter($_POST, $fields, $messages);

        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_services/create');
        }

        // =======================
        // UPLOAD FOTO
        // =======================
        $imageName = null;

        if (!empty($_FILES['image']['name'])) {

            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                Message::setFlash('error', 'Gagal!', 'Format gambar tidak valid', $inputs);
                $this->redirect('services/create');
            }

            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                Message::setFlash('error', 'Gagal!', 'Ukuran gambar maksimal 2MB', $inputs);
                $this->redirect('services/create');
            }

            $imageName = uniqid('service_') . '.' . $ext;
            $path = __DIR__ . '/../../public/uploads/services/' . $imageName;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }

        $this->db->beginTransaction();
        try {
            // simpan ke DB
            $service_id = $this->serviceModel->create([
                'user_id'       => $_SESSION['user']['user_id'],
                'name'          => $inputs['name'],
                'description'   => $inputs['description'],
                'image'         => $imageName,
                'is_active'     => $inputs['is_active'],
            ]);
            
            $regionIds = $inputs['region_id'] ?? [];

            foreach ($regionIds as $regionId) {
                $this->serviceRegionModel->store([
                    'service_id' => $service_id,
                    'region_id'  => $regionId
                ]);
            }

            $this->db->commit();
    
            Message::setFlash('success', 'Berhasil!', 'Layanan berhasil ditambahkan');
            $this->redirect('manage_services');
        } catch (Exception $e) {
            $this->db->rollBack();

            // optional: logging
            error_log($e->getMessage());

            // lempar ulang / redirect error
            throw $e;
        }

    }

    public function edit($id)
    {

        $service = $this->serviceModel->findById($id);
        
        if (!$service) {
            Message::setFlash('error', 'Gagal!', 'Data service tidak ditemukan');
            $this->redirect('manage_services');
        }
        
        $service['region'] = $this->serviceRegionModel->getRegionsByService($id);
        $data = [
            'title'   => 'Edit Service',
            'service' => $service,
            'regions' => $this->regionModel->getAll()
        ];

        $this->view('admin/template/header');
        $this->view('admin/services/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($id)
    {
        $fields = [
            'name' => 'string | required|min:3|max:100',
            'description'  => 'string | required|min:10',
            'is_active'    => 'int',
            'image'        => 'string',
            'region_id'    => 'int[]',
        ];

        $messages = [
            'name' => ['required' => 'Nama layanan wajib diisi'],
            'description'  => ['required' => 'Deskripsi wajib diisi'],
        ];

        [$inputs, $errors] = $this->filter($_POST, $fields, $messages);

        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_services/create');
        }

        $service = $this->serviceModel->findById($id);

        // default: pakai gambar lama
        $imageName = $service['image'];

        // jika user upload gambar baru
        if (!empty($_FILES['image']['name'])) {
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                Message::setFlash('error', 'Gagal!', 'Format gambar tidak valid');
                $this->redirect('manage_services/edit/' . $id);
            }

            if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                Message::setFlash('error', 'Gagal!', 'Ukuran gambar maksimal 2MB');
                $this->redirect('manage_services/edit/' . $id);
            }

            // upload gambar baru
            $imageName = uniqid('service_') . '.' . $ext;
            $path = __DIR__ . '/../../public/uploads/services/' . $imageName;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);

            // hapus gambar lama (optional tapi disarankan)
            $oldPath = __DIR__ . '/../../public/uploads/services/' . $service['image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $regions = $inputs['region_id'] ?? [];
        $this->db->beginTransaction();
        try {
            // update DB
            $this->serviceModel->update($id, [
                'name'  => $inputs['name'],
                'description'   => $inputs['description'],
                'image' => $imageName,
                'is_active'     => $inputs['is_active'],
            ]);

            $this->serviceRegionModel->deleteByService($id);

            if (!empty($regions)) {
                foreach ($regions as $regionId) {
                    $this->serviceRegionModel->store([
                        'service_id' => $id,
                        'region_id'  => $regionId,
                    ]);
                }
            }

            $this->db->commit();
    
            Message::setFlash('success', 'Berhasil!', 'Service berhasil diperbarui');
            $this->redirect('manage_services');
            
        } catch (\Exception $e) {
            $this->db->rollBack();
            Message::setFlash('error', 'Gagal!', $e->getMessage());
            $this->redirect('manage_services/edit/' . $id);
        }
    }

    public function delete($id)
    {
        // 1. cek login
        // if (!isset($_SESSION['user'])) {
        //     Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
        //     $this->redirect('login');
        // }

        $user = $_SESSION['user'];

        // 2. ambil data service
        $service = $this->serviceModel->findById($id);

        if (!$service) {
            Message::setFlash('error', 'Gagal!', 'Data service tidak ditemukan');
            $this->redirect('manage_services');
        }

        // 3. AUTHORIZATION
        // hanya ADMIN atau PEMBUAT SERVICE
        if (
            $user['role'] !== 'admin' &&
            $service['user_id'] != $user['user_id']
        ) {
            Message::setFlash('error', 'Ditolak!', 'Kamu tidak punya akses menghapus service ini');
            $this->redirect('manage_services');
        }

        // 4. hapus file gambar (jika ada)
        if (!empty($service['image'])) {
            $path = __DIR__ . '/../../public/uploads/services/' . $service['image'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // 5. hapus dari database
        $this->serviceModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Service berhasil dihapus');
        $this->redirect('manage_services');
    }
}