<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$stats = [
    'gallery' => $db->fetchOne("SELECT COUNT(*) as count FROM gallery")['count'],
    'images' => $db->fetchOne("SELECT COUNT(*) as count FROM gallery WHERE type='image'")['count'],
    'videos' => $db->fetchOne("SELECT COUNT(*) as count FROM gallery WHERE type='video'")['count'],
    'blog' => $db->fetchOne("SELECT COUNT(*) as count FROM blog_posts")['count'],
    'events' => $db->fetchOne("SELECT COUNT(*) as count FROM events")['count'],
    'testimonials' => $db->fetchOne("SELECT COUNT(*) as count FROM testimonials")['count'],
    'partners' => $db->fetchOne("SELECT COUNT(*) as count FROM partners")['count'],
    'messages' => $db->fetchOne("SELECT COUNT(*) as count FROM contact_messages")['count'],
    'unread' => $db->fetchOne("SELECT COUNT(*) as count FROM contact_messages WHERE read_status=0")['count'],
    'subscribers' => $db->fetchOne("SELECT COUNT(*) as count FROM newsletter_subscribers")['count'],
];
$recentMessages = $db->fetchAll("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");
?>
<div class="row mb-4">
  <div class="col-md-12">
    <h4 style="font-weight:700;">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h4>
    <p style="color:#6c757d;">Here's an overview of your website.</p>
  </div>
</div>

<div class="row g-4 mb-4">
  <div class="col-md-3 col-sm-6">
    <div class="stat-card" style="background:linear-gradient(135deg,#14A5E5,#0d8bc4);">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3><?= $stats['gallery'] ?></h3>
          <p>Gallery Items</p>
        </div>
        <div class="stat-icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card" style="background:linear-gradient(135deg,#F2172D,#d01224);">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3><?= $stats['blog'] ?></h3>
          <p>Blog Posts</p>
        </div>
        <div class="stat-icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card" style="background:linear-gradient(135deg,#198754,#157347);">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3><?= $stats['events'] ?></h3>
          <p>Events</p>
        </div>
        <div class="stat-icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="stat-card" style="background:linear-gradient(135deg,#6f42c1,#553098);">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h3><?= $stats['messages'] ?></h3>
          <p>Messages</p>
          <?php if ($stats['unread'] > 0): ?>
            <small style="opacity:0.9;"><?= $stats['unread'] ?> unread</small>
          <?php endif; ?>
        </div>
        <div class="stat-icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-3">Recent Messages</h5>
        <?php if (count($recentMessages) > 0): ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($recentMessages as $msg): ?>
                  <tr style="<?= $msg['read_status'] ? '' : 'font-weight:600;' ?>">
                    <td><?= htmlspecialchars($msg['name']) ?></td>
                    <td><?= htmlspecialchars($msg['email']) ?></td>
                    <td><?= htmlspecialchars($msg['subject'] ?: 'No subject') ?></td>
                    <td><?= formatDate($msg['created_at'], 'M d, Y') ?></td>
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
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-3">Quick Stats</h5>
        <div style="display:flex;flex-direction:column;gap:10px;">
          <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">
            <span>Testimonials</span>
            <span class="badge bg-primary rounded-pill"><?= $stats['testimonials'] ?></span>
          </div>
          <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">
            <span>Partners</span>
            <span class="badge bg-primary rounded-pill"><?= $stats['partners'] ?></span>
          </div>
          <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">
            <span>Newsletter Subscribers</span>
            <span class="badge bg-primary rounded-pill"><?= $stats['subscribers'] ?></span>
          </div>
          <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">
            <span>Images</span>
            <span class="badge bg-primary rounded-pill"><?= $stats['images'] ?></span>
          </div>
          <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background:#f8f9fa;">
            <span>Videos</span>
            <span class="badge bg-primary rounded-pill"><?= $stats['videos'] ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>
