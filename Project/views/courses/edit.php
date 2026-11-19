<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="col-lg-6 m-auto">
  <!-- Form untuk mengubah data mata kuliah yang dipilih -->
  <form method="post" action="index.php?controller=course&action=update">
    <br><br>
    <div class="card p-4">
      <div class="card-header bg-warning mb-3">
        <h2 class="text-white text-center mb-0">Update Course</h2>
      </div>

      <input type="hidden" name="id" value="<?= (int)$course['id'] ?>">

      <label class="form-label">COURSE CODE:</label>
      <input type="text" name="course_code" value="<?= htmlspecialchars($course['course_code'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">COURSE NAME:</label>
      <input type="text" name="course_name" value="<?= htmlspecialchars($course['course_name'], ENT_QUOTES, 'UTF-8') ?>" class="form-control mb-3" required>

      <label class="form-label">CREDITS (SKS):</label>
      <input type="number" name="credits" min="1" max="6" value="<?= (int)$course['credits'] ?>" class="form-control mb-3" required>

      <label class="form-label">LECTURER:</label>
      <select name="lecturer_id" class="form-select mb-3" required>
        <option value="">-- Pilih Dosen Pengampu --</option>
        <?php foreach ($lecturers as $lect): ?>
          <option value="<?= (int)$lect['id'] ?>" <?= ((int)$course['lecturer_id'] === (int)$lect['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($lect['name'], ENT_QUOTES, 'UTF-8') ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button class="btn btn-success mb-2" type="submit" name="submit">Submit</button>
      <a class="btn btn-info text-white" href="index.php?controller=course&action=index">Cancel</a>
    </div>
  </form>
</div>

<?php
// Memuat bagian footer
require __DIR__ . '/../layout/footer.php';
?>
