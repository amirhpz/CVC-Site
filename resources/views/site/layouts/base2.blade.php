<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'صندوق سرمایه‌گذاری خطرپذیر شرکتی - Metro Fund')</title>
    @yield('meta')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Dana', Verdana, sans-serif;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #2563eb;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
        }

        .mobile-menu-toggle span {
            width: 28px;
            height: 3px;
            background: #2563eb;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        .mobile-menu.active {
            max-height: 500px;
        }

        .mobile-menu ul {
            list-style: none;
            padding: 20px 0;
        }

        .mobile-menu li {
            border-bottom: 1px solid #f0f0f0;
        }

        .mobile-menu a {
            display: block;
            padding: 15px 30px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .mobile-menu a:hover {
            background: #f8f9fa;
            color: #2563eb;
            padding-right: 40px;
        }

        /* Breadcrumb */
        .breadcrumb-nav {
            background: #f8f9fa;
            padding: 1rem 0;
        }

        .breadcrumb {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .breadcrumb li:not(:last-child)::after {
            content: '/';
            margin-right: 0.5rem;
            color: #6c757d;
        }

        .breadcrumb a {
            color: #0066cc;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .active {
            color: #6c757d;
        }

        .section-title {
            font-size: 36px;
            margin-bottom: 20px;
            color: #2563eb;
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
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            transition: background 0.3s;
        }

        .social-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .footer-links h4 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
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
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            /* Hide desktop menu */
            nav ul {
                display: none;
            }

            /* Show mobile menu toggle */
            .mobile-menu-toggle {
                display: flex;
            }

            /* Show mobile menu */
            .mobile-menu {
                display: block;
            }

            .logo {
                font-size: 20px;
            }

            .logo-icon {
                width: 35px;
                height: 35px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }

    </style>
    @yield('styles')
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <div class="logo-icon">MF</div>
                <span>Metro Fund</span>
            </div>

            <!-- Desktop Menu -->
            <ul>
                <li><a href="/">خانه</a></li>
                <li><a href="/about">درباره ما</a></li>
                <li><a href="/portfolio">پورتفولیو</a></li>
                <li><a href="/services">خدمات</a></li>
                <li><a href="/team">تیم</a></li>
                <li><a href="/news">اخبار</a></li>
                <li><a href="/contact">تماس</a></li>
            </ul>

            <!-- Mobile Menu Toggle -->
            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="/">خانه</a></li>
            <li><a href="/about">درباره ما</a></li>
            <li><a href="/portfolio">پورتفولیو</a></li>
            <li><a href="/services">خدمات</a></li>
            <li><a href="/team">تیم</a></li>
            <li><a href="/news">اخبار</a></li>
            <li><a href="/contact">تماس</a></li>
        </ul>
    </div>
</header>

<!-- Main Content -->
@yield('content')

<!-- Footer -->
<footer>
    <div class="container">

        <div class="footer-content">

            <div class="footer-about">
                <h3>Metro Fund</h3>
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
            © 1405 تمامی حقوق متعلق به Metro Fund می‌باشد.
        </div>

    </div>
</footer>

<!-- Mobile Menu Script -->
<script>
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });

    // Close menu when clicking on a link
    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideMenu = mobileMenu.contains(event.target);
        const isClickOnToggle = mobileMenuToggle.contains(event.target);

        if (!isClickInsideMenu && !isClickOnToggle && mobileMenu.classList.contains('active')) {
            mobileMenuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });
</script>

</body>
</html>
