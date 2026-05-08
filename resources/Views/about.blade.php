<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>About | eWitnessVault</title>
        <meta name="description" content="Learn about eWitnessVault — pioneering the future of digital evidence integrity.">

        <!-- PWA Support -->
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#0f172a">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="/images/logo-192.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">

        <!-- Tabler Icons -->
        <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/tabler-icons.min.css" rel="stylesheet">

        <style>
            *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

            body {
                min-height: 100vh;
                font-family: 'Outfit', sans-serif;
                color: #ffffff;
                background-image: url("{{ asset('images/home-bg.png') }}");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                display: flex;
                flex-direction: column;
                position: relative;
            }
            body::before {
                content: '';
                position: absolute;
                inset: 0;
                background: rgba(8, 10, 25, 0.88);
                z-index: 0;
            }

            /* Sticky Nav */
            .top-nav {
                position: sticky;
                top: 0;
                z-index: 100;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 2rem;
                background: rgba(8, 10, 25, 0.97);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(34, 211, 238, 0.15);
                box-shadow: 0 4px 30px rgba(0,0,0,0.4);
            }
            .top-nav-brand {
                display: flex; align-items: center; gap: 0.5rem; text-decoration: none;
            }
            .top-nav-brand i {
                font-size: 1.5rem;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .top-nav-brand span {
                font-size: 1.1rem; font-weight: 800;
                background: linear-gradient(to right, #fff, #22d3ee);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .top-nav-links { display: flex; gap: 0.75rem; align-items: center; }
            .nav-btn {
                padding: 0.45rem 1rem; border-radius: 8px; font-size: 0.875rem;
                font-weight: 600; text-decoration: none; transition: all 0.2s;
                font-family: 'Outfit', sans-serif;
            }
            .nav-btn-ghost { color: #94a3b8; border: 1px solid rgba(71,85,105,0.4); background: transparent; }
            .nav-btn-ghost:hover { color: #22d3ee; border-color: rgba(6,182,212,0.4); background: rgba(6,182,212,0.08); }
            .nav-btn-primary {
                color: white; background: linear-gradient(135deg, #06b6d4, #0891b2);
                border: 1px solid #06b6d4; box-shadow: 0 0 15px rgba(6,182,212,0.3);
            }
            .nav-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 0 25px rgba(6,182,212,0.5); }

            /* Content */
            .content-wrapper {
                position: relative; z-index: 10; flex: 1;
                padding-bottom: 4rem; width: 100%; max-width: 1200px;
                margin: 0 auto; display: flex; flex-direction: column;
            }

            /* Page Header */
            .page-header {
                text-align: center; padding: 4rem 2rem 2rem;
            }
            .page-title {
                font-size: 3.5rem; font-weight: 900; margin-bottom: 1rem;
                background: linear-gradient(to right, #22d3ee, #ffffff);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .page-subtitle { font-size: 1.25rem; color: #64748b; font-weight: 300; }

            /* Sections */
            .section { margin-bottom: 5rem; padding: 0 2rem; }
            .section-title {
                font-size: 2.25rem; font-weight: 800; text-align: center;
                margin-bottom: 0.75rem;
                background: linear-gradient(to right, #06b6d4, #22d3ee);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .section-subtitle {
                text-align: center; color: #64748b; font-size: 1rem;
                margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;
            }

            /* Stats */
            .stats-grid {
                display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1.5rem; margin-bottom: 3rem;
            }
            .stat-card {
                text-align: center; padding: 2rem 1.5rem;
                background: rgba(6, 182, 212, 0.07);
                border: 1px solid rgba(6, 182, 212, 0.25);
                border-radius: 16px; transition: all 0.3s;
            }
            .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(6,182,212,0.2); border-color: rgba(6,182,212,0.5); }
            .stat-icon { font-size: 2rem; color: #22d3ee; margin-bottom: 0.75rem; display: block; }
            .stat-number {
                font-size: 2.75rem; font-weight: 900; display: block; margin-bottom: 0.4rem;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .stat-label { color: #64748b; font-size: 0.9rem; font-weight: 500; }

            /* Feature Cards */
            .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; }
            .card {
                background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(10px);
                border: 1px solid rgba(71, 85, 105, 0.2);
                border-radius: 16px; padding: 2rem; transition: all 0.3s;
            }
            .card:hover {
                transform: translateY(-6px); background: rgba(15, 23, 42, 0.9);
                border-color: rgba(34, 211, 238, 0.4);
                box-shadow: 0 20px 40px rgba(6, 182, 212, 0.15);
            }
            .card-icon {
                font-size: 2.25rem; margin-bottom: 1rem; display: inline-flex;
                align-items: center; justify-content: center;
                width: 56px; height: 56px; border-radius: 12px;
                background: rgba(6, 182, 212, 0.1); border: 1px solid rgba(6,182,212,0.2);
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .card h3 { font-size: 1.25rem; font-weight: 700; color: #e2e8f0; margin-bottom: 0.75rem; }
            .card p { color: #64748b; line-height: 1.7; font-weight: 300; font-size: 0.9375rem; }

            /* Mission */
            .mission-section {
                text-align: center;
                background: linear-gradient(135deg, rgba(6,182,212,0.08) 0%, rgba(15,23,42,0) 100%);
                border-radius: 20px; padding: 3rem;
                border: 1px solid rgba(6,182,212,0.15); margin-bottom: 3rem;
            }
            .mission-section h2 { font-size: 2rem; margin-bottom: 1.5rem; color: #e2e8f0; }
            .mission-icon { font-size: 3rem; color: #22d3ee; margin-bottom: 1rem; display: block; }
            .mission-text { font-size: 1.125rem; line-height: 1.9; max-width: 800px; margin: 0 auto; color: #94a3b8; font-weight: 300; font-style: italic; }

            /* Timeline */
            .timeline { position: relative; padding: 2rem 0; }
            .timeline::before {
                content: ''; position: absolute; left: 50%; top: 0; bottom: 0;
                width: 2px; background: linear-gradient(to bottom, #06b6d4, #22d3ee);
                transform: translateX(-50%);
            }
            .timeline-item {
                display: flex; justify-content: space-between; align-items: center;
                margin-bottom: 3rem; position: relative;
            }
            .timeline-item:nth-child(even) { flex-direction: row-reverse; }
            .timeline-content {
                width: 45%; background: rgba(15, 23, 42, 0.7); padding: 1.5rem;
                border-radius: 12px; border: 1px solid rgba(34,211,238,0.15); transition: all 0.3s;
            }
            .timeline-content:hover { transform: translateY(-4px); border-color: rgba(34,211,238,0.4); box-shadow: 0 10px 30px rgba(6,182,212,0.15); }
            .timeline-date { font-size: 1.125rem; font-weight: 700; color: #22d3ee; margin-bottom: 0.4rem; }
            .timeline-title { font-size: 1rem; font-weight: 600; color: #e2e8f0; margin-bottom: 0.4rem; }
            .timeline-text { color: #64748b; line-height: 1.6; font-size: 0.9rem; }
            .timeline-dot {
                width: 18px; height: 18px;
                background: linear-gradient(135deg, #06b6d4, #22d3ee);
                border-radius: 50%; position: absolute; left: 50%; transform: translateX(-50%);
                box-shadow: 0 0 20px rgba(6,182,212,0.6);
            }

            /* FAQ */
            .faq-container { max-width: 850px; margin: 0 auto; }
            .faq-item {
                background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71,85,105,0.2);
                border-radius: 12px; margin-bottom: 0.75rem; overflow: hidden; transition: all 0.3s;
            }
            .faq-item:hover { border-color: rgba(34,211,238,0.25); }
            .faq-question {
                padding: 1.25rem 1.5rem; cursor: pointer; display: flex;
                justify-content: space-between; align-items: center;
                font-weight: 600; color: #e2e8f0; transition: all 0.3s; font-size: 0.9375rem;
            }
            .faq-question:hover { color: #22d3ee; }
            .faq-icon { font-size: 1.25rem; color: #22d3ee; transition: transform 0.3s; flex-shrink: 0; }
            .faq-item.active .faq-icon { transform: rotate(45deg); }
            .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; padding: 0 1.5rem; }
            .faq-item.active .faq-answer { max-height: 300px; padding: 0 1.5rem 1.25rem; }
            .faq-answer-text { color: #64748b; line-height: 1.8; font-size: 0.9rem; }

            /* Contact */
            .contact-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; }
            .contact-card {
                text-align: center; padding: 2rem 1.5rem;
                background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(71,85,105,0.2);
                border-radius: 16px; transition: all 0.3s;
            }
            .contact-card:hover { transform: translateY(-5px); border-color: rgba(34,211,238,0.4); box-shadow: 0 10px 30px rgba(6,182,212,0.15); }
            .contact-icon { font-size: 2rem; color: #22d3ee; margin-bottom: 0.75rem; display: block; }
            .contact-title { font-size: 1.1rem; font-weight: 700; color: #e2e8f0; margin-bottom: 0.4rem; }
            .contact-info { color: #64748b; font-size: 0.875rem; }
            .contact-link { color: #22d3ee; text-decoration: none; transition: color 0.2s; }
            .contact-link:hover { color: #06b6d4; text-decoration: underline; }

            /* CTA Buttons */
            .nav-actions { text-align: center; display: flex; gap: 1.25rem; justify-content: center; flex-wrap: wrap; padding: 0 2rem 2rem; }
            .btn {
                display: inline-flex; align-items: center; gap: 0.5rem;
                text-decoration: none; font-weight: 700; transition: all 0.3s;
                padding: 0.9rem 2.25rem; border-radius: 50px; font-size: 0.9375rem;
                position: relative; overflow: hidden; font-family: 'Outfit', sans-serif;
            }
            .btn::before {
                content: ''; position: absolute; top: 0; left: -100%;
                width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.5s;
            }
            .btn:hover::before { left: 100%; }
            .btn-primary {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: #fff; border: 2px solid #06b6d4; box-shadow: 0 0 20px rgba(6,182,212,0.4);
            }
            .btn-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 0 40px rgba(34,211,238,0.6); }
            .btn-back { color: #64748b; border: 1px solid rgba(71,85,105,0.3); background: transparent; }
            .btn-back:hover { color: #22d3ee; border-color: rgba(6,182,212,0.4); background: rgba(6,182,212,0.08); transform: translateY(-3px); }

            /* Footer */
            footer { position: relative; z-index: 10; padding: 1.75rem 2rem; background: rgba(8,10,25,0.6); backdrop-filter: blur(10px); border-top: 1px solid rgba(255,255,255,0.07); margin-top: 2rem; }
            .footer-inner { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
            .footer-text { font-size: 0.875rem; color: rgba(255,255,255,0.4); }
            .footer-brand { font-weight: 700; background: linear-gradient(to right, #06b6d4, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

            @media (max-width: 768px) {
                .page-title { font-size: 2.5rem; }
                .top-nav { padding: 0.875rem 1rem; }
                .section { padding: 0 1rem; }
                .section-title { font-size: 1.875rem; }
                .grid { grid-template-columns: 1fr; }
                .timeline::before { left: 20px; }
                .timeline-item { flex-direction: column !important; align-items: flex-start; padding-left: 50px; }
                .timeline-content { width: 100%; }
                .timeline-dot { left: 20px; }
                .nav-actions { flex-direction: column; align-items: center; }
                .btn { width: 100%; max-width: 280px; justify-content: center; }
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Sticky Nav -->
        <nav class="top-nav">
            <a href="{{ url('/') }}" class="top-nav-brand">
                <i class="ti ti-shield-check-filled"></i>
                <span>eWitnessVault</span>
            </a>
            <div class="top-nav-links">
                <a href="{{ url('/') }}" class="nav-btn nav-btn-ghost">
                    <i class="ti ti-home" style="margin-right: 0.3rem;"></i>Home
                </a>
                <a href="{{ route('login') }}" class="nav-btn nav-btn-ghost">Sign In</a>
                <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Get Started</a>
            </div>
        </nav>

        <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">About eWitnessVault</h1>
                <p class="page-subtitle">Pioneering the future of digital evidence integrity</p>
            </div>

            <!-- Stats Section -->
            <section class="section">
                <h2 class="section-title">Platform Statistics</h2>
                <p class="section-subtitle">Trusted by legal professionals worldwide</p>
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="ti ti-users stat-icon"></i>
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Active Users</span>
                    </div>
                    <div class="stat-card">
                        <i class="ti ti-files stat-icon"></i>
                        <span class="stat-number">50K+</span>
                        <span class="stat-label">Evidence Files</span>
                    </div>
                    <div class="stat-card">
                        <i class="ti ti-server-2 stat-icon"></i>
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Uptime</span>
                    </div>
                    <div class="stat-card">
                        <i class="ti ti-shield-lock stat-icon"></i>
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Secure</span>
                    </div>
                </div>
            </section>

            <!-- Core Features -->
            <section class="section">
                <h2 class="section-title">Core Features</h2>
                <p class="section-subtitle">Enterprise-grade security for your digital evidence</p>
                <div class="grid">
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-shield-lock"></i></div>
                        <h3>Secure Storage</h3>
                        <p>Military-grade end-to-end encryption ensures your sensitive evidence remains confidential. Only authorized personnel holding the correct cryptographic keys can access the data.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-link"></i></div>
                        <h3>Chain of Custody</h3>
                        <p>Every interaction with a file — upload, view, download, or share — is immutably logged. Our comprehensive audit trails provide court-admissible proof of handling.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-zoom-scan"></i></div>
                        <h3>Tamper Detection</h3>
                        <p>Automated integrity checks run continuously. Any unauthorized modification attempt triggers immediate alerts, ensuring the evidence presented is exactly as stored.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-key"></i></div>
                        <h3>Access Control</h3>
                        <p>Granular permission systems allow you to share specifically selected evidence with trusted parties like legal counsel or judges, without exposing your entire vault.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-bolt"></i></div>
                        <h3>Real-time Sync</h3>
                        <p>Evidence files sync instantly across all your devices with enterprise-grade security protocols ensuring data integrity at every step.</p>
                    </div>
                    <div class="card">
                        <div class="card-icon"><i class="ti ti-chart-bar"></i></div>
                        <h3>Analytics Dashboard</h3>
                        <p>Comprehensive analytics and reporting tools help you track evidence usage, access patterns, and maintain complete oversight of your digital vault.</p>
                    </div>
                </div>
            </section>

            <!-- Mission -->
            <section class="section">
                <div class="mission-section">
                    <i class="ti ti-target mission-icon"></i>
                    <h2>Our Mission</h2>
                    <p class="mission-text">
                        "To provide an immutable, tamper-proof environment where truth is preserved. We believe that the integrity of evidence is the cornerstone of justice, and our technology ensures that digital assets remain verifiable and secure from the moment of capture to the courtroom."
                    </p>
                </div>
            </section>

            <!-- Timeline -->
            <section class="section">
                <h2 class="section-title">Our Journey</h2>
                <p class="section-subtitle">Building the future of digital evidence management</p>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-date">2024</div>
                            <div class="timeline-title">Platform Launch</div>
                            <div class="timeline-text">eWitnessVault officially launches with cutting-edge blockchain integration for evidence verification.</div>
                        </div>
                        <div class="timeline-dot"></div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-date">2023</div>
                            <div class="timeline-title">Beta Testing</div>
                            <div class="timeline-text">Extensive beta testing with law firms and legal professionals to refine our platform.</div>
                        </div>
                        <div class="timeline-dot"></div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-date">2022</div>
                            <div class="timeline-title">Company Founded</div>
                            <div class="timeline-text">eWitnessVault founded with a mission to revolutionize digital evidence management.</div>
                        </div>
                        <div class="timeline-dot"></div>
                    </div>
                </div>
            </section>

            <!-- FAQ -->
            <section class="section">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Everything you need to know about eWitnessVault</p>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How secure is eWitnessVault?</span>
                            <i class="ti ti-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="faq-answer-text">eWitnessVault uses military-grade AES-256 encryption for all stored data. Every file is encrypted at rest and in transit, with zero-knowledge architecture ensuring only you can access your evidence. Our infrastructure is SOC 2 compliant and regularly audited by third-party security firms.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>Is the evidence admissible in court?</span>
                            <i class="ti ti-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="faq-answer-text">Yes. eWitnessVault maintains a complete chain of custody with cryptographic proof of authenticity. Our system generates comprehensive audit logs that are accepted by courts worldwide, ensuring your digital evidence maintains legal validity.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>What file types are supported?</span>
                            <i class="ti ti-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="faq-answer-text">eWitnessVault supports all major file formats including documents (PDF, DOC, DOCX), images (JPG, PNG, TIFF), videos (MP4, AVI, MOV), audio files (MP3, WAV), and archives (ZIP, RAR). Maximum file size is 5GB per upload.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>Can I share evidence with others?</span>
                            <i class="ti ti-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="faq-answer-text">Yes. You can securely share specific evidence files with authorized parties through encrypted links with customizable access permissions. All sharing activities are logged in the audit trail for complete transparency.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span>How does tamper detection work?</span>
                            <i class="ti ti-plus faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p class="faq-answer-text">Every file uploaded to eWitnessVault is hashed using SHA-256 algorithm. This unique fingerprint is stored immutably. Any modification to the file, however small, will result in a different hash, immediately alerting you to potential tampering.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact -->
            <section class="section">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-subtitle">We're here to help with any questions</p>
                <div class="contact-grid">
                    <div class="contact-card">
                        <i class="ti ti-mail contact-icon"></i>
                        <div class="contact-title">Email</div>
                        <div class="contact-info">
                            <a href="mailto:support@ewitnessvault.com" class="contact-link">support@ewitnessvault.com</a>
                        </div>
                    </div>
                    <div class="contact-card">
                        <i class="ti ti-phone contact-icon"></i>
                        <div class="contact-title">Phone</div>
                        <div class="contact-info">
                            <a href="tel:+1234567890" class="contact-link">+1 (234) 567-890</a>
                        </div>
                    </div>
                    <div class="contact-card">
                        <i class="ti ti-message-circle contact-icon"></i>
                        <div class="contact-title">Live Chat</div>
                        <div class="contact-info">Available 24/7</div>
                    </div>
                    <div class="contact-card">
                        <i class="ti ti-map-pin contact-icon"></i>
                        <div class="contact-title">Location</div>
                        <div class="contact-info">Global Service</div>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <div class="nav-actions">
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="ti ti-rocket"></i> Get Started
                </a>
                <a href="{{ url('/') }}" class="btn btn-back">
                    <i class="ti ti-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>

        <footer>
            <div class="footer-inner">
                <div class="footer-text">&copy; {{ date('Y') }} eWitnessVault &mdash; Your digital evidence, protected.</div>
                <div class="footer-text">Designed by <span class="footer-brand">Tinka</span></div>
            </div>
        </footer>

        <script>
            // Register Service Worker for PWA
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').then(reg => {
                        console.log('SW Registered');
                    }).catch(err => console.log('SW Error', err));
                });
            }

            function toggleFAQ(element) {
                const faqItem = element.parentElement;
                const isActive = faqItem.classList.contains('active');
                document.querySelectorAll('.faq-item').forEach(item => item.classList.remove('active'));
                if (!isActive) faqItem.classList.add('active');
            }

            // Scroll animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });

            document.querySelectorAll('.section').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(25px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });
        </script>
    </body>
</html>