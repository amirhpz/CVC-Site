<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صندوق سرمایه‌گذاری خطرپذیر MSTID Fund</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            color: #333;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0d47a1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #0d47a1;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><circle cx="100" cy="100" r="50" fill="rgba(255,255,255,0.05)"/><circle cx="900" cy="400" r="80" fill="rgba(255,255,255,0.05)"/><circle cx="1100" cy="150" r="60" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .hero-text p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        .hero-image {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #0d47a1;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* Stats Section - NEW */
        .stats-section {
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            padding: 80px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(255,255,255,0.1) 0%, transparent 50%);
        }

        .stats-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
            z-index: 1;
        }

        .stats-header h2 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .stats-header p {
            font-size: 18px;
            opacity: 0.9;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            position: relative;
            z-index: 1;
        }

        .stat-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: transform 0.3s, background 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .stat-number {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .stat-description {
            font-size: 14px;
            opacity: 0.8;
            line-height: 1.6;
        }

        /* Investment Process Section - NEW */
        .investment-process {
            padding: 100px 0;
            background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
            position: relative;
        }

        .process-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .process-header h2 {
            font-size: 42px;
            color: #0d47a1;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .process-subtitle {
            display: inline-block;
            background: linear-gradient(135deg, #4dd0e1 0%, #26c6da 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .process-description {
            font-size: 18px;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .process-flow {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
        }

        .process-timeline {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .process-step {
            position: relative;
            text-align: center;
        }

        .process-step::after {
            content: '';
            position: absolute;
            top: 60px;
            right: -30px;
            width: 30px;
            height: 3px;
            background: linear-gradient(90deg, #0d47a1 0%, #4dd0e1 100%);
            z-index: 0;
        }

        .process-step:last-child::after {
            display: none;
        }

        .step-icon-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 3px solid #0d47a1;
        }

        .process-step:hover .step-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 30px rgba(13, 71, 161, 0.3);
        }

        .step-icon-wrapper img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .step-number {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .step-title {
            font-size: 18px;
            font-weight: 700;
            color: #0d47a1;
            margin-bottom: 10px;
        }

        .step-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .process-bottom {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 80px;
        }

        .process-bottom-step {
            text-align: center;
        }

        .bottom-step-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #757575 0%, #616161 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }

        .process-bottom-step:hover .bottom-step-icon {
            transform: translateY(-10px);
        }

        .bottom-step-title {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .bottom-step-subtitle {
            font-size: 14px;
            color: #999;
        }

        /* Arrow connector for bottom flow */
        .process-arrow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #e91e63 50%, transparent 100%);
            z-index: -1;
        }

        /* About Section */
        .about {
            padding: 80px 0;
            background: white;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-image {
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            border-radius: 20px;
            padding: 40px;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 80px;
        }

        .section-title {
            font-size: 36px;
            margin-bottom: 20px;
            color: #0d47a1;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0d47a1 0%, #1976d2 100%);
            border-radius: 2px;
        }

        /* Portfolio Section */
        .portfolio {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .portfolio-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .portfolio-image {
            height: 200px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .portfolio-content {
            padding: 25px;
        }

        .portfolio-content h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .portfolio-content p {
            color: #666;
            font-size: 14px;
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 50px;
        }

        .service-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            border: 2px solid rgba(255,255,255,0.2);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }

        .service-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .service-card p {
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Investment Areas */
        .investment-areas {
            padding: 80px 0;
            background: white;
        }

        .areas-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            margin-top: 50px;
        }

        .area-item {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .area-item:hover {
            background: white;
            border-color: #0d47a1;
            box-shadow: 0 4px 15px rgba(13, 71, 161, 0.2);
        }

        .area-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 28px;
        }

        .area-item h4 {
            font-size: 14px;
            color: #333;
        }

        /* Team Section */
        .team {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 50px;
        }

        .team-member {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .team-photo {
            height: 300px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 72px;
        }

        .team-info {
            padding: 25px;
            text-align: center;
        }

        .team-info h3 {
            font-size: 22px;
            margin-bottom: 5px;
            color: #333;
        }

        .team-info .position {
            color: #0d47a1;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .team-info p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* News Section */
        .news {
            padding: 80px 0;
            background: white;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .news-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .news-item:hover {
            transform: translateY(-5px);
        }

        .news-image {
            height: 200px;
            background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .news-content {
            padding: 25px;
        }

        .news-date {
            color: #0d47a1;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .news-content h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .news-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta-section p {
            opacity: 0.9;
            margin-bottom: 30px;
            font-size: 18px;
        }

        /* Contact Section */
        .contact {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 40px;
        }

        .contact-info h3 {
            margin-bottom: 15px;
            color: #0d47a1;
        }

        .contact-info p {
            margin-bottom: 10px;
            color: #666;
        }

        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            font-family: inherit;
        }

        .contact-form button {
            background: #0d47a1;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .contact-form button:hover {
            background: #1565c0;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0d47a1 0%, #1565c0 100%);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-about h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .footer-about p {
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .footer-links h4 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content,
            .about-content,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid,
            .portfolio-grid,
            .services-grid,
            .team-grid,
            .news-grid {
                grid-template-columns: 1fr;
            }

            .process-timeline,
            .process-bottom {
                grid-template-columns: 1fr;
            }

            .process-step::after {
                display: none;
            }

            .areas-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            nav ul {
                flex-direction: column;
                gap: 15px;
            }

            .hero-text h1 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <div class="logo-icon">MS</div>
                <span>MSTID Fund</span>
            </div>
            <ul>
                <li><a href="#home">خانه</a></li>
                <li><a href="#about">درباره ما</a></li>
                <li><a href="#portfolio">پورتفولیو</a></li>
                <li><a href="#process">فرآیند</a></li>
                <li><a href="#team">تیم</a></li>
                <li><a href="news.html">اخبار</a></li>
                <li><a href="#contact">تماس</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>سرمایه‌گذاری در آینده نوآوری</h1>
                <p>صندوق سرمایه‌گذاری خطرپذیر MSTID Fund با هدف حمایت از استارت‌آپ‌های نوآور و کسب‌وکارهای فناور در مراحل اولیه تا رشد تأسیس شده است.</p>
                <a href="#contact" class="btn">با ما شروع کنید</a>
            </div>
            <div class="hero-image">
                <div style="width: 100%; max-width: 300px; height: 300px; background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 120px;">💡</div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section - NEW -->
<section class="stats-section">
    <div class="container">
        <div class="stats-header>
                    <h2>دستاوردهای صندوق</h2>
            <p>نگاهی کوتاه به عملکرد و تاثیرگذاری ما در اکوسیستم نوآوری</p>
        </div>

        <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-number">13.8</div>
            <div class="stat-label">میلیارد ریال</div>
            <div class="stat-description">
                سرمایه‌گذاری انجام شده در استارتاپ‌های فناور و نوآور
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🚀</div>
            <div class="stat-number">20</div>
            <div class="stat-label">میلیون ریال</div>
            <div class="stat-description">
                متوسط سرمایه اولیه برای حمایت از تیم‌های نوپا
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎓</div>
            <div class="stat-number">20</div>
            <div class="stat-label">دانشگاه</div>
            <div class="stat-description">
                همکاری با دانشگاه‌ها و مراکز علمی کشور
            </div>
        </div>

    </div>
    </div>
</section>


<!-- Investment Process Section -->
<section class="investment-process" id="process">
    <div class="container">

        <div class="process-header">
            <h2>فرآیند سرمایه‌گذاری</h2>

            <div class="process-subtitle">
                Venture Capital Process
            </div>

            <p class="process-description">
                فرآیند سرمایه‌گذاری در صندوق ما شامل چند مرحله تخصصی برای
                ارزیابی، انتخاب و رشد استارتاپ‌ها می‌باشد.
            </p>
        </div>


        <div class="process-flow">

            <div class="process-timeline">

                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-number">1</div>
                        <img src="/placeholder/icon1.png">
                    </div>

                    <div class="step-title">
                        فاز اول
                    </div>

                    <div class="step-description">
                        ایجاد فرصت سرمایه گذاری
                    </div>
                </div>


                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-number">2</div>
                        <img src="/placeholder/icon2.png">
                    </div>

                    <div class="step-title">
                        فاز دوم
                    </div>

                    <div class="step-description">
                        غربالگری اولیه طرح‌ها
                    </div>
                </div>


                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-number">3</div>
                        <img src="/placeholder/icon3.png">
                    </div>

                    <div class="step-title">
                        فاز سوم
                    </div>

                    <div class="step-description">
                        ارزیابی تخصصی و تحلیل بازار
                    </div>
                </div>


                <div class="process-step">
                    <div class="step-icon-wrapper">
                        <div class="step-number">4</div>
                        <img src="/placeholder/icon4.png">
                    </div>

                    <div class="step-title">
                        فاز چهارم
                    </div>

                    <div class="step-description">
                        تصویب سرمایه‌گذاری
                    </div>
                </div>

            </div>


            <div class="process-bottom">

                <div class="process-bottom-step">
                    <div class="bottom-step-icon">
                        <img src="/placeholder/icon5.png">
                    </div>

                    <div class="bottom-step-title">
                        عقد قرارداد
                    </div>

                    <div class="bottom-step-subtitle">
                        مرحله حقوقی سرمایه گذاری
                    </div>
                </div>


                <div class="process-bottom-step">
                    <div class="bottom-step-icon">
                        <img src="/placeholder/icon6.png">
                    </div>

                    <div class="bottom-step-title">
                        تامین سرمایه
                    </div>

                    <div class="bottom-step-subtitle">
                        تزریق منابع مالی
                    </div>
                </div>


                <div class="process-bottom-step">
                    <div class="bottom-step-icon">
                        <img src="/placeholder/icon7.png">
                    </div>

                    <div class="bottom-step-title">
                        رشد و توسعه
                    </div>

                    <div class="bottom-step-subtitle">
                        منتورینگ و توسعه بازار
                    </div>
                </div>


                <div class="process-bottom-step">
                    <div class="bottom-step-icon">
                        <img src="/placeholder/icon8.png">
                    </div>

                    <div class="bottom-step-title">
                        خروج
                    </div>

                    <div class="bottom-step-subtitle">
                        IPO یا فروش سهام
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

