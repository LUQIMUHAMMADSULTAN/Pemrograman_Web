<?php
class AuthController extends Controller {
    public function login(): void {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('');
        }
        $this->view('auth/login', ['title' => 'Login Sistem']);
    }

    public function authenticate(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('auth/login');
        
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $this->flash('danger', 'Username dan password wajib diisi.');
            $this->redirect('auth/login');
        }

        $user = $this->model('User')->findByUsername($username);

        // Verifikasi password (password default di database sql contoh adalah '123456')
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];

            $this->flash('success', 'Berhasil login. Selamat datang, ' . $user['full_name'] . '!');
            $this->redirect('');
        } else {
            $this->flash('danger', 'Username atau password salah.');
            $this->redirect('auth/login');
        }
    }

    public function logout(): void {
        session_unset();
        session_destroy();
        session_start();
        $this->flash('success', 'Berhasil logout dari sistem.');
        $this->redirect('auth/login');
    }
}