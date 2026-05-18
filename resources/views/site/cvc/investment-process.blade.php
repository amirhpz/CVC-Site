@extends('site.layouts.base2')

@section('title', 'فرآیند سرمایه‌گذاری - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>


        /* Hero Section */
        .process-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .process-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><circle cx="100" cy="100" r="80" fill="rgba(255,255,255,0.05)"/><circle cx="900" cy="400" r="100" fill="rgba(255,255,255,0.05)"/><circle cx="1100" cy="150" r="70" fill="rgba(255,255,255,0.05)"/><circle cx="300" cy="500" r="60" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.4;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 48px;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .hero-content p {
            font-size: 18px;
            opacity: 0.95;
            line-height: 1.8;
        }

        /* Process Overview */
        .process-overview {
            padding: 80px 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 36px;
            margin-bottom: 15px;
            color: #2563eb;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .section-subtitle {
            color: #6c757d;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .overview-card {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s;
            border: 2px solid transparent;
            position: relative;
        }

        .overview-card:hover {
            background: white;
            border-color: #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
            transform: translateY(-5px);
        }

        .overview-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .overview-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .overview-card p {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Detailed Steps */
        .detailed-steps {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .step-item {
            background: white;
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 40px;
            align-items: start;
            transition: all 0.3s;
        }

        .step-item:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }

        .step-number-box {
            position: relative;
        }

        .step-number-circle {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .step-number {
            font-size: 36px;
            font-weight: bold;
            line-height: 1;
        }

        .step-label {
            font-size: 12px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .step-content h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        .step-duration {
            display: inline-block;
            background: #e7f3ff;
            color: #2563eb;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .step-description {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .step-details {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-top: 20px;
        }

        .step-details h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-details h4 i {
            color: #667eea;
        }

        .step-list {
            list-style: none;
            padding: 0;
        }

        .step-list li {
            padding: 10px 0;
            padding-right: 30px;
            position: relative;
            color: #555;
            line-height: 1.6;
        }

        .step-list li::before {
            content: '✓';
            position: absolute;
            right: 0;
            color: #667eea;
            font-weight: bold;
            font-size: 18px;
        }

        .step-requirements {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .requirement-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #e9ecef;
        }

        .requirement-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .requirement-text {
            font-size: 14px;
            color: #555;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 80px 0;
            background: white;
        }

        .timeline-container {
            max-width: 900px;
            margin: 50px auto 0;
            position: relative;
        }

        .timeline-line {
            position: absolute;
            right: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            transform: translateX(50%);
        }

        .timeline-item {
            display: grid;
            grid-template-columns: 1fr 80px 1fr;
            gap: 30px;
            margin-bottom: 60px;
            position: relative;
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            position: relative;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            grid-column: 1;
        }

        .timeline-item:nth-child(even) .timeline-content {
            grid-column: 3;
        }

        .timeline-content h4 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .timeline-content p {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
        }

        .timeline-dot {
            width: 80px;
            height: 80px;
            background: white;
            border: 4px solid #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            grid-column: 2;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        /* Criteria Section */
        .criteria-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }

        .criteria-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .criteria-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }

        .criteria-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .criteria-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 36px;
        }

        .criteria-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            text-align: center;
        }

        .criteria-card p {
            opacity: 0.9;
            line-height: 1.7;
            text-align: center;
            font-size: 15px;
        }

        .criteria-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .criteria-list li {
            padding: 8px 0;
            padding-right: 25px;
            position: relative;
            opacity: 0.9;
        }

        .criteria-list li::before {
            content: '→';
            position: absolute;
            right: 0;
            font-weight: bold;
        }

        /* Documents Section */
        .documents-section {
            padding: 80px 0;
            background: white;
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 50px;
        }

        .document-category {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 40px;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .document-category:hover {
            background: white;
            border-color: #667eea;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }

        .document-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .document-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
        }

        .document-header h3 {
            font-size: 24px;
            color: #333;
        }

        .document-list {
            list-style: none;
            padding: 0;
        }

        .document-list li {
            padding: 15px 0;
            padding-right: 35px;
            position: relative;
            color: #555;
            border-bottom: 1px solid #e9ecef;
            line-height: 1.6;
        }

        .document-list li:last-child {
            border-bottom: none;
        }

        .document-list li::before {
            content: '📄';
            position: absolute;
            right: 0;
            font-size: 18px;
        }

        /* Tips Section */
        .tips-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .tips-container {
            max-width: 900px;
            margin: 50px auto 0;
        }

        .tip-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 25px;
            border-right: 5px solid #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .tip-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            transform: translateX(-5px);
        }

        .tip-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .tip-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .tip-header h4 {
            font-size: 20px;
            color: #333;
        }

        .tip-card p {
            color: #6c757d;
            line-height: 1.8;
            font-size: 15px;
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background: white;
        }

        .faq-container {
            max-width: 900px;
            margin: 50px auto 0;
        }

        .faq-item {
            background: #f8f9fa;
            border-radius: 15px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .faq-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .faq-question {
            padding: 25px 30px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
        }

        .faq-question:hover {
            border-color: #667eea;
        }

        .faq-question-text {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .faq-icon {
            width: 35px;
            height: 35px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            transition: transform 0.3s;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer-content {
            padding: 0 30px 25px;
            color: #6c757d;
            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><circle cx="200" cy="100" r="60" fill="rgba(255,255,255,0.05)"/><circle cx="1000" cy="300" r="80" fill="rgba(255,255,255,0.05)"/></svg>');
            opacity: 0.5;
        }

        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 40px;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .cta-content p {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 35px;
            line-height: 1.7;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cta-btn-primary {
            background: white;
            color: #667eea;
        }

        .cta-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .cta-btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid white;
        }

        .cta-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }

        /* Contact Box */
        .contact-box {
            padding: 60px 0;
            background: white;
        }

        .contact-box-content {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 25px;
            padding: 50px;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 40px;
            align-items: center;
        }

        .contact-box-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .contact-box-text h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #333;
        }

        .contact-box-text p {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .contact-info {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-item i {
            width: 40px;
            height: 40px;
            background: #667eea;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .contact-item span {
            color: #333;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .overview-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .step-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .step-number-box {
                margin: 0 auto;
            }

            .criteria-grid {
                grid-template-columns: 1fr;
            }

            .documents-grid {
                grid-template-columns: 1fr;
            }

            .timeline-item {
                grid-template-columns: 1fr;
            }

            .timeline-line {
                display: none;
            }

            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                grid-column: 1;
            }

            .timeline-dot {
                grid-column: 1;
                margin: 0 auto;
            }

            .contact-box-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .contact-box-icon {
                margin: 0 auto;
            }

            .contact-info {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .overview-grid {
                grid-template-columns: 1fr;
            }

            .step-requirements {
                grid-template-columns: 1fr;
            }

            .cta-content h2 {
                font-size: 28px;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .cta-btn {
                width: 100%;
                justify-content: center;
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
                <li class="active">فرآیند سرمایه گذاری</li>
            </ol>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="process-hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-icon">
                    📊
                </div>
                <h1>فرآیند سرمایه‌گذاری در مستید</h1>
                <p>
                    با یک فرآیند شفاف، ساده و حرفه‌ای، سرمایه‌گذاری خود را در پروژه‌های تحقیقاتی و استراتژیک آغاز کنید.
                    ما در هر مرحله در کنار شما هستیم تا بهترین تصمیم را بگیرید.
                </p>
            </div>
        </div>
    </section>

    <!-- Process Overview -->
    <section class="process-overview">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">مراحل کلی سرمایه‌گذاری</h2>
                <p class="section-subtitle">
                    فرآیند سرمایه‌گذاری در مستید در چهار مرحله اصلی انجام می‌شود که هر کدام با دقت و شفافیت کامل پیگیری
                    می‌گردد.
                </p>
            </div>

            <div class="overview-grid">
                <div class="overview-card">
                    <div class="overview-number">1</div>
                    <h3>ثبت درخواست</h3>
                    <p>تکمیل فرم آنلاین و ارسال مدارک اولیه برای بررسی</p>
                </div>

                <div class="overview-card">
                    <div class="overview-number">2</div>
                    <h3>بررسی و ارزیابی</h3>
                    <p>تحلیل دقیق درخواست توسط تیم متخصص و ارائه پیشنهاد</p>
                </div>

                <div class="overview-card">
                    <div class="overview-number">3</div>
                    <h3>تایید و قرارداد</h3>
                    <p>امضای قرارداد رسمی و تعیین شرایط همکاری</p>
                </div>

                <div class="overview-card">
                    <div class="overview-number">4</div>
                    <h3>اجرا و پیگیری</h3>
                    <p>شروع پروژه و گزارش‌دهی منظم به سرمایه‌گذار</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Steps -->
    <section class="detailed-steps">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">جزئیات مراحل</h2>
                <p class="section-subtitle">
                    در این بخش، هر مرحله از فرآیند سرمایه‌گذاری به تفصیل توضیح داده شده است.
                </p>
            </div>

            <!-- Step 1 -->
            <div class="step-item">
                <div class="step-number-box">
                    <div class="step-number-circle">
                        <div class="step-number">01</div>
                        <div class="step-label">مرحله اول</div>
                    </div>
                </div>
                <div class="step-content">
                    <h3>ثبت درخواست سرمایه‌گذاری</h3>
                    <span class="step-duration">⏱ مدت زمان: 1-2 روز کاری</span>
                    <p class="step-description">
                        در این مرحله، شما با تکمیل فرم آنلاین درخواست سرمایه‌گذاری و ارسال مدارک اولیه، فرآیند را آغاز
                        می‌کنید.
                        تیم ما پس از دریافت درخواست، آن را بررسی اولیه کرده و در صورت نیاز با شما تماس خواهد گرفت.
                    </p>

                    <div class="step-details">
                        <h4><i>📋</i> اقدامات مورد نیاز:</h4>
                        <ul class="step-list">
                            <li>تکمیل فرم درخواست سرمایه‌گذاری در وب‌سایت</li>
                            <li>ارائه اطلاعات شخصی یا شرکتی</li>
                            <li>تعیین میزان سرمایه‌گذاری مورد نظر</li>
                            <li>انتخاب حوزه یا پروژه مورد علاقه</li>
                            <li>ارسال مدارک شناسایی معتبر</li>
                        </ul>

                        <h4 style="margin-top: 25px;"><i>📄</i> مدارک مورد نیاز:</h4>
                        <div class="step-requirements">
                            <div class="requirement-item">
                                <div class="requirement-icon">👤</div>
                                <div class="requirement-text">کپی شناسنامه و کارت ملی</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">🏢</div>
                                <div class="requirement-text">مدارک ثبت شرکت (در صورت وجود)</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">💳</div>
                                <div class="requirement-text">مشخصات حساب بانکی</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">📧</div>
                                <div class="requirement-text">ایمیل و شماره تماس معتبر</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-item">
                <div class="step-number-box">
                    <div class="step-number-circle">
                        <div class="step-number">02</div>
                        <div class="step-label">مرحله دوم</div>
                    </div>
                </div>
                <div class="step-content">
                    <h3>بررسی و ارزیابی درخواست</h3>
                    <span class="step-duration">⏱ مدت زمان: 5-7 روز کاری</span>
                    <p class="step-description">
                        تیم تخصصی مستید درخواست شما را به دقت بررسی می‌کند. این بررسی شامل ارزیابی توان مالی، انطباق با
                        معیارهای سرمایه‌گذاری
                        و تطابق با اهداف پروژه‌های در دست اجرا است. در پایان این مرحله، گزارش ارزیابی و پیشنهاد
                        سرمایه‌گذاری به شما ارائه می‌شود.
                    </p>

                    <div class="step-details">
                        <h4><i>🔍</i> فرآیند بررسی شامل:</h4>
                        <ul class="step-list">
                            <li>تحلیل مدارک و اطلاعات ارسالی</li>
                            <li>بررسی سابقه و اعتبار سرمایه‌گذار</li>
                            <li>ارزیابی میزان سرمایه و توان مالی</li>
                            <li>تطبیق با معیارهای پذیرش مستید</li>
                            <li>تعیین پروژه‌های مناسب برای سرمایه‌گذاری</li>
                            <li>تهیه گزارش ارزیابی اولیه</li>
                        </ul>

                        <h4 style="margin-top: 25px;"><i>📊</i> معیارهای ارزیابی:</h4>
                        <div class="step-requirements">
                            <div class="requirement-item">
                                <div class="requirement-icon">💰</div>
                                <div class="requirement-text">حداقل سرمایه: 100 میلیون تومان</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">⏳</div>
                                <div class="requirement-text">مدت زمان سرمایه‌گذاری: حداقل 12 ماه</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">✅</div>
                                <div class="requirement-text">تایید هویت و اعتبار</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">🎯</div>
                                <div class="requirement-text">انطباق با اهداف پروژه</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-item">
                <div class="step-number-box">
                    <div class="step-number-circle">
                        <div class="step-number">03</div>
                        <div class="step-label">مرحله سوم</div>
                    </div>
                </div>
                <div class="step-content">
                    <h3>تایید نهایی و انعقاد قرارداد</h3>
                    <span class="step-duration">⏱ مدت زمان: 3-5 روز کاری</span>
                    <p class="step-description">
                        پس از تایید متقابل، قرارداد رسمی سرمایه‌گذاری تنظیم و امضا می‌شود. این قرارداد شامل تمامی جزئیات
                        همکاری،
                        حقوق و تعهدات طرفین، نحوه تقسیم سود، و شرایط خروج از سرمایه‌گذاری است.
                    </p>

                    <div class="step-details">
                        <h4><i>📝</i> مراحل انعقاد قرارداد:</h4>
                        <ul class="step-list">
                            <li>ارسال پیش‌نویس قرارداد برای بررسی</li>
                            <li>برگزاری جلسه توضیحی و رفع ابهامات</li>
                            <li>اعمال تغییرات مورد توافق (در صورت نیاز)</li>
                            <li>تایید نهایی قرارداد توسط طرفین</li>
                            <li>امضای رسمی قرارداد</li>
                            <li>ثبت قرارداد در مراجع قانونی</li>
                        </ul>

                        <h4 style="margin-top: 25px;"><i>📋</i> محتویات قرارداد:</h4>
                        <div class="step-requirements">
                            <div class="requirement-item">
                                <div class="requirement-icon">💵</div>
                                <div class="requirement-text">میزان سرمایه و نحوه پرداخت</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">📈</div>
                                <div class="requirement-text">نحوه تقسیم سود و زیان</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">⚖️</div>
                                <div class="requirement-text">حقوق و تعهدات طرفین</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">🚪</div>
                                <div class="requirement-text">شرایط خروج از سرمایه‌گذاری</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-item">
                <div class="step-number-box">
                    <div class="step-number-circle">
                        <div class="step-number">04</div>
                        <div class="step-label">مرحله چهارم</div>
                    </div>
                </div>
                <div class="step-content">
                    <h3>اجرای پروژه و گزارش‌دهی</h3>
                    <span class="step-duration">⏱ مدت زمان: بر اساس قرارداد</span>
                    <p class="step-description">
                        پس از واریز سرمایه، پروژه به طور رسمی آغاز می‌شود. شما به عنوان سرمایه‌گذار، به صورت منظم
                        گزارش‌های پیشرفت پروژه،
                        صورت‌های مالی و تحلیل‌های عملکرد را دریافت خواهید کرد. همچنین امکان نظارت مستقیم بر روند پروژه
                        فراهم است.
                    </p>

                    <div class="step-details">
                        <h4><i>📊</i> خدمات پس از سرمایه‌گذاری:</h4>
                        <ul class="step-list">
                            <li>گزارش‌دهی ماهانه از پیشرفت پروژه</li>
                            <li>ارائه صورت‌های مالی فصلی</li>
                            <li>دسترسی به پنل سرمایه‌گذار</li>
                            <li>برگزاری جلسات توجیهی دوره‌ای</li>
                            <li>پشتیبانی اختصاصی 24/7</li>
                            <li>امکان بازدید حضوری از پروژه</li>
                        </ul>

                        <h4 style="margin-top: 25px;"><i>🎁</i> مزایای سرمایه‌گذار:</h4>
                        <div class="step-requirements">
                            <div class="requirement-item">
                                <div class="requirement-icon">📱</div>
                                <div class="requirement-text">پنل اختصاصی آنلاین</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">📧</div>
                                <div class="requirement-text">گزارش‌های دوره‌ای</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">🤝</div>
                                <div class="requirement-text">مشاوره رایگان</div>
                            </div>
                            <div class="requirement-item">
                                <div class="requirement-icon">🎓</div>
                                <div class="requirement-text">دسترسی به محتوای آموزشی</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">جدول زمانی فرآیند</h2>
                <p class="section-subtitle">
                    مدت زمان تقریبی هر مرحله از فرآیند سرمایه‌گذاری
                </p>
            </div>

            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>روز 1-2</h4>
                        <p>ثبت درخواست و ارسال مدارک</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>روز 3-10</h4>
                        <p>بررسی و ارزیابی توسط تیم متخصص</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>روز 11-15</h4>
                        <p>تنظیم و امضای قرارداد</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>روز 16+</h4>
                        <p>شروع پروژه و گزارش‌دهی منظم</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Criteria Section -->
    <section class="criteria-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">معیارهای پذیرش سرمایه‌گذار</h2>
                <p class="section-subtitle">
                    برای همکاری با مستید، رعایت این معیارها ضروری است
                </p>
            </div>

            <div class="criteria-grid">
                <div class="criteria-card">
                    <div class="criteria-icon">💰</div>
                    <h3>حداقل سرمایه</h3>
                    <p>حداقل مبلغ سرمایه‌گذاری 100 میلیون تومان</p>
                </div>

                <div class="criteria-card">
                    <div class="criteria-icon">⏳</div>
                    <h3>مدت زمان</h3>
                    <p>حداقل مدت زمان سرمایه‌گذاری 12 ماه</p>
                </div>

                <div class="criteria-card">
                    <div class="criteria-icon">✅</div>
                    <h3>احراز هویت</h3>
                    <p>تایید هویت و اعتبار سرمایه‌گذار الزامی است</p>
                </div>

                <div class="criteria-card">
                    <div class="criteria-icon">📋</div>
                    <h3>مدارک کامل</h3>
                    <p>ارائه تمامی مدارک مورد نیاز</p>
                </div>

                <div class="criteria-card">
                    <div class="criteria-icon">🎯</div>
                    <h3>انطباق اهداف</h3>
                    <p>هماهنگی با اهداف و ارزش‌های مستید</p>
                </div>

                <div class="criteria-card">
                    <div class="criteria-icon">🤝</div>
                    <h3>تعهد همکاری</h3>
                    <p>آمادگی برای همکاری بلندمدت</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Documents Section -->
    <section class="documents-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">مدارک مورد نیاز</h2>
                <p class="section-subtitle">
                    لیست کامل مدارک لازم برای ثبت درخواست سرمایه‌گذاری
                </p>
            </div>

            <div class="documents-wrapper">
                <div class="documents-column">
                    <h3 class="documents-title">
                        <i>👤</i> اشخاص حقیقی
                    </h3>
                    <ul class="documents-list">
                        <li>
                            <span class="doc-icon">📄</span>
                            <span class="doc-text">کپی شناسنامه (تمام صفحات)</span>
                        </li>
                        <li>
                            <span class="doc-icon">💳</span>
                            <span class="doc-text">کپی کارت ملی (پشت و رو)</span>
                        </li>
                        <li>
                            <span class="doc-icon">🏦</span>
                            <span class="doc-text">مشخصات حساب بانکی</span>
                        </li>
                        <li>
                            <span class="doc-icon">📧</span>
                            <span class="doc-text">ایمیل و شماره تماس معتبر</span>
                        </li>
                        <li>
                            <span class="doc-icon">📍</span>
                            <span class="doc-text">آدرس محل سکونت</span>
                        </li>
                        <li>
                            <span class="doc-icon">📸</span>
                            <span class="doc-text">عکس پرسنلی (در صورت نیاز)</span>
                        </li>
                    </ul>
                </div>

                <div class="documents-column">
                    <h3 class="documents-title">
                        <i>🏢</i> اشخاص حقوقی
                    </h3>
                    <ul class="documents-list">
                        <li>
                            <span class="doc-icon">📜</span>
                            <span class="doc-text">اساسنامه شرکت</span>
                        </li>
                        <li>
                            <span class="doc-icon">🏛️</span>
                            <span class="doc-text">آگهی ثبت روزنامه رسمی</span>
                        </li>
                        <li>
                            <span class="doc-icon">📋</span>
                            <span class="doc-text">آخرین تغییرات شرکت</span>
                        </li>
                        <li>
                            <span class="doc-icon">👔</span>
                            <span class="doc-text">مدارک شناسایی مدیرعامل</span>
                        </li>
                        <li>
                            <span class="doc-icon">🏦</span>
                            <span class="doc-text">مشخصات حساب بانکی شرکت</span>
                        </li>
                        <li>
                            <span class="doc-icon">📊</span>
                            <span class="doc-text">صورت‌های مالی (در صورت نیاز)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="documents-note">
                <div class="note-icon">ℹ️</div>
                <div class="note-content">
                    <strong>توجه:</strong> تمامی مدارک باید به صورت اسکن شده با کیفیت مناسب و خوانا ارسال شوند.
                    در صورت نیاز، تیم ما ممکن است مدارک تکمیلی درخواست کند.
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">نکات مهم برای سرمایه‌گذاران</h2>
                <p class="section-subtitle">
                    توصیه‌هایی که به شما کمک می‌کند تصمیم بهتری بگیرید
                </p>
            </div>

            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-number">1</div>
                    <h3>تحقیق کنید</h3>
                    <p>
                        قبل از سرمایه‌گذاری، درباره پروژه‌ها و حوزه‌های مختلف تحقیق کامل انجام دهید.
                        از تیم ما سوالات خود را بپرسید.
                    </p>
                </div>

                <div class="tip-card">
                    <div class="tip-number">2</div>
                    <h3>ریسک را بسنجید</h3>
                    <p>
                        هر سرمایه‌گذاری ریسک دارد. میزان ریسک‌پذیری خود را بشناسید و بر اساس آن تصمیم بگیرید.
                    </p>
                </div>

                <div class="tip-card">
                    <div class="tip-number">3</div>
                    <h3>تنوع‌بخشی</h3>
                    <p>
                        سرمایه خود را در چند پروژه مختلف تقسیم کنید تا ریسک کلی کاهش یابد.
                    </p>
                </div>

                <div class="tip-card">
                    <div class="tip-number">4</div>
                    <h3>صبور باشید</h3>
                    <p>
                        سرمایه‌گذاری در پروژه‌های تحقیقاتی نیاز به صبر دارد. نتایج بلندمدت را در نظر بگیرید.
                    </p>
                </div>

                <div class="tip-card">
                    <div class="tip-number">5</div>
                    <h3>قرارداد را بخوانید</h3>
                    <p>
                        تمام بندهای قرارداد را با دقت مطالعه کنید و در صورت ابهام، از مشاور حقوقی کمک بگیرید.
                    </p>
                </div>

                <div class="tip-card">
                    <div class="tip-number">6</div>
                    <h3>پیگیری کنید</h3>
                    <p>
                        به طور منظم گزارش‌های پروژه را بررسی کنید و در جلسات توجیهی شرکت کنید.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">سوالات متداول</h2>
                <p class="section-subtitle">
                    پاسخ به رایج‌ترین سوالات درباره فرآیند سرمایه‌گذاری
                </p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>چقدر طول می‌کشد تا درخواست من بررسی شود؟</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            معمولاً بررسی اولیه درخواست 5 تا 7 روز کاری طول می‌کشد. در صورت نیاز به مدارک تکمیلی،
                            این مدت ممکن است طولانی‌تر شود.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>آیا می‌توانم قبل از سرمایه‌گذاری با تیم پروژه ملاقات کنم؟</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            بله، شما می‌توانید جلسه‌ای با تیم پروژه و مدیران مستید داشته باشید تا اطلاعات بیشتری
                            کسب کنید و سوالات خود را مطرح کنید.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>آیا امکان خروج زودهنگام از سرمایه‌گذاری وجود دارد؟</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            شرایط خروج از سرمایه‌گذاری در قرارداد مشخص می‌شود. معمولاً خروج زودهنگام با شرایط خاصی
                            امکان‌پذیر است که در قرارداد ذکر شده است.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>چگونه از پیشرفت پروژه مطلع می‌شوم؟</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            شما به صورت ماهانه گزارش پیشرفت دریافت می‌کنید و همچنین از طریق پنل اختصاصی می‌توانید
                            وضعیت پروژه را به صورت آنلاین پیگیری کنید.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>آیا می‌توانم در چند پروژه همزمان سرمایه‌گذاری کنم؟</h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>
                            بله، شما می‌توانید در چندین پروژه مختلف سرمایه‌گذاری کنید. این کار به تنوع‌بخشی
                            سبد سرمایه‌گذاری شما کمک می‌کند.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>آماده شروع سرمایه‌گذاری هستید؟</h2>
                <p>
                    با تکمیل فرم درخواست، اولین قدم را برای همکاری با مستید بردارید.
                    تیم ما در کنار شما خواهد بود.
                </p>
                <div class="cta-buttons">
                    <a href="#" class="btn btn-primary">
                        ثبت درخواست سرمایه‌گذاری
                    </a>
                    <a href="#" class="btn btn-secondary">
                        تماس با ما
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        // FAQ Accordion
        document.querySelectorAll('.faq-item').forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');

            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all items
                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-icon').textContent = '+';
                });

                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                    icon.textContent = '−';
                }
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endsection
