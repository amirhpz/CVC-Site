@extends('site.layouts.base2')

@section('title', 'درباره ما - توسعه دانش بنیان سینا')

@section('styles')
    <style>

        /* Hero Section */
        .about-hero {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            padding: 6rem 0 5rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .about-hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 100px;
            background: var(--cvc-surface);
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        .about-hero-content {
            position: relative;
            z-index: 1;
        }

        .about-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.8s ease;
        }

        .about-hero p {
            font-size: 1.35rem;
            opacity: 0.95;
            max-width: 850px;
            margin: 0 auto 2.5rem;
            line-height: 2;
            animation: fadeInUp 0.8s ease 0.2s backwards;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 900px;
            margin: 3rem auto 0;
            animation: fadeInUp 0.8s ease 0.4s backwards;
        }

        .hero-stat {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 2rem 1.5rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .hero-stat:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            display: block;
        }

        .hero-stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Story Section */
        .story-section {
            padding: 6rem 0;
            background: #fff;
        }

        .story-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .story-text h2 {
            font-size: 2.8rem;
            color: var(--cvc-text);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
            font-weight: 800;
        }

        .story-text h2::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 100px;
            height: 5px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 3px;
        }

        .story-text h3 {
            font-size: 1.5rem;
            color: var(--cvc-primary-hover);
            margin: 2rem 0 1rem;
            font-weight: 700;
        }

        .story-text p {
            color: var(--cvc-muted);
            line-height: 2;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .story-highlight {
            background: linear-gradient(135deg, var(--cvc-bg) 0%, #eef5f3 100%);
            padding: 2rem;
            border-radius: 16px;
            border-right: 5px solid var(--cvc-primary);
            margin: 2rem 0;
        }

        .story-highlight p {
            margin: 0;
            font-size: 1.15rem;
            color: var(--cvc-text);
            font-weight: 500;
            font-style: italic;
        }

        .story-image-container {
            position: relative;
        }

        .story-image-wrapper {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(36, 66, 61, 0.12);
        }

        .story-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: block;
        }

        .story-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(36, 66, 61, 0.72) 0%, transparent 100%);
            padding: 2rem;
            color: white;
        }

        .story-image-overlay h4 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .story-image-overlay p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        .story-decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }

        .story-decoration-1 {
            top: -50px;
            right: -50px;
        }

        .story-decoration-2 {
            bottom: -50px;
            left: -50px;
        }

        /* Mission & Vision Section */
        .mission-vision-section {
            background: linear-gradient(135deg, var(--cvc-bg) 0%, #eef5f3 100%);
            padding: 6rem 0;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.8rem;
            color: var(--cvc-text);
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .section-header p {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .mission-vision-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
        }

        .mv-card {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .mv-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .mv-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .mv-card:hover::before {
            transform: scaleX(1);
        }

        .mv-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            transition: all 0.4s ease;
        }

        .mv-card:hover .mv-icon {
            transform: rotateY(360deg);
        }

        .mv-card h3 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .mv-card p {
            color: #555;
            line-height: 2;
            font-size: 1.1rem;
            text-align: justify;
        }

        /* Values Section */
        .values-section {
            padding: 6rem 0;
            background: #fff;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            margin-top: 4rem;
        }

        .value-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .value-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .value-card:hover::before {
            opacity: 0.05;
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
            border-color: var(--cvc-primary);
        }

        .value-card > * {
            position: relative;
            z-index: 1;
        }

        .value-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .value-card:hover .value-icon {
            transform: scale(1.2);
        }

        .value-card h4 {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .value-card p {
            color: #555;
            line-height: 1.9;
            font-size: 1rem;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .timeline {
            position: relative;
            max-width: 1000px;
            margin: 4rem auto 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            right: 50%;
            width: 4px;
            background: linear-gradient(to bottom, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 4rem;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            width: 45%;
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
        }

        .timeline-content:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        .timeline-year {
            position: absolute;
            right: 50%;
            transform: translateX(50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: 800;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            border: 5px solid #f8f9fa;
        }

        .timeline-content h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .timeline-content p {
            color: #555;
            line-height: 1.9;
            font-size: 1.05rem;
        }

        /* Team Section */
        .team-section {
            padding: 6rem 0;
            background: #fff;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
        }

        .team-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            text-align: center;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .team-image {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            color: white;
            font-weight: 800;
            position: relative;
            overflow: hidden;
        }

        .team-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        }

        .team-info {
            padding: 2rem;
        }

        .team-info h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .team-info .team-role {
            color: var(--cvc-primary-hover);
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .team-info p {
            color: #555;
            line-height: 1.8;
            font-size: 0.95rem;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .team-social a {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .team-social a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Partners Section */
        .partners-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-top: 4rem;
        }

        .partner-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            min-height: 150px;
        }

        .partner-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        .partner-logo {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
        }

        /* CTA Section */
        .about-cta {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            padding: 5rem 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid2" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid2)"/></svg>');
            opacity: 0.3;
        }

        .about-cta-content {
            position: relative;
            z-index: 1;
        }

        .about-cta h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .about-cta p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 800px;
            margin: 0 auto 3rem;
            line-height: 2;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid white;
        }

        .cta-btn-primary {
            background: white;
            color: var(--cvc-primary-hover);
        }

        .cta-btn-primary:hover {
            background: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
        }

        .cta-btn-secondary:hover {
            background: white;
            color: var(--cvc-primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .about-hero h1 {
                font-size: 2.5rem;
            }

            .about-hero p {
                font-size: 1.1rem;
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .story-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .story-image-container {
                order: -1;
            }

            .timeline::before {
                right: 20px;
            }

            .timeline-item {
                flex-direction: row !important;
            }

            .timeline-content {
                width: calc(100% - 120px);
                margin-right: 120px;
            }

            .timeline-year {
                right: 20px;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .about-hero {
                padding: 4rem 0 3rem;
            }

            .about-hero h1 {
                font-size: 2rem;
            }

            .hero-stats {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .story-text h2 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .mission-vision-grid,
            .values-grid,
            .team-grid,
            .partners-grid {
                grid-template-columns: 1fr;
            }

            .about-cta h2 {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .cta-btn {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    @include('site.cvc.partials.dynamic-page-content')
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="/">خانه</a></li>
                <li class="active">درباره ما</li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <div class="container">
                <h1>توسعه دانش بنیان سینا</h1>
                <p>
                    ما پلی میان ایده‌های نوآورانه و موفقیت‌های تجاری هستیم. با ترکیب دانش، تجربه و سرمایه،
                    آینده‌ای روشن برای کسب‌وکارهای نوپا و فناوری‌محور می‌سازیم.
                </p>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">۱۵+</span>
                        <span class="hero-stat-label">سال تجربه</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">{{ $projectCount }}+</span>
                        <span class="hero-stat-label">پروژه موفق</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">{{ $teamCount }}+</span>
                        <span class="hero-stat-label">عضو تیم</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">{{ $newsCount }}+</span>
                        <span class="hero-stat-label">خبر و تحلیل</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="story-content">
                <div class="story-text">
                    <h2>داستان ما</h2>
                    <p>
                        توسعه دانش بنیان سینا با هدف ایجاد پلی میان ایده‌های نوآورانه و موفقیت‌های
                        تجاری
                        تاسیس شد. ما با درک عمیق از چالش‌های استارتاپ‌ها و کسب‌وکارهای نوپا، تصمیم گرفتیم فراتر از یک
                        سرمایه‌گذار سنتی عمل کنیم.
                    </p>

                    <div class="story-highlight">
                        <p>
                            "ما به این باور رسیدیم که موفقیت واقعی زمانی حاصل می‌شود که دانش، تجربه و سرمایه در کنار هم
                            قرار گیرند."
                        </p>
                    </div>

                    <h3>چشم‌انداز ما</h3>
                    <p>
                        از همان ابتدا، هدف ما فراتر از سرمایه‌گذاری مالی بود. ما می‌خواستیم شریکی استراتژیک برای
                        کارآفرینان باشیم که نه تنها منابع مالی، بلکه دانش، شبکه و تجربه خود را نیز در اختیار آن‌ها قرار
                        دهیم.
                    </p>

                    <p>
                        امروز، با افتخار می‌توانیم بگوییم که بیش از ۲۰۰ پروژه موفق را همراهی کرده‌ایم و شاهد رشد و
                        شکوفایی ایده‌هایی بوده‌ایم که به کسب‌وکارهای پایدار و موفق تبدیل شده‌اند.
                    </p>
                </div>

                <div class="story-image-container">
                    <div class="story-decoration story-decoration-1"></div>
                    <div class="story-decoration story-decoration-2"></div>
                    <div class="story-image-wrapper">
{{--                        <img src="/images/about-story.jpg" alt="داستان مستید" class="story-image">--}}

                        <div class="story-image-overlay">
                            <h4>۱۵ سال تجربه</h4>
                            <p>در حمایت از نوآوری و کارآفرینی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="mission-vision-section">
        <div class="container">
            <div class="section-header">
                <h2>ماموریت و چشم‌انداز</h2>
                <p>
                    ما با تمرکز بر نوآوری، کیفیت و پایداری، به دنبال خلق ارزش بلندمدت برای همه ذینفعان هستیم.
                </p>
            </div>

            <div class="mission-vision-grid">
                <div class="mv-card">
                    <div class="mv-icon">🎯</div>
                    <h3>ماموریت</h3>
                    <p>
                        حمایت جامع از کسب‌وکارهای نوپا و فناوری‌محور از طریق ارائه سرمایه، دانش و شبکه‌های استراتژیک
                        برای تبدیل ایده‌های نوآورانه به کسب‌وکارهای موفق و پایدار که ارزش واقعی برای جامعه خلق می‌کنند.
                    </p>
                </div>

                <div class="mv-card">
                    <div class="mv-icon">🔭</div>
                    <h3>چشم‌انداز</h3>
                    <p>
                        تبدیل شدن به پیشروترین مرکز تحقیقات و سرمایه‌گذاری استراتژیک در منطقه که با رویکردی نوآورانه
                        و انسان‌محور، الگویی برای توسعه اکوسیستم کارآفرینی و فناوری باشد و نقشی کلیدی در رشد اقتصاد
                        دانش‌بنیان ایفا کند.
                    </p>
                </div>

                <div class="mv-card">
                    <div class="mv-icon">💎</div>
                    <h3>ارزش‌های ما</h3>
                    <p>
                        نوآوری، صداقت، تعهد، همکاری و مسئولیت اجتماعی پایه‌های اصلی فعالیت‌های ما هستند.
                        ما به شفافیت، اخلاق حرفه‌ای و ایجاد ارزش پایدار برای همه ذینفعان متعهدیم.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-header">
                <h2>ارزش‌های بنیادین ما</h2>
                <p>
                    اصولی که هر روز ما را در مسیر موفقیت همراهی می‌کنند
                </p>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">💡</div>
                    <h4>نوآوری</h4>
                    <p>
                        ما به دنبال ایده‌های نو و خلاقانه هستیم که می‌توانند تحول واقعی ایجاد کنند.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h4>همکاری</h4>
                    <p>
                        موفقیت در گرو همکاری و هم‌افزایی است. ما شریک واقعی کارآفرینان هستیم.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">✨</div>
                    <h4>کیفیت</h4>
                    <p>
                        در هر پروژه، استانداردهای بالای کیفی را رعایت می‌کنیم و به تعالی متعهدیم.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🎓</div>
                    <h4>یادگیری مستمر</h4>
                    <p>
                        دنیای کسب‌وکار همواره در حال تغییر است و ما نیز همواره در حال یادگیری هستیم.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🌱</div>
                    <h4>پایداری</h4>
                    <p>
                        به دنبال ایجاد ارزش بلندمدت و پایدار برای جامعه و محیط زیست هستیم.
                    </p>
                </div>

                <div class="value-card">
                    <div class="value-icon">🔒</div>
                    <h4>صداقت</h4>
                    <p>
                        شفافیت و صداقت در تمام تعاملات ما اصل اساسی و غیرقابل مذاکره است.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <h2>سیر تحول ما</h2>
                <p>
                    نگاهی به مسیر رشد و دستاوردهای توسعه دانش بنیان سینا
                </p>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">۱۳۸۸</div>
                    <div class="timeline-content">
                        <h3>تاسیس مستید</h3>
                        <p>
                            آغاز فعالیت با تیمی کوچک اما پرانگیزه و هدف ایجاد تحول در اکوسیستم کارآفرینی کشور.
                            اولین سرمایه‌گذاری در حوزه فناوری اطلاعات انجام شد.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">۱۳۹۲</div>
                    <div class="timeline-content">
                        <h3>گسترش فعالیت‌ها</h3>
                        <p>
                            راه‌اندازی برنامه شتاب‌دهی و افزایش تیم به ۲۰ نفر. سرمایه‌گذاری در ۱۵ استارتاپ
                            و ایجاد شبکه‌ای از مشاوران و متخصصان.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">۱۳۹۵</div>
                    <div class="timeline-content">
                        <h3>توسعه بین‌المللی</h3>
                        <p>
                            ایجاد شراکت‌های استراتژیک با مراکز نوآوری بین‌المللی و گسترش فعالیت‌ها به
                            حوزه‌های جدید از جمله هوش مصنوعی و اینترنت اشیا.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">۱۳۹۸</div>
                    <div class="timeline-content">
                        <h3>دهمین سالگرد</h3>
                        <p>
                            جشن دهمین سالگرد با دستاورد سرمایه‌گذاری در بیش از ۱۰۰ پروژه موفق و ایجاد
                            بیش از ۵۰۰۰ فرصت شغلی مستقیم و غیرمستقیم.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">۱۴۰۱</div>
                    <div class="timeline-content">
                        <h3>تحول دیجیتال</h3>
                        <p>
                            راه‌اندازی پلتفرم دیجیتال جامع برای ارتباط سرمایه‌گذاران و کارآفرینان و
                            ارائه خدمات مشاوره‌ای آنلاین به صورت ۲۴/۷.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">۱۴۰۵</div>
                    <div class="timeline-content">
                        <h3>آینده روشن</h3>
                        <p>
                            با بیش از ۲۰۰ پروژه موفق، ۵۰ شریک استراتژیک و حجم سرمایه‌گذاری بیش از ۱۰۰ میلیون دلار،
                            آماده نوشتن فصل جدیدی از موفقیت هستیم.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <h2>تیم ما</h2>
                <p>
                    متخصصان و کارشناسانی که با تجربه و دانش خود، موفقیت شما را رقم می‌زنند
                </p>
            </div>

            <div class="team-grid">
                @forelse($teamMembers as $member)
                    <div class="team-card">
                        <div class="team-image">
                            {{ mb_substr($member->fullname, 0, 1) }}
                        </div>
                        <div class="team-info">
                            <h3>{{ $member->fullname }}</h3>
                            <div class="team-role">{{ $member->side }}</div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($member->description ?? ''), 140) }}</p>
                            <div class="team-social">
                                @if(!empty($member->slug))
                                    <a href="{{ route('cvc.team-member', $member->slug) }}" aria-label="پروفایل">👤</a>
                                @endif
                                @if(!empty($member->phone))
                                    <a href="tel:{{ $member->phone }}" aria-label="تلفن">📞</a>
                                @endif
                                @if(!empty($member->instagram))
                                    <a href="mailto:{{ $member->instagram }}" aria-label="ایمیل">✉️</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>در حال حاضر اعضای تیم برای نمایش ثبت نشده‌اند.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="container">
            <div class="section-header">
                <h2>شرکای استراتژیک</h2>
                <p>
                    همکاری با برترین سازمان‌ها و شرکت‌های داخلی و بین‌المللی
                </p>
            </div>

            <div class="partners-grid">
                <div class="partner-card">
                    <div class="partner-logo">TechCorp</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">InnoVenture</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">GlobalFund</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">StartHub</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">FutureLab</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">SmartCapital</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">TechBridge</div>
                </div>
                <div class="partner-card">
                    <div class="partner-logo">NextGen</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="about-cta">
        <div class="about-cta-content">
            <div class="container">
                <h2>آماده همکاری با ما هستید؟</h2>
                <p>
                    اگر ایده‌ای نوآورانه دارید یا به دنبال شریکی استراتژیک برای رشد کسب‌وکار خود هستید،
                    ما آماده‌ایم تا در کنار شما باشیم و موفقیت شما را رقم بزنیم.
                </p>
                <div class="cta-buttons">
                    <a href="/contact" class="cta-btn cta-btn-primary">
                        <span>تماس با ما</span>
                        <span>←</span>
                    </a>
                    <a href="/services" class="cta-btn cta-btn-secondary">
                        <span>خدمات ما</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
