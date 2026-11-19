# Tugas Praktikum 8 DPBO 2526 C2 (TP8DPBO2526C2)
Aplikasi **Academic System** berbasis **PHP Native** dengan arsitektur **Model-View-Controller (MVC)**, basis data MySQL melalui PDO (*Prepared Statements*), dan antarmuka Bootstrap untuk pengelolaan data Departemen, Dosen (*Lecturers*), serta Mata Kuliah (*Courses*).

---

## Janji

> Saya Muhammad Zidan Mirza Fedrieka dengan NIM 2507692 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---

## 1. Desain Program & Arsitektur MVC

### A. Pemisahan Tanggung Jawab (*Model-View-Controller*)
1. **Model (`Project/models/`)**:
   - Mengelola koneksi database (`Project/config/Database.php`) dan seluruh kueri SQL menggunakan *Prepared Statements* PDO (`prepare()` dan `execute()`).
   - Terdiri atas `Department`, `Lecturer`, dan `Course`.
2. **View (`Project/views/`)**:
   - Menyajikan antarmuka HTML/Bootstrap kepada pengguna menggunakan data yang dikirimkan oleh Controller, tanpa berinteraksi langsung dengan database atau Model.
   - Terdiri atas tata letak bersama (`views/layout/header.php`, `views/layout/footer.php`) serta tampilan `index.php`, `create.php`, dan `edit.php` untuk masing-masing entitas.
3. **Controller (`Project/controllers/`)**:
   - Menjadi penghubung antara Model dan View, memproses permintaan HTTP (`GET`/`POST`), memanggil metode Model, serta mengarahkan (*redirect*) atau merender View yang sesuai.
   - Terdiri atas `DepartmentController`, `LecturerController`, dan `CourseController`, dengan `Project/index.php` sebagai *front controller* (`?controller=...&action=...`).

### B. Skema Database & Relasi (*Entity Relationship Diagram*)

```mermaid
erDiagram
    DEPARTMENTS ||--o{ LECTURERS : "memiliki"
    LECTURERS ||--o{ COURSES : "mengampu"

    DEPARTMENTS {
        int id PK
        varchar name
        varchar code UK
        varchar faculty
    }

    LECTURERS {
        int id PK
        varchar name
        varchar nidn UK
        varchar phone
        date join_date
        int department_id FK
    }

    COURSES {
        int id PK
        varchar course_code UK
        varchar course_name
        int credits
        int lecturer_id FK
    }
```

- `lecturers.department_id` merujuk ke `departments.id` (`ON DELETE SET NULL ON UPDATE CASCADE`).
- `courses.lecturer_id` merujuk ke `lecturers.id` (`ON DELETE CASCADE ON UPDATE CASCADE`).

---

## 2. Alur Program

```mermaid
flowchart TD
    User([Pengguna / Browser]) -->|Request HTTP| Router[Project/index.php]
    Router -->|Pilih Controller & Action| Controller[Controller]
    Controller -->|Panggil Query CRUD| Model[Model + PDO]
    Model <-->|SQL Prepared Statement| DB[(MySQL: tp_mvc25)]
    Model -->|Kembalikan Data| Controller
    Controller -->|Kirim Data ke Tampilan| View[View Bootstrap]
    Controller -->|Redirect PRG setelah POST/Delete| Router
    View -->|Response HTML| User
```

1. **Read (`index`)**: `index.php` meneruskan permintaan ke `index()` pada Controller terkait. Controller mengambil data melalui Model (`getAll()`) dan memanggil View `index.php` untuk menampilkan tabel.
2. **Create (`create` & `store`)**: `create()` menampilkan form input beserta daftar relasi (departemen pada form dosen, dosen pada form mata kuliah). Pengiriman form menuju `store()` memvalidasi input, menyimpan data via Model (`create()`), lalu melakukan redirect ke halaman `index`.
3. **Update (`edit` & `update`)**: `edit($id)` mengambil data berdasarkan ID via Model (`getById()`) untuk mengisi form ubah. Pengiriman form menuju `update()` memperbarui baris di database via Model (`update()`), lalu redirect ke halaman `index`.
4. **Delete (`delete`)**: `delete($id)` menghapus baris berdasarkan ID melalui Model (`delete()`), lalu redirect kembali ke halaman `index`.

