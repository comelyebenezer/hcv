<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$info = $db->fetchOne("SELECT * FROM contact_info ORDER BY id DESC LIMIT 1");
if (!$info) $info = [];
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Contact Information</h5>
    <p class="text-muted mb-4">Update the contact details displayed on the website.</p>
    <form id="contactInfoForm">
      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label fw600">Address</label>
          <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($info['address'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($info['phone'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($info['email'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Facebook URL</label>
          <input type="url" name="facebook" class="form-control" value="<?= htmlspecialchars($info['facebook'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Twitter URL</label>
          <input type="url" name="twitter" class="form-control" value="<?= htmlspecialchars($info['twitter'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">Instagram URL</label>
          <input type="url" name="instagram" class="form-control" value="<?= htmlspecialchars($info['instagram'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label fw600">LinkedIn URL</label>
          <input type="url" name="linkedin" class="form-control" value="<?= htmlspecialchars($info['linkedin'] ?? '') ?>">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save Contact Info</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.getElementById('contactInfoForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Saving...';
  try {
    const formData = new URLSearchParams(new FormData(this));
    const res = await fetch('../api/contact_info_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    alert(data.message || (data.success ? 'Saved!' : 'Error'));
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Save Contact Info'; }
});
</script>
<?php require_once 'footer.php'; ?>
