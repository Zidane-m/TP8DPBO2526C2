<?php
require_once __DIR__ . '/../config/Database.php';

// Model untuk mengelola data pada tabel courses
class Course {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil seluruh data mata kuliah beserta nama dosen pengampu
    public function getAll() {
        $sql = "SELECT courses.*, lecturers.name AS lecturer_name
                FROM courses
                INNER JOIN lecturers ON courses.lecturer_id = lecturers.id
                ORDER BY courses.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengambil satu data mata kuliah berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan data mata kuliah baru
    public function create($course_code, $course_name, $credits, $lecturer_id) {
        $stmt = $this->db->prepare("INSERT INTO courses (course_code, course_name, credits, lecturer_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$course_code, $course_name, (int)$credits, (int)$lecturer_id]);
    }

    // Memperbarui data mata kuliah berdasarkan ID
    public function update($id, $course_code, $course_name, $credits, $lecturer_id) {
        $stmt = $this->db->prepare("UPDATE courses SET course_code = ?, course_name = ?, credits = ?, lecturer_id = ? WHERE id = ?");
        return $stmt->execute([$course_code, $course_name, (int)$credits, (int)$lecturer_id, $id]);
    }

    // Menghapus data mata kuliah berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
