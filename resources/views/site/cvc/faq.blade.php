@extends('site.layouts.base2')

@section('title', 'سوالات متداول - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>

        /* ============================================
           Hero Section
        ============================================ */
        .faq-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5rem 0 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .faq-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .faq-hero-content {
            position: relative;
            z-index: 1;
        }

        .faq-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            animation: fadeInDown 0.8s ease;
        }

        .faq-hero p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .faq-hero-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: bounce 2s infinite;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* ============================================
           Search Section
        ============================================ */
        .faq-search-section {
            background: white;
            padding: 3rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .search-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .search-container h2 {
            color: #2c3e50;
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .search-container p {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: 1.25rem 4rem 1.25rem 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .search-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .search-input::placeholder {
            color: #adb5bd;
        }

        .search-btn {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        /* ============================================
           Category Tabs
        ============================================ */
        .faq-categories {
            background: #f8f9fa;
            padding: 3rem 0;
        }

        .category-tabs {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .category-tab {
            background: white;
            color: #6c757d;
            border: 2px solid #e9ecef;
            padding: 1rem 2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-family: inherit;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .category-tab:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .category-tab.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .category-tab i {
            font-size: 1.2rem;
        }

        /* ============================================
           FAQ Items
        ============================================ */
        .faq-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-category-section {
            display: none;
        }

        .faq-category-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .category-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .category-header h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .category-header h2 i {
            color: #667eea;
            font-size: 2.5rem;
        }

        .category-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .faq-question {
            padding: 1.75rem 2rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s ease;
            user-select: none;
        }

        .faq-item:hover .faq-question {
            background: linear-gradient(to right, rgba(102, 126, 234, 0.05), transparent);
        }

        .faq-item.active .faq-question {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .faq-question-text {
            flex: 1;
            font-size: 1.15rem;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.6;
        }

        .faq-item.active .faq-question-text {
            color: white;
        }

        .faq-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .faq-item.active .faq-icon {
            background: white;
            color: #667eea;
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 1000px;
            padding: 0 2rem 2rem 2rem;
        }

        .faq-answer-content {
            color: #555;
            line-height: 1.9;
            font-size: 1.05rem;
            padding-top: 1rem;
            border-top: 2px solid #f0f0f0;
        }

        .faq-answer-content p {
            margin-bottom: 1rem;
        }

        .faq-answer-content ul,
        .faq-answer-content ol {
            margin: 1rem 0 1rem 2rem;
            line-height: 2;
        }

        .faq-answer-content li {
            margin-bottom: 0.5rem;
        }

        .faq-answer-content strong {
            color: #2c3e50;
            font-weight: 700;
        }

        .faq-answer-content a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .faq-answer-content a:hover {
            color: #5568d3;
            text-decoration: underline;
        }

        /* ============================================
           Stats Section
        ============================================ */
        .faq-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            margin-top: 4rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .stat-item {
            position: relative;
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        /* ============================================
           CTA Section
        ============================================ */
        .faq-cta {
            background: white;
            padding: 4rem 0;
            text-align: center;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .cta-content h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .cta-content p {
            color: #6c757d;
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .cta-btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 2px solid transparent;
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .cta-btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .cta-btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* ============================================
   Help Box
============================================ */
        .help-box {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-right: 5px solid #667eea;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 3rem;
        }


        .help-box-content {
            display: flex;
            align-items: center;
            gap: 2rem;
            max-width: 700px;
            margin: 0 auto;
        }

        .help-box-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            flex-shrink: 0;
        }

        .help-box-text h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .help-box-text p {
            color: #6c757d;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .help-box-links {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .help-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .help-link:hover {
            color: #5568d3;
            gap: 0.75rem;
        }

        /* ============================================
           Popular Questions Badge
        ============================================ */
        .popular-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        /* ============================================
           No Results Message
        ============================================ */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .no-results i {
            font-size: 5rem;
            color: #e9ecef;
            margin-bottom: 1.5rem;
        }

        .no-results h3 {
            color: #2c3e50;
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .no-results p {
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* ============================================
           Responsive Design
        ============================================ */
        @media (max-width: 992px) {
            .faq-hero h1 {
                font-size: 2.25rem;
            }

            .category-tabs {
                gap: 0.75rem;
            }

            .category-tab {
                padding: 0.875rem 1.5rem;
                font-size: 0.95rem;
            }

            .help-box-content {
                flex-direction: column;
                text-align: center;
            }

            .help-box-links {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .faq-hero {
                padding: 3rem 0 2rem;
            }

            .faq-hero h1 {
                font-size: 1.875rem;
            }

            .faq-hero p {
                font-size: 1rem;
            }

            .faq-hero-icon {
                font-size: 3rem;
            }

            .search-input {
                padding: 1rem 3.5rem 1rem 1.25rem;
                font-size: 1rem;
            }

            .search-btn {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }

            .category-tabs {
                gap: 0.5rem;
            }

            .category-tab {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }

            .category-header h2 {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .faq-question {
                padding: 1.25rem 1.5rem;
                gap: 1rem;
            }

            .faq-question-text {
                font-size: 1rem;
            }

            .faq-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .faq-item.active .faq-answer {
                padding: 0 1.5rem 1.5rem 1.5rem;
            }

            .faq-answer-content {
                font-size: 0.95rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .cta-content h2 {
                font-size: 1.5rem;
            }

            .cta-content p {
                font-size: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-btn {
                width: 100%;
                justify-content: center;
            }

            .popular-badge {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .faq-hero h1 {
                font-size: 1.5rem;
            }

            .search-container h2 {
                font-size: 1.4rem;
            }

            .category-header h2 {
                font-size: 1.3rem;
            }

            .help-box {
                padding: 1.5rem;
            }

            .help-box-icon {
                width: 60px;
                height: 60px;
                font-size: 2rem;
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
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">خانه</a></li>
                <li class="active">سوالات متداول</li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="faq-hero">
        <div class="faq-hero-content">
            <div class="container">
                <div class="faq-hero-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h1>سوالات متداول</h1>
                <p>
                    پاسخ سوالات رایج درباره خدمات، فرآیندها و همکاری با مرکز تحقیقات استراتژیک مستید را در این بخش
                    بیابید.
                    اگر پاسخ سوال خود را پیدا نکردید، با ما تماس بگیرید.
                </p>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="faq-search-section">
        <div class="container">
            <div class="search-container">
                <h2>جستجو در سوالات متداول</h2>
                <p>سوال خود را تایپ کنید تا سریع‌تر به پاسخ برسید</p>
                <div class="search-box">
                    <input
                        type="text"
                        class="search-input"
                        id="faqSearch"
                        placeholder="مثلاً: نحوه ثبت درخواست سرمایه..."
                    >
                    <button class="search-btn" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories & FAQ Content -->
    <section class="faq-categories">
        <div class="container">
            <!-- Category Tabs -->
            <div class="category-tabs">
                <button class="category-tab active" data-category="general">
                    <i class="fas fa-info-circle"></i>
                    <span>عمومی</span>
                </button>
                <button class="category-tab" data-category="services">
                    <i class="fas fa-briefcase"></i>
                    <span>خدمات</span>
                </button>
                <button class="category-tab" data-category="investment">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>سرمایه‌گذاری</span>
                </button>
                <button class="category-tab" data-category="research">
                    <i class="fas fa-flask"></i>
                    <span>پژوهش</span>
                </button>
                <button class="category-tab" data-category="cooperation">
                    <i class="fas fa-handshake"></i>
                    <span>همکاری</span>
                </button>
                <button class="category-tab" data-category="payment">
                    <i class="fas fa-credit-card"></i>
                    <span>پرداخت</span>
                </button>
            </div>

            <!-- FAQ Content -->
            <div class="faq-content">
                <!-- General Category -->
                <div class="faq-category-section active" data-category="general">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-info-circle"></i>
                            سوالات عمومی
                        </h2>
                        <p>پاسخ سوالات کلی درباره مرکز تحقیقات استراتژیک مستید</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                <span class="popular-badge">
                                    <i class="fas fa-fire"></i>
                                    پرتکرار
                                </span>
                                مرکز تحقیقات استراتژیک مستید چه نوع سازمانی است؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    مرکز تحقیقات استراتژیک مستید یک مرکز تحقیقاتی مستقل و تخصصی است که در حوزه‌های
                                    <strong>مطالعات استراتژیک، سیاست‌گذاری عمومی، توسعه اقتصادی و نوآوری</strong> فعالیت
                                    می‌کند.
                                </p>
                                <p>
                                    ما با ارائه تحلیل‌های علمی، مشاوره‌های تخصصی و پژوهش‌های کاربردی، به سازمان‌ها،
                                    شرکت‌ها
                                    و نهادهای دولتی کمک می‌کنیم تا تصمیمات استراتژیک بهتری اتخاذ کنند.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                حوزه‌های تخصصی فعالیت مرکز کدامند؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>مرکز تحقیقات استراتژیک مستید در حوزه‌های زیر فعالیت می‌کند:</p>
                                <ul>
                                    <li><strong>مطالعات استراتژیک:</strong> تحلیل روندها، پیش‌بینی آینده و برنامه‌ریزی
                                        بلندمدت
                                    </li>
                                    <li><strong>سیاست‌گذاری عمومی:</strong> مشاوره به نهادهای دولتی و تدوین سیاست‌های
                                        کلان
                                    </li>
                                    <li><strong>توسعه اقتصادی:</strong> مطالعات بازار، تحلیل صنایع و برنامه‌ریزی توسعه
                                    </li>
                                    <li><strong>نوآوری و فناوری:</strong> ارزیابی فناوری‌های نوین و مدیریت نوآوری</li>
                                    <li><strong>مدیریت استراتژیک:</strong> مشاوره سازمانی و بهبود فرآیندها</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چگونه می‌توانم با مرکز همکاری کنم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>راه‌های مختلفی برای همکاری با مرکز وجود دارد:</p>
                                <ol>
                                    <li><strong>همکاری پژوهشی:</strong> شرکت در پروژه‌های تحقیقاتی مشترک</li>
                                    <li><strong>مشاوره تخصصی:</strong> دریافت خدمات مشاوره‌ای در حوزه‌های مختلف</li>
                                    <li><strong>سرمایه‌گذاری:</strong> حمایت مالی از پروژه‌های تحقیقاتی</li>
                                    <li><strong>استخدام:</strong> پیوستن به تیم ما به عنوان پژوهشگر یا کارشناس</li>
                                </ol>
                                <p>
                                    برای اطلاعات بیشتر می‌توانید از طریق <a href="/contact">صفحه تماس با ما</a> با ما در
                                    ارتباط باشید.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا مرکز خدمات بین‌المللی ارائه می‌دهد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، مرکز تحقیقات استراتژیک مستید با شبکه‌ای از مراکز تحقیقاتی و دانشگاه‌های معتبر
                                    بین‌المللی
                                    در ارتباط است و می‌تواند پروژه‌های بین‌المللی را نیز انجام دهد.
                                </p>
                                <p>
                                    ما همچنین در زمینه <strong>مطالعات تطبیقی، تحلیل بازارهای جهانی و مشاوره‌های
                                        بین‌المللی</strong>
                                    تخصص داریم.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Category -->
                <div class="faq-category-section" data-category="services">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-briefcase"></i>
                            خدمات
                        </h2>
                        <p>سوالات مربوط به خدمات و محصولات مرکز</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                <span class="popular-badge">
                                    <i class="fas fa-fire"></i>
                                    پرتکرار
                                </span>
                                چه نوع خدمات مشاوره‌ای ارائه می‌دهید؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>خدمات مشاوره‌ای ما شامل موارد زیر است:</p>
                                <ul>
                                    <li><strong>مشاوره استراتژیک:</strong> تدوین استراتژی‌های کلان سازمانی و کسب‌وکار
                                    </li>
                                    <li><strong>مشاوره سیاست‌گذاری:</strong> کمک به تدوین و ارزیابی سیاست‌های عمومی</li>
                                    <li><strong>مشاوره مدیریت:</strong> بهبود فرآیندها و ساختار سازمانی</li>
                                    <li><strong>مشاوره فناوری:</strong> ارزیابی و انتخاب فناوری‌های مناسب</li>
                                    <li><strong>مشاوره بازار:</strong> تحلیل بازار و برنامه‌ریزی ورود به بازارهای جدید
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                مدت زمان انجام یک پروژه تحقیقاتی چقدر است؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    مدت زمان انجام پروژه‌های تحقیقاتی بسته به <strong>پیچیدگی موضوع، حجم کار و منابع در
                                        دسترس</strong>
                                    متفاوت است:
                                </p>
                                <ul>
                                    <li><strong>پروژه‌های کوچک:</strong> ۱ تا ۳ ماه</li>
                                    <li><strong>پروژه‌های متوسط:</strong> ۳ تا ۶ ماه</li>
                                    <li><strong>پروژه‌های بزرگ:</strong> ۶ ماه تا ۱ سال</li>
                                    <li><strong>پروژه‌های استراتژیک:</strong> بیش از ۱ سال</li>
                                </ul>
                                <p>
                                    پس از دریافت درخواست شما، تیم ما یک برنامه زمانی دقیق ارائه خواهد کرد.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا امکان سفارش پروژه اختصاصی وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، ما پروژه‌های تحقیقاتی و مشاوره‌ای را به صورت <strong>کاملاً سفارشی</strong> و
                                    متناسب با
                                    نیازهای خاص سازمان شما طراحی و اجرا می‌کنیم.
                                </p>
                                <p>
                                    برای سفارش پروژه اختصاصی، کافی است فرم <a href="/investment">درخواست سرمایه</a> را
                                    تکمیل کنید
                                    یا با تیم فروش ما تماس بگیرید.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چگونه می‌توانم از کیفیت خدمات شما مطمئن شوم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>کیفیت خدمات ما از طریق موارد زیر تضمین می‌شود:</p>
                                <ul>
                                    <li>تیم متخصص با سابقه کاری معتبر در حوزه‌های مختلف</li>
                                    <li>استفاده از روش‌های علمی و استانداردهای بین‌المللی</li>
                                    <li>نظارت مستمر بر فرآیند اجرای پروژه</li>
                                    <li>ارائه گزارش‌های دوره‌ای به کارفرما</li>
                                    <li>پشتیبانی پس از تحویل پروژه</li>
                                </ul>
                                <p>
                                    همچنین می‌توانید <strong>نمونه کارها و مطالعات موردی</strong> ما را در وب‌سایت
                                    مشاهده کنید.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Investment Category -->
                <div class="faq-category-section" data-category="investment">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-hand-holding-usd"></i>
                            سرمایه‌گذاری
                        </h2>
                        <p>سوالات مربوط به درخواست سرمایه و تامین مالی پروژه‌ها</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                <span class="popular-badge">
                                    <i class="fas fa-fire"></i>
                                    پرتکرار
                                </span>
                                چگونه می‌توانم درخواست سرمایه بدهم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>برای درخواست سرمایه، مراحل زیر را طی کنید:</p>
                                <ol>
                                    <li>به صفحه <a href="/investment">درخواست سرمایه</a> مراجعه کنید</li>
                                    <li>فرم درخواست را با دقت تکمیل کنید</li>
                                    <li>مدارک و اسناد مورد نیاز را پیوست کنید</li>
                                    <li>درخواست خود را ارسال کنید</li>
                                    <li>منتظر بررسی و تماس تیم ما باشید (حداکثر ۷ روز کاری)</li>
                                </ol>
                                <p>
                                    تیم ارزیابی ما درخواست شما را بررسی کرده و در صورت تایید، جلسه حضوری برای بررسی
                                    جزئیات
                                    برگزار خواهد شد.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چه نوع پروژه‌هایی واجد شرایط دریافت سرمایه هستند؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>پروژه‌های واجد شرایط باید دارای ویژگی‌های زیر باشند:</p>
                                <ul>
                                    <li>نوآورانه و دارای پتانسیل رشد بالا باشند</li>
                                    <li>در حوزه‌های استراتژیک و اولویت‌دار فعالیت کنند</li>
                                    <li>تیم مجرب و متعهد داشته باشند</li>
                                    <li>مدل کسب‌وکار شفاف و قابل اجرا داشته باشند</li>
                                    <li>برنامه مالی و زمان‌بندی مشخص ارائه دهند</li>
                                </ul>
                                <p>
                                    پروژه‌های حوزه‌های <strong>فناوری، سلامت، انرژی، کشاورزی و صنایع خلاق</strong> در
                                    اولویت قرار دارند.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                مرکز چه نوع سرمایه‌گذاری‌هایی انجام می‌دهد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>انواع سرمایه‌گذاری‌های ما شامل:</p>
                                <ul>
                                    <li><strong>سرمایه‌گذاری مستقیم:</strong> تامین مالی پروژه‌های تحقیقاتی و نوآورانه
                                    </li>
                                    <li><strong>سرمایه‌گذاری مشترک:</strong> مشارکت با سایر سرمایه‌گذاران</li>
                                    <li><strong>تامین مالی جمعی:</strong> حمایت از استارتاپ‌ها و کسب‌وکارهای نوپا</li>
                                    <li><strong>وام‌های کم‌بهره:</strong> تسهیلات مالی برای پروژه‌های خاص</li>
                                </ul>
                                <p>
                                    میزان سرمایه‌گذاری بسته به نوع و مقیاس پروژه از <strong>۱۰۰ میلیون تا ۵ میلیارد
                                        تومان</strong> متغیر است.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                فرآیند بررسی درخواست سرمایه چقدر طول می‌کشد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>فرآیند بررسی درخواست سرمایه شامل مراحل زیر است:</p>
                                <ol>
                                    <li><strong>بررسی اولیه:</strong> ۳ تا ۷ روز کاری</li>
                                    <li><strong>ارزیابی تخصصی:</strong> ۲ تا ۴ هفته</li>
                                    <li><strong>مذاکره و تنظیم قرارداد:</strong> ۱ تا ۲ هفته</li>
                                    <li><strong>تصویب نهایی:</strong> ۱ هفته</li>
                                </ol>
                                <p>
                                    در مجموع، فرآیند کامل معمولاً <strong>۶ تا ۸ هفته</strong> زمان می‌برد. در طول این
                                    مدت،
                                    به‌طور مستمر از وضعیت درخواست خود مطلع خواهید شد.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Research Category -->
                <div class="faq-category-section" data-category="research">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-flask"></i>
                            پژوهش
                        </h2>
                        <p>سوالات مربوط به پروژه‌های تحقیقاتی و پژوهشی</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چگونه می‌توانم در پروژه‌های تحقیقاتی شرکت کنم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>برای شرکت در پروژه‌های تحقیقاتی مرکز، می‌توانید:</p>
                                <ul>
                                    <li>رزومه علمی خود را به ایمیل <strong>research@mstid.com</strong> ارسال کنید</li>
                                    <li>در فراخوان‌های پژوهشی که در وب‌سایت منتشر می‌شود، شرکت کنید</li>
                                    <li>پیشنهاد پروژه تحقیقاتی خود را ارسال کنید</li>
                                    <li>به عنوان پژوهشگر مهمان با ما همکاری کنید</li>
                                </ul>
                                <p>
                                    ما به دنبال پژوهشگران با <strong>مدرک کارشناسی ارشد یا دکترا</strong> در رشته‌های
                                    مرتبط هستیم.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا نتایج تحقیقات منتشر می‌شود؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، بخشی از نتایج تحقیقات ما به صورت <strong>مقالات علمی، گزارش‌های عمومی و
                                        کتاب</strong>
                                    منتشر می‌شود. البته برخی پروژه‌ها به دلیل محرمانه بودن، فقط برای کارفرما ارائه
                                    می‌شوند.
                                </p>
                                <p>
                                    شما می‌توانید آخرین مقالات و گزارش‌های ما را در بخش <a href="/news">اخبار و
                                        مقالات</a> مشاهده کنید.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا امکان همکاری با دانشگاه‌ها وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، مرکز تحقیقات استراتژیک مستید با بسیاری از دانشگاه‌های معتبر داخلی و خارجی
                                    <strong>تفاهم‌نامه همکاری</strong> دارد.
                                </p>
                                <p>انواع همکاری با دانشگاه‌ها شامل:</p>
                                <ul>
                                    <li>اجرای پروژه‌های تحقیقاتی مشترک</li>
                                    <li>برگزاری کارگاه‌ها و سمینارهای علمی</li>
                                    <li>راهنمایی پایان‌نامه‌های دانشجویی</li>
                                    <li>تبادل پژوهشگر و دانشجو</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چگونه می‌توانم به منابع علمی مرکز دسترسی پیدا کنم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    مرکز دارای <strong>کتابخانه دیجیتال</strong> با دسترسی به هزاران مقاله، کتاب و گزارش
                                    تحقیقاتی است.
                                </p>
                                <p>برای دسترسی به منابع علمی:</p>
                                <ul>
                                    <li>اعضای تیم تحقیقاتی: دسترسی کامل و رایگان</li>
                                    <li>دانشجویان و پژوهشگران: ثبت‌نام و دریافت اشتراک</li>
                                    <li>عموم: دسترسی به بخش عمومی کتابخانه</li>
                                </ul>
                                <p>
                                    برای اطلاعات بیشتر با بخش کتابخانه به شماره <strong>۰۲۱-۸۸۷۷۶۶۵۵</strong> تماس
                                    بگیرید.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cooperation Category -->
                <div class="faq-category-section" data-category="cooperation">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-handshake"></i>
                            همکاری
                        </h2>
                        <p>سوالات مربوط به فرصت‌های شغلی و همکاری</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                چگونه می‌توانم در مرکز استخدام شوم؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>برای استخدام در مرکز تحقیقات استراتژیک مستید:</p>
                                <ol>
                                    <li>آگهی‌های استخدام را در بخش <strong>فرصت‌های شغلی</strong> وب‌سایت دنبال کنید
                                    </li>
                                    <li>رزومه خود را به ایمیل <strong>hr@mstid.com</strong> ارسال کنید</li>
                                    <li>در صورت تطابق، برای مصاحبه دعوت خواهید شد</li>
                                    <li>پس از تایید نهایی، قرارداد همکاری منعقد می‌شود</li>
                                </ol>
                                <p>
                                    ما به دنبال افراد <strong>متخصص، خلاق و متعهد</strong> در حوزه‌های مختلف هستیم.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا امکان همکاری پاره‌وقت وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، مرکز برای برخی پروژه‌ها از <strong>همکاران پاره‌وقت و پروژه‌ای</strong> نیز
                                    استفاده می‌کند.
                                </p>
                                <p>انواع همکاری پاره‌وقت:</p>
                                <ul>
                                    <li>پژوهشگر پروژه‌ای</li>
                                    <li>مشاور تخصصی</li>
                                    <li>مترجم و ویراستار</li>
                                    <li>تحلیلگر داده</li>
                                </ul>
                                <p>
                                    برای همکاری پاره‌وقت، رزومه و زمینه تخصصی خود را برای ما ارسال کنید.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا برای دانشجویان فرصت کارآموزی وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، مرکز هر ساله تعداد محدودی <strong>دانشجوی کارآموز</strong> در رشته‌های مرتبط
                                    می‌پذیرد.
                                </p>
                                <p>شرایط پذیرش کارآموز:</p>
                                <ul>
                                    <li>دانشجوی مقطع کارشناسی ارشد یا دکترا</li>
                                    <li>معدل حداقل ۱۶</li>
                                    <li>علاقه‌مند به تحقیق و پژوهش</li>
                                    <li>مسلط به زبان انگلیسی</li>
                                </ul>
                                <p>
                                    برای ثبت‌نام در دوره کارآموزی، فرم درخواست را از وب‌سایت دانلود و تکمیل کنید.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                مزایای کار در مرکز چیست؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>مزایای کار در مرکز تحقیقات استراتژیک مستید:</p>
                                <ul>
                                    <li><strong>حقوق و مزایای رقابتی</strong> متناسب با تجربه و تخصص</li>
                                    <li>بیمه تکمیلی برای کارکنان و خانواده</li>
                                    <li>فرصت رشد و ارتقای شغلی</li>
                                    <li>محیط کاری حرفه‌ای و دوستانه</li>
                                    <li>دسترسی به منابع علمی و آموزشی</li>
                                    <li>شرکت در کنفرانس‌ها و سمینارهای بین‌المللی</li>
                                    <li>امکان دورکاری (برای برخی پست‌ها)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Category -->
                <div class="faq-category-section" data-category="payment">
                    <div class="category-header">
                        <h2>
                            <i class="fas fa-credit-card"></i>
                            پرداخت
                        </h2>
                        <p>سوالات مربوط به هزینه‌ها و روش‌های پرداخت</p>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                هزینه خدمات مشاوره‌ای چگونه محاسبه می‌شود؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>هزینه خدمات مشاوره‌ای بر اساس عوامل زیر محاسبه می‌شود:</p>
                                <ul>
                                    <li><strong>پیچیدگی پروژه:</strong> حجم کار و تخصص مورد نیاز</li>
                                    <li><strong>مدت زمان:</strong> تعداد ساعات یا روزهای مشاوره</li>
                                    <li><strong>تیم اجرایی:</strong> تعداد و تخصص اعضای تیم</li>
                                    <li><strong>منابع مورد نیاز:</strong> ابزارها و داده‌های مورد استفاده</li>
                                </ul>
                                <p>
                                    پس از دریافت درخواست شما، یک <strong>پیش‌فاکتور رایگان</strong> با جزئیات هزینه‌ها
                                    ارائه خواهد شد.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                روش‌های پرداخت چیست؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>روش‌های پرداخت موجود:</p>
                                <ul>
                                    <li><strong>واریز بانکی:</strong> به حساب مرکز</li>
                                    <li><strong>پرداخت آنلاین:</strong> از طریق درگاه پرداخت وب‌سایت</li>
                                    <li><strong>چک:</strong> برای مبالغ بالا</li>
                                    <li><strong>اقساطی:</strong> برای پروژه‌های بلندمدت</li>
                                </ul>
                                <p>
                                    پس از پرداخت، <strong>فاکتور رسمی</strong> برای شما صادر و ارسال می‌شود.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا امکان پرداخت اقساطی وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، برای پروژه‌های بلندمدت و با هزینه بالا، امکان <strong>پرداخت اقساطی</strong>
                                    وجود دارد.
                                </p>
                                <p>شرایط پرداخت اقساطی:</p>
                                <ul>
                                    <li>پیش‌پرداخت حداقل ۳۰٪ هزینه کل</li>
                                    <li>تقسیط مابقی به ۳ تا ۶ قسط</li>
                                    <li>ارائه ضمانت (چک یا سفته)</li>
                                </ul>
                                <p>
                                    جزئیات پرداخت اقساطی در قرارداد مشخص خواهد شد.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <div class="faq-question-text">
                                آیا تخفیف برای پروژه‌های متعدد وجود دارد؟
                            </div>
                            <div class="faq-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-content">
                                <p>
                                    بله، برای مشتریان دائمی و سازمان‌هایی که چندین پروژه را به ما می‌سپارند،
                                    <strong>تخفیف‌های ویژه</strong> در نظر گرفته می‌شود.
                                </p>
                                <p>انواع تخفیف:</p>
                                <ul>
                                    <li><strong>تخفیف حجمی:</strong> برای پروژه‌های بزرگ</li>
                                    <li><strong>تخفیف وفاداری:</strong> برای مشتریان دائمی</li>
                                    <li><strong>تخفیف فصلی:</strong> در مناسبت‌های خاص</li>
                                    <li><strong>تخفیف دانشجویی:</strong> برای پایان‌نامه‌ها</li>
                                </ul>
                                <p>
                                    برای اطلاع از تخفیف‌های جاری، با بخش فروش تماس بگیرید.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="faq-stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-number">۲۵۰+</div>
                    <div class="stat-label">پروژه تکمیل شده</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number">۱۵۰+</div>
                    <div class="stat-label">مقاله منتشر شده</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">۵۰+</div>
                    <div class="stat-label">همکار متخصص</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="faq-cta">
        <div class="container">
            <div class="cta-content">
                <h2>پاسخ سوال خود را پیدا نکردید؟</h2>
                <p>
                    تیم ما آماده است تا به سوالات شما پاسخ دهد. از طریق فرم تماس یا شماره تلفن با ما در ارتباط باشید.
                </p>
                <div class="cta-buttons">
                    <a href="/investment" class="cta-btn cta-btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        <span>ارسال درخواست سرمایه</span>
                    </a>
                    <a href="/contact" class="cta-btn cta-btn-secondary">
                        <i class="fas fa-phone-alt"></i>
                        <span>تماس با ما</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Box -->
    <section class="help-box">
        <div class="container">
            <div class="help-box-content">
                <div class="help-box-icon">
                    <i class="fas fa-life-ring"></i>
                </div>
                <div class="help-box-text">
                    <h3>نیاز به راهنمایی بیشتر دارید؟</h3>
                    <p>
                        برای دریافت اطلاعات تکمیلی، مشاهده راهنماها یا تماس مستقیم با تیم پشتیبانی، از لینک‌های زیر
                        استفاده کنید.
                    </p>
                    <div class="help-box-links">
                        <a href="/contact" class="help-link">
                            <i class="fas fa-envelope"></i>
                            ارتباط با پشتیبانی
                        </a>
                        <a href="/guides" class="help-link">
                            <i class="fas fa-book"></i>
                            مشاهده راهنماها
                        </a>
                        <a href="/about" class="help-link">
                            <i class="fas fa-info-circle"></i>
                            درباره ما
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

