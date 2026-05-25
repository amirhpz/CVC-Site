@extends('site.layouts.base2')

@section('title', 'صندوق سرمایه‌گذاری خطرپذیر شرکتی - توسعه دانش بنیان سینا')

@section('styles')
    <style>


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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .lightbulb-illustration {
            width: 100%;
            max-width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.05) 100%);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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


            .hero-text h1 {
                font-size: 32px;
            }
        }
    </style>

@endsection

@section('content')
    @include('site.cvc.partials.dynamic-page-content')

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>سرمایه‌گذاری در آینده نوآوری</h1>
                    <p>ما در توسعه دانش بنیان سینا به دنبال استارت‌آپ‌ها و کسب‌وکارهای نوآور هستیم که می‌خواهند دنیا را تغییر دهند.
                        با سرمایه‌گذاری هوشمند و مشاوره تخصصی، رویاهای شما را به واقعیت تبدیل می‌کنیم.</p>
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
                    <p>صندوق سرمایه‌گذاری خطرپذیر توسعه دانش بنیان سینا با هدف حمایت از استارت‌آپ‌های نوآور و کسب‌وکارهای فناور در
                        مراحل اولیه تا رشد تأسیس شده است. ما با تیمی متشکل از متخصصان باتجربه در حوزه‌های مختلف
                        کسب‌وکار،
                        فناوری و سرمایه‌گذاری، فراتر از تأمین سرمایه، مشاوره استراتژیک و دسترسی به شبکه گسترده‌ای از
                        شرکا و
                        متخصصان را ارائه می‌دهیم.</p>
                    <p>رویکرد ما مبتنی بر شناخت عمیق بازار، ارزیابی دقیق پتانسیل رشد و همراهی بلندمدت با کارآفرینان است.
                        ما
                        معتقدیم که موفقیت استارت‌آپ‌ها، موفقیت ماست.</p>
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
                @forelse($homeProjects as $project)
                    <div class="portfolio-item">
                        <div class="portfolio-image">
                            @if(!empty($project->cover))
                                <img src="{{ asset('storage/' . $project->cover) }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                🚀
                            @endif
                        </div>
                        <div class="portfolio-content">
                            <h3>{{ $project->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($project->description ?? ''), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <p>پروژه‌ای برای نمایش ثبت نشده است.</p>
                @endforelse
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
                @forelse($homeTeamMembers as $member)
                    <div class="team-member">
                        <div class="team-photo">
                            @if(!empty($member->image))
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->fullname }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                👤
                            @endif
                        </div>
                        <div class="team-info">
                            <h3>{{ $member->fullname }}</h3>
                            <div class="position">{{ $member->side }}</div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($member->description ?? ''), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <p>عضو تیمی برای نمایش ثبت نشده است.</p>
                @endforelse

            </div>
        </div>
    </section>

    <!-- News -->
    <section class="news" id="news">
        <div class="container">

            <h2 class="section-title">اخبار و رویدادها</h2>
            <p>آخرین فعالیت‌ها و اطلاعیه‌های صندوق</p>

            <div class="news-grid">
                @forelse($homeNews as $post)
                    <div class="news-item">
                        <div class="news-image">📰</div>
                        <div class="news-content">
                            <div class="news-date">{{ $post->created_at->format('Y-m-d') }}</div>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->description ?? ''), 120) }}</p>
                        </div>
                    </div>
                @empty
                    <p>خبری برای نمایش ثبت نشده است.</p>
                @endforelse

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section
        style="padding: 80px 0; background: linear-gradient(135deg,var(--cvc-primary),var(--cvc-primary-hover)); color:white; text-align:center;">
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

@endsection

