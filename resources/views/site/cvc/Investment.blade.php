@extends('site.layouts.base2')

@section('title', 'درخواست سرمایه - شرکت سرمایه‌گذاری')

@section('styles')
    <style>

        /* Hero Section */
        .investment-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 20px 60px;
            text-align: center;
            color: white;
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
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .investment-hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .investment-hero p {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            line-height: 1.8;
        }

        /* Container */
        .investment-container {
            max-width: 1200px;
            margin: -40px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        /* Progress Steps */
        .progress-steps {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .step {
            flex: 1;
            min-width: 150px;
            text-align: center;
            position: relative;
        }

        .step::after {
            content: '';
            position: absolute;
            top: 20px;
            right: -50%;
            width: 100%;
            height: 3px;
            background: #e0e0e0;
            z-index: -1;
        }

        .step:last-child::after {
            display: none;
        }

        .step-number {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #e0e0e0;
            color: #666;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .step.completed .step-number {
            background: #10b981;
            color: white;
        }


        .step-title {
            font-size: 0.95rem;
            color: #666;
            font-weight: 600;
        }

        .step.active .step-title {
            color: #667eea;
        }

        .step.completed .step-title {
            color: #10b981;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            font-size: 1.8rem;
            color: #1f2937;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .section-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Form Groups */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group label .required {
            color: #ef4444;
            margin-right: 3px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        select.form-control {
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 15px center;
            padding-left: 40px;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #f9fafb;
        }

        .file-upload-wrapper:hover {
            border-color: #667eea;
            background: #f3f4ff;
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
            color: #9ca3af;
            margin-bottom: 10px;
        }

        .file-upload-text {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .file-upload-text strong {
            color: #667eea;
        }

        .file-name {
            margin-top: 10px;
            padding: 8px 12px;
            background: #e0e7ff;
            border-radius: 6px;
            color: #667eea;
            font-size: 0.9rem;
            display: inline-block;
        }

        /* Radio & Checkbox */
        .radio-group, .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .radio-item, .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-item input[type="radio"],
        .checkbox-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .radio-item label,
        .checkbox-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 500;
        }

        /* Dynamic Fields */
        .dynamic-section {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            background: #f9fafb;
            position: relative;
        }

        .dynamic-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dynamic-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
        }

        .btn-remove {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-add {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        /* Navigation Buttons */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-prev {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-prev:hover {
            background: #d1d5db;
            transform: translateX(5px);
        }

        .btn-next, .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-next:hover, .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .btn-submit:hover {
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        /* Success Message */
        .success-message {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }

        .success-message.show {
            display: block;
            animation: fadeInUp 0.5s ease;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin-bottom: 20px;
        }

        .success-message h2 {
            font-size: 2rem;
            color: #1f2937;
            margin-bottom: 15px;
        }

        .success-message p {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%);
            border-right: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .info-box-title {
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .info-box ul {
            margin: 0;
            padding-right: 20px;
            color: #4b5563;
        }

        .info-box li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .investment-hero h1 {
                font-size: 2rem;
            }

            .investment-hero p {
                font-size: 1rem;
            }

            .form-card {
                padding: 25px;
            }

            .progress-steps {
                padding: 20px;
            }

            .step {
                min-width: 100px;
            }

            .step-title {
                font-size: 0.85rem;
            }

            .form-navigation {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* اصلاح بخش form-control */
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
            background-color: white; /* اضافه شد */
            color: #1f2937; /* اضافه شد */
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* اصلاح select */
        select.form-control {
            cursor: pointer;
            appearance: none; /* اضافه شد - حذف استایل پیش‌فرض مرورگر */
            -webkit-appearance: none; /* اضافه شد */
            -moz-appearance: none; /* اضافه شد */
            background-color: white;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 15px center;
            padding-left: 40px;
            padding-right: 15px; /* اضافه شد */
        }

        select.form-control:focus {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        }

        /* اصلاح textarea */
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6; /* اضافه شد */
        }

        /* اصلاح input[type="file"] */
        input[type="file"].form-control {
            padding: 10px; /* اضافه شد */
            cursor: pointer; /* اضافه شد */
        }

        /* اصلاح دکمه‌ها - حذف تکرار و یکپارچه‌سازی */
        .btn,
        .btn-prev,
        .btn-next,
        .btn-submit {
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center; /* اضافه شد */
            gap: 8px;
            font-family: inherit; /* اضافه شد */
            text-decoration: none; /* اضافه شد */
            line-height: 1.5; /* اضافه شد */
        }

        .btn:disabled,
        .btn-prev:disabled,
        .btn-next:disabled,
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        .btn-prev {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-prev:hover:not(:disabled) {
            background: #d1d5db;
            transform: translateX(5px);
        }

        .btn-next {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-next:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-size: 1.1rem; /* اضافه شد */
            padding: 16px 40px; /* اضافه شد */
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        /* اصلاح btn-add */
        .btn-add {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center; /* اضافه شد */
            gap: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: inherit; /* اضافه شد */
        }

        .btn-add:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-add:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* اصلاح btn-remove */
        .btn-remove {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600; /* اضافه شد */
            transition: all 0.3s ease;
            font-family: inherit; /* اضافه شد */
            display: inline-flex; /* اضافه شد */
            align-items: center; /* اضافه شد */
            gap: 5px; /* اضافه شد */
        }

        .btn-remove:hover:not(:disabled) {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-remove:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* اضافه کردن استایل برای form tag */
        #investmentForm {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* اصلاح Radio & Checkbox */
        .radio-group,
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px; /* اضافه شد */
        }

        .radio-item,
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px; /* اضافه شد */
            border-radius: 6px; /* اضافه شد */
            transition: background 0.2s ease; /* اضافه شد */
        }

        .radio-item:hover,
        .checkbox-item:hover {
            background: #f3f4f6; /* اضافه شد */
        }

        .radio-item input[type="radio"],
        .checkbox-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #667eea;
            flex-shrink: 0; /* اضافه شد */
        }

        .radio-item label,
        .checkbox-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 500;
            color: #374151; /* اضافه شد */
            user-select: none; /* اضافه شد */
        }

        /* اضافه کردن استایل برای input number */
        input[type="number"].form-control {
            -moz-appearance: textfield;
        }

        input[type="number"].form-control::-webkit-outer-spin-button,
        input[type="number"].form-control::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* اضافه کردن استایل برای placeholder */
        .form-control::placeholder {
            color: #9ca3af;
            opacity: 1;
        }

        .form-control:focus::placeholder {
            opacity: 0.5;
        }

        /* اصلاح file upload */
        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #f9fafb;
        }

        .file-upload-wrapper:hover {
            border-color: #667eea;
            background: #f3f4ff;
        }

        .file-upload-wrapper.has-file { /* اضافه شد */
            border-color: #10b981;
            background: #f0fdf4;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2; /* اضافه شد */
        }

        /* اضافه کردن استایل برای validation errors */
        .form-control.error {
            border-color: #ef4444;
        }

        .form-control.error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* اضافه کردن استایل برای loading state */
        .btn.loading {
            position: relative;
            color: transparent;
            pointer-events: none;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spinner 0.6s linear infinite;
        }

        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }

        /* اصلاح responsive */
        @media (max-width: 768px) {
            .investment-hero h1 {
                font-size: 2rem;
            }

            .investment-hero p {
                font-size: 1rem;
            }

            #investmentForm { /* تغییر از .form-card */
                padding: 25px;
            }

            .progress-steps {
                padding: 20px;
            }

            .step {
                min-width: 100px;
            }

            .step-title {
                font-size: 0.85rem;
            }

            .form-navigation {
                flex-direction: column;
            }

            .btn,
            .btn-prev,
            .btn-next,
            .btn-submit {
                width: 100%;
                justify-content: center;
            }

            .form-row {
                grid-template-columns: 1fr; /* اضافه شد */
            }

            select.form-control {
                background-position: left 10px center; /* اضافه شد */
                padding-left: 35px; /* اضافه شد */
            }
        }

        @media (max-width: 480px) {
            .investment-hero {
                padding: 60px 15px 40px;
            }

            .investment-hero h1 {
                font-size: 1.5rem;
            }

            #investmentForm {
                padding: 20px;
            }

            .section-title {
                font-size: 1.4rem;
            }

            .btn-submit {
                font-size: 1rem;
                padding: 14px 32px;
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
    <div class="investment-hero">
        <h1>درخواست سرمایه‌گذاری</h1>
        <p>با تکمیل این فرم، درخواست خود را برای دریافت سرمایه از شرکت ما ثبت کنید. تیم ما درخواست شما را بررسی کرده و
            در اسرع وقت با شما تماس خواهد گرفت.</p>
    </div>

    <div class="investment-container">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-title">اطلاعات کسب‌وکار</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-title">اطلاعات مالی</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-title">جزئیات سرمایه</div>
            </div>
            <div class="step" data-step="4">
                <div class="step-number">4</div>
                <div class="step-title">تیم و بازار</div>
            </div>
            <div class="step" data-step="5">
                <div class="step-number">5</div>
                <div class="step-title">مدارک و تکمیل</div>
            </div>
        </div>

        <form id="investmentForm" method="POST" action="#" enctype="multipart/form-data">
            @csrf

            <!-- Step 1: اطلاعات کسب‌وکار -->
            <div class="form-section active" data-section="1">
                <h2 class="section-title">اطلاعات کسب‌وکار</h2>
                <p class="section-subtitle">لطفاً اطلاعات کامل و دقیق کسب‌وکار خود را وارد کنید.</p>

                <div class="info-box">
                    <div class="info-box-title">📋 نکات مهم:</div>
                    <ul>
                        <li>تمامی فیلدهای دارای ستاره (*) الزامی هستند</li>
                        <li>اطلاعات وارد شده باید دقیق و قابل بررسی باشد</li>
                        <li>نام تجاری باید با مدارک ثبتی مطابقت داشته باشد</li>
                    </ul>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> نام شرکت/استارتاپ</label>
                        <input type="text" name="company_name" class="form-control" required
                               placeholder="مثال: شرکت فناوری نوآوران">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> نام تجاری (Brand Name)</label>
                        <input type="text" name="brand_name" class="form-control" required
                               placeholder="مثال: Noavaran Tech">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> شماره ثبت/شناسه ملی</label>
                        <input type="text" name="registration_number" class="form-control" required
                               placeholder="مثال: 10320123456">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> تاریخ تاسیس</label>
                        <input type="text" name="establishment_date" class="form-control" required
                               placeholder="مثال: 1400/05/15">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> صنعت/حوزه فعالیت</label>
                        <select name="industry" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <option value="fintech">فین‌تک (Fintech)</option>
                            <option value="healthtech">هلث‌تک (HealthTech)</option>
                            <option value="edtech">ادتک (EdTech)</option>
                            <option value="ecommerce">تجارت الکترونیک</option>
                            <option value="ai">هوش مصنوعی</option>
                            <option value="blockchain">بلاکچین و کریپتو</option>
                            <option value="iot">اینترنت اشیا (IoT)</option>
                            <option value="saas">نرم‌افزار به عنوان سرویس (SaaS)</option>
                            <option value="logistics">لجستیک و حمل‌ونقل</option>
                            <option value="food">صنایع غذایی</option>
                            <option value="energy">انرژی و محیط زیست</option>
                            <option value="entertainment">سرگرمی و رسانه</option>
                            <option value="other">سایر</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> مرحله کسب‌وکار</label>
                        <select name="business_stage" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <option value="idea">ایده (Idea Stage)</option>
                            <option value="prototype">نمونه اولیه (Prototype)</option>
                            <option value="mvp">محصول حداقلی (MVP)</option>
                            <option value="early">مرحله اولیه (Early Stage)</option>
                            <option value="growth">مرحله رشد (Growth Stage)</option>
                            <option value="expansion">مرحله توسعه (Expansion)</option>
                            <option value="mature">بالغ (Mature)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> وب‌سایت</label>
                    <input type="url" name="website" class="form-control" required placeholder="https://example.com">
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> آدرس دفتر مرکزی</label>
                    <textarea name="address" class="form-control" required
                              placeholder="آدرس کامل شامل شهر، خیابان، پلاک و کدپستی"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> تلفن ثابت</label>
                        <input type="tel" name="phone" class="form-control" required placeholder="021-12345678">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> ایمیل رسمی شرکت</label>
                        <input type="email" name="company_email" class="form-control" required
                               placeholder="info@company.com">
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> توضیحات کسب‌وکار (Business Description)</label>
                    <textarea name="business_description" class="form-control" required
                              placeholder="توضیح کامل درباره محصول/خدمات، مشتریان هدف، مزیت رقابتی و ارزش پیشنهادی شما (حداقل 200 کاراکتر)"
                              style="min-height: 150px;"></textarea>
                </div>

                <div class="form-group">
                    <label>مشکل/نیازی که حل می‌کنید (Problem Statement)</label>
                    <textarea name="problem_statement" class="form-control"
                              placeholder="چه مشکل یا نیاز بازاری را شناسایی کرده‌اید و چگونه آن را حل می‌کنید؟"
                              style="min-height: 120px;"></textarea>
                </div>

                <div class="form-group">
                    <label>راه‌حل پیشنهادی (Solution)</label>
                    <textarea name="solution" class="form-control"
                              placeholder="محصول یا خدمات شما چگونه این مشکل را حل می‌کند؟"
                              style="min-height: 120px;"></textarea>
                </div>
            </div>

            <!-- Step 2: اطلاعات مالی -->
            <div class="form-section" data-section="2">
                <h2 class="section-title">اطلاعات مالی</h2>
                <p class="section-subtitle">اطلاعات مالی دقیق کسب‌وکار خود را وارد کنید.</p>

                <div class="info-box">
                    <div class="info-box-title">💰 نکات مهم:</div>
                    <ul>
                        <li>تمامی مبالغ را به تومان وارد کنید</li>
                        <li>اطلاعات مالی باید با مدارک حسابداری مطابقت داشته باشد</li>
                        <li>در صورت عدم وجود درآمد، عدد صفر وارد کنید</li>
                    </ul>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> درآمد سال جاری (تومان)</label>
                        <input type="number" name="current_revenue" class="form-control" required
                               placeholder="مثال: 5000000000" min="0">
                    </div>
                    <div class="form-group">
                        <label>درآمد سال گذشته (تومان)</label>
                        <input type="number" name="last_year_revenue" class="form-control"
                               placeholder="مثال: 3000000000"
                               min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> هزینه‌های عملیاتی ماهانه (تومان)</label>
                        <input type="number" name="monthly_expenses" class="form-control" required
                               placeholder="مثال: 200000000" min="0">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> سود/زیان خالص سال جاری (تومان)</label>
                        <input type="number" name="net_profit" class="form-control" required
                               placeholder="مثال: 500000000 یا -100000000">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>دارایی‌های جاری (تومان)</label>
                        <input type="number" name="current_assets" class="form-control" placeholder="مثال: 1000000000"
                               min="0">
                    </div>
                    <div class="form-group">
                        <label>بدهی‌های جاری (تومان)</label>
                        <input type="number" name="current_liabilities" class="form-control"
                               placeholder="مثال: 500000000"
                               min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> نرخ رشد ماهانه (درصد)</label>
                        <input type="number" name="monthly_growth_rate" class="form-control" required
                               placeholder="مثال: 15"
                               step="0.1" min="0">
                    </div>
                    <div class="form-group">
                        <label>Burn Rate ماهانه (تومان)</label>
                        <input type="number" name="burn_rate" class="form-control" placeholder="مثال: 150000000"
                               min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>تعداد مشتریان فعال</label>
                        <input type="number" name="active_customers" class="form-control" placeholder="مثال: 5000"
                               min="0">
                    </div>
                    <div class="form-group">
                        <label>میانگین درآمد هر مشتری (ARPU)</label>
                        <input type="number" name="arpu" class="form-control" placeholder="مثال: 500000" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>هزینه جذب مشتری (CAC)</label>
                        <input type="number" name="cac" class="form-control" placeholder="مثال: 200000" min="0">
                    </div>
                    <div class="form-group">
                        <label>ارزش طول عمر مشتری (LTV)</label>
                        <input type="number" name="ltv" class="form-control" placeholder="مثال: 2000000" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>آیا قبلاً سرمایه دریافت کرده‌اید؟</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" name="previous_funding" id="funding_yes" value="yes">
                            <label for="funding_yes">بله</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" name="previous_funding" id="funding_no" value="no" checked>
                            <label for="funding_no">خیر</label>
                        </div>
                    </div>
                </div>

                <div id="previousFundingDetails" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label>مبلغ سرمایه قبلی (تومان)</label>
                            <input type="number" name="previous_funding_amount" class="form-control"
                                   placeholder="مثال: 10000000000" min="0">
                        </div>
                        <div class="form-group">
                            <label>نوع سرمایه‌گذاری قبلی</label>
                            <select name="previous_funding_type" class="form-control">
                                <option value="">انتخاب کنید</option>
                                <option value="seed">Seed</option>
                                <option value="series_a">Series A</option>
                                <option value="series_b">Series B</option>
                                <option value="series_c">Series C+</option>
                                <option value="angel">Angel Investment</option>
                                <option value="venture">Venture Capital</option>
                                <option value="loan">وام بانکی</option>
                                <option value="grant">کمک بلاعوض</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>نام سرمایه‌گذاران قبلی</label>
                        <textarea name="previous_investors" class="form-control"
                                  placeholder="نام سرمایه‌گذاران یا شرکت‌های سرمایه‌گذاری قبلی"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>توضیحات مالی تکمیلی</label>
                    <textarea name="financial_notes" class="form-control"
                              placeholder="هر گونه توضیح اضافی درباره وضعیت مالی، پیش‌بینی درآمد، یا نکات مهم مالی"></textarea>
                </div>
            </div>


            <!-- Step 3: جزئیات سرمایه -->
            <div class="form-section" data-section="3">
                <h2 class="section-title">جزئیات سرمایه درخواستی</h2>
                <p class="section-subtitle">مشخص کنید چه مقدار سرمایه نیاز دارید و چگونه از آن استفاده خواهید کرد.</p>

                <div class="info-box">
                    <div class="info-box-title">📊 نکات مهم:</div>
                    <ul>
                        <li>مبلغ درخواستی باید با برنامه کسب‌وکار شما همخوانی داشته باشد</li>
                        <li>نحوه مصرف سرمایه باید شفاف و قابل توجیه باشد</li>
                        <li>ارزش‌گذاری باید بر اساس معیارهای واقعی بازار باشد</li>
                    </ul>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> مبلغ سرمایه درخواستی (تومان)</label>
                        <input type="number" name="requested_amount" class="form-control" required
                               placeholder="مثال: 50000000000" min="0">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> نوع سرمایه‌گذاری مورد نظر</label>
                        <select name="investment_type" class="form-control" required>
                            <option value="">انتخاب کنید</option>
                            <option value="equity">سهامی (Equity)</option>
                            <option value="convertible">اوراق قابل تبدیل (Convertible Note)</option>
                            <option value="revenue_share">تقسیم درآمد (Revenue Share)</option>
                            <option value="debt">وام (Debt Financing)</option>
                            <option value="hybrid">ترکیبی (Hybrid)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> درصد سهام پیشنهادی</label>
                        <input type="number" name="equity_percentage" class="form-control" required
                               placeholder="مثال: 15"
                               min="0" max="100" step="0.1">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> ارزش‌گذاری پیش از سرمایه (Pre-money Valuation)</label>
                        <input type="number" name="pre_money_valuation" class="form-control" required
                               placeholder="مثال: 300000000000" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>بازه زمانی مورد نیاز برای سرمایه</label>
                        <select name="funding_timeline" class="form-control">
                            <option value="">انتخاب کنید</option>
                            <option value="immediate">فوری (کمتر از ۱ ماه)</option>
                            <option value="1_3months">۱ تا ۳ ماه آینده</option>
                            <option value="3_6months">۳ تا ۶ ماه آینده</option>
                            <option value="6_12months">۶ تا ۱۲ ماه آینده</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>دوره بازگشت سرمایه پیش‌بینی شده</label>
                        <select name="roi_period" class="form-control">
                            <option value="">انتخاب کنید</option>
                            <option value="1year">کمتر از ۱ سال</option>
                            <option value="2years">۱ تا ۲ سال</option>
                            <option value="3years">۲ تا ۳ سال</option>
                            <option value="5years">۳ تا ۵ سال</option>
                            <option value="5plus">بیشتر از ۵ سال</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> نحوه مصرف سرمایه</label>
                    <p style="color:#6b7280; font-size:0.9rem; margin-bottom:15px;">درصد تخصیص سرمایه به هر بخش را مشخص
                        کنید
                        (جمع باید ۱۰۰٪ باشد)</p>

                    <div id="fundingAllocation">
                        <div class="dynamic-section">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>بخش هزینه</label>
                                    <select name="allocation_category[]" class="form-control">
                                        <option value="">انتخاب کنید</option>
                                        <option value="product">توسعه محصول</option>
                                        <option value="marketing">بازاریابی و فروش</option>
                                        <option value="hr">استخدام و منابع انسانی</option>
                                        <option value="infrastructure">زیرساخت و تجهیزات</option>
                                        <option value="operations">عملیات</option>
                                        <option value="rd">تحقیق و توسعه</option>
                                        <option value="legal">حقوقی و اداری</option>
                                        <option value="other">سایر</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>درصد تخصیص</label>
                                    <input type="number" name="allocation_percentage[]" class="form-control"
                                           placeholder="مثال: 40" min="0" max="100">
                                </div>
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <input type="text" name="allocation_description[]" class="form-control"
                                           placeholder="توضیح مختصر">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-add" onclick="addAllocation()">
                        ➕ افزودن بخش هزینه
                    </button>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> اهداف ۱۲ ماه آینده پس از دریافت سرمایه</label>
                    <textarea name="goals_12months" class="form-control" required
                              placeholder="اهداف کمی و کیفی خود را برای ۱۲ ماه آینده شرح دهید"
                              style="min-height: 130px;"></textarea>
                </div>

                <div class="form-group">
                    <label>استراتژی خروج (Exit Strategy)</label>
                    <select name="exit_strategy" class="form-control">
                        <option value="">انتخاب کنید</option>
                        <option value="ipo">عرضه عمومی اولیه (IPO)</option>
                        <option value="acquisition">خرید توسط شرکت بزرگ‌تر (Acquisition)</option>
                        <option value="buyback">بازخرید سهام (Buyback)</option>
                        <option value="merger">ادغام (Merger)</option>
                        <option value="secondary">فروش ثانویه (Secondary Sale)</option>
                        <option value="undecided">هنوز تصمیم نگرفته‌ام</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>انتظارات از سرمایه‌گذار (علاوه بر سرمایه)</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="mentorship" value="mentorship">
                            <label for="mentorship">مشاوره و منتورشیپ</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="network" value="network">
                            <label for="network">شبکه ارتباطی</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="market_access" value="market_access">
                            <label for="market_access">دسترسی به بازار</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="tech_support" value="tech_support">
                            <label for="tech_support">پشتیبانی فنی</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="legal_support" value="legal_support">
                            <label for="legal_support">پشتیبانی حقوقی</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="investor_support[]" id="hr_support" value="hr_support">
                            <label for="hr_support">کمک در استخدام</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: تیم و بازار -->
            <div class="form-section" data-section="4">
                <h2 class="section-title">تیم و تحلیل بازار</h2>
                <p class="section-subtitle">اطلاعات تیم مدیریتی و تحلیل بازار هدف خود را وارد کنید.</p>

                <!-- اعضای تیم -->
                <h3 style="font-size:1.3rem; color:#374151; margin-bottom:20px; padding-bottom:10px; border-bottom:2px solid #e5e7eb;">
                    👥 اعضای کلیدی تیم
                </h3>

                <div id="teamMembers">
                    <div class="dynamic-section">
                        <div class="dynamic-section-header">
                            <span class="dynamic-section-title">عضو تیم ۱</span>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label><span class="required">*</span> نام و نام خانوادگی</label>
                                <input type="text" name="member_name[]" class="form-control" required
                                       placeholder="مثال: علی محمدی">
                            </div>
                            <div class="form-group">
                                <label><span class="required">*</span> سمت</label>
                                <input type="text" name="member_role[]" class="form-control" required
                                       placeholder="مثال: مدیرعامل (CEO)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>تحصیلات</label>
                                <input type="text" name="member_education[]" class="form-control"
                                       placeholder="مثال: کارشناسی ارشد مهندسی نرم‌افزار - دانشگاه تهران">
                            </div>
                            <div class="form-group">
                                <label>سال‌های تجربه</label>
                                <input type="number" name="member_experience[]" class="form-control"
                                       placeholder="مثال: 8"
                                       min="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>لینک LinkedIn</label>
                            <input type="url" name="member_linkedin[]" class="form-control"
                                   placeholder="https://linkedin.com/in/username">
                        </div>
                        <div class="form-group">
                            <label>خلاصه سوابق</label>
                            <textarea name="member_bio[]" class="form-control"
                                      placeholder="خلاصه‌ای از سوابق و دستاوردهای این عضو"></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-add" onclick="addTeamMember()">
                    ➕ افزودن عضو تیم
                </button>

                <!-- تحلیل بازار -->
                <h3 style="font-size:1.3rem; color:#374151; margin:35px 0 20px; padding-bottom:10px; border-bottom:2px solid #e5e7eb;">
                    📈 تحلیل بازار
                </h3>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> حجم کل بازار (TAM) - تومان</label>
                        <input type="number" name="tam" class="form-control" required placeholder="مثال: 10000000000000"
                               min="0">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> بازار قابل دسترس (SAM) - تومان</label>
                        <input type="number" name="sam" class="form-control" required placeholder="مثال: 2000000000000"
                               min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> بازار هدف (SOM) - تومان</label>
                        <input type="number" name="som" class="form-control" required placeholder="مثال: 500000000000"
                               min="0">
                    </div>
                    <div class="form-group">
                        <label>سهم بازار فعلی (درصد)</label>
                        <input type="number" name="market_share" class="form-control" placeholder="مثال: 2.5" step="0.1"
                               min="0" max="100">
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> رقبای اصلی</label>
                    <textarea name="competitors" class="form-control" required
                              placeholder="نام رقبای اصلی و مزیت رقابتی شما نسبت به آن‌ها را شرح دهید"
                              style="min-height:120px;"></textarea>
                </div>

                <div class="form-group">
                    <label>مشتریان هدف (Target Customers)</label>
                    <textarea name="target_customers" class="form-control"
                              placeholder="پروفایل دقیق مشتریان هدف خود را توصیف کنید (سن، شغل، نیازها، رفتار خرید و...)"
                              style="min-height:120px;"></textarea>
                </div>

                <div class="form-group">
                    <label>کانال‌های توزیع و فروش</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="direct" value="direct">
                            <label for="direct">فروش مستقیم</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="online" value="online">
                            <label for="online">فروش آنلاین</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="reseller" value="reseller">
                            <label for="reseller">نمایندگی و توزیع</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="b2b" value="b2b">
                            <label for="b2b">B2B</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="b2c" value="b2c">
                            <label for="b2c">B2C</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="sales_channels[]" id="marketplace" value="marketplace">
                            <label for="marketplace">مارکت‌پلیس</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>مزیت رقابتی پایدار (Sustainable Competitive Advantage)</label>
                    <textarea name="competitive_advantage" class="form-control"
                              placeholder="چه مزیت رقابتی پایداری دارید که رقبا به سختی می‌توانند آن را کپی کنند؟"
                              style="min-height:120px;"></textarea>
                </div>

                <div class="form-group">
                    <label>ریسک‌های اصلی و راهکارها</label>
                    <textarea name="risks" class="form-control"
                              placeholder="ریسک‌های اصلی کسب‌وکار و راهکارهای مقابله با آن‌ها را شرح دهید"
                              style="min-height:120px;"></textarea>
                </div>
            </div>

            <!-- Step 5: مدارک و تکمیل -->
            <div class="form-section" data-section="5">
                <h2 class="section-title">مدارک و تکمیل درخواست</h2>
                <p class="section-subtitle">مدارک مورد نیاز را بارگذاری کرده و اطلاعات تماس خود را وارد کنید.</p>

                <div class="info-box">
                    <div class="info-box-title">📎 مدارک مورد نیاز:</div>
                    <ul>
                        <li>طرح کسب‌وکار (Business Plan) - فرمت PDF</li>
                        <li>صورت‌های مالی (حداقل ۱ سال گذشته) - فرمت PDF یا Excel</li>
                        <li>ارائه سرمایه‌گذاری (Pitch Deck) - فرمت PDF یا PPT</li>
                        <li>اساسنامه و مدارک ثبتی شرکت - فرمت PDF</li>
                    </ul>
                </div>

                <!-- اطلاعات تماس -->
                <h3 style="font-size:1.3rem; color:#374151; margin-bottom:20px; padding-bottom:10px; border-bottom:2px solid #e5e7eb;">
                    📞 اطلاعات تماس نماینده
                </h3>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> نام و نام خانوادگی</label>
                        <input type="text" name="contact_name" class="form-control" required
                               placeholder="مثال: علی محمدی">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> سمت در شرکت</label>
                        <input type="text" name="contact_position" class="form-control" required
                               placeholder="مثال: مدیرعامل">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><span class="required">*</span> شماره موبایل</label>
                        <input type="tel" name="contact_mobile" class="form-control" required placeholder="09123456789">
                    </div>
                    <div class="form-group">
                        <label><span class="required">*</span> ایمیل</label>
                        <input type="email" name="contact_email" class="form-control" required
                               placeholder="name@company.com">
                    </div>
                </div>

                <!-- آپلود مدارک -->
                <h3 style="font-size:1.3rem; color:#374151; margin:30px 0 20px; padding-bottom:10px; border-bottom:2px solid #e5e7eb;">
                    📁 بارگذاری مدارک
                </h3>

                <div class="form-group">
                    <label><span class="required">*</span> طرح کسب‌وکار (Business Plan)</label>
                    <div class="file-upload-wrapper" id="businessPlanWrapper">
                        <input type="file" name="business_plan" accept=".pdf,.doc,.docx"
                               onchange="updateFileName(this, 'businessPlanName')">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">
                            <strong>کلیک کنید</strong> یا فایل را اینجا بکشید<br>
                            <small>PDF, DOC, DOCX - حداکثر ۱۰ مگابایت</small>
                        </div>
                        <div id="businessPlanName"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> ارائه سرمایه‌گذاری (Pitch Deck)</label>
                    <div class="file-upload-wrapper" id="pitchDeckWrapper">
                        <input type="file" name="pitch_deck" accept=".pdf,.ppt,.pptx"
                               onchange="updateFileName(this, 'pitchDeckName')">
                        <div class="file-upload-icon">📊</div>
                        <div class="file-upload-text">
                            <strong>کلیک کنید</strong> یا فایل را اینجا بکشید<br>
                            <small>PDF, PPT, PPTX - حداکثر ۲۰ مگابایت</small>
                        </div>
                        <div id="pitchDeckName"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label><span class="required">*</span> صورت‌های مالی</label>
                    <div class="file-upload-wrapper" id="financialWrapper">
                        <input type="file" name="financial_statements" accept=".pdf,.xls,.xlsx"
                               onchange="updateFileName(this, 'financialName')">
                        <div class="file-upload-icon">💰</div>
                        <div class="file-upload-text">
                            <strong>کلیک کنید</strong> یا فایل را اینجا بکشید<br>
                            <small>PDF, XLS, XLSX - حداکثر ۱۰ مگابایت</small>
                        </div>
                        <div id="financialName"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>مدارک ثبتی شرکت</label>
                    <div class="file-upload-wrapper" id="registrationWrapper">
                        <input type="file" name="registration_docs" accept=".pdf"
                               onchange="updateFileName(this, 'registrationName')">
                        <div class="file-upload-icon">📋</div>
                        <div class="file-upload-text">
                            <strong>کلیک کنید</strong> یا فایل را اینجا بکشید<br>
                            <small>PDF - حداکثر ۱۰ مگابایت</small>
                        </div>
                        <div id="registrationName"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>سایر مدارک (اختیاری)</label>
                    <div class="file-upload-wrapper" id="otherDocsWrapper">
                        <input type="file" name="other_docs[]" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" multiple
                               onchange="updateFileName(this, 'otherDocsName')">
                        <div class="file-upload-icon">📂</div>
                        <div class="file-upload-text">
                            <strong>کلیک کنید</strong> یا فایل را اینجا بکشید<br>
                            <small>امکان انتخاب چند فایل - حداکثر ۵۰ مگابایت</small>
                        </div>
                        <div id="otherDocsName"></div>
                    </div>
                </div>

                <!-- توضیحات نهایی -->
                <div class="form-group">
                    <label>توضیحات تکمیلی</label>
                    <textarea name="additional_notes" class="form-control"
                              placeholder="هر گونه اطلاعات اضافی که فکر می‌کنید برای بررسی درخواست شما مفید است"
                              style="min-height:120px;"></textarea>
                </div>

                <!-- قوانین -->
                <div class="form-group">
                    <div
                        style="background:#f9fafb; border:2px solid #e5e7eb; border-radius:10px; padding:20px; margin-bottom:20px;">
                        <h4 style="color:#374151; margin-bottom:15px;">📜 شرایط و قوانین</h4>
                        <div
                            style="color:#6b7280; font-size:0.95rem; line-height:1.8; max-height:150px; overflow-y:auto; padding-left:10px;">
                            <p>با ارسال این فرم، تأیید می‌کنید که:</p>
                            <ul style="padding-right:20px; margin-top:10px;">
                                <li>تمامی اطلاعات ارائه شده صحیح و دقیق است</li>
                                <li>مجاز به ارائه این اطلاعات از طرف شرکت هستید</li>
                                <li>اطلاعات ارائه شده محرمانه تلقی می‌شود</li>
                                <li>شرکت سرمایه‌گذاری حق بررسی و رد درخواست را دارد</li>
                                <li>فرآیند بررسی ممکن است ۲ تا ۴ هفته کاری زمان ببرد
                                </li>
                            </ul>
                        </div>

                        <div style="margin-top:15px;">
                            <input type="checkbox" id="acceptTerms" name="accept_terms" required>
                            <label for="acceptTerms" style="margin-right:8px; cursor:pointer;">
                                <span class="required">*</span>
                                تمامی شرایط و قوانین را مطالعه کرده و می‌پذیرم
                            </label>
                        </div>
                    </div>
                </div>

                <!-- دکمه ارسال نهایی -->
                <div style="text-align:center; margin-top:40px;">
                    <button type="submit" class="btn-submit">
                        🚀 ارسال نهایی درخواست سرمایه
                    </button>
                    <p style="color:#6b7280; font-size:0.9rem; margin-top:15px;">
                        پس از ارسال، ایمیل تأیید برای شما ارسال خواهد شد
                    </p>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-navigation">
                <button type="button" class="btn-prev" onclick="prevStep()">قبلی</button>
                <button type="button" class="btn-next" onclick="nextStep()">بعدی</button>
            </div>

        </form>

    </div>
    <!-- Form Card -->

@endsection

{{-- Scripts --}}
<script>
    let currentStep = 1;
    const totalSteps = 5;

    function showStep(step) {
        document.querySelectorAll('.form-section').forEach(section => {
            section.classList.remove('active');
            if (parseInt(section.dataset.section) === step) {
                section.classList.add('active');
            }
        });

        document.querySelectorAll('.step').forEach((el, index) => {
            el.classList.remove('active', 'completed');
            if (index + 1 < step) el.classList.add('completed');
            if (index + 1 === step) el.classList.add('active');
        });

        document.querySelector('.btn-prev').style.display = step === 1 ? 'none' : 'inline-flex';
        document.querySelector('.btn-next').style.display = step === totalSteps ? 'none' : 'inline-flex';
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    }

    /* Dynamic Allocation */
    function addAllocation() {
        const container = document.getElementById('fundingAllocation');
        const clone = container.firstElementChild.cloneNode(true);
        clone.querySelectorAll('input, select').forEach(el => el.value = '');
        container.appendChild(clone);
    }

    /* Dynamic Team Members */
    function addTeamMember() {
        const container = document.getElementById('teamMembers');
        const index = container.children.length + 1;
        const clone = container.firstElementChild.cloneNode(true);

        clone.querySelector('.dynamic-section-title').innerText = `عضو تیم ${index}`;
        clone.querySelectorAll('input, textarea').forEach(el => el.value = '');

        container.appendChild(clone);
    }

    /* File name preview */
    function updateFileName(input, targetId) {
        const target = document.getElementById(targetId);
        if (!target) return;

        if (input.files.length === 1) {
            target.innerText = `📎 ${input.files[0].name}`;
        } else if (input.files.length > 1) {
            target.innerText = `📎 ${input.files.length} فایل انتخاب شد`;
        }
    }

    /* Initial */
    document.addEventListener('DOMContentLoaded', () => {
        showStep(currentStep);
    });
</script>
