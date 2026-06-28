<?php
require_once __DIR__ . '/../includes/auth.php';
checkAuth();

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - HCV</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    :root {
      --sidebar-width: 250px;
      --admin-header: 60px;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: #f8f9fa;
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: var(--sidebar-width);
      background: #1a1a2e;
      color: #fff;
      position: fixed;
      top: 0; left: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      z-index: 1000;
      transition: transform 0.3s ease;
    }
    .sidebar-brand {
      padding: 20px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .sidebar-brand svg { width: 35px; height: 35px; flex-shrink: 0; }
    .sidebar-brand h2 { font-size: 1.1rem; font-weight: 700; }
    .sidebar-brand small { font-size: 0.65rem; opacity: 0.6; display: block; }
    .sidebar-nav { flex: 1; padding: 15px 0; overflow-y: auto; }
    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 24px;
      color: rgba(255,255,255,0.6);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s;
      border-left: 3px solid transparent;
    }
    .sidebar-nav a:hover { color: #fff; background: rgba(255,255,255,0.05); }
    .sidebar-nav a.active {
      color: #14A5E5;
      background: rgba(20,165,229,0.1);
      border-left-color: #14A5E5;
    }
    .sidebar-nav a svg { width: 20px; height: 20px; flex-shrink: 0; }
    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid rgba(255,255,255,0.1);
    }
    .sidebar-footer a {
      color: rgba(255,255,255,0.5);
      text-decoration: none;
      font-size: 0.85rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .sidebar-footer a:hover { color: #F2172D; }
    .main-content {
      margin-left: var(--sidebar-width);
      flex: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .admin-header {
      height: var(--admin-header);
      background: #fff;
      border-bottom: 1px solid #e9ecef;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .admin-header h3 { font-size: 1.2rem; font-weight: 700; }
    .admin-user { display: flex; align-items: center; gap: 12px; }
    .admin-avatar {
      width: 36px; height: 36px;
      background: #14A5E5;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 700; font-size: 0.85rem;
    }
    .page-content { padding: 30px; flex: 1; }
    .toggle-sidebar {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      padding: 5px;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
    .stat-card {
      padding: 25px;
      border-radius: 12px;
      color: #fff;
    }
    .stat-card h3 { font-size: 2rem; font-weight: 800; margin-bottom: 5px; }
    .stat-card p { font-size: 0.85rem; opacity: 0.85; margin: 0; }
    .stat-icon { font-size: 2.5rem; opacity: 0.3; }
    .table th { font-weight: 600; font-size: 0.85rem; color: #6c757d; border-top: none; }
    .table td { vertical-align: middle; }
    .btn-sm { padding: 6px 14px; font-size: 0.8rem; border-radius: 8px; }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      .main-content { margin-left: 0; }
      .toggle-sidebar { display: block; }
      .page-content { padding: 20px 15px; }
    }
  </style>
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="45" fill="#14A5E5"/>
        <text x="50" y="58" font-size="32" font-weight="bold" fill="white" text-anchor="middle" font-family="Arial">HCV</text>
      </svg>
      <div>
        <h2>HCV Admin</h2>
        <small>Dashboard</small>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="dashboard.php" class="<?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="gallery.php" class="<?= $currentPage === 'gallery.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        Gallery
      </a>
      <a href="blog.php" class="<?= $currentPage === 'blog.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
        Blog Posts
      </a>
      <a href="events.php" class="<?= $currentPage === 'events.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Events
      </a>
      <a href="testimonials.php" class="<?= $currentPage === 'testimonials.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        Testimonials
      </a>
      <a href="partners.php" class="<?= $currentPage === 'partners.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Partners
      </a>
      <a href="donations.php" class="<?= $currentPage === 'donations.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        Donation Info
      </a>
      <a href="messages.php" class="<?= $currentPage === 'messages.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        Messages
      </a>
      <a href="contacts.php" class="<?= $currentPage === 'contacts.php' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        Contact Info
      </a>
    </nav>
    <div class="sidebar-footer">
      <a href="logout.php">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Sign Out
      </a>
    </div>
  </aside>

  <div class="main-content">
    <header class="admin-header">
      <div style="display:flex;align-items:center;gap:15px;">
        <button class="toggle-sidebar" onclick="document.getElementById('sidebar').classList.toggle('open')">&#9776;</button>
        <h3><?= ucfirst(str_replace('.php', '', $currentPage)) ?></h3>
      </div>
      <div class="admin-user">
        <span style="font-size:0.9rem;color:#6c757d;"><?= htmlspecialchars($_SESSION['username']) ?></span>
        <div class="admin-avatar"><?= strtoupper(substr($_SESSION['username'], 0, 1)) ?></div>
      </div>
    </header>
    <div class="page-content">
