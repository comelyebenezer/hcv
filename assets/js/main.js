// HCV Main JavaScript

document.addEventListener('DOMContentLoaded', () => {

  // ====== Preloader ======
  const preloader = document.getElementById('preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      setTimeout(() => preloader.classList.add('hidden'), 500);
    });
    // Fallback
    setTimeout(() => preloader.classList.add('hidden'), 3000);
  }

  // ====== Navbar Toggle ======
  const navToggle = document.querySelector('.nav-toggle');
  const navLinks = document.querySelector('.nav-links');
  if (navToggle) {
    navToggle.addEventListener('click', () => {
      navLinks.classList.toggle('open');
      navToggle.classList.toggle('active');
    });
    // Close on link click
    document.querySelectorAll('.nav-links a').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('open');
        navToggle.classList.remove('active');
      });
    });
  }

  // ====== Navbar Scroll Effect ======
  const navbar = document.querySelector('.navbar');
  const backToTop = document.querySelector('.back-to-top');
  
  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    if (navbar) navbar.classList.toggle('scrolled', scrollY > 50);
    if (backToTop) backToTop.classList.toggle('visible', scrollY > 500);
  });

  // ====== Active Nav Link ======
  const sections = document.querySelectorAll('section[id]');
  const navAnchors = document.querySelectorAll('.nav-links a[href^="#"]');
  
  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
      const top = section.offsetTop - 150;
      const height = section.offsetHeight;
      if (window.scrollY >= top && window.scrollY < top + height) {
        current = section.getAttribute('id');
      }
    });
    navAnchors.forEach(a => {
      a.classList.toggle('active', a.getAttribute('href') === '#' + current);
    });
  });

  // ====== Smooth Scroll ======
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // ====== Impact Counter Animation ======
  function animateCounter(element, target, suffix = '') {
    const duration = 2000;
    const steps = 60;
    const increment = target / steps;
    let current = 0;
    const startTime = performance.now();

    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      current = Math.floor(target * eased);
      element.textContent = current.toLocaleString() + suffix;
      if (progress < 1) requestAnimationFrame(update);
      else element.textContent = target.toLocaleString() + suffix;
    }
    requestAnimationFrame(update);
  }

  const impactObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target.querySelector('.impact-number');
        if (counter && !counter.dataset.animated) {
          counter.dataset.animated = 'true';
          const target = parseInt(counter.dataset.target) || 0;
          const suffix = counter.dataset.suffix || '+';
          animateCounter(counter, target, suffix);
        }
        impactObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('.impact-card').forEach(card => impactObserver.observe(card));

  // ====== Gallery Tabs ======
  const galleryTabs = document.querySelectorAll('.gallery-tab');
  const galleryItems = document.querySelectorAll('.masonry-item');
  
  galleryTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      galleryTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const filter = tab.dataset.filter;
      
      galleryItems.forEach(item => {
        if (filter === 'all' || item.dataset.category === filter) {
          item.style.display = 'block';
          setTimeout(() => item.style.opacity = '1', 50);
        } else {
          item.style.opacity = '0';
          setTimeout(() => item.style.display = 'none', 300);
        }
      });
    });
  });

  // ====== Lightbox ======
  const lightbox = document.querySelector('.lightbox');
  const lightboxImg = lightbox?.querySelector('.lightbox-content img');
  const lightboxVideo = lightbox?.querySelector('.lightbox-content video');
  const lightboxCaption = lightbox?.querySelector('.lightbox-caption');
  const lightboxClose = lightbox?.querySelector('.lightbox-close');
  const lightboxPrev = lightbox?.querySelector('.lightbox-nav.prev');
  const lightboxNext = lightbox?.querySelector('.lightbox-nav.next');
  let currentLightboxIndex = 0;
  let lightboxItems = [];

  function openLightbox(index, items) {
    if (!lightbox) return;
    lightboxItems = items;
    currentLightboxIndex = index;
    showLightboxItem(index);
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function showLightboxItem(index) {
    const item = lightboxItems[index];
    if (!item) return;
    
    lightboxImg.style.display = 'none';
    lightboxVideo.style.display = 'none';
    lightboxCaption.textContent = item.title || '';

    if (item.type === 'video' || item.videoUrl) {
      lightboxVideo.src = item.videoUrl || item.src;
      lightboxVideo.style.display = 'block';
      lightboxVideo.play();
    } else {
      lightboxImg.src = item.src;
      lightboxImg.style.display = 'block';
      if (lightboxVideo.src) {
        lightboxVideo.pause();
        lightboxVideo.src = '';
      }
    }

    if (lightboxPrev) lightboxPrev.style.display = lightboxItems.length > 1 ? 'flex' : 'none';
    if (lightboxNext) lightboxNext.style.display = lightboxItems.length > 1 ? 'flex' : 'none';
  }

  function closeLightbox() {
    if (!lightbox) return;
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
    if (lightboxVideo) { lightboxVideo.pause(); lightboxVideo.src = ''; }
  }

  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
  if (lightbox) lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft' && lightbox?.classList.contains('active')) {
      currentLightboxIndex = (currentLightboxIndex - 1 + lightboxItems.length) % lightboxItems.length;
      showLightboxItem(currentLightboxIndex);
    }
    if (e.key === 'ArrowRight' && lightbox?.classList.contains('active')) {
      currentLightboxIndex = (currentLightboxIndex + 1) % lightboxItems.length;
      showLightboxItem(currentLightboxIndex);
    }
  });
  if (lightboxPrev) lightboxPrev.addEventListener('click', () => {
    currentLightboxIndex = (currentLightboxIndex - 1 + lightboxItems.length) % lightboxItems.length;
    showLightboxItem(currentLightboxIndex);
  });
  if (lightboxNext) lightboxNext.addEventListener('click', () => {
    currentLightboxIndex = (currentLightboxIndex + 1) % lightboxItems.length;
    showLightboxItem(currentLightboxIndex);
  });

  // Attach lightbox to gallery items
  document.querySelectorAll('.masonry-item').forEach((item, index) => {
    item.addEventListener('click', () => {
      const allItems = Array.from(document.querySelectorAll('.masonry-item:not([style*="display: none"])'));
      const idx = allItems.indexOf(item);
      const itemsData = allItems.map(i => ({
        src: i.dataset.src || i.querySelector('img')?.src || '',
        videoUrl: i.dataset.video || '',
        type: i.dataset.type || 'image',
        title: i.dataset.title || i.querySelector('.masonry-overlay h4')?.textContent || ''
      }));
      openLightbox(idx, itemsData);
    });
  });

  // ====== Testimonial Slider ======
  const testimonialSlides = document.querySelectorAll('.testimonial-slide');
  const testimonialDots = document.querySelectorAll('.testimonial-dot');
  let currentTestimonial = 0;

  function showTestimonial(index) {
    testimonialSlides.forEach((slide, i) => {
      slide.style.display = i === index ? 'block' : 'none';
    });
    testimonialDots.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
    });
    currentTestimonial = index;
  }

  if (testimonialSlides.length > 0) {
    showTestimonial(0);
    testimonialDots.forEach(dot => {
      dot.addEventListener('click', () => showTestimonial(parseInt(dot.dataset.index)));
    });
    // Auto slide
    setInterval(() => {
      showTestimonial((currentTestimonial + 1) % testimonialSlides.length);
    }, 5000);
  }

  // ====== Donation Modal ======
  const modalOverlay = document.querySelector('.modal-overlay');
  const modalClose = document.querySelector('.modal-close');
  const donateBtns = document.querySelectorAll('[data-modal="donation"]');

  donateBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (modalOverlay) modalOverlay.classList.add('active');
    });
  });

  if (modalClose) modalClose.addEventListener('click', () => modalOverlay.classList.remove('active'));
  if (modalOverlay) modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) modalOverlay.classList.remove('active');
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') modalOverlay?.classList.remove('active');
  });

  // ====== Copy to Clipboard ======
  document.querySelectorAll('.copy-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.copy;
      if (target) {
        navigator.clipboard.writeText(target).then(() => {
          const original = btn.innerHTML;
          btn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
          setTimeout(() => btn.innerHTML = original, 2000);
        });
      }
    });
  });

  // ====== Contact Form ======
  const contactForm = document.querySelector('.contact-form form');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const formData = new FormData(contactForm);
      const submitBtn = contactForm.querySelector('.submit-btn');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;

      try {
        const response = await fetch('api/contact.php', {
          method: 'POST',
          body: formData
        });
        const result = await response.json();
        if (result.success) {
          showToast(result.message || 'Message sent successfully!', 'success');
          contactForm.reset();
        } else {
          showToast(result.error || 'Failed to send message.', 'error');
        }
      } catch (err) {
        showToast('Network error. Please try again.', 'error');
      } finally {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    });
  }

  // ====== Newsletter Form ======
  const newsletterForms = document.querySelectorAll('.newsletter-form');
  newsletterForms.forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const input = form.querySelector('input[type="email"]');
      const email = input.value;
      if (!email) return;
      const btn = form.querySelector('button');
      const originalText = btn.textContent;
      btn.textContent = '...';
      btn.disabled = true;

      try {
        const response = await fetch('api/newsletter.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email })
        });
        const result = await response.json();
        if (result.success) {
          showToast('Subscribed successfully!', 'success');
          input.value = '';
        } else {
          showToast(result.error || 'Subscription failed.', 'error');
        }
      } catch (err) {
        showToast('Network error.', 'error');
      } finally {
        btn.textContent = originalText;
        btn.disabled = false;
      }
    });
  });

  // ====== Toast System ======
  function showToast(message, type = 'info') {
    const container = document.querySelector('.toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = message;
    container.appendChild(toast);
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }

  // ====== GSAP Animations (if available) ======
  if (typeof gsap !== 'undefined') {
    // Hero section animations
    gsap.from('.hero-content', {
      opacity: 0,
      y: 50,
      duration: 1,
      delay: 0.3,
      ease: 'power3.out'
    });
    gsap.from('.hero-image-wrapper', {
      opacity: 0,
      scale: 0.8,
      duration: 1,
      delay: 0.6,
      ease: 'power3.out'
    });

    // Scroll-triggered animations
    gsap.utils.toArray('.section').forEach(section => {
      const title = section.querySelector('.section-title');
      const cards = section.querySelectorAll('[class*="-card"], [class*="grid"] > *');
      
      if (title) {
        gsap.from(title, {
          scrollTrigger: {
            trigger: title,
            start: 'top 80%',
            toggleActions: 'play none none none'
          },
          opacity: 0,
          y: 40,
          duration: 0.8,
          ease: 'power3.out'
        });
      }
      
      if (cards.length) {
        gsap.from(cards, {
          scrollTrigger: {
            trigger: cards[0].parentElement,
            start: 'top 80%',
            toggleActions: 'play none none none'
          },
          opacity: 0,
          y: 40,
          duration: 0.6,
          stagger: 0.1,
          ease: 'power3.out'
        });
      }
    });
  }

  // ====== Dynamic Data Loading ======
  loadGalleryData();
  loadEventsData();
  loadBlogData();
  loadPartnersData();
  loadDonationInfo();
  loadContactInfo();

  async function loadGalleryData() {
    try {
      const res = await fetch('api/gallery.php');
      const data = await res.json();
      if (data.success && data.data.length > 0) {
        renderGallery(data.data);
      }
    } catch (e) {
      // Gallery will use fallback
    }
  }

  async function loadEventsData() {
    try {
      const res = await fetch('api/events.php');
      const data = await res.json();
      if (data.success && data.data.length > 0) {
        renderEvents(data.data);
      }
    } catch (e) {}
  }

  async function loadBlogData() {
    try {
      const res = await fetch('api/blog.php');
      const data = await res.json();
      if (data.success && data.data.length > 0) {
        renderBlog(data.data);
      }
    } catch (e) {}
  }

  async function loadPartnersData() {
    try {
      const res = await fetch('api/partners.php');
      const data = await res.json();
      if (data.success && data.data.length > 0) {
        renderPartners(data.data);
      }
    } catch (e) {}
  }

  async function loadDonationInfo() {
    try {
      const res = await fetch('api/donation_info.php');
      const data = await res.json();
      if (data.success && data.data) {
        renderDonationInfo(data.data);
      }
    } catch (e) {}
  }

  async function loadContactInfo() {
    try {
      const res = await fetch('api/contact_info.php');
      const data = await res.json();
      if (data.success && data.data) {
        renderContactInfo(data.data);
      }
    } catch (e) {}
  }

  function renderGallery(items) {
    const grid = document.querySelector('.masonry-grid');
    if (!grid) return;
    grid.innerHTML = '';
    const categories = new Set(['all']);
    
    items.forEach((item, index) => {
      categories.add(item.category || 'uncategorized');
      const div = document.createElement('div');
      div.className = 'masonry-item';
      div.dataset.category = item.category || 'uncategorized';
      div.dataset.src = item.type === 'image' ? `assets/uploads/gallery/${item.file_path}` : '';
      div.dataset.video = item.type === 'video' && item.video_url ? item.video_url : (item.type === 'video' ? `assets/uploads/gallery/${item.file_path}` : '');
      div.dataset.type = item.type;
      div.dataset.title = item.title;
      
      if (item.type === 'image') {
        div.innerHTML = `
          <img src="assets/uploads/gallery/${item.file_path}" alt="${item.title}" loading="lazy">
          <div class="masonry-overlay">
            <div>
              <h4>${item.title}</h4>
              <span>${item.category}</span>
            </div>
          </div>
        `;
      } else {
        div.innerHTML = `
          <div class="video-indicator"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
          <img src="assets/uploads/gallery/${item.thumbnail || 'video-thumb.jpg'}" alt="${item.title}" loading="lazy">
          <div class="masonry-overlay">
            <div>
              <h4>${item.title}</h4>
              <span>${item.category}</span>
            </div>
          </div>
        `;
      }
      grid.appendChild(div);
    });

    // Update tabs
    const tabsContainer = document.querySelector('.gallery-tabs');
    if (tabsContainer) {
      tabsContainer.innerHTML = '';
      categories.forEach(cat => {
        const btn = document.createElement('button');
        btn.className = `gallery-tab${cat === 'all' ? ' active' : ''}`;
        btn.dataset.filter = cat;
        btn.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
        btn.addEventListener('click', () => {
          tabsContainer.querySelectorAll('.gallery-tab').forEach(t => t.classList.remove('active'));
          btn.classList.add('active');
          document.querySelectorAll('.masonry-item').forEach(item => {
            if (cat === 'all' || item.dataset.category === cat) {
              item.style.display = 'block';
              item.style.opacity = '1';
            } else {
              item.style.display = 'none';
            }
          });
        });
        tabsContainer.appendChild(btn);
      });
    }
  }

  function renderEvents(events) {
    const grid = document.querySelector('.events-grid');
    if (!grid) return;
    grid.innerHTML = '';
    events.forEach(event => {
      const date = new Date(event.event_date);
      const card = document.createElement('div');
      card.className = 'event-card';
      card.innerHTML = `
        <div class="event-image">
          ${event.image ? `<img src="assets/uploads/events/${event.image}" alt="${event.title}">` : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'}
          <div class="event-date-badge">
            <span class="day">${date.getDate()}</span>
            ${date.toLocaleString('default', { month: 'short' })}
          </div>
        </div>
        <div class="event-body">
          <h3>${event.title}</h3>
          <div class="event-meta">
            <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> ${event.location || 'TBD'}</span>
            <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> ${formatDate(event.event_date)}</span>
          </div>
          <p>${event.description || ''}</p>
          <button class="event-btn">Register</button>
        </div>
      `;
      grid.appendChild(card);
    });
  }

  function renderBlog(posts) {
    const grid = document.querySelector('.blog-grid');
    if (!grid) return;
    grid.innerHTML = '';
    posts.forEach(post => {
      const card = document.createElement('div');
      card.className = 'blog-card';
      card.innerHTML = `
        <div class="blog-image">
          ${post.featured_image ? `<img src="assets/uploads/blog/${post.featured_image}" alt="${post.title}">` : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>'}
          <span class="blog-category">${post.category}</span>
        </div>
        <div class="blog-body">
          <div class="blog-date">${formatDate(post.created_at)}</div>
          <h3>${post.title}</h3>
          <p>${truncateText(post.excerpt || post.content || '', 120)}</p>
          <a href="#" class="blog-link">Read More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        </div>
      `;
      grid.appendChild(card);
    });
  }

  function renderPartners(partners) {
    const slider = document.querySelector('.partner-slider');
    if (!slider) return;
    // Clone for infinite scroll effect
    const renderItems = (items) => items.map(p => `
      <div class="partner-item">
        ${p.logo ? `<img src="assets/uploads/partners/${p.logo}" alt="${p.name}" style="max-width:100%;max-height:100%;object-fit:contain;">` : `<span>${p.name}</span>`}
      </div>
    `).join('');
    
    slider.innerHTML = renderItems(partners) + renderItems(partners);
  }

  function renderDonationInfo(info) {
    // Update donation info in modal
    document.querySelectorAll('[data-donation="bank"]').forEach(el => { el.textContent = info.bank_name; });
    document.querySelectorAll('[data-donation="account"]').forEach(el => { el.textContent = info.account_name; });
    document.querySelectorAll('[data-donation="number"]').forEach(el => { el.textContent = info.account_number; });
    document.querySelectorAll('[data-donation="number"]').forEach(el => {
      const copyBtn = document.createElement('button');
      copyBtn.className = 'copy-btn';
      copyBtn.dataset.copy = info.account_number;
      copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy';
      copyBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(info.account_number).then(() => {
          copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> Copied!';
          setTimeout(() => copyBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy', 2000);
        });
      });
      el.parentNode.appendChild(copyBtn);
    });
  }

  function renderContactInfo(info) {
    if (info.address) document.querySelectorAll('[data-contact="address"]').forEach(el => el.textContent = info.address);
    if (info.phone) document.querySelectorAll('[data-contact="phone"]').forEach(el => el.textContent = info.phone);
    if (info.email) document.querySelectorAll('[data-contact="email"]').forEach(el => el.textContent = info.email);
    if (info.facebook) document.querySelectorAll('[data-social="facebook"]').forEach(el => el.href = info.facebook);
    if (info.twitter) document.querySelectorAll('[data-social="twitter"]').forEach(el => el.href = info.twitter);
    if (info.instagram) document.querySelectorAll('[data-social="instagram"]').forEach(el => el.href = info.instagram);
    if (info.linkedin) document.querySelectorAll('[data-social="linkedin"]').forEach(el => el.href = info.linkedin);
  }

  function formatDate(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
  }

  function truncateText(text, len) {
    if (!text) return '';
    return text.length > len ? text.substring(0, len) + '...' : text;
  }

  // ====== Intersection Observer for animations fallback ======
  const animateObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        animateObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease';
    animateObserver.observe(el);
  });

});
