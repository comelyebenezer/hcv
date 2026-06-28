    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
      const sidebar = document.getElementById('sidebar');
      const toggle = document.querySelector('.toggle-sidebar');
      if (window.innerWidth <= 768 && sidebar.classList.contains('open') && 
          !sidebar.contains(e.target) && !toggle.contains(e.target)) {
        sidebar.classList.remove('open');
      }
    });
  </script>
</body>
</html>
