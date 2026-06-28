<?php require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Communication and Visibility (HCV) | Creating Health Awareness</title>
  <meta name="description" content="Health Communication and Visibility (HCV) promotes healthier communities through education, advocacy, outreach programs, and public health awareness campaigns.">
  <meta name="keywords" content="health communication, visibility, HCV, health awareness, public health, community outreach, disease prevention">
  
  <!-- Open Graph -->
  <meta property="og:title" content="Health Communication and Visibility (HCV)">
  <meta property="og:description" content="Creating Health Awareness, Transforming Communities">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= SITE_URL ?>">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='45' fill='%23C62828'/%3E%3Ctext x='50' y='58' font-size='32' font-weight='bold' fill='white' text-anchor='middle' font-family='Arial'%3EHCV%3C/text%3E%3C/svg%3E">
</head>
<body>

  <!-- Preloader -->
  <div id="preloader">
    <div class="loader"></div>
  </div>

  <!-- Toast Container -->
  <div class="toast-container"></div>

  <!-- === NAVBAR === -->
  <nav class="navbar" id="home">
    <div class="container">
      <a href="#" class="navbar-brand">
        <svg class="navbar-logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <circle cx="50" cy="50" r="45" fill="#C62828"/>
          <text x="50" y="58" font-size="32" font-weight="bold" fill="white" text-anchor="middle" font-family="Arial">HCV</text>
        </svg>
        <div class="brand-text">
          HCV
          <small>Health Communication &amp; Visibility</small>
        </div>
      </a>
      <div class="nav-links">
        <a href="#home" class="active">Home</a>
        <a href="#about">About</a>
        <a href="#programs">Programs</a>
        <a href="#gallery">Gallery</a>
        <a href="#events">Events</a>
        <a href="#blog">Blog</a>
        <a href="#contact">Contact</a>
        <a href="#" class="donate-btn" data-modal="donation">Donate Now</a>
      </div>
      <button class="nav-toggle" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>

  <!-- === HERO SECTION === -->
  <section class="hero" id="home">
    <div class="container">
      <div class="hero-content">
        <div class="hero-badge">Saving Lives Through Awareness</div>
        <h1 class="hero-title">Creating Health Awareness, <span>Transforming Communities</span></h1>
        <p class="hero-subtitle">Health Communication and Visibility (HCV) promotes healthier communities through education, advocacy, outreach programs, and public health awareness campaigns.</p>
        <div class="hero-buttons">
          <button class="btn btn-primary" data-modal="donation">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            Donate Now
          </button>
          <a href="#about" class="btn btn-secondary">Learn More</a>
        </div>
      </div>
      <div class="hero-image">
        <div class="hero-image-wrapper">
          <div class="hero-image-main">
            <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="400" height="300" rx="20" fill="white" fill-opacity="0.15"/>
              <!-- Heart icon -->
              <path d="M200 240C200 240 120 190 80 150C40 110 40 60 80 40C120 20 160 40 200 80C240 40 280 20 320 40C360 60 360 110 320 150C280 190 200 240 200 240Z" fill="white" fill-opacity="0.3"/>
              <!-- Cross -->
              <rect x="185" y="100" width="30" height="80" rx="4" fill="white" fill-opacity="0.5"/>
              <rect x="160" y="125" width="80" height="30" rx="4" fill="white" fill-opacity="0.5"/>
              <!-- People silhouettes -->
              <circle cx="120" cy="180" r="20" fill="white" fill-opacity="0.2"/>
              <circle cx="280" cy="180" r="20" fill="white" fill-opacity="0.2"/>
              <rect x="100" y="200" width="40" height="50" rx="10" fill="white" fill-opacity="0.2"/>
              <rect x="260" y="200" width="40" height="50" rx="10" fill="white" fill-opacity="0.2"/>
            </svg>
          </div>
          <div class="hero-image-float">
            <div class="float-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="float-text">
              <strong>10,000+</strong>
              <small>People Reached</small>
            </div>
          </div>
          <div class="hero-image-float">
            <div class="float-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div class="float-text">
              <strong>100+</strong>
              <small>Campaigns</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="section-divider"></div>

  <!-- === ABOUT SECTION === -->
  <section class="about section" id="about">
    <div class="container">
      <h2 class="section-title">About <span>HCV</span></h2>
      <p class="section-subtitle">Learn more about our mission to create healthier communities through effective health communication.</p>
      <div class="about-grid">
        <div class="about-image">
          <div class="about-image-placeholder">
            <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="400" height="300" rx="16" fill="#C62828" fill-opacity="0.08"/>
              <path d="M200 60C140 60 90 100 90 150C90 200 140 240 200 240C260 240 310 200 310 150C310 100 260 60 200 60Z" fill="#C62828" fill-opacity="0.12"/>
              <circle cx="200" cy="140" r="30" fill="#C62828" fill-opacity="0.15"/>
              <rect x="170" y="210" width="60" height="30" rx="6" fill="#1565C0" fill-opacity="0.15"/>
              <circle cx="150" cy="120" r="8" fill="#C62828" fill-opacity="0.2"/>
              <circle cx="250" cy="130" r="6" fill="#C62828" fill-opacity="0.2"/>
              <circle cx="180" cy="100" r="5" fill="#1565C0" fill-opacity="0.15"/>
            </svg>
          </div>
        </div>
        <div class="about-content">
          <h2>Who <span>We Are</span></h2>
          <p>Health Communication and Visibility (HCV) is a dedicated non-profit organization committed to improving public health outcomes through strategic communication, education, and community engagement. Founded on the belief that every individual deserves access to quality health information, HCV works tirelessly to bridge the gap between healthcare providers and communities.</p>
          <p>Through innovative awareness campaigns, grassroots outreach, and partnerships with healthcare institutions, we empower individuals with the knowledge they need to make informed health decisions.</p>
          <div class="about-stats">
            <div class="about-stat">
              <h3>2018</h3>
              <p>Founded</p>
            </div>
            <div class="about-stat">
              <h3>15+</h3>
              <p>Staff</p>
            </div>
            <div class="about-stat">
              <h3>5</h3>
              <p>Regions</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission -->
  <section class="vision-mission">
    <div class="container">
      <div class="vm-grid">
        <div class="vm-card vision">
          <div class="vm-icon">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </div>
          <h3>Our Vision</h3>
          <p>To create healthier communities through effective communication, education, and visibility of health initiatives. We envision a world where every individual has access to accurate health information and the support needed to make informed decisions.</p>
        </div>
        <div class="vm-card mission">
          <div class="vm-icon">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h3>Our Mission</h3>
          <p>To improve public health outcomes through awareness campaigns, advocacy, partnerships, and community engagement. We strive to empower communities with knowledge, promote preventive healthcare, and amplify the visibility of critical health initiatives.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Values -->
  <section class="values">
    <div class="container">
      <h2 class="section-title">Our Core <span>Values</span></h2>
      <p class="section-subtitle">The principles that guide everything we do at HCV.</p>
      <div class="values-grid">
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h4>Integrity</h4>
          <p>We uphold the highest standards of honesty and transparency in all our operations and communications.</p>
        </div>
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </div>
          <h4>Compassion</h4>
          <p>We approach every community and individual with empathy, understanding, and genuine care for their well-being.</p>
        </div>
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <h4>Excellence</h4>
          <p>We strive for the highest quality in our programs, campaigns, and service delivery to maximize impact.</p>
        </div>
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
          </div>
          <h4>Accountability</h4>
          <p>We take responsibility for our actions and ensure transparent use of resources and donor funds.</p>
        </div>
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          </div>
          <h4>Innovation</h4>
          <p>We embrace creative approaches and modern tools to enhance health communication and community engagement.</p>
        </div>
        <div class="value-card animate-on-scroll">
          <div class="value-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h4>Community Impact</h4>
          <p>We measure our success by the tangible positive changes we bring to the communities we serve.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- === PROGRAMS SECTION === -->
  <section class="programs section" id="programs">
    <div class="container">
      <h2 class="section-title">Our <span>Programs</span></h2>
      <p class="section-subtitle">Comprehensive health initiatives designed to educate, empower, and transform communities.</p>
      <div class="programs-grid">
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Health Awareness Campaigns</h3>
            <p>Public education and sensitization programs that inform communities about critical health issues, preventive measures, and available healthcare services.</p>
          </div>
        </div>
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Disease Prevention</h3>
            <p>Preventive healthcare education focused on reducing the incidence of communicable and non-communicable diseases through awareness and early detection.</p>
          </div>
        </div>
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Community Outreach</h3>
            <p>Rural and urban interventions bringing healthcare services, health education, and resources directly to underserved communities across multiple regions.</p>
          </div>
        </div>
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Maternal and Child Health</h3>
            <p>Supporting women and children with comprehensive health education, prenatal care awareness, immunization programs, and nutrition guidance.</p>
          </div>
        </div>
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M16.24 7.76l-8.48 8.48"/><path d="M7.76 7.76l8.48 8.48"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Health Communication</h3>
            <p>Strategic information dissemination through multiple channels to ensure accurate health messaging reaches diverse populations effectively.</p>
          </div>
        </div>
        <div class="program-card animate-on-scroll">
          <div class="program-icon">
            <div class="icon-wrap">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
          </div>
          <div class="program-body">
            <h3>Advocacy and Visibility</h3>
            <p>Promoting healthcare initiatives through advocacy, policy engagement, and increased visibility for critical health issues affecting communities.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- === IMPACT SECTION === -->
  <section class="impact section" id="impact">
    <div class="container">
      <h2 class="section-title">Our <span>Impact</span></h2>
      <p class="section-subtitle">Measurable results that demonstrate our commitment to community health and well-being.</p>
      <div class="impact-grid">
        <div class="impact-card">
          <div class="impact-number" data-target="10000" data-suffix="+">0+</div>
          <div class="impact-label">People Reached</div>
        </div>
        <div class="impact-card">
          <div class="impact-number" data-target="100" data-suffix="+">0+</div>
          <div class="impact-label">Awareness Campaigns</div>
        </div>
        <div class="impact-card">
          <div class="impact-number" data-target="50" data-suffix="+">0+</div>
          <div class="impact-label">Communities Served</div>
        </div>
        <div class="impact-card">
          <div class="impact-number" data-target="30" data-suffix="+">0+</div>
          <div class="impact-label">Healthcare Partners</div>
        </div>
      </div>
    </div>
  </section>

  <!-- === GALLERY SECTION === -->
  <section class="gallery section" id="gallery">
    <div class="container">
      <h2 class="section-title">Our <span>Gallery</span></h2>
      <p class="section-subtitle">Explore our work through images and videos showcasing our programs and impact.</p>
      <div class="gallery-tabs">
        <button class="gallery-tab active" data-filter="all">All</button>
        <button class="gallery-tab" data-filter="images">Images</button>
        <button class="gallery-tab" data-filter="videos">Videos</button>
        <button class="gallery-tab" data-filter="events">Events</button>
        <button class="gallery-tab" data-filter="outreach">Outreach</button>
        <button class="gallery-tab" data-filter="campaigns">Campaigns</button>
      </div>
      <div class="masonry-grid">
        <!-- Fallback gallery items - will be replaced by API data -->
        <div class="masonry-item" data-category="outreach" data-type="image" data-src="" data-title="Community Health Outreach">
          <div style="background:linear-gradient(135deg,#ffebee,#fce4ec);height:250px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#C62828;font-size:1rem;font-weight:600;">Community Outreach</div>
          <div class="masonry-overlay"><div><h4>Community Health Outreach</h4><span>Outreach</span></div></div>
        </div>
        <div class="masonry-item" data-category="campaigns" data-type="image" data-src="" data-title="Health Awareness Campaign">
          <div style="background:linear-gradient(135deg,#fce4ec,#f8bbd0);height:300px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#C62828;font-size:1rem;font-weight:600;">Awareness Campaign</div>
          <div class="masonry-overlay"><div><h4>Health Awareness Campaign</h4><span>Campaigns</span></div></div>
        </div>
        <div class="masonry-item" data-category="events" data-type="video" data-src="" data-title="Annual Health Summit" data-video="">
          <div class="video-indicator"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
          <div style="background:linear-gradient(135deg,#e8f8ed,#d1f0dc);height:280px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#198754;font-size:1rem;font-weight:600;">Health Summit 2024</div>
          <div class="masonry-overlay"><div><h4>Annual Health Summit</h4><span>Events</span></div></div>
        </div>
        <div class="masonry-item" data-category="outreach" data-type="image" data-src="" data-title="Rural Health Mission">
          <div style="background:linear-gradient(135deg,#fef3e2,#fde8cc);height:320px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#ffc107;font-size:1rem;font-weight:600;">Rural Health Mission</div>
          <div class="masonry-overlay"><div><h4>Rural Health Mission</h4><span>Outreach</span></div></div>
        </div>
        <div class="masonry-item" data-category="campaigns" data-type="image" data-src="" data-title="Disease Prevention Drive">
          <div style="background:linear-gradient(135deg,#e3f2fd,#bbdefb);height:240px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#1565C0;font-size:1rem;font-weight:600;">Prevention Drive</div>
          <div class="masonry-overlay"><div><h4>Disease Prevention Drive</h4><span>Campaigns</span></div></div>
        </div>
        <div class="masonry-item" data-category="events" data-type="image" data-src="" data-title="Community Health Fair">
          <div style="background:linear-gradient(135deg,#f3e8fd,#e8d1fc);height:260px;display:flex;align-items:center;justify-content:center;border-radius:12px;color:#6f42c1;font-size:1rem;font-weight:600;">Health Fair</div>
          <div class="masonry-overlay"><div><h4>Community Health Fair</h4><span>Events</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Lightbox -->
  <div class="lightbox">
    <button class="lightbox-close">&times;</button>
    <button class="lightbox-nav prev">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="lightbox-nav next">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
    <div class="lightbox-content">
      <img src="" alt="">
      <video controls></video>
      <div class="lightbox-caption"></div>
    </div>
  </div>

  <!-- === EVENTS SECTION === -->
  <section class="events section" id="events">
    <div class="container">
      <h2 class="section-title">Upcoming <span>Events</span></h2>
      <p class="section-subtitle">Join us in our mission. Participate in our upcoming health events and programs.</p>
      <div class="events-grid">
        <div class="event-card">
          <div class="event-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <div class="event-date-badge">
              <span class="day">15</span>
              Jul
            </div>
          </div>
          <div class="event-body">
            <h3>Community Health Awareness Walk</h3>
            <div class="event-meta">
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Central Park, Wellness City</span>
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Jul 15, 2025</span>
            </div>
            <p>Join us for a community walk to promote physical activity and health awareness. Free health screenings available.</p>
            <button class="event-btn">Register</button>
          </div>
        </div>
        <div class="event-card">
          <div class="event-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <div class="event-date-badge">
              <span class="day">22</span>
              Aug
            </div>
          </div>
          <div class="event-body">
            <h3>Maternal Health Workshop</h3>
            <div class="event-meta">
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> Community Center, Health District</span>
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Aug 22, 2025</span>
            </div>
            <p>A comprehensive workshop on maternal health, nutrition during pregnancy, and postnatal care for expectant mothers.</p>
            <button class="event-btn">Register</button>
          </div>
        </div>
        <div class="event-card">
          <div class="event-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <div class="event-date-badge">
              <span class="day">10</span>
              Sep
            </div>
          </div>
          <div class="event-body">
            <h3>Disease Prevention Seminar</h3>
            <div class="event-meta">
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> City Hall, Wellness City</span>
              <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> Sep 10, 2025</span>
            </div>
            <p>Expert-led seminar on preventing common diseases through vaccination, hygiene, and healthy lifestyle choices.</p>
            <button class="event-btn">Register</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- === BLOG SECTION === -->
  <section class="blog section" id="blog">
    <div class="container">
      <h2 class="section-title">Latest <span>News</span></h2>
      <p class="section-subtitle">Stay informed with health tips, success stories, and updates from HCV.</p>
      <div class="blog-grid">
        <div class="blog-card">
          <div class="blog-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
            <span class="blog-category">Health Tips</span>
          </div>
          <div class="blog-body">
            <div class="blog-date">June 1, 2025</div>
            <h3>10 Essential Health Tips for a Stronger Immune System</h3>
            <p>Discover practical ways to boost your immune system naturally through diet, exercise, and healthy habits.</p>
            <a href="#" class="blog-link">Read More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          </div>
        </div>
        <div class="blog-card">
          <div class="blog-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
            <span class="blog-category">Success Stories</span>
          </div>
          <div class="blog-body">
            <div class="blog-date">May 25, 2025</div>
            <h3>How Our Outreach Program Transformed a Rural Community</h3>
            <p>Read about the remarkable transformation of a rural community through HCV's comprehensive health outreach initiative.</p>
            <a href="#" class="blog-link">Read More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          </div>
        </div>
        <div class="blog-card">
          <div class="blog-image">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
            <span class="blog-category">Public Health</span>
          </div>
          <div class="blog-body">
            <div class="blog-date">May 18, 2025</div>
            <h3>Understanding the Importance of Vaccination in Public Health</h3>
            <p>An in-depth look at how vaccination programs save lives and protect communities from preventable diseases.</p>
            <a href="#" class="blog-link">Read More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- === PARTNERS SECTION === -->
  <section class="partners section" id="partners">
    <div class="container">
      <h2 class="section-title">Our <span>Partners</span></h2>
      <p class="section-subtitle">Collaborating with organizations that share our vision for healthier communities.</p>
    </div>
    <div class="partner-slider">
      <div class="partner-item"><span>Ministry of Health</span></div>
      <div class="partner-item"><span>WHO</span></div>
      <div class="partner-item"><span>UNICEF</span></div>
      <div class="partner-item"><span>Red Cross</span></div>
      <div class="partner-item"><span>Doctors Without Borders</span></div>
      <div class="partner-item"><span>Health Foundation</span></div>
      <div class="partner-item"><span>Community Health Alliance</span></div>
      <div class="partner-item"><span>Global Health Initiative</span></div>
      <div class="partner-item"><span>Ministry of Health</span></div>
      <div class="partner-item"><span>WHO</span></div>
      <div class="partner-item"><span>UNICEF</span></div>
      <div class="partner-item"><span>Red Cross</span></div>
      <div class="partner-item"><span>Doctors Without Borders</span></div>
      <div class="partner-item"><span>Health Foundation</span></div>
      <div class="partner-item"><span>Community Health Alliance</span></div>
      <div class="partner-item"><span>Global Health Initiative</span></div>
    </div>
  </section>

  <!-- === TESTIMONIALS SECTION === -->
  <section class="testimonials section" id="testimonials">
    <div class="container">
      <h2 class="section-title">What People <span>Say</span></h2>
      <p class="section-subtitle">Hear from community members and partners about the impact of our work.</p>
      <div class="testimonials-slider">
        <div class="testimonial-slide">
          <div class="testimonial-card">
            <p class="testimonial-content">"HCV's outreach program has been a game-changer for our community. The health education sessions have empowered our residents with knowledge that has literally saved lives. We are grateful for their dedication and professionalism."</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">MJ</div>
              <div class="testimonial-info">
                <h4>Dr. Mary Johnson</h4>
                <span>Community Health Director, Wellness City</span>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slide" style="display:none;">
          <div class="testimonial-card">
            <p class="testimonial-content">"The maternal health program by HCV provided my wife and I with essential knowledge during her pregnancy. The workshops were informative, and the staff were incredibly supportive. Thank you, HCV!"</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">PK</div>
              <div class="testimonial-info">
                <h4>Peter Kamau</h4>
                <span>Beneficiary, Maternal Health Program</span>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slide" style="display:none;">
          <div class="testimonial-card">
            <p class="testimonial-content">"Partnering with HCV has been an incredible experience. Their commitment to health communication and community engagement aligns perfectly with our mission. Together, we are making a real difference."</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">SA</div>
              <div class="testimonial-info">
                <h4>Sarah Ahmed</h4>
                <span>Program Director, Health Foundation</span>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-dots">
          <button class="testimonial-dot active" data-index="0"></button>
          <button class="testimonial-dot" data-index="1"></button>
          <button class="testimonial-dot" data-index="2"></button>
        </div>
      </div>
    </div>
  </section>

  <!-- === DONATION SECTION === -->
  <section class="donation section" id="donation">
    <div class="container">
      <h2 class="section-title">Support <span>Our Mission</span></h2>
      <p class="section-subtitle">Your donation helps us reach more communities with life-saving health information and services.</p>
      <div class="donation-grid">
        <div class="donation-info animate-on-scroll">
          <h3>Make a Donation</h3>
          <div class="donation-detail">
            <span class="label">Bank Name:</span>
            <span class="value" data-donation="bank">First Bank of Health</span>
          </div>
          <div class="donation-detail">
            <span class="label">Account Name:</span>
            <span class="value" data-donation="account">Health Communication and Visibility</span>
          </div>
          <div class="donation-detail">
            <span class="label">Account Number:</span>
            <span class="value" data-donation="number">
              0123456789
            </span>
          </div>
          <div style="margin-top:20px;text-align:center;">
            <button class="btn btn-primary" data-modal="donation">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              Donate via Bank Transfer
            </button>
          </div>
        </div>
        <div class="donation-benefits animate-on-scroll">
          <h3>Why <span>Donate?</span></h3>
          <ul>
            <li>
              <span class="check">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <span><strong>Save Lives</strong> — Your contribution directly supports life-saving health awareness campaigns and community outreach programs.</span>
            </li>
            <li>
              <span class="check">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <span><strong>Empower Communities</strong> — Help us provide health education and resources to underserved communities across multiple regions.</span>
            </li>
            <li>
              <span class="check">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <span><strong>Transparent Impact</strong> — We maintain full transparency on how every donation is utilized, with regular impact reports shared with donors.</span>
            </li>
            <li>
              <span class="check">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <span><strong>Tax Deductible</strong> — All donations are tax-deductible and support a registered non-profit organization.</span>
            </li>
            <li>
              <span class="check">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
              </span>
              <span><strong>Sustainable Change</strong> — Your support enables long-term health initiatives that create lasting positive change in communities.</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- === CONTACT SECTION === -->
  <section class="contact section" id="contact">
    <div class="container">
      <h2 class="section-title">Get In <span>Touch</span></h2>
      <p class="section-subtitle">Have questions or want to collaborate? We'd love to hear from you.</p>
      <div class="contact-grid">
        <div class="contact-form animate-on-scroll">
          <form>
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Your full name" required>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="form-control" placeholder="+1 (555) 000-0000">
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" name="subject" class="form-control" placeholder="How can we help?">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" name="message" class="form-control" placeholder="Tell us more about your inquiry..." required></textarea>
            </div>
            <button type="submit" class="submit-btn">Send Message</button>
          </form>
        </div>
        <div class="contact-info-list animate-on-scroll">
          <div class="contact-item">
            <div class="contact-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="contact-text">
              <h4>Our Address</h4>
              <p data-contact="address">123 Health Avenue, Wellness City, HC 10001</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div class="contact-text">
              <h4>Phone</h4>
              <p data-contact="phone">+1 (555) 123-4567</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div class="contact-text">
              <h4>Email</h4>
              <p data-contact="email">info@hcv.org</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <div class="contact-text">
              <h4>Follow Us</h4>
              <p>Connect with us on social media for updates</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <div class="map-section">
    <div class="map-placeholder">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <span style="margin-left:10px;">Interactive Map Loading...</span>
    </div>
  </div>

  <!-- === DONATION MODAL === -->
  <div class="modal-overlay">
    <div class="modal">
      <button class="modal-close">&times;</button>
      <div class="modal-icon">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
      </div>
      <h2>Support Health Communication and Visibility</h2>
      <p>Your contribution helps us create healthier communities through education and awareness.</p>
      <div class="modal-details">
        <div class="modal-detail">
          <span class="label">Bank Name:</span>
          <span class="value" data-donation="bank">First Bank of Health</span>
        </div>
        <div class="modal-detail">
          <span class="label">Account Name:</span>
          <span class="value" data-donation="account">Health Communication and Visibility</span>
        </div>
        <div class="modal-detail">
          <span class="label">Account Number:</span>
          <span class="value" data-donation="number">0123456789</span>
        </div>
      </div>
      <div class="modal-footer-text">Thank you for supporting our mission.</div>
    </div>
  </div>

  <!-- === FOOTER === -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h4>Health Communication &amp; Visibility</h4>
          <p>Dedicated to creating healthier communities through effective health communication, education, and advocacy. Join us in making a difference.</p>
          <div class="footer-social">
            <a href="#" data-social="facebook" aria-label="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" data-social="twitter" aria-label="Twitter">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
            </a>
            <a href="#" data-social="instagram" aria-label="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" data-social="linkedin" aria-label="LinkedIn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
          </div>
        </div>
        <div>
          <h4>Quick Links</h4>
          <ul class="footer-links">
            <li><a href="#home">&#8226; Home</a></li>
            <li><a href="#about">&#8226; About</a></li>
            <li><a href="#programs">&#8226; Programs</a></li>
            <li><a href="#gallery">&#8226; Gallery</a></li>
            <li><a href="#events">&#8226; Events</a></li>
            <li><a href="#blog">&#8226; Blog</a></li>
            <li><a href="#contact">&#8226; Contact</a></li>
          </ul>
        </div>
        <div>
          <h4>Programs</h4>
          <ul class="footer-links">
            <li><a href="#programs">&#8226; Health Awareness</a></li>
            <li><a href="#programs">&#8226; Disease Prevention</a></li>
            <li><a href="#programs">&#8226; Community Outreach</a></li>
            <li><a href="#programs">&#8226; Maternal Health</a></li>
            <li><a href="#programs">&#8226; Health Communication</a></li>
            <li><a href="#programs">&#8226; Advocacy</a></li>
          </ul>
        </div>
        <div>
          <h4>Newsletter</h4>
          <p style="font-size:0.9rem;color:rgba(255,255,255,0.6);margin-bottom:15px;">Subscribe to receive health tips and updates.</p>
          <form class="newsletter-form">
            <input type="email" placeholder="Your email address" required>
            <button type="submit">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </form>
          <ul class="footer-contact" style="margin-top:20px;">
            <li>
              <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </span>
              <span data-contact="address">123 Health Avenue, Wellness City</span>
            </li>
            <li>
              <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </span>
              <span data-contact="phone">+1 (555) 123-4567</span>
            </li>
            <li>
              <span class="icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </span>
              <span data-contact="email">info@hcv.org</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; <?= date('Y') ?> Health Communication and Visibility (HCV). All rights reserved.
      </div>
    </div>
  </footer>

  <!-- Back to Top -->
  <button class="back-to-top" aria-label="Back to top">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"/></svg>
  </button>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
  
  <!-- GSAP ScrollTrigger -->
  <script>
    if (typeof gsap !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }
  </script>
  
  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
</body>
</html>
