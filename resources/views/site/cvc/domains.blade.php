@extends('site.layouts.base2')

@section('title', 'حوزه‌های سرمایه‌گذاری - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>
        /* Hero Section */
        .investment-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 6rem 0 5rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .investment-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .investment-hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 100px;
            background: #ffffff;
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        .investment-hero-content {
            position: relative;
            z-index: 1;
        }

        .investment-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.8s ease;
        }

        .investment-hero p {
            font-size: 1.35rem;
            opacity: 0.95;
            max-width: 850px;
            margin: 0 auto;
            line-height: 2;
            animation: fadeInUp 0.8s ease 0.2s backwards;
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

        /* Intro Section */
        .intro-section {
            padding: 6rem 0 4rem;
            background: #fff;
        }

        .intro-content {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .intro-content h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .intro-content p {
            font-size: 1.15rem;
            color: #555;
            line-height: 2;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .intro-highlight {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 16px;
            border-right: 5px solid #667eea;
            margin: 2rem 0;
        }

        .intro-highlight p {
            margin: 0;
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: 600;
            text-align: center;
        }

        /* Investment Areas Section */
        .areas-section {
            padding: 4rem 0 6rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.8rem;
            color: #2c3e50;
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

        .areas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
        }

        .area-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
        }

        .area-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .area-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .area-card:hover::before {
            transform: scaleX(1);
        }

        .area-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .area-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="50" height="50" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="2" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
            opacity: 0.5;
        }

        .area-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: block;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .area-card:hover .area-icon {
            transform: scale(1.2) rotateY(360deg);
        }

        .area-header h3 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .area-body {
            padding: 2.5rem;
        }

        .area-description {
            color: #555;
            line-height: 2;
            font-size: 1.05rem;
            margin-bottom: 2rem;
            text-align: justify;
        }

        .area-features {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
        }

        .area-features li {
            padding: 0.75rem 0;
            color: #2c3e50;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .area-features li:last-child {
            border-bottom: none;
        }

        .area-features li::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .area-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e9ecef;
        }

        .area-stat {
            text-align: center;
        }

        .area-stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .area-stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid2" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid2)"/></svg>');
            opacity: 0.3;
        }

        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .cta-content p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            line-height: 2;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1.2rem 3rem;
            font-size: 1.1rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .cta-btn-primary {
            background: white;
            color: #667eea;
        }

        .cta-btn-primary:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-btn-secondary:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .investment-hero h1 {
                font-size: 2.5rem;
            }

            .investment-hero p {
                font-size: 1.1rem;
            }

            .intro-content h2 {
                font-size: 2rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .areas-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .cta-content h2 {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .cta-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
@endsection

@section('content')
    @if($pageContent || $items->isNotEmpty())
        <section style="padding:24px 0;background:#fff;">
            <div class="container">
                @if($pageContent)
                    <h2 style="margin-bottom:10px;">{{ $pageContent->title }}</h2>
                    <p style="margin-bottom:16px;color:#666;">{{ $pageContent->description }}</p>
                @endif
                @foreach($items as $item)
                    <div style="margin-bottom:12px;padding:12px;border:1px solid #eee;border-radius:8px;">
                        <strong>{{ $item->title }}</strong>
                        @if($item->description)
                            <p style="margin:8px 0 0;">{{ $item->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    <!-- Hero Section -->
    <section class="investment-hero">
        <div class="investment-hero-content">
            <div class="container">
                <h1>حوزه‌های سرمایه‌گذاری</h1>
                <p>مستید با تمرکز بر فناوری‌های نوین و صنایع پیشرو، فرصت‌های سرمایه‌گذاری ارزشمند را در حوزه‌های
                    استراتژیک شناسایی و پشتیبانی می‌کند</p>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="container">
            <div class="intro-content">
                <h2>رویکرد سرمایه‌گذاری مستید</h2>
                <p>
                    مرکز تحقیقات استراتژیک مستید با بهره‌گیری از تیم متخصص و تحلیل‌های عمیق بازار، در حوزه‌های کلیدی
                    اقتصاد دیجیتال و صنایع نوآور سرمایه‌گذاری می‌کند. ما به دنبال شرکت‌هایی هستیم که پتانسیل رشد بالا،
                    تیم مدیریتی قوی و مدل کسب‌وکار پایدار دارند.
                </p>
                <div class="intro-highlight">
                    <p>تمرکز ما بر خلق ارزش بلندمدت و همراهی استراتژیک با شرکت‌های سرمایه‌پذیر است</p>
                </div>
                <p>
                    با رویکردی جامع و چندبعدی، ما نه تنها سرمایه مالی، بلکه دانش، شبکه و تجربه خود را در اختیار شرکت‌های
                    پرتفوی قرار می‌دهیم تا آن‌ها را در مسیر موفقیت یاری کنیم.
                </p>
            </div>
        </div>
    </section>

    <!-- Investment Areas Section -->
    <section class="areas-section">
        <div class="container">
            <div class="section-header">
                <h2>حوزه‌های اصلی سرمایه‌گذاری</h2>
                <p>مستید در حوزه‌های زیر به دنبال فرصت‌های سرمایه‌گذاری است</p>
            </div>

            <div class="areas-grid">
                <!-- Area 1: Fintech -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">💳</span>
                        <h3>فین‌تک و خدمات مالی</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            فناوری‌های مالی نوین که تجربه کاربری را بهبود می‌بخشند و دسترسی به خدمات مالی را گسترش
                            می‌دهند. از پرداخت‌های دیجیتال تا سرویس‌های بانکداری باز و مدیریت دارایی هوشمند.
                        </p>
                        <ul class="area-features">
                            <li>پلتفرم‌های پرداخت دیجیتال</li>
                            <li>سیستم‌های وام‌دهی آنلاین</li>
                            <li>کیف پول‌های دیجیتال</li>
                            <li>راهکارهای بانکداری باز</li>
                            <li>مدیریت دارایی مبتنی بر هوش مصنوعی</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$15B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">35%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area 2: E-commerce -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">🛒</span>
                        <h3>تجارت الکترونیک</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            پلتفرم‌های نوآورانه خرید و فروش آنلاین که زنجیره تامین را بهینه می‌کنند و تجربه خرید مشتریان
                            را متحول می‌سازند. از مارکت‌پلیس‌های عمودی تا راهکارهای B2B.
                        </p>
                        <ul class="area-features">
                            <li>مارکت‌پلیس‌های تخصصی</li>
                            <li>پلتفرم‌های B2B و B2C</li>
                            <li>راهکارهای لجستیک هوشمند</li>
                            <li>سیستم‌های مدیریت موجودی</li>
                            <li>تجارت اجتماعی و لایو کامرس</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$25B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">42%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area 3: HealthTech -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">🏥</span>
                        <h3>فناوری سلامت</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            راهکارهای دیجیتال در حوزه سلامت که کیفیت خدمات پزشکی را ارتقا می‌دهند و دسترسی به مراقبت‌های
                            بهداشتی را آسان‌تر می‌کنند. از تله‌مدیسین تا سیستم‌های تشخیص هوشمند.
                        </p>
                        <ul class="area-features">
                            <li>پلتفرم‌های تله‌مدیسین</li>
                            <li>سیستم‌های مدیریت پرونده الکترونیک</li>
                            <li>ابزارهای تشخیص مبتنی بر AI</li>
                            <li>اپلیکیشن‌های سلامت شخصی</li>
                            <li>راهکارهای داروخانه آنلاین</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$18B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">38%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area 4: EdTech -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">📚</span>
                        <h3>فناوری آموزش</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            پلتفرم‌های یادگیری نوین که آموزش را شخصی‌سازی می‌کنند و دسترسی به دانش را دموکراتیزه
                            می‌نمایند. از آموزش آنلاین تا سیستم‌های مدیریت یادگیری هوشمند.
                        </p>
                        <ul class="area-features">
                            <li>پلتفرم‌های آموزش آنلاین</li>
                            <li>سیستم‌های LMS پیشرفته</li>
                            <li>محتوای تعاملی و گیمیفیکیشن</li>
                            <li>راهکارهای یادگیری تطبیقی</li>
                            <li>ابزارهای ارزیابی هوشمند</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$12B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">28%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area 5: AI & Data -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">🤖</span>
                        <h3>هوش مصنوعی و داده</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            فناوری‌های هوش مصنوعی و تحلیل داده که کسب‌وکارها را هوشمندتر می‌کنند و تصمیم‌گیری را بهینه
                            می‌سازند. از یادگیری ماشین تا پردازش زبان طبیعی و بینایی ماشین.
                        </p>
                        <ul class="area-features">
                            <li>پلتفرم‌های یادگیری ماشین</li>
                            <li>ابزارهای تحلیل داده پیشرفته</li>
                            <li>سیستم‌های پردازش زبان طبیعی</li>
                            <li>راهکارهای بینایی ماشین</li>
                            <li>اتوماسیون هوشمند فرآیندها</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$30B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">45%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Area 6: SaaS -->
                <div class="area-card">
                    <div class="area-header">
                        <span class="area-icon">☁️</span>
                        <h3>نرم‌افزار به عنوان سرویس</h3>
                    </div>
                    <div class="area-body">
                        <p class="area-description">
                            راهکارهای نرم‌افزاری ابری که فرآیندهای کسب‌وکار را دیجیتالی می‌کنند و بهره‌وری را افزایش
                            می‌دهند. از CRM تا ابزارهای همکاری تیمی و مدیریت پروژه.
                        </p>
                        <ul class="area-features">
                            <li>سیستم‌های CRM و ERP</li>
                            <li>ابزارهای همکاری و ارتباط تیمی</li>
                            <li>پلتفرم‌های مدیریت پروژه</li>
                            <li>راهکارهای منابع انسانی</li>
                            <li>ابزارهای اتوماسیون بازاریابی</li>
                        </ul>
                        <div class="area-stats">
                            <div class="area-stat">
                                <span class="area-stat-number">$20B+</span>
                                <span class="area-stat-label">ارزش بازار</span>
                            </div>
                            <div class="area-stat">
                                <span class="area-stat-number">32%</span>
                                <span class="area-stat-label">رشد سالانه</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <div class="container">
                <h2>آیا استارتاپ شما در این حوزه‌هاست؟</h2>
                <p>اگر در یکی از این حوزه‌ها فعالیت می‌کنید و به دنبال سرمایه‌گذار استراتژیک هستید، دوست داریم با شما
                    آشنا شویم</p>
                <div class="cta-buttons">
                    <a href="#" class="cta-btn cta-btn-primary">ارسال درخواست سرمایه‌گذاری</a>
                    <a href="#" class="cta-btn cta-btn-secondary">تماس با ما</a>
                </div>
            </div>
        </div>
    </section>
@endsection
