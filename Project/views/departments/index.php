<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Departments</h2>
    <a class="btn btn-primary" href="index.php?controller=department&action=create">Add New</a>
  </div>

  <!-- Tabel daftar departemen -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>CODE</th>
        <th>NAME</th>
        <th>FACULTY</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($departments as $row): ?>
      <tr>
        <th><?= (int)$row['id'] ?></th>
        <td><?= htmlspecialchars($row['code'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
        <td><?= htmlspecialchars($row['faculty'], ENT_QUOTES, 'UTF-8') ?></td>
        <td>
          <a class="btn btn-success btn-sm" href="index.php?controller=department&action=edit&id=<?= (int)$row['id'] ?>">Edit</a>
          <a class="btn btn-danger btn-sm" href="index.php?controller=department&action=delete&id=<?= (int)$row['id'] ?>" onclick="return confirm('Hapus data departemen ini?')">Delete</a>
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
