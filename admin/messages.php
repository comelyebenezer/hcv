<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$messages = $db->fetchAll("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Contact Messages</h5>
    <?php if (count($messages) > 0): ?>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($messages as $m): ?>
              <tr style="<?= $m['read_status'] ? '' : 'font-weight:600;background:#f0f7ff;' ?>">
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><a href="mailto:<?= htmlspecialchars($m['email']) ?>"><?= htmlspecialchars($m['email']) ?></a></td>
                <td><?= htmlspecialchars($m['phone'] ?: '-') ?></td>
                <td><?= htmlspecialchars($m['subject'] ?: '-') ?></td>
                <td><?= htmlspecialchars(truncateText($m['message'], 60)) ?></td>
                <td><?= formatDate($m['created_at'], 'M d, Y') ?></td>
                <td>
                  <div class="d-flex gap-1">
                    <?php if (!$m['read_status']): ?>
                      <button class="btn btn-sm btn-outline-success mark-read" data-id="<?= $m['id'] ?>">Mark Read</button>
                    <?php endif; ?>
                    <button class="btn btn-sm btn-outline-danger delete-message" data-id="<?= $m['id'] ?>">Delete</button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-muted mb-0">No messages yet.</p>
    <?php endif; ?>
  </div>
</div>

<script>
document.querySelectorAll('.mark-read').forEach(btn => {
  btn.addEventListener('click', async function() {
    const res = await fetch('../api/messages_admin.php', {
      method: 'PUT',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `id=${this.dataset.id}&read_status=1`
    });
    const data = await res.json();
    if (data.success) location.reload();
  });
});

document.querySelectorAll('.delete-message').forEach(btn => {
  btn.addEventListener('click', async function() {
    if (!confirm('Delete this message?')) return;
    const res = await fetch(`../api/messages_admin.php?id=${this.dataset.id}`, { method: 'DELETE' });
    const data = await res.json();
    if (data.success) location.reload();
  });
});
</script>
<?php require_once 'footer.php'; ?>
