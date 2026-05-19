@extends('layouts.auth')

@section('title', 'ورود به پنل مدیریت CVC')

@push('head')
    <style>
        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 12% 18%, rgba(47, 94, 255, .22), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(20, 184, 166, .18), transparent 28%),
                linear-gradient(135deg, #07111f 0%, #0d1b2e 48%, #f5efe3 48%, #f8f4ec 100%);
            font-family: IRANSans, sans-serif;
        }

        .cvc-auth-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
        }

        .cvc-auth-card {
            width: min(1080px, 100%);
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, .88);
            box-shadow: 0 28px 90px rgba(2, 8, 23, .24);
            backdrop-filter: blur(18px);
        }

        .cvc-auth-panel {
            position: relative;
            min-height: 620px;
            padding: 52px;
            color: #fff;
            background:
                linear-gradient(145deg, rgba(8, 21, 39, .94), rgba(13, 35, 62, .92)),
                url("{{ asset('site/assets/images/banner/b3dads-new.png') }}") center/cover;
        }

        .cvc-auth-panel::after {
            content: "";
            position: absolute;
            inset: auto 42px 42px auto;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 50%;
            box-shadow: 0 0 0 44px rgba(255, 255, 255, .04);
        }

        .cvc-brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #fff;
        }

        .cvc-brand-icon {
            display: grid;
            width: 46px;
            height: 46px;
            place-items: center;
            border-radius: 16px;
            background: linear-gradient(135deg, #22c55e, #0ea5e9);
            font-weight: 800;
            letter-spacing: .5px;
        }

        .cvc-auth-panel h1 {
            max-width: 520px;
            margin: 96px 0 18px;
            font-size: clamp(34px, 5vw, 58px);
            font-weight: 900;
            line-height: 1.35;
        }

        .cvc-auth-panel p {
            max-width: 470px;
            color: rgba(255, 255, 255, .76);
            font-size: 15px;
            line-height: 2;
        }

        .cvc-auth-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 48px;
        }

        .cvc-auth-stat {
            min-width: 132px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 18px;
            background: rgba(255, 255, 255, .08);
        }

        .cvc-auth-stat strong {
            display: block;
            margin-bottom: 4px;
            font-size: 22px;
        }

        .cvc-auth-form {
            padding: 54px 48px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, .96), rgba(255, 255, 255, .9)),
                radial-gradient(circle at top left, rgba(14, 165, 233, .14), transparent 35%);
        }

        .cvc-auth-form h2 {
            margin-bottom: 10px;
            color: #0f172a;
            font-weight: 900;
        }

        .cvc-auth-form .lead {
            margin-bottom: 28px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.9;
        }

        .cvc-input {
            height: 54px;
            border: 1px solid #dbe3ef;
            border-radius: 16px;
            background: #fff;
            box-shadow: none;
        }

        .cvc-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, .12);
        }

        .cvc-password-toggle {
            border: 1px solid #dbe3ef;
            border-right: 0;
            border-radius: 16px 0 0 16px;
            background: #fff;
        }

        .cvc-primary-btn,
        .cvc-secondary-btn,
        .cvc-google-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            border-radius: 16px;
            font-weight: 800;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .cvc-primary-btn {
            border: 0;
            color: #fff;
            background: linear-gradient(135deg, #0f766e, #0ea5e9);
            box-shadow: 0 16px 30px rgba(14, 165, 233, .22);
        }

        .cvc-secondary-btn {
            border: 1px solid #cbd5e1;
            color: #0f172a;
            background: #fff;
        }

        .cvc-google-btn {
            gap: 10px;
            border: 1px solid #dbe3ef;
            color: #1e293b;
            background: #fff;
        }

        .cvc-primary-btn:hover,
        .cvc-secondary-btn:hover,
        .cvc-google-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(15, 23, 42, .12);
        }

        .cvc-google-btn img {
            width: 22px;
            height: 22px;
        }

        .cvc-auth-links a {
            color: #0f766e;
            font-weight: 800;
        }

        @media (max-width: 991px) {
            body {
                background: linear-gradient(160deg, #07111f 0%, #0d1b2e 45%, #f8f4ec 45%, #f8f4ec 100%);
            }

            .cvc-auth-card {
                grid-template-columns: 1fr;
            }

            .cvc-auth-panel {
                min-height: auto;
                padding: 36px;
            }

            .cvc-auth-panel h1 {
                margin-top: 56px;
                font-size: 34px;
            }
        }

        @media (max-width: 575px) {
            .cvc-auth-shell {
                padding: 0;
            }

            .cvc-auth-card {
                min-height: 100vh;
                border-radius: 0;
            }

            .cvc-auth-panel,
            .cvc-auth-form {
                padding: 28px 20px;
            }

            .cvc-auth-stats {
                display: none;
            }

            .cvc-auth-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <main class="cvc-auth-shell">
        <section class="cvc-auth-card">
            <aside class="cvc-auth-panel">
                <a href="{{ url('/') }}" class="cvc-brand-mark">
                    <span class="cvc-brand-icon">CVC</span>
                    <span>
                        <strong class="d-block">CVC Admin</strong>
                        <small class="text-white-50">Corporate Venture Capital</small>
                    </span>
                </a>

                <h1>ورود امن به مرکز مدیریت CVC</h1>
                <p>
                    مدیریت محتوا، اخبار، تیم، درخواست‌ها و داده‌های سایت از این پنل انجام می‌شود.
                    اطلاعات ورود را فقط در اختیار اعضای مجاز تیم قرار دهید.
                </p>

                <div class="cvc-auth-stats">
                    <div class="cvc-auth-stat">
                        <strong>CMS</strong>
                        <small>مدیریت صفحات سایت</small>
                    </div>
                    <div class="cvc-auth-stat">
                        <strong>News</strong>
                        <small>انتشار محتوای خبری</small>
                    </div>
                    <div class="cvc-auth-stat">
                        <strong>Panel</strong>
                        <small>دسترسی مدیران</small>
                    </div>
                </div>
            </aside>

            <div class="cvc-auth-form">
                <h2>ورود به پنل</h2>
                <p class="lead">برای ادامه، ایمیل و رمز عبور حساب مدیریتی خود را وارد کنید.</p>

                @include('partials.alerts')

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>خطا در ورود:</strong>
                        <ul class="mb-0 mt-2 pe-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form id="formAuthentication" action="{{ route('login') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل یا نام کاربری</label>
                        <input
                            type="text"
                            class="form-control cvc-input @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="admin@example.com"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            autofocus
                            required
                        >
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">رمز عبور</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input
                                type="password"
                                id="password"
                                class="form-control cvc-input @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="رمز عبور"
                                autocomplete="current-password"
                                required
                            >
                            <span class="input-group-text cursor-pointer cvc-password-toggle">
                                <i class="mdi mdi-eye-off-outline"></i>
                            </span>
                        </div>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember-me">مرا به خاطر بسپار</label>
                        </div>
                    </div>

                    <div class="cvc-auth-actions d-flex gap-3 mb-3">
                        <button class="cvc-primary-btn w-100" type="submit">ورود به پنل</button>
                        <a href="{{ route('otplogin') }}" class="cvc-secondary-btn w-100 text-center">رمز یکبارمصرف</a>
                    </div>

                    <a href="{{ url('login/google') }}" class="cvc-google-btn w-100 mb-4">
                        <img src="{{ asset('site/assets/images/logo/google-logo.png') }}" alt="Google">
                        <span>ورود با حساب گوگل</span>
                    </a>

                    <p class="text-center mb-0 cvc-auth-links">
                        حساب ندارید؟
                        <a href="{{ route('register') }}">ایجاد حساب</a>
                    </p>
                </form>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.form-password-toggle .input-group-text');
            const passwordInput = document.querySelector('#password');
            const icon = togglePassword?.querySelector('i');

            togglePassword?.addEventListener('click', function () {
                passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
                icon?.classList.toggle('mdi-eye-outline');
                icon?.classList.toggle('mdi-eye-off-outline');
            });
        });
    </script>

    <script>
        @if (session('success')) toastr.success(@json(session('success'))); @endif
        @if (session('info')) toastr.info(@json(session('info'))); @endif
        @if (session('warning')) toastr.warning(@json(session('warning'))); @endif
        @if (session('error')) toastr.error(@json(session('error'))); @endif

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error(@json($error));
        @endforeach
        @endif
    </script>
@endsection
