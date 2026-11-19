<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="col-lg-6 m-auto">
  <!-- Form untuk mengubah data dosen yang dipilih -->
  <form method="post" action="index.php?controller=lecturer&action=update">
    <br><br>
    <div class="card p-4">
      <div class="card-header bg-warning mb-3">
        <h2 class="text-white text-center mb-0">Update Lecturer</h2>
      </div>

      <input type="hidden" name="id" value="<?= (int)$lecturer['id'] ?>">

      <label class="form-label">NAME:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($lecturer['name'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">NIDN:</label>
      <input type="text" name="nidn" value="<?= htmlspecialchars($lecturer['nidn'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">PHONE:</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($lecturer['phone'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">JOIN DATE:</label>
      <input type="date" name="join_date" value="<?= htmlspecialchars($lecturer['join_date'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">DEPARTMENT:</label>
      <select name="department_id" class="form-select mb-3">
        <option value="">-- Pilih Departemen --</option>
        <?php foreach ($departments as $dept): ?>
          <option value="<?= (int)$dept['id'] ?>" <?= ((int)$lecturer['department_id'] === (int)$dept['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($dept['name'], ENT_QUOTES, 'UTF-8') ?>
          </option>
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
