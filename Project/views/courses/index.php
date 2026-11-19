<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Courses</h2>
    <a class="btn btn-primary" href="index.php?controller=course&action=create">Add New</a>
  </div>

  <!-- Tabel daftar mata kuliah -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>CODE</th>
        <th>COURSE NAME</th>
        <th>CREDITS</th>
        <th>LECTURER</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($courses as $row): ?>
      <tr>
        <th><?= (int)$row['id'] ?></th>
        <td><?= htmlspecialchars($row['course_code'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['course_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= (int)$row['credits'] ?></td>
        <td><?= htmlspecialchars($row['lecturer_name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td>
          <a class="btn btn-success btn-sm" href="index.php?controller=course&action=edit&id=<?= (int)$row['id'] ?>">Edit</a>
          <a class="btn btn-danger btn-sm" href="index.php?controller=course&action=delete&id=<?= (int)$row['id'] ?>" onclick="return confirm('Hapus mata kuliah ini?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php
// Memuat bagian footer
require __DIR__ . '/../layout/footer.php';
?>
