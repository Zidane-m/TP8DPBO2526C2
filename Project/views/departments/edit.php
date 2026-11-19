<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="col-lg-6 m-auto">
  <!-- Form untuk mengubah data departemen yang dipilih -->
  <form method="post" action="index.php?controller=department&action=update">
    <br><br>
    <div class="card p-4">
      <div class="card-header bg-warning mb-3">
        <h2 class="text-white text-center mb-0">Update Department</h2>
      </div>

      <input type="hidden" name="id" value="<?= (int)$department['id'] ?>">

      <label class="form-label">CODE:</label>
      <input type="text" name="code" value="<?= htmlspecialchars($department['code'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">NAME:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($department['name'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">FACULTY:</label>
      <input type="text" name="faculty" value="<?= htmlspecialchars($department['faculty'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <button class="btn btn-success mb-2" type="submit" name="submit">Submit</button>
      <a class="btn btn-info text-white" href="index.php?controller=department&action=index">Cancel</a>
    </div>
  </form>
</div>

<?php
// Memuat bagian footer
require __DIR__ . '/../layout/footer.php';
?>
