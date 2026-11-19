<?php
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Lecturer.php';

// Controller untuk mengatur alur halaman dan aksi CRUD mata kuliah
class CourseController {
    private $courseModel;
    private $lecturerModel;

    public function __construct() {
        $this->courseModel = new Course();
        $this->lecturerModel = new Lecturer();
    }

    // Menampilkan halaman daftar mata kuliah
    public function index() {
        $courses = $this->courseModel->getAll();
        $activePage = 'courses';
        $pageTitle = 'Courses';
        require __DIR__ . '/../views/courses/index.php';
    }

    // Menampilkan form tambah mata kuliah beserta pilihan dosen pengampu
    public function create() {
        $lecturers = $this->lecturerModel->getAll();
        $activePage = 'courses';
        $pageTitle = 'Create Course';
        require __DIR__ . '/../views/courses/create.php';
    }

    // Memproses penyimpanan data mata kuliah baru dari form POST
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_code = trim($_POST['course_code'] ?? '');
            $course_name = trim($_POST['course_name'] ?? '');
            $credits = (int)($_POST['credits'] ?? 0);
            $lecturer_id = (int)($_POST['lecturer_id'] ?? 0);

            if ($course_code !== '' && $course_name !== '' && $credits > 0 && $lecturer_id > 0) {
                $this->courseModel->create($course_code, $course_name, $credits, $lecturer_id);
            }
        }
        header('Location: index.php?controller=course&action=index');
        exit;
    }

    // Menampilkan form ubah data mata kuliah berdasarkan ID
    public function edit($id) {
        $course = $this->courseModel->getById($id);
        if (!$course) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        $lecturers = $this->lecturerModel->getAll();
        $activePage = 'courses';
        $pageTitle = 'Update Course';
        require __DIR__ . '/../views/courses/edit.php';
    }

    // Memproses pembaruan data mata kuliah dari form POST
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $course_code = trim($_POST['course_code'] ?? '');
            $course_name = trim($_POST['course_name'] ?? '');
            $credits = (int)($_POST['credits'] ?? 0);
            $lecturer_id = (int)($_POST['lecturer_id'] ?? 0);

            if ($id > 0 && $course_code !== '' && $course_name !== '' && $credits > 0 && $lecturer_id > 0) {
                $this->courseModel->update($id, $course_code, $course_name, $credits, $lecturer_id);
            }
        }
        header('Location: index.php?controller=course&action=index');
        exit;
    }

    // Menghapus data mata kuliah lalu kembali ke halaman daftar
    public function delete($id) {
        if ($id > 0) {
            $this->courseModel->delete($id);
        }
        header('Location: index.php?controller=course&action=index');
        exit;
    }
}
?>
