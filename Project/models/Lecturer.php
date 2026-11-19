<?php
require_once __DIR__ . '/../config/Database.php';

// Model untuk mengelola data pada tabel lecturers
class Lecturer {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil seluruh data dosen beserta nama departemennya
    public function getAll() {
        $sql = "SELECT lecturers.*, departments.name AS department_name
                FROM lecturers
                LEFT JOIN departments ON lecturers.department_id = departments.id
                ORDER BY lecturers.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengambil satu data dosen berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM lecturers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan data dosen baru
    public function create($name, $nidn, $phone, $join_date, $department_id) {
        $dept = $department_id ?: null;
        $stmt = $this->db->prepare("INSERT INTO lecturers (name, nidn, phone, join_date, department_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $nidn, $phone, $join_date, $dept]);
    }

    // Memperbarui data dosen berdasarkan ID
    public function update($id, $name, $nidn, $phone, $join_date, $department_id) {
        $dept = $department_id ?: null;
        $stmt = $this->db->prepare("UPDATE lecturers SET name = ?, nidn = ?, phone = ?, join_date = ?, department_id = ? WHERE id = ?");
        return $stmt->execute([$name, $nidn, $phone, $join_date, $dept, $id]);
    }

    // Menghapus data dosen berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM lecturers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
