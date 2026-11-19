<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="col-lg-6 m-auto">
  <!-- Form untuk menambahkan data dosen baru -->
  <form method="post" action="index.php?controller=lecturer&action=store">
    <br><br>
    <div class="card p-4">
      <div class="card-header bg-primary mb-3">
        <h2 class="text-white text-center mb-0">Create Lecturer</h2>
      </div>

      <label class="form-label">NAME:</label>
      <input type="text" name="name" class="form-control mb-3" required>

      <label class="form-label">NIDN:</label>
      <input type="text" name="nidn" class="form-control mb-3" required>

      <label class="form-label">PHONE:</label>
      <input type="text" name="phone" class="form-control mb-3" required>

      <label class="form-label">JOIN DATE:</label>
      <input type="date" name="join_date" class="form-control mb-3" required>

      <label class="form-label">DEPARTMENT:</label>
      <select name="department_id" class="form-select mb-3">
        <option value="">-- Pilih Departemen --</option>
        <?php foreach ($departments as $dept): ?>
          <option value="<?= (int)$dept['id'] ?>"><?= htmlspecialchars($dept['name'], ENT_QUOTES, 'UTF-8') ?></option>
        <?php endforeach; ?>
      </select>

      <button class="btn btn-success mb-2" type="submit" name="submit">Submit</button>
      <a class="btn btn-info text-white" href="index.php?controller=lecturer&action=index">Cancel</a>
    </div>
  </form>
</div>

<?php
// Memuat bagian footer
require __DIR__ . '/../layout/footer.php';
?>
