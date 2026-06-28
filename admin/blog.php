<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$posts = $db->fetchAll("SELECT * FROM blog_posts ORDER BY created_at DESC");
?>
<div class="card mb-4">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title fw-bold mb-0">Create Blog Post</h5>
    </div>
    <form id="postForm" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-8">
          <label class="form-label fw600">Title *</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label fw600">Category</label>
          <select name="category" class="form-select">
            <option value="Health Tips">Health Tips</option>
            <option value="Awareness Campaigns">Awareness Campaigns</option>
            <option value="Success Stories">Success Stories</option>
            <option value="Community Projects">Community Projects</option>
            <option value="Public Health">Public Health Updates</option>
          </select>
        </div>
        <div class="col-md-12">
          <label class="form-label fw600">Excerpt</label>
          <textarea name="excerpt" class="form-control" rows="2"></textarea>
        </div>
        <div class="col-md-12">
          <label class="form-label fw600">Content *</label>
          <textarea name="content" class="form-control" rows="8" required></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Featured Image</label>
          <input type="file" name="featured_image" class="form-control" accept="image/*">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Author</label>
          <input type="text" name="author" class="form-control" value="HCV">
        </div>
        <div class="col-md-3">
          <div class="form-check mt-4">
            <input type="checkbox" name="featured" class="form-check-input" id="postFeatured">
            <label class="form-check-label" for="postFeatured">Featured Post</label>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Publish Post</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">All Posts</h5>
    <?php if (count($posts) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Author</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($posts as $p): ?>
              <tr>
                <td><?= htmlspecialchars($p['title']) ?></td>
                <td><span class="badge bg-info"><?= htmlspecialchars($p['category']) ?></span></td>
                <td><?= htmlspecialchars($p['author']) ?></td>
                <td><span class="badge bg-<?= $p['status'] === 'published' ? 'success' : 'secondary' ?>"><?= $p['status'] ?></span></td>
                <td><?= formatDate($p['created_at'], 'M d, Y') ?></td>
                <td>
                  <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-outline-danger delete-post" data-id="<?= $p['id'] ?>">Delete</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No posts yet.</p>
    <?php endif; ?>
  </div>
</div>

<script>
document.getElementById('postForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Publishing...';
  try {
    const formData = new FormData(this);
    const res = await fetch('../api/blog_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.error || 'Failed');
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Publish Post'; }
});

document.querySelectorAll('.delete-post').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete this post?')) return;
    const res = await fetch(`../api/blog_admin.php?id=${this.dataset.id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
    else alert('Delete failed');
  });
});
</script>
<?php require_once 'footer.php'; ?>
