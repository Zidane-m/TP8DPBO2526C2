-- Membuat database utama jika belum tersedia
CREATE DATABASE IF NOT EXISTS tp_mvc25;
USE tp_mvc25;

-- Tabel departemen / program studi
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) NOT NULL UNIQUE,
    faculty VARCHAR(100) NOT NULL
);

-- Tabel dosen dengan relasi foreign key ke tabel departments
CREATE TABLE IF NOT EXISTS lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(30) NOT NULL UNIQUE,
    phone VARCHAR(25) NOT NULL,
    join_date DATE NOT NULL,
    department_id INT NULL,
    CONSTRAINT fk_lecturer_department
        FOREIGN KEY (department_id) REFERENCES departments(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- Tabel mata kuliah dengan relasi foreign key ke tabel lecturers
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL,
    lecturer_id INT NOT NULL,
    CONSTRAINT fk_course_lecturer
        FOREIGN KEY (lecturer_id) REFERENCES lecturers(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Data awal untuk pengujian setiap tabel
INSERT INTO departments (name, code, faculty) VALUES
('Ilmu Komputer', 'IK', 'FPMIPA'),
('Pendidikan Ilmu Komputer', 'PIK', 'FPMIPA'),
('Matematika', 'MTK', 'FPMIPA');

INSERT INTO lecturers (name, nidn, phone, join_date, department_id) VALUES
('Dr. Budi Santoso', '0012048501', '081234567890', '2018-09-01', 1),
('Siti Aminah, M.Kom.', '0025079002', '081298765432', '2020-02-15', 1),
('Ahmad Fauzi, M.T.', '0008118803', '081345678901', '2019-08-10', 2);

INSERT INTO courses (course_code, course_name, credits, lecturer_id) VALUES
('IK201', 'Desain Pemrograman Berorientasi Objek', 3, 1),
('IK305', 'Rekayasa Perangkat Lunak', 3, 2),
('PIK102', 'Algoritma dan Pemrograman', 4, 3);
