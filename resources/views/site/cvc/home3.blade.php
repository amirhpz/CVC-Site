<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صندوق سرمایه‌گذاری خطرپذیر شرکتی - توسعه دانش بنیان سینا</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: YekanBakhFaNum, Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            color: var(--cvc-text);
            background: var(--cvc-bg);
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
            color: var(--cvc-primary-hover);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: var(--cvc-muted);
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: var(--cvc-primary-hover);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><circle cx="100" cy="100" r="50" fill="rgba(255,255,255,0.1)"/><circle cx="900" cy="400" r="80" fill="rgba(255,255,255,0.1)"/><circle cx="1100" cy="150" r="60" fill="rgba(255,255,255,0.1)"/></svg>');
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
            text-align: justify;
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

        .lightbulb-illustration {
            width: 100%;
            max-width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.05) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .lightbulb-illustration::before {
            content: '💡';
            font-size: 120px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: var(--cvc-primary);
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
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-accent) 100%);
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
            color: var(--cvc-primary-hover);
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
            background: linear-gradient(90deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 2px;
        }

        /* Portfolio Section */
        .portfolio {
            padding: 80px 0;
            background: var(--cvc-bg);
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
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
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
            color: var(--cvc-text);
        }

        .portfolio-content p {
            color: var(--cvc-muted);
            font-size: 14px;
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--cvc-text) 0%, var(--cvc-primary-hover) 100%);
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
            background: var(--cvc-bg);
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .area-item:hover {
            background: white;
            border-color: var(--cvc-primary);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .area-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 28px;
        }

        .area-item h4 {
            font-size: 14px;
            color: var(--cvc-text);
        }

        /* Partners Section */
        .partners {
            padding: 80px 0;
            background: var(--cvc-bg);
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 30px;
            margin-top: 50px;
            align-items: center;
        }

        .partner-logo {
            background: white;
            border-radius: 15px;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 120px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .partner-logo:hover {
            transform: scale(1.05);
        }

        .partner-placeholder {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
        }

        /* Team Section */
        .team {
            padding: 80px 0;
            background: white;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-top: 50px;
        }

        .team-member {
            background: var(--cvc-bg);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .team-photo {
            height: 300px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
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
            color: var(--cvc-text);
        }

        .team-info .position {
            color: var(--cvc-primary);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .team-info p {
            color: var(--cvc-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* News Section */
        .news {
            padding: 80px 0;
            background: var(--cvc-bg);
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
            color: var(--cvc-primary);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .news-content h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--cvc-text);
        }

        .news-content p {
            color: var(--cvc-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--cvc-text) 0%, var(--cvc-primary-hover) 100%);
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

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            transition: background 0.3s;
        }

        .social-link:hover {
            background: rgba(255,255,255,0.2);
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
            .about-content {
                grid-template-columns: 1fr;
            }

            .portfolio-grid,
            .services-grid,
            .team-grid,
            .news-grid {
                grid-template-columns: 1fr;
            }

            .areas-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .partners-grid {
                grid-template-columns: repeat(3, 1fr);
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
@include('site.cvc.partials.dynamic-page-content')
<!-- Header -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <div class="logo-icon">MF</div>
                <span>توسعه دانش بنیان سینا</span>
            </div>
            <ul>
                <li><a href="#home">خانه</a></li>
                <li><a href="#about">درباره ما</a></li>
                <li><a href="#portfolio">پورتفولیو</a></li>
                <li><a href="#services">خدمات</a></li>
                <li><a href="#team">تیم</a></li>
                <li><a href="#news">اخبار</a></li>
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
                <p>ما در توسعه دانش بنیان سینا به دنبال استارت‌آپ‌ها و کسب‌وکارهای نوآور هستیم که می‌خواهند دنیا را تغییر دهند. با سرمایه‌گذاری هوشمند و مشاوره تخصصی، رویاهای شما را به واقعیت تبدیل می‌کنیم.</p>
                <a href="#contact" class="btn">با ما شروع کنید</a>
            </div>
            <div class="hero-image">
                <div class="lightbulb-illustration"></div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about" id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-image">
                🌱
            </div>
            <div class="about-text">
                <h2 class="section-title">درباره توسعه دانش بنیان سینا</h2>
                <p>صندوق سرمایه‌گذاری خطرپذیر توسعه دانش بنیان سینا با هدف حمایت از استارت‌آپ‌های نوآور و کسب‌وکارهای فناور در مراحل اولیه تا رشد تأسیس شده است. ما با تیمی متشکل از متخصصان باتجربه در حوزه‌های مختلف کسب‌وکار، فناوری و سرمایه‌گذاری، فراتر از تأمین سرمایه، مشاوره استراتژیک و دسترسی به شبکه گسترده‌ای از شرکا و متخصصان را ارائه می‌دهیم.</p>
                <p>رویکرد ما مبتنی بر شناخت عمیق بازار، ارزیابی دقیق پتانسیل رشد و همراهی بلندمدت با کارآفرینان است. ما معتقدیم که موفقیت استارت‌آپ‌ها، موفقیت ماست.</p>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="portfolio" id="portfolio">
    <div class="container">
        <h2 class="section-title">پورتفولیو سرمایه‌گذاری‌ها</h2>
        <p>نگاهی به شرکت‌هایی که در آن‌ها سرمایه‌گذاری کرده‌ایم</p>
        <div class="portfolio-grid">
            <div class="portfolio-item">
                <div class="portfolio-image">🚀</div>
                <div class="portfolio-content">
                    <h3>تکنو استارت</h3>
                    <p>پلتفرم هوش مصنوعی برای تحلیل داده‌های کسب‌وکار و پیش‌بینی روندهای بازار با دقت بالا</p>
                </div>
            </div>
            <div class="portfolio-item">
                <div class="portfolio-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">💊</div>
                <div class="portfolio-content">
                    <h3>هلث تک</h3>
                    <p>سامانه تله‌مدیسین و مشاوره پزشکی آنلاین با بیش از 500 پزشک متخصص</p>
                </div>
            </div>
            <div class="portfolio-item">
                <div class="portfolio-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">🏦</div>
                <div class="portfolio-content">
                    <h3>فین پی</h3>
                    <p>پلتفرم پرداخت دیجیتال و کیف پول الکترونیک با امکانات پیشرفته مدیریت مالی</p>
                </div>
            </div>
            <div class="portfolio-item">
                <div class="portfolio-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">🎓</div>
                <div class="portfolio-content">
                    <h3>ادیو تک</h3>
                    <p>پلتفرم آموزش آنلاین با رویکرد یادگیری تطبیقی و هوشمند</p>
                </div>
            </div>
            <div class="portfolio-item">
                <div class="portfolio-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">🛒</div>
                <div class="portfolio-content">
                    <h3>شاپ لینک</h3>
                    <p>پلتفرم تجارت الکترونیک B2B برای اتصال تولیدکنندگان و خرده‌فروشان</p>
                </div>
            </div>
            <div class="portfolio-item">
                <div class="portfolio-image" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">🌍</div>
                <div class="portfolio-content">
                    <h3>گرین انرژی</h3>
                    <p>استارت‌آپ فعال در حوزه انرژی‌های تجدیدپذیر و راهکارهای هوشمند مدیریت انرژی</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="container">
        <h2 class="section-title" style="color: white;">خدمات ما</h2>
        <p style="text-align: center; opacity: 0.9;">فراتر از سرمایه، شریک موفقیت شما</p>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">💰</div>
                <h3>تأمین سرمایه</h3>
                <p>سرمایه‌گذاری از 100 میلیون تا 5 میلیارد تومان در مراحل مختلف رشد کسب‌وکار شما</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>مشاوره استراتژیک</h3>
                <p>راهنمایی تخصصی در زمینه استراتژی کسب‌وکار، توسعه محصول و ورود به بازار</p>
            </div>
            <div class="service-card">
                <div class="service-icon">🤝</div>
                <h3>شبکه‌سازی</h3>
                <p>دسترسی به شبکه گسترده‌ای از سرمایه‌گذاران، متخصصان و شرکای تجاری</p>
            </div>
        </div>
    </div>
</section>

<!-- Investment Areas -->
<section class="investment-areas">
    <div class="container">
        <h2 class="section-title">حوزه‌های سرمایه‌گذاری</h2>
        <p>ما در حوزه‌های فناوری پیشرو سرمایه‌گذاری می‌کنیم</p>
        <div class="areas-grid">
            <div class="area-item">
                <div class="area-icon">🤖</div>
                <h4>هوش مصنوعی</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🔗</div>
                <h4>بلاکچین</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">☁️</div>
                <h4>رایانش ابری</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🏥</div>
                <h4>سلامت دیجیتال</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🎓</div>
                <h4>فناوری آموزشی</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">💳</div>
                <h4>فین‌تک</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🛒</div>
                <h4>تجارت الکترونیک</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🌱</div>
                <h4>کشاورزی هوشمند</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🚗</div>
                <h4>حمل‌ونقل هوشمند</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🏠</div>
                <h4>پراپ‌تک</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">⚡</div>
                <h4>انرژی پاک</h4>
            </div>
            <div class="area-item">
                <div class="area-icon">🎮</div>
                <h4>گیمینگ</h4>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners">
    <div class="container">
        <h2 class="section-title">شرکای ما</h2>
        <p>همکاری با برترین سازمان‌ها و شرکت‌ها</p>
        <div class="partners-grid">
            <div class="partner-logo">
                <div class="partner-placeholder">A1</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">B2</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">C3</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">D4</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">E5</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">F6</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">G7</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">H8</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">I9</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">J1</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">K2</div>
            </div>
            <div class="partner-logo">
                <div class="partner-placeholder">L3</div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team" id="team">
    <div class="container">
        <h2 class="section-title">تیم سرمایه‌گذاری</h2>
        <p>افرادی که پشت موفقیت این صندوق هستند</p>

        <div class="team-grid">

            <div class="team-member">
                <div class="team-photo">👤</div>
                <div class="team-info">
                    <h3>دکتر علی رضایی</h3>
                    <div class="position">مدیرعامل</div>
                    <p>
                        بیش از 15 سال تجربه در سرمایه‌گذاری خطرپذیر و توسعه کسب‌وکارهای
                        فناورانه در حوزه استارت‌آپ.
                    </p>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo">👤</div>
                <div class="team-info">
                    <h3>مهندس سارا محمدی</h3>
                    <div class="position">مدیر سرمایه‌گذاری</div>
                    <p>
                        متخصص تحلیل استارت‌آپ‌ها و مدیریت پورتفولیو با سابقه همکاری
                        با چندین صندوق سرمایه‌گذاری.
                    </p>
                </div>
            </div>

            <div class="team-member">
                <div class="team-photo">👤</div>
                <div class="team-info">
                    <h3>مهندس امیر کاظمی</h3>
                    <div class="position">مدیر توسعه کسب‌وکار</div>
                    <p>
                        فعال در حوزه اکوسیستم نوآوری و مسئول توسعه همکاری‌های
                        استراتژیک با شرکت‌ها و استارت‌آپ‌ها.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- News -->
<section class="news" id="news">
    <div class="container">

        <h2 class="section-title">اخبار و رویدادها</h2>
        <p>آخرین فعالیت‌ها و اطلاعیه‌های صندوق</p>

        <div class="news-grid">

            <div class="news-item">
                <div class="news-image">📰</div>
                <div class="news-content">
                    <div class="news-date">20 فروردین 1405</div>
                    <h3>سرمایه‌گذاری جدید در حوزه هوش مصنوعی</h3>
                    <p>
                        صندوق توسعه دانش بنیان سینا در یک استارت‌آپ فعال در حوزه پردازش داده و
                        هوش مصنوعی سرمایه‌گذاری جدیدی انجام داد.
                    </p>
                </div>
            </div>

            <div class="news-item">
                <div class="news-image">📢</div>
                <div class="news-content">
                    <div class="news-date">10 فروردین 1405</div>
                    <h3>فراخوان جذب استارت‌آپ</h3>
                    <p>
                        صندوق توسعه دانش بنیان سینا از استارت‌آپ‌های فعال در حوزه فین‌تک،
                        سلامت دیجیتال و AI دعوت به همکاری می‌کند.
                    </p>
                </div>
            </div>

            <div class="news-item">
                <div class="news-image">🎤</div>
                <div class="news-content">
                    <div class="news-date">1 فروردین 1405</div>
                    <h3>حضور در رویداد ملی نوآوری</h3>
                    <p>
                        تیم سرمایه‌گذاری توسعه دانش بنیان سینا در رویداد ملی نوآوری حضور یافته و با
                        بیش از 120 تیم استارت‌آپی جلسات B2B برگزار کرد.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg,var(--cvc-primary),var(--cvc-primary-hover)); color:white; text-align:center;">
    <div class="container">
        <h2 style="font-size:36px; margin-bottom:20px;">آماده جذب سرمایه هستید؟</h2>
        <p style="opacity:.9; margin-bottom:30px;">
            طرح کسب‌وکار خود را برای ما ارسال کنید و وارد مسیر رشد حرفه‌ای شوید.
        </p>
        <a href="#contact" class="btn" style="background:white; color:var(--cvc-primary);">
            ارسال درخواست سرمایه‌گذاری
        </a>
    </div>
</section>

<!-- Contact -->
<section id="contact" style="padding:80px 0; background:white;">
    <div class="container">
        <h2 class="section-title">تماس با ما</h2>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; margin-top:40px;">

            <div>
                <h3 style="margin-bottom:15px;">اطلاعات تماس</h3>
                <p>آدرس: تهران، خیابان نوآوری، برج فناوری، طبقه 12</p>
                <p>تلفن: 021-12345678</p>
                <p>ایمیل: info@metrofuntest.ir</p>
            </div>

            <div style="background:var(--cvc-bg); padding:30px; border-radius:15px;">
                <form>
                    <div style="margin-bottom:15px;">
                        <input type="text" placeholder="نام و نام خانوادگی"
                               style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
                    </div>
                    <div style="margin-bottom:15px;">
                        <input type="email" placeholder="ایمیل"
                               style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
                    </div>
                    <div style="margin-bottom:15px;">
                            <textarea rows="4" placeholder="پیام شما"
                                      style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;"></textarea>
                    </div>
                    <button type="submit"
                            style="background:var(--cvc-primary); color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer;">
                        ارسال پیام
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">

        <div class="footer-content">

            <div class="footer-about">
                <h3>توسعه دانش بنیان سینا</h3>
                <p>
                    صندوق سرمایه‌گذاری خطرپذیر شرکتی با تمرکز بر نوآوری،
                    فناوری‌های پیشرو و رشد پایدار کسب‌وکارها.
                </p>
            </div>

            <div class="footer-links">
                <h4>دسترسی سریع</h4>
                <ul>
                    <li><a href="#">خانه</a></li>
                    <li><a href="#">پورتفولیو</a></li>
                    <li><a href="#">خدمات</a></li>
                    <li><a href="#">تماس با ما</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>حوزه‌ها</h4>
                <ul>
                    <li><a href="#">هوش مصنوعی</a></li>
                    <li><a href="#">فین‌تک</a></li>
                    <li><a href="#">سلامت دیجیتال</a></li>
                    <li><a href="#">انرژی پاک</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>ارتباط با ما</h4>
                <ul>
                    <li><a href="#">لینکدین</a></li>
                    <li><a href="#">اینستاگرام</a></li>
                    <li><a href="#">تلگرام</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            © 1405 تمامی حقوق متعلق به توسعه دانش بنیان سینا می‌باشد.
        </div>

    </div>
</footer>

</body>
</html>

