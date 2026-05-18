@extends('site.layouts.base2')

@section('title', 'نمونه کارها - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>

        /* Hero Section */
        .portfolio-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 5rem 0 3rem;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .portfolio-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .portfolio-hero-content {
            position: relative;
            z-index: 1;
        }

        .portfolio-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .portfolio-hero p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 800px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Filter Section */
        .portfolio-filter {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .filter-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e9ecef;
            background: white;
            color: #495057;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
        }

        .filter-btn:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Portfolio Grid */
        .portfolio-section {
            padding: 4rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .section-header p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 1.5rem auto 0;
            line-height: 1.8;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .portfolio-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
        }

        .portfolio-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .portfolio-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .portfolio-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }

        .portfolio-image-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
            color: white;
            opacity: 0.9;
        }

        .portfolio-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.95);
            color: #667eea;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .portfolio-content {
            padding: 1.5rem;
        }

        .portfolio-category {
            display: inline-block;
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .portfolio-title {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            font-weight: 700;
            line-height: 1.4;
        }

        .portfolio-description {
            color: #6c757d;
            line-height: 1.7;
            margin-bottom: 1.25rem;
            font-size: 0.95rem;
        }

        .portfolio-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 2px solid #f8f9fa;
        }

        .portfolio-client {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #495057;
            font-size: 0.9rem;
        }

        .portfolio-client i {
            color: #667eea;
        }

        .portfolio-date {
            color: #adb5bd;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .portfolio-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .portfolio-tag {
            background: #f8f9fa;
            color: #495057;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Featured Projects */
        .featured-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 4rem 0;
            margin: 4rem 0;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .featured-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .featured-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.2);
        }

        .featured-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .featured-card h3 {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .featured-card p {
            color: #6c757d;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .featured-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .featured-list li {
            padding: 0.5rem 0;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .featured-list li::before {
            content: '✓';
            color: #667eea;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* CTA Section */
        .portfolio-cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .portfolio-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        }

        .portfolio-cta-content {
            position: relative;
            z-index: 1;
        }

        .portfolio-cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .portfolio-cta p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
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
            cursor: pointer;
            border: 2px solid white;
        }

        .cta-btn-primary {
            background: white;
            color: #667eea;
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255,255,255,0.3);
        }

        .cta-btn-secondary {
            background: transparent;
            color: white;
        }

        .cta-btn-secondary:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-3px);
        }

        /* Testimonials */
        .testimonials-section {
            padding: 4rem 0;
            background: white;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .testimonial-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 16px;
            position: relative;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .testimonial-quote {
            font-size: 3rem;
            color: #667eea;
            opacity: 0.3;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .testimonial-text {
            color: #495057;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-style: italic;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .testimonial-info h4 {
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .testimonial-info p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .portfolio-hero h1 {
                font-size: 2.25rem;
            }

            .portfolio-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .hero-stats {
                gap: 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .portfolio-hero {
                padding: 3rem 0 2rem;
            }

            .portfolio-hero h1 {
                font-size: 1.875rem;
            }

            .portfolio-hero p {
                font-size: 1rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .portfolio-section {
                padding: 2rem 0;
            }

            .portfolio-grid {
                grid-template-columns: 1fr;
            }

            .filter-container {
                gap: 0.5rem;
            }

            .filter-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .portfolio-cta h2 {
                font-size: 1.875rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .cta-btn {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .portfolio-image {
                height: 200px;
            }

            .portfolio-image-icon {
                font-size: 3rem;
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
                <li class="active">نمونه کارها</li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="portfolio-hero">
        <div class="portfolio-hero-content">
            <div class="container">
                <h1>نمونه کارها و سرمایه‌گذاری‌های موفق</h1>
                <p>
                    مرکز تحقیقات استراتژیک مستید با افتخار مجموعه‌ای از پروژه‌های موفق، سرمایه‌گذاری‌های استراتژیک
                    و همکاری‌های پژوهشی خود را به نمایش می‌گذارد. هر پروژه نمایانگر تعهد ما به نوآوری، کیفیت و ایجاد ارزش پایدار است.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">۱۵۰+</span>
                        <span class="stat-label">پروژه موفق</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">۸۵+</span>
                        <span class="stat-label">شرکت سرمایه‌پذیر</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">۲۵+</span>
                        <span class="stat-label">صنعت مختلف</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">۹۵٪</span>
                        <span class="stat-label">رضایت مشتریان</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="portfolio-filter">
        <div class="container">
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">همه پروژه‌ها</button>
                @foreach($categories as $category)
                    @php($categoryKey = \Illuminate\Support\Str::slug($category))
                    <button class="filter-btn" data-filter="{{ $categoryKey !== '' ? $categoryKey : 'category-' . $loop->index }}">{{ $category }}</button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    <section class="portfolio-section">
        <div class="container">
            <div class="section-header">
                <h2>پروژه‌های برجسته</h2>
                <p>
                    مجموعه‌ای از پروژه‌های موفق که با حمایت مالی و مشاوره‌ای مرکز تحقیقات استراتژیک مستید
                    به رشد و توسعه پایدار دست یافته‌اند.
                </p>
            </div>

            <div class="portfolio-grid">
                @forelse($projects as $project)
                    @php($category = $project->sub_title ?: 'عمومی')
                    @php($categoryKey = \Illuminate\Support\Str::slug($category))
                    <div class="portfolio-card" data-category="{{ $categoryKey !== '' ? $categoryKey : 'category-' . $loop->index }}">
                        <div class="portfolio-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            @if(!empty($project->cover))
                                <img src="{{ asset('storage/' . $project->cover) }}" alt="{{ $project->title }}"
                                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="portfolio-image-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            @endif
                            <span class="portfolio-badge">{{ $project->item1 ?: 'پروژه فعال' }}</span>
                        </div>
                        <div class="portfolio-content">
                            <span class="portfolio-category">{{ $category }}</span>
                            <h3 class="portfolio-title">{{ $project->title }}</h3>
                            <p class="portfolio-description">{{ \Illuminate\Support\Str::limit(strip_tags($project->description ?: ''), 220) }}</p>
                            <div class="portfolio-tags">
                                @php($tags = collect(explode(',', $project->en_title ?? ''))->map(fn($tag) => trim($tag))->filter()->take(3))
                                @forelse($tags as $tag)
                                    <span class="portfolio-tag">{{ $tag }}</span>
                                @empty
                                    <span class="portfolio-tag">{{ $project->product_type ?: 'Portfolio' }}</span>
                                @endforelse
                            </div>
                            <div class="portfolio-meta">
                                <div class="portfolio-client">
                                    <i class="fas fa-building"></i>
                                    <span>{{ $project->item2 ?: 'شرکت سرمایه‌پذیر' }}</span>
                                </div>
                                <div class="portfolio-date">
                                    <i class="far fa-calendar"></i>
                                    <span>{{ $project->start_date ? \Illuminate\Support\Carbon::parse($project->start_date)->format('Y') : $project->created_at->format('Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>در حال حاضر پروژه‌ای برای نمایش ثبت نشده است.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="featured-section">
        <div class="container">
            <div class="section-header">
                <h2>پروژه‌های ویژه</h2>
                <p>
                    پروژه‌هایی که با رویکرد نوآورانه و تاثیرگذاری بالا، الگویی برای موفقیت در صنایع مختلف شده‌اند.
                </p>
            </div>

            <div class="featured-grid">
                <div class="featured-card">
                    <div class="featured-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>استارتاپ‌های سریع‌الرشد</h3>
                    <p>
                        حمایت از استارتاپ‌هایی که در کمتر از ۲ سال به ارزش‌گذاری بالای ۱۰ میلیون دلار رسیده‌اند.
                    </p>
                    <ul class="featured-list">
                        <li>رشد سالانه بیش از ۲۰۰٪</li>
                        <li>ایجاد بیش از ۵۰۰ فرصت شغلی</li>
                        <li>جذب سرمایه‌گذاری بین‌المللی</li>
                        <li>توسعه محصولات نوآورانه</li>
                    </ul>
                </div>

                <div class="featured-card">
                    <div class="featured-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>پروژه‌های بین‌المللی</h3>
                    <p>
                        همکاری با شرکت‌های بین‌المللی برای توسعه محصولات و خدمات با استانداردهای جهانی.
                    </p>
                    <ul class="featured-list">
                        <li>حضور در ۱۵ کشور مختلف</li>
                        <li>همکاری با ۵۰ شرکت بین‌المللی</li>
                        <li>صادرات فناوری و دانش</li>
                        <li>انتقال تکنولوژی پیشرفته</li>
                    </ul>
                </div>

                <div class="featured-card">
                    <div class="featured-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>پروژه‌های برنده جایزه</h3>
                    <p>
                        پروژه‌هایی که موفق به دریافت جوایز ملی و بین‌المللی در حوزه نوآوری و فناوری شده‌اند.
                    </p>
                    <ul class="featured-list">
                        <li>۲۵ جایزه ملی و بین‌المللی</li>
                        <li>تقدیر از سازمان‌های معتبر</li>
                        <li>ثبت ۴۰ اختراع و نوآوری</li>
                        <li>انتشار ۱۰۰ مقاله علمی</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="portfolio-cta">
        <div class="portfolio-cta-content">
            <div class="container">
                <h2>آیا پروژه نوآورانه‌ای دارید؟</h2>
                <p>
                    ما آماده‌ایم تا با سرمایه‌گذاری هوشمند، مشاوره تخصصی و حمایت جامع، ایده شما را به یک کسب‌وکار موفق تبدیل کنیم.
                    با تیم متخصص مستید همراه شوید و آینده را بسازید.
                </p>
                <div class="cta-buttons">
                    <a href="/contact" class="cta-btn cta-btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        درخواست سرمایه‌گذاری
                    </a>
                    <a href="/about" class="cta-btn cta-btn-secondary">
                        <i class="fas fa-info-circle"></i>
                        بیشتر بدانید
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2>نظرات مشتریان و شرکا</h2>
                <p>
                    آنچه بنیان‌گذاران و مدیران شرکت‌های سرمایه‌پذیر درباره همکاری با مرکز تحقیقات استراتژیک مستید می‌گویند.
                </p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-text">
                        همکاری با مستید نقطه عطفی در مسیر رشد استارتاپ ما بود. نه تنها سرمایه مالی، بلکه دانش، تجربه و شبکه ارتباطی
                        گسترده‌ای در اختیار ما قرار گرفت که باعث شد در کمتر از یک سال به اهداف سه‌ساله خود برسیم.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">ر.م</div>
                        <div class="testimonial-info">
                            <h4>رضا محمدی</h4>
                            <p>بنیان‌گذار پی‌لینک</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-text">
                        تیم مستید با درک عمیق از چالش‌های صنعت سلامت دیجیتال، راهکارهای استراتژیک و عملیاتی ارائه دادند که
                        به ما کمک کرد تا از رقبا پیشی بگیریم. مشاوره‌های تخصصی آن‌ها بی‌نظیر بود.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">س.ا</div>
                        <div class="testimonial-info">
                            <h4>سارا احمدی</h4>
                            <p>مدیرعامل دکتریاب</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-text">
                        سرمایه‌گذاری مستید فراتر از یک حمایت مالی بود. آن‌ها به عنوان شریک استراتژیک در کنار ما بودند و با
                        معرفی به سرمایه‌گذاران بین‌المللی، مسیر توسعه جهانی ما را هموار کردند.
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">ع.ک</div>
                        <div class="testimonial-info">
                            <h4>علی کریمی</h4>
                            <p>بنیان‌گذار دیتا‌ویژن</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const portfolioCards = document.querySelectorAll('.portfolio-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    portfolioCards.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'block';
                        } else {
                            const category = card.getAttribute('data-category');
                            if (category === filterValue) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection

