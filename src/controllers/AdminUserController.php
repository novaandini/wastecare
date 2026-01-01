<?php

class AdminUserController extends BaseController {
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        if (!isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Silakan login');
            $this->redirect('login');
        } else if ($_SESSION['user']['role'] != 'admin') {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }
    }

    public function index($role) {
        $data = [
            'title' => 'Kelola Akun '.$role,
            'data' => $this->userModel->getByRole($role),
            'role' => $role,
        ];
        // var_dump($data); die;
        $this->view('admin/template/header');
        $this->view('admin/user/index', $data);
        $this->view('admin/template/footer');
    }

    public function create($role) {
        $data = [
            'title' => 'Daftarkan Akun Baru',
            'data' => null,
            'user' => null,
            'role' => $role,
        ];
        $this->view('admin/template/header');
        $this->view('admin/user/form', $data);
        $this->view('admin/template/footer');
    }

    public function store($role) {
        $fields = [
            'name' => 'string | required',
            'email' => 'string | required',
            'password' => 'string | required',
            'phone_number' => 'string | required',
            'address' => 'string | required',
        ];
        [$inputs, $errors] = $this->filter($_POST, $fields);
        
        if ($errors) {
            Message::setFlash('error', 'Gagal!', $errors[0], $inputs);
            $this->redirect('manage_users/'.$role.'/create');
        }

        $inputs['password'] = password_hash(
            $inputs['password'],
            PASSWORD_DEFAULT
        );

        $proc = $this->userModel->create([
            'role' => $role,
            'name' => trim($inputs['name']),
            'email' => trim($inputs['email']),
            'password' => trim($inputs['password']),
            'phone_number' => trim($inputs['phone_number']),
            'address' => trim($inputs['address']),
        ]);
        if ($proc) {
            Message::setFlash('success', 'Berhasil!', 'Akun baru berhasil ditambahkan');
            $this->redirect('manage_users/'.$role);
        }
    }

    public function edit($role, $id) {
        $data = [
            'title' => 'Edit Akun',
            'user' => $this->userModel->findById($id),
            'role' => $role,
            'id' => $id,
        ];
        $this->view('admin/template/header');
        $this->view('admin/user/form', $data);
        $this->view('admin/template/footer');
    }

    public function update($role, $id) {
        $user = $this->userModel->findById($id);
        $password = empty($_POST['password'])
            ? $user['password']
            : password_hash($_POST['password'], PASSWORD_DEFAULT);
        $this->userModel->update($id, [
            'name' => trim($_POST['name']),
            'password' => $password,
            'phone_number' => trim($_POST['phone_number']),
            'address' => trim($_POST['address']),
        ]);

        Message::setFlash('success', 'Berhasil!', 'Akun berhasil diperbarui');
        $this->redirect('manage_users/'.$role);
    }

    public function delete($role, $id)
    {
        $user = $this->userModel->findById($id);

        if (!$user) {
            Message::setFlash('error', 'Gagal!', 'Akun tidak ditemukan');
            $this->redirect('manage_users');
        }

        $this->userModel->delete($id);

        Message::setFlash('success', 'Berhasil!', 'Akun berhasil dihapus');
        $this->redirect('manage_users/'.$role);
    }
}