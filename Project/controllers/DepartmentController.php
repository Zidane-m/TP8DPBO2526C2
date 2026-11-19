<?php
require_once __DIR__ . '/../models/Department.php';

// Controller untuk mengatur alur halaman dan aksi CRUD departemen
class DepartmentController {
    private $departmentModel;

    public function __construct() {
        $this->departmentModel = new Department();
    }

    // Menampilkan halaman daftar departemen
    public function index() {
        $departments = $this->departmentModel->getAll();
        $activePage = 'departments';
        $pageTitle = 'Departments';
        require __DIR__ . '/../views/departments/index.php';
    }

    // Menampilkan form tambah departemen
    public function create() {
        $activePage = 'departments';
        $pageTitle = 'Create Department';
        require __DIR__ . '/../views/departments/create.php';
    }

    // Memproses penyimpanan data departemen baru dari form POST
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $code = trim($_POST['code'] ?? '');
            $faculty = trim($_POST['faculty'] ?? '');

            if ($name !== '' && $code !== '' && $faculty !== '') {
                $this->departmentModel->create($name, $code, $faculty);
            }
        }
        header('Location: index.php?controller=department&action=index');
        exit;
    }

    // Menampilkan form ubah data departemen berdasarkan ID
    public function edit($id) {
        $department = $this->departmentModel->getById($id);
        if (!$department) {
            header('Location: index.php?controller=department&action=index');
            exit;
        }
        $activePage = 'departments';
        $pageTitle = 'Update Department';
        require __DIR__ . '/../views/departments/edit.php';
    }

    // Memproses pembaruan data departemen dari form POST
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $name = trim($_POST['name'] ?? '');
            $code = trim($_POST['code'] ?? '');
            $faculty = trim($_POST['faculty'] ?? '');

            if ($id > 0 && $name !== '' && $code !== '' && $faculty !== '') {
                $this->departmentModel->update($id, $name, $code, $faculty);
            }
        }
        header('Location: index.php?controller=department&action=index');
        exit;
    }

    // Menghapus data departemen lalu kembali ke halaman daftar
    public function delete($id) {
        if ($id > 0) {
            $this->departmentModel->delete($id);
        }
        header('Location: index.php?controller=department&action=index');
        exit;
    }
}
?>
