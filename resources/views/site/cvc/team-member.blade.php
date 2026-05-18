@extends('site.layouts.base2')

@section('title', ($member->fullname ?? 'پروفایل عضو تیم') . ' - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 4rem 0 2rem;
            color: white;
        }

        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 3rem;
            align-items: start;
        }

        .profile-image-wrapper {
            position: relative;
            z-index: 10;
        }

        .profile-image {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
            border: 4px solid rgba(255,255,255,0.3);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }

        .profile-social {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            justify-content: center;
        }

        .profile-social a {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .profile-social a:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }

        .profile-header-info h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .profile-role {
            font-size: 1.3rem;
            opacity: 0.95;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .profile-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.15);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .meta-item i {
            font-size: 1.2rem;
        }

        .profile-content {
            background: white;
            margin-top: -3rem;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1rem;
        }

        .content-section {
            margin-bottom: 3rem;
        }

        /*.section-title {*/
        /*    font-size: 1.75rem;*/
        /*    color: #2c3e50;*/
        /*    margin-bottom: 1.5rem;*/
        /*    padding-bottom: 0.75rem;*/
        /*    border-bottom: 3px solid #667eea;*/
        /*    display: inline-block;*/
        /*}*/

        .bio-text {
            color: #555;
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
        }

        .expertise-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .expertise-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .expertise-card:hover {
            background: #e9ecef;
            transform: translateX(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .expertise-card h4 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .expertise-card p {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .education-timeline {
            position: relative;
            padding-right: 2rem;
            margin-top: 1.5rem;
        }

        .education-timeline::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, #667eea, #764ba2);
        }

        .education-item {
            position: relative;
            margin-bottom: 2rem;
            padding-right: 2.5rem;
        }

        .education-item::before {
            content: '';
            position: absolute;
            right: -0.5rem;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            background: #667eea;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #667eea;
        }

        .education-degree {
            font-size: 1.15rem;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .education-school {
            color: #667eea;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .education-year {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .publications-list {
            margin-top: 1.5rem;
        }

        .publication-item {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .publication-item:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            border-color: #667eea;
        }

        .publication-title {
            font-size: 1.15rem;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .publication-meta {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
        }

        .publication-abstract {
            color: #555;
            line-height: 1.6;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .publication-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .publication-link:hover {
            color: #5568d3;
            gap: 0.75rem;
        }

        .awards-grid {
            display: grid;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .award-card {
            background: linear-gradient(135deg, #fff5e6 0%, #ffe6f0 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border-right: 4px solid #ffd700;
            display: flex;
            gap: 1.5rem;
            align-items: start;
        }

        .award-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            flex-shrink: 0;
        }

        .award-content h4 {
            color: #2c3e50;
            font-size: 1.15rem;
            margin-bottom: 0.5rem;
        }

        .award-content p {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .award-year {
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .project-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .project-card:hover {
            border-color: #667eea;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
            transform: translateY(-5px);
        }

        .project-status {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .project-card h4 {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
        }

        .project-card p {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .project-duration {
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .skills-container {
            margin-top: 1.5rem;
        }

        .skill-category {
            margin-bottom: 2rem;
        }

        .skill-category h4 {
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .skill-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .contact-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            margin-top: 1.5rem;
        }

        .contact-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .contact-card p {
            opacity: 0.95;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255,255,255,0.15);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            backdrop-filter: blur(10px);
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(255,255,255,0.25);
            transform: translateX(-5px);
        }

        .back-to-team {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-to-team:hover {
            gap: 0.75rem;
            color: #5568d3;
        }

        @media (max-width: 992px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .profile-image-wrapper {
                max-width: 300px;
                margin: 0 auto;
            }

            .profile-header-info {
                text-align: center;
            }

            .profile-meta {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .profile-header h1 {
                font-size: 2rem;
            }

            .profile-role {
                font-size: 1.1rem;
            }

            .expertise-grid,
            .projects-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">خانه</a></li>
                <li><a href="/about">درباره ما</a></li>
                <li><a href="{{ route('cvc.team') }}">تیم ما</a></li>
                <li class="active">{{ $member->fullname }}</li>
            </ol>
        </div>
    </nav>

    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container">
            <div class="profile-container">
                <div class="profile-image-wrapper">
                    <div class="profile-image" @if(!empty($member->image)) style="background-image:url('{{ asset('storage/' . ltrim($member->image, '/')) }}');background-size:cover;background-position:center;" @endif></div>
                    <div class="profile-social">
                        @if(!empty($member->instagram))
                            <a href="{{ str_contains($member->instagram, '@') ? 'mailto:' . $member->instagram : $member->instagram }}" aria-label="Social"><i class="fas fa-link"></i></a>
                        @endif
                        @if(!empty($member->phone))
                            <a href="tel:{{ $member->phone }}" aria-label="Phone"><i class="fas fa-phone"></i></a>
                        @endif
                    </div>
                </div>

                <div class="profile-header-info">
                    <h1>{{ $member->fullname }}</h1>
                    <p class="profile-role">{{ $member->side }}</p>

                    <div class="profile-meta">
                        <div class="meta-item">
                            <i class="fas fa-briefcase"></i>
                            <span>۲۰+ سال تجربه</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>تهران، ایران</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>دکترای اقتصاد</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="profile-content">
        <div class="content-wrapper">
            <a href="{{ route('cvc.team') }}" class="back-to-team">
                <i class="fas fa-arrow-right"></i>
                بازگشت به صفحه تیم
            </a>

            <!-- Biography -->
            <div class="content-section">
                <h2 class="section-title">درباره من</h2>
                @if(!empty($member->description))
                    <p class="bio-text">{!! nl2br(e($member->description)) !!}</p>
                @else
                    <p class="bio-text">برای این عضو هنوز توضیحی ثبت نشده است.</p>
                @endif
            </div>

                @if(false)
                <p class="bio-text">
                    در طول سال‌های فعالیت حرفه‌ای، دکتر رضایی در پروژه‌های متعدد ملی و بین‌المللی مشارکت داشته و به عنوان مشاور ارشد سازمان‌های دولتی و خصوصی فعالیت کرده است. تمرکز اصلی ایشان بر توسعه پایدار، نوآوری در سیاست‌گذاری عمومی و ارتقای کیفیت تحقیقات علمی است.
                </p>
                <p class="bio-text">
                    به عنوان مدیر عامل مرکز تحقیقات استراتژیک مستید، دکتر رضایی با رویکردی نوآورانه و علمی، تیمی از متخصصان برجسته را در راستای تولید دانش کاربردی و ارائه راهکارهای استراتژیک به سازمان‌ها و نهادهای مختلف رهبری می‌کند.
                </p>

            <!-- Expertise Areas -->
            <div class="content-section">
                <h2 class="section-title">حوزه‌های تخصصی</h2>
                <div class="expertise-grid">
                    <div class="expertise-card">
                        <h4><i class="fas fa-chart-line"></i> اقتصاد کلان</h4>
                        <p>تحلیل سیاست‌های پولی و مالی، پیش‌بینی اقتصادی و مدل‌سازی اقتصادسنجی</p>
                    </div>
                    <div class="expertise-card">
                        <h4><i class="fas fa-chess"></i> برنامه‌ریزی استراتژیک</h4>
                        <p>طراحی و اجرای برنامه‌های استراتژیک سازمانی و ملی</p>
                    </div>
                    <div class="expertise-card">
                        <h4><i class="fas fa-lightbulb"></i> نوآوری و توسعه</h4>
                        <p>مدیریت نوآوری، توسعه فناوری و اکوسیستم کارآفرینی</p>
                    </div>
                    <div class="expertise-card">
                        <h4><i class="fas fa-balance-scale"></i> سیاست‌گذاری عمومی</h4>
                        <p>تحلیل و ارزیابی سیاست‌های عمومی و اصلاحات ساختاری</p>
                    </div>
                    <div class="expertise-card">
                        <h4><i class="fas fa-globe"></i> اقتصاد بین‌الملل</h4>
                        <p>تجارت بین‌الملل، سرمایه‌گذاری خارجی و همکاری‌های منطقه‌ای</p>
                    </div>
                    <div class="expertise-card">
                        <h4><i class="fas fa-users"></i> مشاوره سازمانی</h4>
                        <p>بهبود فرآیندها، تحول سازمانی و مدیریت تغییر</p>
                    </div>
                </div>
            </div>

            <!-- Education -->
            <div class="content-section">
                <h2 class="section-title">تحصیلات</h2>
                <div class="education-timeline">
                    <div class="education-item">
                        <div class="education-degree">دکترای اقتصاد</div>
                        <div class="education-school">دانشگاه تهران</div>
                        <div class="education-year">۱۳۸۵ - ۱۳۸۹</div>
                    </div>
                    <div class="education-item">
                        <div class="education-degree">کارشناسی ارشد اقتصاد</div>
                        <div class="education-school">دانشگاه شریف</div>
                        <div class="education-year">۱۳۸۲ - ۱۳۸۵</div>
                    </div>
                    <div class="education-item">
                        <div class="education-degree">کارشناسی مدیریت</div>
                        <div class="education-school">دانشگاه علامه طباطبایی</div>
                        <div class="education-year">۱۳۷۸ - ۱۳۸۲</div>
                    </div>
                </div>
            </div>

            <!-- Publications -->
            <div class="content-section">
                <h2 class="section-title">انتشارات و مقالات</h2>
                <div class="publications-list">
                    <div class="publication-item">
                        <div class="publication-title">
                            تحلیل تأثیر سیاست‌های پولی بر رشد اقتصادی در کشورهای در حال توسعه
                        </div>
                        <div class="publication-meta">
                            <i class="fas fa-book"></i> فصلنامه تحقیقات اقتصادی | بهار ۱۴۰۲
                        </div>
                        <p class="publication-abstract">
                            این مقاله به بررسی تأثیر ابزارهای سیاست پولی بر شاخص‌های رشد اقتصادی در ۳۰ کشور در حال توسعه طی دوره ۲۰۰۰-۲۰۲۰ می‌پردازد. نتایج نشان می‌دهد که...
                        </p>
                        <a href="#" class="publication-link">
                            مشاهده مقاله کامل
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <div class="publication-item">
                        <div class="publication-title">
                            نقش نوآوری در توسعه پایدار: مطالعه موردی ایران
                        </div>
                        <div class="publication-meta">
                            <i class="fas fa-book"></i> مجله مطالعات توسعه | پاییز ۱۴۰۱
                        </div>
                        <p class="publication-abstract">
                            پژوهش حاضر با رویکردی کیفی و کمی به تحلیل نقش نوآوری فناورانه در دستیابی به اهداف توسعه پایدار در ایران پرداخته است...
                        </p>
                        <a href="#" class="publication-link">
                            مشاهده مقاله کامل
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>

                    <div class="publication-item">
                        <div class="publication-title">
                            چالش‌های سیاست‌گذاری اقتصادی در دوران بحران
                        </div>
                        <div class="publication-meta">
                            <i class="fas fa-book"></i> نشریه سیاست‌گذاری عمومی | زمستان ۱۴۰۰
                        </div>
                        <p class="publication-abstract">
                            این مطالعه به شناسایی و تحلیل چالش‌های پیش روی سیاست‌گذاران اقتصادی در شرایط بحران‌های داخلی و خارجی می‌پردازد و راهکارهایی عملیاتی ارائه می‌دهد...
                        </p>
                        <a href="#" class="publication-link">
                            مشاهده مقاله کامل
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Awards & Honors -->
            <div class="content-section">
                <h2 class="section-title">جوایز و افتخارات</h2>
                <div class="awards-grid">
                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="award-content">
                            <h4>پژوهشگر برتر سال</h4>
                            <p>دریافت عنوان پژوهشگر برتر از سوی وزارت علوم، تحقیقات و فناوری</p>
                            <span class="award-year">۱۴۰۱</span>
                        </div>
                    </div>

                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="award-content">
                            <h4>جایزه ملی نوآوری</h4>
                            <p>دریافت جایزه ملی نوآوری برای طرح توسعه اکوسیستم کارآفرینی</p>
                            <span class="award-year">۱۳۹۹</span>
                        </div>
                    </div>

                    <div class="award-card">
                        <div class="award-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="award-content">
                            <h4>مقاله برگزیده بین‌المللی</h4>
                            <p>انتخاب مقاله به عنوان برترین مقاله در کنفرانس بین‌المللی اقتصاد توسعه</p>
                            <span class="award-year">۱۳۹۸</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Projects -->
            <div class="content-section">
                <h2 class="section-title">پروژه‌های جاری</h2>
                <div class="projects-grid">
                    <div class="project-card">
                        <span class="project-status status-active">در حال اجرا</span>
                        <h4>طراحی نقشه راه توسعه اقتصاد دیجیتال</h4>
                        <p>مطالعه جامع و ارائه راهکارهای عملیاتی برای توسعه اقتصاد دیجیتال در ایران</p>
                        <div class="project-duration">
                            <i class="far fa-calendar"></i>
                            ۱۴۰۳ - ۱۴۰۵
                        </div>
                    </div>

                    <div class="project-card">
                        <span class="project-status status-active">در حال اجرا</span>
                        <h4>ارزیابی تأثیر سیاست‌های حمایتی بر نوآوری</h4>
                        <p>تحلیل اثربخشی سیاست‌های حمایتی دولت در توسعه نوآوری و فناوری</p>
                        <div class="project-duration">
                            <i class="far fa-calendar"></i>
                            ۱۴۰۲ - ۱۴۰۴
                        </div>
                    </div>

                    <div class="project-card">
                        <span class="project-status status-completed">پایان یافته</span>
                        <h4>مدل‌سازی سناریوهای توسعه پایدار</h4>
                        <p>طراحی مدل‌های سناریونویسی برای دستیابی به اهداف توسعه پایدار در ایران</p>
                        <div class="project-duration">
                            <i class="far fa-calendar"></i>
                            ۱۴۰۰ - ۱۴۰۲
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="content-section">
                <h2 class="section-title">مهارت‌ها</h2>
                <div class="skills-container">
                    <div class="skill-category">
                        <h4>مهارت‌های تخصصی</h4>
                        <div class="skills-list">
                            <span class="skill-tag">تحلیل داده‌های اقتصادی</span>
                            <span class="skill-tag">مدل‌سازی اقتصادسنجی</span>
                            <span class="skill-tag">تحلیل سیاست‌گذاری</span>
                            <span class="skill-tag">تحقیقات پیمایشی</span>
                            <span class="skill-tag">ارزیابی اثرات اقتصادی</span>
                        </div>
                    </div>

                    <div class="skill-category">
                        <h4>مهارت‌های مدیریتی</h4>
                        <div class="skills-list">
                            <span class="skill-tag">رهبری تیم‌های پژوهشی</span>
                            <span class="skill-tag">مدیریت پروژه</span>
                            <span class="skill-tag">برنامه‌ریزی استراتژیک</span>
                            <span class="skill-tag">مذاکره و تعامل بین‌سازمانی</span>
                        </div>
                    </div>

                    <div class="skill-category">
                        <h4>مهارت‌های ارتباطی</h4>
                        <div class="skills-list">
                            <span class="skill-tag">سخنرانی علمی</span>
                            <span class="skill-tag">نگارش مقاله علمی</span>
                            <span class="skill-tag">تدوین گزارش سیاستی</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contact -->
            <div class="content-section">
                <h2 class="section-title">ارتباط با من</h2>
                <div class="contact-card">
                    <h3>راه‌های ارتباط با {{ $member->fullname }}</h3>
                    <p>
                        اطلاعات تماس این عضو از طریق پنل مدیریت تیم قابل ویرایش است.
                    </p>
                    <div class="contact-info">
                        @if(!empty($member->instagram))
                            <a href="{{ str_contains($member->instagram, '@') ? 'mailto:' . $member->instagram : $member->instagram }}" class="contact-item">
                                <i class="fas fa-link"></i>
                                <span>{{ $member->instagram }}</span>
                            </a>
                        @endif
                        @if(!empty($member->phone))
                            <a href="tel:{{ $member->phone }}" class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $member->phone }}</span>
                            </a>
                        @endif
                        @if(empty($member->instagram) && empty($member->phone))
                            <span class="contact-item">اطلاعات تماس ثبت نشده است.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
