<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$events = $db->fetchAll("SELECT * FROM events ORDER BY event_date ASC");
?>
<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Create Event</h5>
    <form id="eventForm" enctype="multipart/form-data">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label fw600">Title *</label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Date *</label>
          <input type="date" name="event_date" class="form-control" required>
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Time</label>
          <input type="time" name="event_time" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Location</label>
          <input type="text" name="location" class="form-control" placeholder="Event venue">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Status</label>
          <select name="status" class="form-select">
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Image</label>
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="col-12">
          <label class="form-label fw600">Description</label>
          <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Create Event</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">All Events</h5>
    <?php if (count($events) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Date</th>
              <th>Location</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($events as $e): ?>
              <tr>
                <td><?= htmlspecialchars($e['title']) ?></td>
                <td><?= formatDate($e['event_date'], 'M d, Y') ?></td>
                <td><?= htmlspecialchars($e['location'] ?: '-') ?></td>
                <td><span class="badge bg-<?= $e['status'] === 'upcoming' ? 'primary' : ($e['status'] === 'ongoing' ? 'success' : 'secondary') ?>"><?= $e['status'] ?></span></td>
                <td>
                  <button class="btn btn-sm btn-outline-danger delete-event" data-id="<?= $e['id'] ?>">Delete</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No events created.</p>
    <?php endif; ?>
  </div>
</div>

<script>
document.getElementById('eventForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Creating...';
  try {
    const formData = new FormData(this);
    const res = await fetch('../api/events_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.error || 'Failed');
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Create Event'; }
});

document.querySelectorAll('.delete-event').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete this event?')) return;
    const res = await fetch(`../api/events_admin.php?id=${this.dataset.id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
    else alert('Delete failed');
  });
});
</script>
<?php require_once 'footer.php'; ?>
