<?php
// Memuat bagian header dan navbar
require __DIR__ . '/../layout/header.php';
?>

<div class="col-lg-6 m-auto">
  <!-- Form untuk menambahkan data departemen baru -->
  <form method="post" action="index.php?controller=department&action=store">
    <br><br>
    <div class="card p-4">
      <div class="card-header bg-primary mb-3">
        <h2 class="text-white text-center mb-0">Create Department</h2>
      </div>

      <label class="form-label">CODE:</label>
      <input type="text" name="code" class="form-control mb-3" required>

      <label class="form-label">NAME:</label>
      <input type="text" name="name" class="form-control mb-3" required>

      <label class="form-label">FACULTY:</label>
      <input type="text" name="faculty" class="form-control mb-3" required>

      <button class="btn btn-success mb-2" type="submit" name="submit">Submit</button>
      <a class="btn btn-info text-white" href="index.php?controller=department&action=index">Cancel</a>
    </div>
  </form>
</div>

<?php
// Memuat bagian footer
require __DIR__ . '/../layout/footer.php';
?>
