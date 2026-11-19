<?php
require_once __DIR__ . '/../models/Lecturer.php';
require_once __DIR__ . '/../models/Department.php';

// Controller untuk mengatur alur halaman dan aksi CRUD dosen
class LecturerController {
    private $lecturerModel;
    private $departmentModel;

    public function __construct() {
        $this->lecturerModel = new Lecturer();
        $this->departmentModel = new Department();
    }

    // Menampilkan halaman daftar dosen
    public function index() {
        $lecturers = $this->lecturerModel->getAll();
        $activePage = 'lecturers';
        $pageTitle = 'Lecturers';
        require __DIR__ . '/../views/lecturers/index.php';
    }

    // Menampilkan form tambah dosen beserta pilihan departemen
    public function create() {
        $departments = $this->departmentModel->getAll();
        $activePage = 'lecturers';
        $pageTitle = 'Create Lecturer';
        require __DIR__ . '/../views/lecturers/create.php';
    }

    // Memproses penyimpanan data dosen baru dari form POST
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $nidn = trim($_POST['nidn'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $join_date = $_POST['join_date'] ?? '';
            $department_id = !empty($_POST['department_id']) ? (int)$_POST['department_id'] : null;

            if ($name !== '' && $nidn !== '' && $phone !== '' && $join_date !== '') {
                $this->lecturerModel->create($name, $nidn, $phone, $join_date, $department_id);
            }
        }
        header('Location: index.php?controller=lecturer&action=index');
        exit;
    }

    // Menampilkan form ubah data dosen berdasarkan ID
    public function edit($id) {
        $lecturer = $this->lecturerModel->getById($id);
        if (!$lecturer) {
            header('Location: index.php?controller=lecturer&action=index');
            exit;
        }
        $departments = $this->departmentModel->getAll();
        $activePage = 'lecturers';
        $pageTitle = 'Update Lecturer';
        require __DIR__ . '/../views/lecturers/edit.php';
    }

    // Memproses pembaruan data dosen dari form POST
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $name = trim($_POST['name'] ?? '');
            $nidn = trim($_POST['nidn'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $join_date = $_POST['join_date'] ?? '';
            $department_id = !empty($_POST['department_id']) ? (int)$_POST['department_id'] : null;

            if ($id > 0 && $name !== '' && $nidn !== '' && $phone !== '' && $join_date !== '') {
                $this->lecturerModel->update($id, $name, $nidn, $phone, $join_date, $department_id);
            }
        }
        header('Location: index.php?controller=lecturer&action=index');
        exit;
    }

    // Menghapus data dosen lalu kembali ke halaman daftar
    public function delete($id) {
        if ($id > 0) {
            $this->lecturerModel->delete($id);
        }
        header('Location: index.php?controller=lecturer&action=index');
        exit;
    }
}
?>
