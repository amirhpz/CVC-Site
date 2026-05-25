@extends('site.layouts.base2')

@section('title', 'تماس با ما - توسعه دانش بنیان سینا')

@section('styles')
    <style>
        .contact-hero {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            padding: 5rem 0 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .contact-hero-content {
            position: relative;
            z-index: 1;
        }

        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }

        .contact-main {
            padding: 4rem 0;
            background: var(--cvc-bg);
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-info-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-card {
            background: var(--cvc-surface);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-card-header h3 {
            color: var(--cvc-text);
            font-size: 1.3rem;
            margin: 0;
        }

        .info-card-content {
            color: var(--cvc-muted);
            line-height: 1.8;
        }

        .info-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: #f8f9fa;
        }

        .info-item i {
            color: var(--cvc-primary-hover);
            font-size: 1.2rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .info-item-content {
            flex: 1;
        }

        .info-item-label {
            font-weight: 600;
            color: var(--cvc-text);
            margin-bottom: 0.25rem;
        }

        .info-item-value {
            color: var(--cvc-muted);
        }

        .info-item-value a {
            color: var(--cvc-primary-hover);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .info-item-value a:hover {
            color: #5568d3;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .social-link:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .contact-form-section {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-header h2 {
            color: #2c3e50;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #6c757d;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-group label .required {
            color: #dc3545;
            margin-right: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--cvc-primary);
            box-shadow: 0 0 0 4px rgba(87, 199, 182, 0.12);
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 500px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .map-section {
            margin-top: 4rem;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .map-header {
            padding: 2rem;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            color: white;
            text-align: center;
        }

        .map-header h2 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .map-header p {
            opacity: 0.95;
        }

        .map-container {
            width: 100%;
            height: 450px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--cvc-primary-hover);
            font-size: 3rem;
        }

        .quick-contact {
            background: white;
            padding: 3rem 0;
        }

        .quick-contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .quick-contact-card {
            background: linear-gradient(135deg, var(--cvc-bg) 0%, #eef5f3 100%);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .quick-contact-card:hover {
            border-color: var(--cvc-primary);
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .quick-contact-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            margin: 0 auto 1.5rem;
        }

        .quick-contact-card h3 {
            color: #2c3e50;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .quick-contact-card p {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .quick-contact-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--cvc-primary-hover);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .quick-contact-link:hover {
            gap: 0.75rem;
            color: #5568d3;
        }

        .working-hours {
            background: linear-gradient(135deg, var(--cvc-primary) 0%, var(--cvc-primary-hover) 100%);
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .working-hours-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .working-hours h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .hours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .hours-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 12px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .hours-card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .hours-card p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin: 0.5rem 0;
        }

        .hours-card .closed {
            opacity: 0.7;
            font-style: italic;
        }

        @media (max-width: 992px) {
            .contact-container {
                grid-template-columns: 1fr;
            }

            .contact-hero h1 {
                font-size: 2.25rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .contact-hero {
                padding: 3rem 0 2rem;
            }

            .contact-hero h1 {
                font-size: 1.875rem;
            }

            .contact-hero p {
                font-size: 1rem;
            }

            .contact-main {
                padding: 2rem 0;
            }

            .contact-form-section {
                padding: 1.5rem;
            }

            .map-container {
                height: 300px;
            }

            .hours-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    @include('site.cvc.partials.dynamic-page-content')
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">خانه</a></li>
                <li class="active">تماس با ما</li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <div class="container">
                <h1>تماس با ما</h1>
                <p>
                    ما آماده‌ایم تا به سوالات شما پاسخ دهیم و در مسیر همکاری‌های پژوهشی و مشاوره‌ای در کنار شما باشیم.
                    از طریق فرم زیر یا راه‌های ارتباطی با ما در تماس باشید.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="contact-main">
        <div class="container">
            <div class="contact-container">
                <!-- Contact Information -->
                <div class="contact-info-section">
                    <!-- Address Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3>آدرس دفتر مرکزی</h3>
                        </div>
                        <div class="info-card-content">
                            <div class="info-item">
                                <i class="fas fa-building"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">آدرس</div>
                                    <div class="info-item-value">
                                        تهران، خیابان ولیعصر، بالاتر از میدان ونک، پلاک ۱۲۳۴، طبقه ۵
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-mail-bulk"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">کد پستی</div>
                                    <div class="info-item-value">۱۹۱۷۹۵۳۴۱۴</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h3>اطلاعات تماس</h3>
                        </div>
                        <div class="info-card-content">
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">تلفن دفتر مرکزی</div>
                                    <div class="info-item-value">
                                        <a href="tel:+982188776655">۰۲۱-۸۸۷۷۶۶۵۵</a>
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-fax"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">فکس</div>
                                    <div class="info-item-value">۰۲۱-۸۸۷۷۶۶۵۶</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">ایمیل</div>
                                    <div class="info-item-value">
                                        <a href="mailto:info@mstid.com">info@mstid.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-headset"></i>
                                <div class="info-item-content">
                                    <div class="info-item-label">پشتیبانی</div>
                                    <div class="info-item-value">
                                        <a href="mailto:support@mstid.com">support@mstid.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-icon">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h3>شبکه‌های اجتماعی</h3>
                        </div>
                        <div class="info-card-content">
                            <p style="margin-bottom: 1rem; color: #6c757d;">
                                ما را در شبکه‌های اجتماعی دنبال کنید و از آخرین اخبار و رویدادها مطلع شوید.
                            </p>
                            <div class="social-links">
                                <a href="#" class="social-link" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="Telegram">
                                    <i class="fab fa-telegram-plane"></i>
                                </a>
                                <a href="#" class="social-link" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-section">
                    <div class="form-header">
                        <h2>فرم تماس با ما</h2>
                        <p>
                            لطفاً فرم زیر را با دقت تکمیل کنید. کارشناسان ما در اسرع وقت با شما تماس خواهند گرفت.
                        </p>
                    </div>

                    @if(session('contact_success'))
                        <div class="alert alert-success" style="margin-bottom: 24px; padding: 14px 16px; background:#e8f5e9; border:1px solid #a5d6a7; border-radius:10px; color:#1b5e20;">
                            پیام شما با موفقیت ارسال شد.
                        </div>
                    @endif

                    <form action="{{ route('cvc.contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">
                                    <span class="required">*</span>
                                    نام
                                </label>
                                <input
                                    type="text"
                                    id="firstName"
                                    name="first_name"
                                    class="form-control"
                                    placeholder="نام خود را وارد کنید"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="lastName">
                                    <span class="required">*</span>
                                    نام خانوادگی
                                </label>
                                <input
                                    type="text"
                                    id="lastName"
                                    name="last_name"
                                    class="form-control"
                                    placeholder="نام خانوادگی خود را وارد کنید"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">
                                    <span class="required">*</span>
                                    ایمیل
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="example@email.com"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="phone">
                                    <span class="required">*</span>
                                    شماره تماس
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    placeholder="۰۹۱۲۳۴۵۶۷۸۹"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">
                                <span class="required">*</span>
                                موضوع
                            </label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="form-control"
                                placeholder="موضوع پیام خود را وارد کنید"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="message">
                                <span class="required">*</span>
                                پیام شما
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                class="form-control"
                                placeholder="پیام خود را اینجا بنویسید..."
                                required
                            ></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <span>ارسال پیام</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact -->
    <section class="quick-contact">
        <div class="container">
            <div class="quick-contact-grid">
                <div class="quick-contact-card">
                    <div class="quick-contact-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>همکاری‌های پژوهشی</h3>
                    <p>
                        برای تعریف پروژه‌های مشترک، طرح‌های پژوهشی و قراردادهای مشاوره‌ای با ما در ارتباط باشید.
                    </p>
                    <a href="mailto:research@mstid.com" class="quick-contact-link">
                        <span>research@mstid.com</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <div class="quick-contact-card">
                    <div class="quick-contact-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>دعوت به سخنرانی و کارگاه</h3>
                    <p>
                        برای هماهنگی برگزاری کارگاه‌ها، دوره‌های آموزشی و سخنرانی‌های تخصصی با ما مکاتبه کنید.
                    </p>
                    <a href="mailto:events@mstid.com" class="quick-contact-link">
                        <span>events@mstid.com</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <div class="quick-contact-card">
                    <div class="quick-contact-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>فرصت‌های پژوهشی و استخدامی</h3>
                    <p>
                        برای اطلاع از فرصت‌های همکاری، جذب پژوهشگر و کارآموزی رزومه خود را ارسال کنید.
                    </p>
                    <a href="mailto:hr@mstid.com" class="quick-contact-link">
                        <span>hr@mstid.com</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Placeholder Section -->
    <section class="map-section">
        <div class="map-header">
            <h2>موقعیت ما روی نقشه</h2>
            <p>به‌زودی نقشه تعاملی دفتر مرکزی توسعه دانش بنیان سینا در این بخش قرار خواهد گرفت.</p>
        </div>
        <div class="map-container">
            <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
        </div>
    </section>

    <!-- Working Hours -->
    <section class="working-hours">
        <div class="working-hours-content">
            <h2>ساعات کاری توسعه دانش بنیان سینا</h2>
            <p>
                شما می‌توانید در ساعات زیر با دفتر مرکزی در تماس باشید. در خارج از این ساعات، پیام خود را از طریق فرم
                تماس ارسال کنید.
            </p>
            <div class="hours-grid">
                <div class="hours-card">
                    <h3>
                        <i class="far fa-clock"></i>
                        روزهای کاری
                    </h3>
                    <p>شنبه تا چهارشنبه: ۸:۳۰ تا ۱۷:۰۰</p>
                    <p>پنجشنبه: ۸:۳۰ تا ۱۳:۰۰</p>
                </div>
                <div class="hours-card">
                    <h3>
                        <i class="fas fa-calendar-week"></i>
                        تعطیلات رسمی
                    </h3>
                    <p class="closed">در ایام تعطیل رسمی، دفتر مرکزی تعطیل است.</p>
                    <p>در این ایام می‌توانید از طریق ایمیل و فرم تماس با ما در ارتباط باشید.</p>
                </div>
                <div class="hours-card">
                    <h3>
                        <i class="fas fa-headset"></i>
                        پشتیبانی آنلاین
                    </h3>
                    <p>پاسخگویی ایمیل: همه روزه ۹:۰۰ تا ۲۰:۰۰</p>
                    <p>زمان متوسط پاسخگویی: ۲۴ ساعت کاری</p>
                </div>
            </div>
        </div>
    </section>
@endsection
