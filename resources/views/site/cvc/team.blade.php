@extends('site.layouts.base2')

@section('title', 'تیم ما - مرکز تحقیقات استراتژیک مستید')

@section('styles')
    <style>


        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .page-header .lead {
            font-size: 1.25rem;
            opacity: 0.95;
        }

        .team-section {
            padding: 3rem 0;
        }

        .team-section.research-team {
            background: #f8f9fa;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .section-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .senior-grid {
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        }

        .team-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .team-image {
            position: relative;
            width: 100%;
            padding-top: 100%;
            overflow: hidden;
        }

        .senior-card .team-image {
            padding-top: 120%;
        }

        .team-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .team-card:hover .team-overlay {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: white;
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .team-info {
            padding: 1.5rem;
        }

        .senior-card .team-info {
            padding: 2rem;
        }

        .team-info h3 {
            font-size: 1.25rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .team-role {
            display: block;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .team-bio {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .btn-profile {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-profile:hover {
            background: #5568d3;
        }

        .join-team-cta {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .cta-content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .cta-content p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .team-grid,
            .senior-grid {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
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
                <li class="active">تیم ما</li>
            </ol>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>تیم ما</h1>
            <p class="lead">متخصصان و پژوهشگران مرکز تحقیقات استراتژیک مستید</p>
        </div>
    </section>

    <section class="team-section research-team">
        <div class="container">
            <div class="section-header">
                <h2>اعضای تیم</h2>
                <p>متخصصان و پژوهشگران فعال مرکز</p>
            </div>

            <div class="team-grid">
                @forelse($teamMembers as $member)
                    <div class="team-card">
                        <div class="team-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            @if(!empty($member->image))
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->fullname }}"
                                     style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                            @endif
                        </div>
                        <div class="team-info">
                            <h3>{{ $member->fullname }}</h3>
                            <span class="team-role">{{ $member->side }}</span>
                            @if(!empty($member->description))
                                <p class="team-bio">{{ \Illuminate\Support\Str::limit(strip_tags($member->description), 140) }}</p>
                            @endif
                            @if(!empty($member->slug))
                                <a href="{{ route('cvc.team-member', $member->slug) }}" class="btn-profile">مشاهده پروفایل</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>در حال حاضر عضو فعالی برای نمایش ثبت نشده است.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Join Team CTA -->
    <section class="join-team-cta">
        <div class="container">
            <div class="cta-content">
                <h2>به تیم ما بپیوندید</h2>
                <p>اگر به دنبال فرصتی برای کار در یک محیط پژوهشی پویا و حرفه‌ای هستید، رزومه خود را برای ما ارسال
                    کنید.</p>
                <a href="/career" class="btn-cta">مشاهده موقعیت‌های شغلی</a>
            </div>
        </div>
    </section>
@endsection
