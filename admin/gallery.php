<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$items = $db->fetchAll("SELECT * FROM gallery ORDER BY created_at DESC");
$categories = $db->fetchAll("SELECT DISTINCT category FROM gallery ORDER BY category");
?>
<div class="card mb-4">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title fw-bold mb-0">Upload Media</h5>
    </div>
    <form id="uploadForm" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label fw600">Title *</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Type</label>
          <select name="type" class="form-select" id="mediaType">
            <option value="image">Image</option>
            <option value="video">Video</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Category</label>
          <input type="text" name="category" class="form-control" placeholder="e.g., outreach" list="catList">
          <datalist id="catList">
            <?php foreach ($categories as $c): ?>
              <option value="<?= htmlspecialchars($c['category']) ?>">
            <?php endforeach; ?>
          </datalist>
        </div>
        <div class="col-md-2">
          <div class="form-check mt-4">
            <input type="checkbox" name="featured" class="form-check-input" id="featuredCheck">
            <label class="form-check-label" for="featuredCheck">Featured</label>
          </div>
        </div>
        <div class="col-md-6" id="fileUploadGroup">
          <label class="form-label fw600">File</label>
          <input type="file" name="file" class="form-control" accept="image/*,.mp4,.webm" id="fileInput">
        </div>
        <div class="col-md-6" id="videoUrlGroup" style="display:none;">
          <label class="form-label fw600">Video URL (YouTube/Vimeo)</label>
          <input type="text" name="video_url" class="form-control" placeholder="https://youtube.com/watch?v=...">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Upload Media</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Gallery Items</h5>
    <?php if (count($items) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Preview</th>
              <th>Title</th>
              <th>Type</th>
              <th>Category</th>
              <th>Featured</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $item): ?>
              <tr>
                <td>
                  <?php if ($item['type'] === 'image'): ?>
                    <img src="../assets/uploads/gallery/<?= htmlspecialchars($item['file_path']) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                  <?php else: ?>
                    <div style="width:60px;height:60px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:0.7rem;color:#666;">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    </div>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($item['title']) ?></td>
                <td><span class="badge bg-<?= $item['type'] === 'image' ? 'success' : 'warning' ?>"><?= $item['type'] ?></span></td>
                <td><?= htmlspecialchars($item['category']) ?></td>
                <td><?= $item['featured'] ? '&#10003;' : '-' ?></td>
                <td><?= formatDate($item['created_at'], 'M d, Y') ?></td>
                <td>
                  <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-outline-primary edit-item" data-id="<?= $item['id'] ?>" data-title="<?= htmlspecialchars($item['title']) ?>" data-category="<?= htmlspecialchars($item['category']) ?>">Edit</button>
                    <button class="btn btn-sm btn-outline-danger delete-item" data-id="<?= $item['id'] ?>">Delete</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No gallery items uploaded yet.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Edit Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="editForm">
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">
          <div class="mb-3">
            <label class="form-label fw600">Title</label>
            <input type="text" name="title" id="editTitle" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw600">Category</label>
            <input type="text" name="category" id="editCategory" class="form-control">
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input" id="editFeatured">
            <label class="form-check-label" for="editFeatured">Featured</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('mediaType').addEventListener('change', function() {
  document.getElementById('fileUploadGroup').style.display = this.value === 'image' ? 'block' : 'none';
  document.getElementById('videoUrlGroup').style.display = this.value === 'video' ? 'block' : 'none';
  document.getElementById('fileInput').required = this.value === 'image';
});

document.getElementById('uploadForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Uploading...';
  try {
    const formData = new FormData(this);
    // Ensure type is always sent
    formData.set('type', document.getElementById('mediaType').value);
    const res = await fetch('../api/gallery.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) { location.reload(); }
    else { alert(data.error || 'Upload failed'); }
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Upload Media'; }
});

document.querySelectorAll('.delete-item').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete this item?')) return;
    const id = this.dataset.id;
    const res = await fetch(`../api/gallery.php?id=${id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
    else alert('Delete failed');
  });
});

document.querySelectorAll('.edit-item').forEach(btn => {
  btn.addEventListener('click', function() {
    document.getElementById('editId').value = this.dataset.id;
    document.getElementById('editTitle').value = this.dataset.title;
    document.getElementById('editCategory').value = this.dataset.category;
    new bootstrap.Modal(document.getElementById('editModal')).show();
  });
});

document.getElementById('editForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const id = document.getElementById('editId').value;
  const data = new URLSearchParams();
  data.append('title', document.getElementById('editTitle').value);
  data.append('category', document.getElementById('editCategory').value);
  data.append('featured', document.getElementById('editFeatured').checked ? '1' : '0');
  const res = await fetch(`../api/gallery.php?id=${id}`, { method: 'PUT', body: data });
  const result = await res.json();
  if (result.success) location.reload();
  else alert('Update failed');
});
</script>
<?php require_once 'footer.php'; ?>
