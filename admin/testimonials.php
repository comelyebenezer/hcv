<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$items = $db->fetchAll("SELECT * FROM testimonials ORDER BY created_at DESC");
?>
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Add Testimonial</h5>
    <form id="testimonialForm" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw600">Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw600">Position</label>
          <input type="text" name="position" class="form-control" placeholder="e.g., Community Leader">
        </div>
        <div class="col-md-4">
          <label class="form-label fw600">Photo</label>
          <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <div class="col-md-12">
          <label class="form-label fw600">Testimonial *</label>
          <textarea name="content" class="form-control" rows="3" required></textarea>
        </div>
        <div class="col-md-3">
          <div class="form-check mt-4">
            <input type="checkbox" name="featured" class="form-check-input" id="testFeatured">
            <label class="form-check-label" for="testFeatured">Featured</label>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Add Testimonial</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Testimonials</h5>
    <?php if (count($items) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Content</th>
              <th>Featured</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $t): ?>
              <tr>
                <td><?= htmlspecialchars($t['name']) ?></td>
                <td><?= htmlspecialchars($t['position'] ?: '-') ?></td>
                <td><?= htmlspecialchars(truncateText($t['content'], 80)) ?></td>
                <td><?= $t['featured'] ? '&#10003;' : '-' ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-danger delete-item" data-id="<?= $t['id'] ?>">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No testimonials yet.</p>
    <?php endif; ?>
  </div>
</div>

<script>
document.getElementById('testimonialForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Saving...';
  try {
    const formData = new FormData(this);
    const res = await fetch('../api/testimonials_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.error || 'Failed');
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Add Testimonial'; }
});

document.querySelectorAll('.delete-item').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete?')) return;
    const res = await fetch(`../api/testimonials_admin.php?id=${this.dataset.id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
    else alert('Delete failed');
  });
});
</script>
<?php require_once 'footer.php'; ?>
