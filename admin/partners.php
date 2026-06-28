<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$items = $db->fetchAll("SELECT * FROM partners ORDER BY display_order ASC");
?>
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Add Partner</h5>
    <form id="partnerForm" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw600">Name *</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw600">Category</label>
          <input type="text" name="category" class="form-control" value="partner">
        </div>
        <div class="col-md-4">
          <label class="form-label fw600">Logo *</label>
          <input type="file" name="logo" class="form-control" accept="image/*" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Website</label>
          <input type="url" name="website" class="form-control" placeholder="https://">
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Display Order</label>
          <input type="number" name="display_order" class="form-control" value="0">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Add Partner</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Partners</h5>
    <?php if (count($items) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Logo</th>
              <th>Name</th>
              <th>Category</th>
              <th>Order</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $p): ?>
              <tr>
                <td>
                  <?php if ($p['logo']): ?>
                    <img src="../assets/uploads/partners/<?= htmlspecialchars($p['logo']) ?>" alt="" style="width:50px;height:50px;object-fit:contain;border-radius:8px;">
                  <?php else: ?>
                    -
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= htmlspecialchars($p['category']) ?></td>
                <td><?= $p['display_order'] ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-danger delete-item" data-id="<?= $p['id'] ?>">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No partners added.</p>
    <?php endif; ?>
  </div>
</div>

<script>
document.getElementById('partnerForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Saving...';
  try {
    const formData = new FormData(this);
    const res = await fetch('../api/partners_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.error || 'Failed');
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Add Partner'; }
});

document.querySelectorAll('.delete-item').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete?')) return;
    const res = await fetch(`../api/partners_admin.php?id=${this.dataset.id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
    else alert('Delete failed');
  });
});
</script>
<?php require_once 'footer.php'; ?>
