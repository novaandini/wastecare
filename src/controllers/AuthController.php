<?php

class AuthController extends BaseController {
    private $userModel;
    private $institutionModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->institutionModel = $this->model('InstitutionModel');
    }

    public function user_form() {
        $data = [
            'title' => 'Register'
        ];
        $this->view('auth/register/user/index', $data);
    }

    public function institution_form() {
        $data = [
            'title' => 'Institution Registration'
        ];
        $this->view('auth/register/institution/index', $data);
    }

    // Proses form register
    public function user_register()
    {
        // 1️⃣ Definisi field + rule (sanitize | validate)
        $fields = [
            'name'             => 'string | required|min:3|max:50',
            'email'            => 'email  | required|email',
            'password'         => 'string | required|secure',
            'confirm_password' => 'string | required|same:password',
        ];

        // 2️⃣ Custom message (opsional, sesuai kebutuhan)
        $messages = [
            'name' => [
                'required' => 'Nama wajib diisi',
            ],
            'email' => [
                'required' => 'Email wajib diisi',
                'email'    => 'Format email tidak valid',
            ],
            'password' => [
                'required' => 'Password wajib diisi',
                'secure'   => 'Password harus kuat',
            ],
            'confirm_password' => [
                'same' => 'Konfirmasi password tidak sama',
            ],
        ];

        // 3️⃣ Filter (sanitize + validate)
        [$inputs, $errors] = $this->filter($_POST, $fields, $messages);

        // 4️⃣ Cek error validasi
        if ($errors) {
            Message::setFlash(
                'error',
                'Register gagal!',
                $errors[0],
                $inputs
            );
            $this->redirect('user/register');
        }

        // 5️⃣ Cek email unik (database-level)
        if ($this->userModel->findByEmail($inputs['email'])) {
            Message::setFlash(
                'error',
                'Register gagal!',
                'Email sudah terdaftar',
                $inputs
            );
            $this->redirect('user/register');
        }

        // 6️⃣ Hash password
        $inputs['password'] = password_hash(
            $inputs['password'],
            PASSWORD_DEFAULT
        );

        // 7️⃣ Simpan ke database
        $this->userModel->create([
            'role'  => 'user',
            'name'     => $inputs['name'],
            'email'    => $inputs['email'],
            'password' => $inputs['password'],
            'phone_number' => $inputs['phone_number'] ?? null,
            'address' => $inputs['address'] ?? null,
        ]);

        // 8️⃣ Redirect sukses
        Message::setFlash(
            'success',
            'Berhasil!',
            'Registrasi berhasil, silakan login'
        );
        $this->redirect('login');
    }
    
    public function institution_register() {
        $fields = [
            'name'             => 'string | required|min:3|max:100',
            'email'            => 'email  | required|email',
            'password'         => 'string | required|secure',
            'confirm_password' => 'string | required|same:password',
            'brn'              => 'string | required|numeric',
            'address'          => 'string | required',
            'phone_number'     => 'string | required|numeric|min:10|max:15',
            'social_media'   => 'string | max:50',
        ];
        
        $messages = [
            'name' => ['required' => 'Nama lembaga wajib diisi'],
            'email' => [
                'required' => 'Email wajib diisi',
                'email'    => 'Format email tidak valid'
            ],
            'password' => [
                'required' => 'Password wajib diisi',
                'secure'   => 'Password harus kuat'
            ],
            'confirm_password' => [
                'same' => 'Konfirmasi password tidak sama'
            ],
            'brn' => [
                'required' => 'NIB wajib diisi',
                // 'numeric'  => 'NIB harus angka'
            ],
            'phone_number' => [
                'required' => 'Nomor telepon wajib diisi',
                'numeric'  => 'Nomor telepon harus angka',
                'min'      => 'Nomor telepon minimal 10 digit',
                'max'      => 'Nomor telepon maksimal 15 digit'
            ]
        ];
        
        // sanitize + validate
        [$inputs, $errors] = $this->filter($_POST, $fields, $messages);
        
        // validasi error
        if ($errors) {
            Message::setFlash('error', 'Register gagal!', $errors[0], $inputs);
            $this->redirect('institution/register');
        }
        
        // cek email & brn unik
        if ($this->userModel->findByEmail($inputs['email'])) {
            Message::setFlash('error', 'Register gagal!', 'Email sudah terdaftar', $inputs);
            $this->redirect('institution/register');
        }
        if ($this->institutionModel->findByBrn($inputs['brn'])) {
            Message::setFlash('error', 'Register gagal!', 'NIB sudah terdaftar', $inputs);
            $this->redirect('institution/register');
        }
        
        // hash password
        $inputs['password'] = password_hash($inputs['password'], PASSWORD_DEFAULT);
        
        $user_id = $this->userModel->create([
            'role'  => 'admin',
            'name'     => $inputs['name'],
            'email'    => $inputs['email'],
            'password' => $inputs['password'],
            'phone_number' => $inputs['phone_number'] ?? null,
            'address' => $inputs['address'] ?? null,
        ]);
        
        $this->institutionModel->create([
            'user_id'        => $user_id,
            'business_name'  => $inputs['name'],
            'brn'            => $inputs['brn'],
            'address'        => $inputs['address'],
            'phone_number'   => $inputs['phone_number'],
            'social_media'   => $inputs['social_media'] ?? null,
        ]);
        
        // sukses
        Message::setFlash(
            'success',
            'Berhasil!',
            'Registrasi berhasil, silakan login'
        );
        $this->redirect('login');
    }

    public function login_form() {
        if (isset($_SESSION['user'])) {
            Message::setFlash('error', 'Akses ditolak!', 'Anda tidak bisa mengakses halaman ini');
            $this->redirect('');
        }

        $data = [
            'title' => 'Login'
        ];
        $this->view('auth/login/index', $data);
    }

    public function verify_login() {
        $fields = [
            'email'    => 'string | required|email',
            'password' => 'string | required',
        ];

        $messages = [
            'email' => [
                'required' => 'Email wajib diisi',
                'email'    => 'Format email tidak valid',
            ],
            'password' => [
                'required' => 'Password wajib diisi'
            ]
        ];

        // sanitize + validate
        [$inputs, $errors] = $this->filter($_POST, $fields, $messages);

        if ($errors) {
            Message::setFlash('error', 'Login gagal!', $errors[0], $inputs);
            $this->redirect('login');
        }

        // cek user berdasarkan email
        $user = $this->userModel->findByEmail($inputs['email']);
        if (!$user) {
            Message::setFlash('error', 'Login gagal!', 'Email tidak ditemukan', $inputs);
            $this->redirect('login');
        }

        // cek password
        if (!password_verify($inputs['password'], $user['password'])) {
            Message::setFlash('error', 'Login gagal!', 'Password salah', $inputs);
            $this->redirect('login');
        }

        // set session login
        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'role' => $user['role'],
            'name'    => $user['name'],
            'phone_number'   => $user['phone_number'],
            'address'   => $user['address'],
        ];

        Message::setFlash('success', 'Login berhasil!', 'Selamat datang ' . $user['name']);
        
        // redirect sesuai role
        if ($user['role'] == 'admin') {
            $this->redirect('manage_services'); // halaman lembaga
        } else {
            $this->redirect('services');      // halaman user biasa
        }
    }

    public function logout()
    {
        // pastikan session aktif
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // hapus semua data session
        $_SESSION = [];

        // hapus cookie session (best practice)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // destroy session
        session_destroy();

        Message::setFlash('success', 'Logout berhasil', 'Sampai jumpa 👋');
        $this->redirect('login');
    }
}