<?php require_once 'header.php'; ?>
<?php
$db = getDB();
$info = $db->fetchOne("SELECT * FROM donation_info ORDER BY id DESC LIMIT 1");
if (!$info) {
    $info = ['bank_name' => '', 'account_name' => '', 'account_number' => ''];
}
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-3">Donation Information</h5>
    <p class="text-muted mb-4">Update the bank details shown to donors when they click "Donate Now".</p>
    <form id="donationForm">
      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label fw600">Bank Name</label>
          <input type="text" name="bank_name" class="form-control" value="<?= htmlspecialchars($info['bank_name']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Account Name</label>
          <input type="text" name="account_name" class="form-control" value="<?= htmlspecialchars($info['account_name']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label fw600">Account Number</label>
          <input type="text" name="account_number" class="form-control" value="<?= htmlspecialchars($info['account_number']) ?>" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save Donation Info</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.getElementById('donationForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true; btn.textContent = 'Saving...';
  try {
    const formData = new URLSearchParams(new FormData(this));
    const res = await fetch('../api/donation_admin.php', { method: 'POST', body: formData });
    const data = await res.json();
    alert(data.message || (data.success ? 'Saved!' : 'Error'));
  } catch (err) { alert('Network error'); }
  finally { btn.disabled = false; btn.textContent = 'Save Donation Info'; }
});
</script>
<?php require_once 'footer.php'; ?>