---

## 3. Panduan Menjalankan Program

### Prasyarat
- **PHP**: Versi 7.4 atau lebih baru (dengan ekstensi `pdo_mysql`).
- **Database**: MySQL / MariaDB (port default `3306`).

### Langkah Menjalankan
1. Nyalakan layanan MySQL, lalu impor berkas `tp_mvc25.sql` untuk membuat database `tp_mvc25` beserta tabel dan data awal:
   ```bash
   mysql -u root < tp_mvc25.sql
   ```
2. Sesuaikan konfigurasi koneksi pada `Project/config/Database.php` apabila *username* atau *password* MySQL berbeda.
3. Jalankan server PHP dari dalam direktori `Project/`:
   ```bash
   cd Project
   php -S localhost:8000
   ```
4. Buka browser dan akses `http://localhost:8000`.

---

## 4. Dokumentasi Program Saat Dijalankan

### A. Modul Dosen (*Lecturers*)
1. **Daftar Dosen Awal**
   ![Daftar Dosen](Dokumentasi/01_daftar_dosen.png)
2. **Form Tambah Dosen**
   ![Form Tambah Dosen](Dokumentasi/02_form_tambah_dosen.png)
3. **Hasil Tambah Dosen**
   ![Hasil Tambah Dosen](Dokumentasi/03_hasil_tambah_dosen.png)
4. **Form Ubah Data Dosen**
   ![Form Ubah Dosen](Dokumentasi/04_form_ubah_dosen.png)
5. **Hasil Ubah Data Dosen**
   ![Hasil Ubah Dosen](Dokumentasi/05_hasil_ubah_dosen.png)
6. **Hasil Hapus Data Dosen**
   ![Hasil Hapus Dosen](Dokumentasi/06_hasil_hapus_dosen.png)

### B. Modul Departemen (*Departments*)
1. **Daftar Departemen**
   ![Daftar Departemen](Dokumentasi/07_daftar_departemen.png)
2. **Form Tambah Departemen**
   ![Form Tambah Departemen](Dokumentasi/08_form_tambah_departemen.png)
3. **Hasil Tambah Departemen**
   ![Hasil Tambah Departemen](Dokumentasi/09_hasil_tambah_departemen.png)
4. **Form Ubah Data Departemen**
   ![Form Ubah Departemen](Dokumentasi/10_form_ubah_departemen.png)
5. **Hasil Ubah Data Departemen**
   ![Hasil Ubah Departemen](Dokumentasi/11_hasil_ubah_departemen.png)
6. **Hasil Hapus Data Departemen**
   ![Hasil Hapus Departemen](Dokumentasi/12_hasil_hapus_departemen.png)

### C. Modul Mata Kuliah (*Courses*)
1. **Daftar Mata Kuliah**
   ![Daftar Mata Kuliah](Dokumentasi/13_daftar_mata_kuliah.png)
2. **Form Tambah Mata Kuliah**
   ![Form Tambah Mata Kuliah](Dokumentasi/14_form_tambah_mata_kuliah.png)
3. **Hasil Tambah Mata Kuliah**
   ![Hasil Tambah Mata Kuliah](Dokumentasi/15_hasil_tambah_mata_kuliah.png)
4. **Form Ubah Data Mata Kuliah**
   ![Form Ubah Mata Kuliah](Dokumentasi/16_form_ubah_mata_kuliah.png)
5. **Hasil Ubah Data Mata Kuliah**
   ![Hasil Ubah Mata Kuliah](Dokumentasi/17_hasil_ubah_mata_kuliah.png)
6. **Hasil Hapus Data Mata Kuliah**
   ![Hasil Hapus Mata Kuliah](Dokumentasi/18_hasil_hapus_mata_kuliah.png)
