<?php
require_once __DIR__ . '/../config/Database.php';

// Model untuk mengelola data pada tabel departments
class Department {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil seluruh data departemen
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM departments ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Mengambil satu data departemen berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM departments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Menambahkan data departemen baru
    public function create($name, $code, $faculty) {
        $stmt = $this->db->prepare("INSERT INTO departments (name, code, faculty) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $code, $faculty]);
    }

    // Memperbarui data departemen berdasarkan ID
    public function update($id, $name, $code, $faculty) {
        $stmt = $this->db->prepare("UPDATE departments SET name = ?, code = ?, faculty = ? WHERE id = ?");
        return $stmt->execute([$name, $code, $faculty, $id]);
    }

    // Menghapus data departemen berdasarkan ID
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM departments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
