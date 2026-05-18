@extends('site.layouts.base2')

@section('title', 'درخواست همکاری - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>
        /* Hero Section */
        .career-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .career-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }

        .career-hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .career-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .career-hero p {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Application Form Section */
        .application-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 50px;
            margin-top: -60px;
            position: relative;
            z-index: 2;
        }

        .form-header {
            text-align: center;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-header h2 {
            font-size: 2.2rem;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .form-header p {
            font-size: 1.1rem;
            color: #718096;
        }

        /* Form Steps */
        .form-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
            position: relative;
        }

        .form-steps::before {
            content: '';
            position: absolute;
            top: 25px;
            right: 0;
            left: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: 700;
            font-size: 1.2rem;
            color: #a0aec0;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .step.completed .step-number {
            background: #48bb78;
            border-color: #48bb78;
            color: white;
        }

        .step-title {
            font-size: 0.95rem;
            color: #a0aec0;
            font-weight: 500;
        }

        .step.active .step-title {
            color: #667eea;
            font-weight: 600;
        }

        /* Form Sections */
        .form-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .form-section.active {
            display: block;
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

        /* Form Groups */
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-row.single {
            grid-template-columns: 1fr;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .form-group label .required {
            color: #e53e3e;
            margin-right: 3px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f7fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path fill="%23667eea" d="M6 9L1 4h10z"/></svg>');
            background-repeat: no-repeat;
            background-position: left 15px center;
            padding-left: 40px;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            background: #f7fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-wrapper:hover {
            border-color: #667eea;
            background: #edf2f7;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #667eea;
        }

        .file-upload-text {
            color: #4a5568;
            font-size: 1rem;
        }

        .file-upload-text strong {
            color: #667eea;
        }

        .file-name {
            margin-top: 15px;
            padding: 10px;
            background: #e6fffa;
            border-radius: 8px;
            color: #234e52;
            font-weight: 500;
            display: none;
        }

        .file-name.show {
            display: block;
        }

        /* Dynamic Fields */
        .dynamic-section {
            margin-bottom: 40px;
        }

        .dynamic-item {
            background: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            position: relative;
        }

        .dynamic-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
        }

        .dynamic-item-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2d3748;
        }

        .remove-item-btn {
            background: #fc8181;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .remove-item-btn:hover {
            background: #e53e3e;
            transform: translateY(-2px);
        }

        .add-item-btn {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .add-item-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.3);
        }

        /* Checkbox & Radio */
        .checkbox-group,
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"],
        .radio-item input[type="radio"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        /* Form Navigation Buttons */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            font-family: inherit;
            padding: 14px 35px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-prev {
            background: #e2e8f0;
            color: #4a5568;
        }

        .btn-prev:hover {
            background: #cbd5e0;
            transform: translateX(5px);
        }

        .btn-next {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-next:hover {
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit {
            font-family: inherit;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Success Message */
        .success-message {
            display: none;
            text-align: center;
            padding: 60px 40px;
        }

        .success-message.show {
            display: block;
        }

        .success-icon {
            font-size: 5rem;
            color: #48bb78;
            margin-bottom: 20px;
        }

        .success-message h3 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .success-message p {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .career-hero {
                padding: 80px 0 60px;
            }

            .career-hero h1 {
                font-size: 2rem;
            }

            .career-hero p {
                font-size: 1.1rem;
            }

            .form-container {
                padding: 30px 20px;
                margin-top: -40px;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-steps {
                flex-wrap: wrap;
            }

            .step {
                flex: 0 0 50%;
                margin-bottom: 20px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .form-navigation {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    @include('site.cvc.partials.dynamic-page-content')
    <!-- Hero Section -->
    <section class="career-hero">
        <div class="container">
            <div class="career-hero-content">
                <h1>به تیم مستید بپیوندید</h1>
                <p>
                    ما به دنبال افرادی با استعداد، خلاق و پرانگیزه هستیم که بخواهند در کنار ما آینده را بسازند.
                    فرم زیر را تکمیل کنید و بخشی از تیم موفق ما شوید.
                </p>
            </div>
        </div>
    </section>

    <!-- Application Form Section -->
    <section class="application-section">
        <div class="container">
            <div class="form-container">
                <div class="form-header">
                    <h2>فرم درخواست همکاری</h2>
                    <p>لطفاً تمامی فیلدهای مشخص شده با ستاره (*) را با دقت تکمیل نمایید</p>
                </div>

                @if(session('career_success'))
                    <div class="alert alert-success" style="margin-bottom: 24px; padding: 14px 16px; background:#e8f5e9; border:1px solid #a5d6a7; border-radius:10px; color:#1b5e20;">
                        درخواست همکاری شما با موفقیت ثبت شد.
                    </div>
                @endif

                <!-- Form Steps -->
                <div class="form-steps">
                    <div class="step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-title">اطلاعات شخصی</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-title">سوابق تحصیلی</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-title">سوابق شغلی</div>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-title">مدارک و تکمیل</div>
                    </div>
                </div>

                <!-- Application Form -->
                <form id="applicationForm" method="POST" action="{{ route('cvc.career.apply') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Step 1: Personal Information -->
                    <div class="form-section active" data-section="1">
                        <h3 class="section-title">اطلاعات شخصی</h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">
                                    <span class="required">*</span>
                                    نام
                                </label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">
                                    <span class="required">*</span>
                                    نام خانوادگی
                                </label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="national_code">
                                    <span class="required">*</span>
                                    کد ملی
                                </label>
                                <input type="text" id="national_code" name="national_code" class="form-control"
                                       maxlength="10" required>
                            </div>

                            <div class="form-group">
                                <label for="birth_date">
                                    <span class="required">*</span>
                                    تاریخ تولد
                                </label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="gender">
                                    <span class="required">*</span>
                                    جنسیت
                                </label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">انتخاب کنید</option>
                                    <option value="male">مرد</option>
                                    <option value="female">زن</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="marital_status">
                                    <span class="required">*</span>
                                    وضعیت تأهل
                                </label>
                                <select id="marital_status" name="marital_status" class="form-control" required>
                                    <option value="">انتخاب کنید</option>
                                    <option value="single">مجرد</option>
                                    <option value="married">متأهل</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">
                                    <span class="required">*</span>
                                    ایمیل
                                </label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">
                                    <span class="required">*</span>
                                    شماره تماس
                                </label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label for="address">
                                    آدرس محل سکونت
                                </label>
                                <textarea id="address" name="address" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">
                                    <span class="required">*</span>
                                    شهر
                                </label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="province">
                                    <span class="required">*</span>
                                    استان
                                </label>
                                <input type="text" id="province" name="province" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Educational Background -->
                    <div class="form-section" data-section="2">
                        <h3 class="section-title">سوابق تحصیلی</h3>

                        <div class="dynamic-section" id="educationSection">
                            <div class="dynamic-item" data-index="0">
                                <div class="dynamic-item-header">
                                    <div class="dynamic-item-title">مدرک تحصیلی ۱</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            مقطع تحصیلی
                                        </label>
                                        <select name="education[0][degree]" class="form-control" required>
                                            <option value="">انتخاب کنید</option>
                                            <option value="diploma">دیپلم</option>
                                            <option value="associate">کاردانی</option>
                                            <option value="bachelor">کارشناسی</option>
                                            <option value="master">کارشناسی ارشد</option>
                                            <option value="phd">دکتری</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            رشته تحصیلی
                                        </label>
                                        <input type="text" name="education[0][field]" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            نام دانشگاه/موسسه
                                        </label>
                                        <input type="text" name="education[0][university]" class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            معدل
                                        </label>
                                        <input type="text" name="education[0][gpa]" class="form-control"
                                               placeholder="مثال: 17.50" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            سال شروع
                                        </label>
                                        <input type="text" name="education[0][start_year]" class="form-control"
                                               placeholder="مثال: 1395" required>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            سال پایان
                                        </label>
                                        <input type="text" name="education[0][end_year]" class="form-control"
                                               placeholder="مثال: 1399" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="add-item-btn" onclick="addEducation()">
                            <span>➕</span>
                            افزودن مدرک تحصیلی
                        </button>
                    </div>

                    <!-- Step 3: Work Experience -->
                    <div class="form-section" data-section="3">
                        <h3 class="section-title">سوابق شغلی</h3>

                        <div class="dynamic-section" id="experienceSection">
                            <div class="dynamic-item" data-index="0">
                                <div class="dynamic-item-header">
                                    <div class="dynamic-item-title">سابقه شغلی ۱</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            عنوان شغلی
                                        </label>
                                        <input type="text" name="experience[0][job_title]" class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            نام شرکت/سازمان
                                        </label>
                                        <input type="text" name="experience[0][company]" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <span class="required">*</span>
                                            تاریخ شروع
                                        </label>
                                        <input type="month" name="experience[0][start_date]" class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            تاریخ پایان
                                        </label>
                                        <input type="month" name="experience[0][end_date]" class="form-control">
                                        <div class="checkbox-item" style="margin-top: 10px;">
                                            <input type="checkbox" name="experience[0][current]" id="current_0"
                                                   value="1">
                                            <label for="current_0" style="margin: 0;">هم‌اکنون مشغول به کار هستم</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row single">
                                    <div class="form-group">
                                        <label>
                                            شرح وظایف و مسئولیت‌ها
                                        </label>
                                        <textarea name="experience[0][responsibilities]" class="form-control"
                                                  rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="add-item-btn" onclick="addExperience()">
                            <span>➕</span>
                            افزودن سابقه شغلی
                        </button>

                        <div class="form-row single" style="margin-top: 30px;">
                            <div class="form-group">
                                <label>
                                    مهارت‌های تخصصی
                                </label>
                                <textarea name="skills" class="form-control" rows="3"
                                          placeholder="مهارت‌های خود را با ویرگول جدا کنید (مثال: Python, JavaScript, Project Management)"></textarea>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    زبان‌های خارجی
                                </label>
                                <textarea name="languages" class="form-control" rows="2"
                                          placeholder="مثال: انگلیسی (پیشرفته), آلمانی (متوسط)"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Documents & Completion -->
                    <div class="form-section" data-section="4">
                        <h3 class="section-title">مدارک و تکمیل درخواست</h3>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    <span class="required">*</span>
                                    موقعیت شغلی مورد نظر
                                </label>
                                <select name="position" class="form-control" required>
                                    <option value="">انتخاب کنید</option>
                                    <option value="investment_analyst">تحلیلگر سرمایه‌گذاری</option>
                                    <option value="portfolio_manager">مدیر پرتفوی</option>
                                    <option value="financial_analyst">تحلیلگر مالی</option>
                                    <option value="risk_manager">مدیر ریسک</option>
                                    <option value="business_developer">توسعه‌دهنده کسب‌وکار</option>
                                    <option value="marketing_specialist">متخصص بازاریابی</option>
                                    <option value="hr_specialist">متخصص منابع انسانی</option>
                                    <option value="it_specialist">متخصص IT</option>
                                    <option value="legal_advisor">مشاور حقوقی</option>
                                    <option value="other">سایر</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>
                                    <span class="required">*</span>
                                    حقوق درخواستی (تومان)
                                </label>
                                <input type="text" name="expected_salary" class="form-control"
                                       placeholder="مثال: 50000000" required>
                            </div>

                            <div class="form-group">
                                <label>
                                    <span class="required">*</span>
                                    زمان آمادگی برای شروع کار
                                </label>
                                <select name="availability" class="form-control" required>
                                    <option value="">انتخاب کنید</option>
                                    <option value="immediate">فوری</option>
                                    <option value="1week">یک هفته</option>
                                    <option value="2weeks">دو هفته</option>
                                    <option value="1month">یک ماه</option>
                                    <option value="negotiable">قابل مذاکره</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    <span class="required">*</span>
                                    آپلود رزومه (PDF, DOC, DOCX - حداکثر 5MB)
                                </label>
                                <div class="file-upload-wrapper">
                                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx" required
                                           onchange="handleFileSelect(this, 'resume-name')">
                                    <div class="file-upload-icon">📄</div>
                                    <div class="file-upload-text">
                                        <strong>فایل رزومه خود را انتخاب کنید</strong>
                                        <br>
                                        یا آن را به اینجا بکشید
                                    </div>
                                    <div class="file-name" id="resume-name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    آپلود مدارک تحصیلی (اختیاری - PDF, ZIP - حداکثر 10MB)
                                </label>
                                <div class="file-upload-wrapper">
                                    <input type="file" name="documents" id="documents" accept=".pdf,.zip"
                                           onchange="handleFileSelect(this, 'documents-name')">
                                    <div class="file-upload-icon">📎</div>
                                    <div class="file-upload-text">
                                        <strong>فایل مدارک را انتخاب کنید</strong>
                                        <br>
                                        یا آن را به اینجا بکشید
                                    </div>
                                    <div class="file-name" id="documents-name"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    انگیزه و دلیل درخواست همکاری
                                </label>
                                <textarea name="motivation" class="form-control" rows="5"
                                          placeholder="لطفاً دلایل و انگیزه خود برای همکاری با مستید را بنویسید..."></textarea>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <label>
                                    چگونه از موقعیت شغلی مطلع شدید؟
                                </label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" name="source" id="source_website" value="website">
                                        <label for="source_website">وب‌سایت</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="source" id="source_linkedin" value="linkedin">
                                        <label for="source_linkedin">لینکدین</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="source" id="source_jobsite" value="jobsite">
                                        <label for="source_jobsite">سایت‌های کاریابی</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="source" id="source_referral" value="referral">
                                        <label for="source_referral">معرفی دوستان</label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="source" id="source_other" value="other">
                                        <label for="source_other">سایر</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row single">
                            <div class="form-group">
                                <div class="checkbox-item">
                                    <input type="checkbox" name="terms" id="terms" value="1" required>
                                    <label for="terms">
                                        <span class="required">*</span>
                                        اطلاعات وارد شده صحیح است و با قوانین و مقررات موافقم
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Navigation -->
                    <div class="form-navigation">
                        <button type="button" class="btn btn-prev" id="prevBtn" onclick="changeStep(-1)"
                                style="display: none;">
                            ← مرحله قبل
                        </button>
                        <button type="button" class="btn btn-next" id="nextBtn" onclick="changeStep(1)">
                            مرحله بعد →
                        </button>
                        <button type="submit" class="btn btn-submit" id="submitBtn" style="display: none;">
                            ✓ ارسال درخواست
                        </button>
                    </div>
                </form>

                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    <div class="success-icon">✓</div>
                    <h3>درخواست شما با موفقیت ارسال شد!</h3>
                    <p>
                        از اینکه وقت خود را برای تکمیل فرم گذاشتید متشکریم.
                        <br>
                        تیم منابع انسانی ما درخواست شما را بررسی کرده و در اسرع وقت با شما تماس خواهند گرفت.
                    </p>
                    <a href="/" class="btn btn-next">بازگشت به صفحه اصلی</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        let currentStep = 1;
        const totalSteps = 4;
        let educationCount = 1;
        let experienceCount = 1;

        // Change Step Function
        function changeStep(direction) {
            const currentSection = document.querySelector(`.form-section[data-section="${currentStep}"]`);

            // Validate current step before moving forward
            if (direction === 1) {
                const inputs = currentSection.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.borderColor = '#e53e3e';
                    } else {
                        input.style.borderColor = '#e2e8f0';
                    }
                });

                if (!isValid) {
                    alert('لطفاً تمامی فیلدهای الزامی را تکمیل کنید.');
                    return;
                }
            }

            // Update step
            currentStep += direction;

            // Update UI
            updateStepUI();
        }

        function updateStepUI() {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });

            // Show current section
            document.querySelector(`.form-section[data-section="${currentStep}"]`)
                .classList.add('active');

            // Update buttons
            document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'inline-block';
            document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
            document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';

            // Update step indicator
            document.querySelectorAll('.step').forEach(step => {
                const num = parseInt(step.getAttribute('data-step'));
                step.classList.remove('active', 'completed');
                if (num === currentStep) step.classList.add('active');
                if (num < currentStep) step.classList.add('completed');
            });
        }

        // Handle file upload name
        function handleFileSelect(input, targetId) {
            const fileName = input.files.length ? input.files[0].name : '';
            document.getElementById(targetId).textContent = fileName;
        }

        // Add Education Item
        function addEducation() {
            const container = document.getElementById('educationSection');
            const index = educationCount++;

            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.dataset.index = index;

            item.innerHTML = `
                <div class="dynamic-item-header">
                    <div class="dynamic-item-title">مدرک تحصیلی ${index + 1}</div>
                    <button type="button" class="remove-item-btn" onclick="removeItem(this)">✖</button>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> مقطع تحصیلی</label>
                        <select name="education[${index}][degree]" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <option value="diploma">دیپلم</option>
                            <option value="associate">کاردانی</option>
                            <option value="bachelor">کارشناسی</option>
                            <option value="master">کارشناسی ارشد</option>
                            <option value="phd">دکتری</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span class="required">*</span> رشته تحصیلی</label>
                        <input type="text" name="education[${index}][field]" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> دانشگاه</label>
                        <input type="text" name="education[${index}][university]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span class="required">*</span> معدل</label>
                        <input type="text" name="education[${index}][gpa]" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> سال شروع</label>
                        <input type="text" name="education[${index}][start_year]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span class="required">*</span> سال پایان</label>
                        <input type="text" name="education[${index}][end_year]" class="form-control" required>
                    </div>
                </div>
            `;

            container.appendChild(item);
        }

        // Add Experience Item
        function addExperience() {
            const container = document.getElementById('experienceSection');
            const index = experienceCount++;

            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.dataset.index = index;

            item.innerHTML = `
                <div class="dynamic-item-header">
                    <div class="dynamic-item-title">سابقه شغلی ${index + 1}</div>
                    <button type="button" class="remove-item-btn" onclick="removeItem(this)">✖</button>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> عنوان شغلی</label>
                        <input type="text" name="experience[${index}][job_title]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span class="required">*</span> شرکت</label>
                        <input type="text" name="experience[${index}][company]" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> تاریخ شروع</label>
                        <input type="month" name="experience[${index}][start_date]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>تاریخ پایان</label>
                        <input type="month" name="experience[${index}][end_date]" class="form-control">
                        <div class="checkbox-item" style="margin-top: 10px;">
                            <input type="checkbox" name="experience[${index}][current]" id="current_${index}">
                            <label for="current_${index}">هم‌اکنون مشغولم</label>
                        </div>
                    </div>
                </div>

                <div class="form-row single">
                    <div class="form-group">
                        <label>شرح وظایف</label>
                        <textarea name="experience[${index}][responsibilities]" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            `;

            container.appendChild(item);
        }

        // Remove dynamic item
        function removeItem(button) {
            button.closest('.dynamic-item').remove();
        }

    </script>

@endsection


