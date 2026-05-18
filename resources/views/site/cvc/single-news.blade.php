@extends('site.layouts.base2')

@section('title', ($post->title ?? 'خبر') . ' - MSTID Fund')

@php
    $coverUrl = !empty($post->cover)
        ? (preg_match('/^https?:\/\//', $post->cover) ? $post->cover : asset('storage/' . ltrim($post->cover, '/')))
        : null;
    $attachmentUrl = !empty($post->file_path)
        ? (preg_match('/^https?:\/\//', $post->file_path) ? $post->file_path : asset('storage/' . ltrim($post->file_path, '/')))
        : null;
    $excerpt = trim(strip_tags($post->description ?? ''));
    if ($excerpt === '') {
        $excerpt = trim(strip_tags($post->full_description ?? ''));
    }
    $excerpt = \Illuminate\Support\Str::limit($excerpt, 160);
    $authorName = $post->user->name ?? $post->user->username ?? 'تحریریه CVC';
    $authorRole = $post->sub_title ?: 'خبر CVC';
    $tagsArray = collect(explode(',', (string) ($post->en_title ?? '')))
        ->map(fn ($tag) => trim($tag))
        ->filter()
        ->values();
    $galleryItems = collect($post->gallery_media ?? [])
        ->filter(fn ($item) => !empty($item['path']))
        ->values();
@endphp

@section('meta')
    <meta name="description" content="{{ $excerpt }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $excerpt }}">
    @if($coverUrl)
        <meta property="og:image" content="{{ $coverUrl }}">
    @endif
    <link rel="canonical" href="{{ route('cvc.single-news', $post->slug) }}">
@endsection

@section('styles')
    <style>
        .news-article-shell {
            padding: 40px 0 72px;
        }

        .news-article-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.9fr) minmax(280px, 0.95fr);
            gap: 28px;
            align-items: start;
        }

        .article-card, .sidebar-card, .related-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .article-hero {
            min-height: 320px;
            background: linear-gradient(135deg, #0f4c81 0%, #1d8fe1 100%);
            position: relative;
            display: flex;
            align-items: end;
            color: #fff;
        }

        .article-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(7, 16, 29, 0.75), transparent 55%);
        }

        .article-hero-cover {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-hero-content {
            position: relative;
            z-index: 1;
            padding: 34px;
            width: 100%;
        }

        .article-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .article-title {
            font-size: clamp(28px, 4vw, 46px);
            line-height: 1.35;
            margin-bottom: 14px;
            font-weight: 800;
        }

        .article-excerpt {
            max-width: 760px;
            font-size: 17px;
            line-height: 1.95;
            color: rgba(255, 255, 255, 0.92);
        }

        .article-body {
            padding: 32px 34px 36px;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 20px;
            color: #64748b;
            font-size: 14px;
        }

        .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 7px 12px;
            border-radius: 999px;
        }

        .article-content {
            font-size: 17px;
            line-height: 2.05;
            color: #243041;
        }

        .article-content h2,
        .article-content h3,
        .article-content h4 {
            color: #0f4c81;
            margin: 28px 0 14px;
            line-height: 1.45;
        }

        .article-content p {
            margin-bottom: 18px;
        }

        .article-content img,
        .article-content iframe,
        .article-content video {
            max-width: 100%;
            border-radius: 16px;
        }

        .article-gallery {
            margin-top: 30px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .gallery-media {
            aspect-ratio: 16 / 10;
            background: #0f172a;
            border-radius: 18px;
            overflow: hidden;
        }

        .gallery-media img,
        .gallery-media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .article-attachment,
        .article-share,
        .article-author {
            margin-top: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #f8fafc;
            padding: 18px 20px;
        }

        .article-attachment {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #0f4c81, #1d8fe1);
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 999px;
            font-weight: 700;
        }

        .article-author {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .author-avatar {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, #0f4c81, #1d8fe1);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            flex-shrink: 0;
        }

        .author-name {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 4px;
            color: #0f172a;
        }

        .author-role {
            color: #64748b;
            font-size: 14px;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eef6ff;
            color: #0f4c81;
            text-decoration: none;
            font-size: 13px;
            border: 1px solid #dbeafe;
        }

        .sidebar-card {
            padding: 22px;
            margin-bottom: 20px;
        }

        .sidebar-card h3 {
            font-size: 18px;
            margin-bottom: 14px;
            color: #0f4c81;
        }

        .popular-post {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #eef2f7;
            text-decoration: none;
            color: inherit;
        }

        .popular-post:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .popular-thumb {
            width: 76px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0f4c81, #1d8fe1);
            overflow: hidden;
            flex-shrink: 0;
        }

        .popular-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .popular-title {
            font-size: 14px;
            line-height: 1.65;
            color: #111827;
            font-weight: 700;
        }

        .popular-date {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .category-list {
            display: grid;
            gap: 10px;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 11px 14px;
            color: #334155;
            text-decoration: none;
            font-size: 14px;
        }

        .category-count {
            background: #fff;
            color: #0f4c81;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 700;
        }

        .related-section {
            margin-top: 30px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .related-card a {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .related-thumb {
            height: 160px;
            background: linear-gradient(135deg, #0f4c81, #1d8fe1);
            overflow: hidden;
        }

        .related-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-content {
            padding: 16px 18px 18px;
        }

        .related-date {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 7px;
        }

        .related-title {
            font-size: 15px;
            line-height: 1.75;
            color: #0f172a;
            font-weight: 700;
        }

        .empty-state {
            padding: 18px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            color: #64748b;
        }

        @media (max-width: 992px) {
            .news-article-grid,
            .related-grid {
                grid-template-columns: 1fr;
            }

            .article-body,
            .article-hero-content {
                padding: 24px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <section class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ route('cvc.home') }}">خانه</a></li>
                <li><a href="{{ route('cvc.news') }}">اخبار</a></li>
                <li class="active">{{ $post->title }}</li>
            </ol>
        </div>
    </section>

    <section class="news-article-shell">
        <div class="container">
            <div class="news-article-grid">
                <article class="article-card">
                    <header class="article-hero">
                        @if($coverUrl)
                            <img class="article-hero-cover" src="{{ $coverUrl }}" alt="{{ $post->title }}">
                        @endif
                        <div class="article-hero-content">
                            <div class="article-chip">
                                <span>خبر CVC</span>
                                <span>•</span>
                                <span>{{ $authorRole }}</span>
                            </div>
                            <h1 class="article-title">{{ $post->title }}</h1>
                            <div class="article-excerpt">
                                {{ $excerpt ?: 'محتوای این خبر توسط پنل مدیریت تکمیل می‌شود.' }}
                            </div>
                        </div>
                    </header>

                    <div class="article-body">
                        <div class="article-meta">
                            <span>تاریخ: {{ optional($post->created_at)->format('Y/m/d') }}</span>
                            <span>نویسنده: {{ $authorName }}</span>
                            <span>دسته بندی: {{ $post->sub_title ?: 'عمومی' }}</span>
                        </div>

                        <div class="article-author">
                            <div class="author-avatar">{{ mb_substr($authorName, 0, 1) }}</div>
                            <div>
                                <div class="author-name">{{ $authorName }}</div>
                                <div class="author-role">{{ $authorRole }}</div>
                            </div>
                        </div>

                        @if(!empty($post->full_description) || !empty($post->description))
                            <div class="article-content">
                                {!! $post->full_description ?: nl2br(e($post->description)) !!}
                            </div>
                        @else
                            <div class="empty-state">برای این خبر هنوز محتوای کامل ثبت نشده است.</div>
                        @endif

                        @if($attachmentUrl)
                            <div class="article-attachment">
                                <div>
                                    <strong>پیوست خبر</strong>
                                    <div class="text-muted" style="font-size:14px;">فایل مرتبط برای دانلود یا مشاهده در دسترس است.</div>
                                </div>
                                <a class="download-btn" href="{{ $attachmentUrl }}" target="_blank" rel="noopener">
                                    دریافت فایل
                                </a>
                            </div>
                        @endif

                        @if($galleryItems->isNotEmpty())
                            <section class="article-gallery">
                                <div class="section-title" style="font-size:28px;">گالری خبر</div>
                                <div class="gallery-grid">
                                    @foreach($galleryItems as $item)
                                        @php
                                            $mediaUrl = preg_match('/^https?:\/\//', $item['path']) ? $item['path'] : asset('storage/' . ltrim($item['path'], '/'));
                                        @endphp
                                        <div class="gallery-media">
                                            @if(($item['type'] ?? 'image') === 'video')
                                                <video controls preload="metadata">
                                                    <source src="{{ $mediaUrl }}">
                                                </video>
                                            @else
                                                <img src="{{ $mediaUrl }}" alt="{{ $item['name'] ?? $post->title }}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if($tagsArray->isNotEmpty())
                            <div class="chips">
                                @foreach($tagsArray as $tag)
                                    <span class="chip">{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="article-share">
                            @php $shareUrl = urlencode(route('cvc.single-news', $post->slug)); @endphp
                            <strong>اشتراک گذاری</strong>
                            <div class="chips" style="margin-top:12px;">
                                <a class="chip" target="_blank" rel="noopener" href="https://t.me/share/url?url={{ $shareUrl }}">تلگرام</a>
                                <a class="chip" target="_blank" rel="noopener" href="https://wa.me/?text={{ $shareUrl }}">واتساپ</a>
                                <a class="chip" target="_blank" rel="noopener" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}">لینکدین</a>
                            </div>
                        </div>

                        <section class="related-section">
                            <div class="section-title" style="font-size:28px;">اخبار مرتبط</div>
                            <div class="related-grid">
                                @forelse($relatedPosts as $relatedPost)
                                    <div class="related-card">
                                        <a href="{{ route('cvc.single-news', $relatedPost->slug) }}">
                                            <div class="related-thumb">
                                                @if(!empty($relatedPost->cover))
                                                    <img src="{{ preg_match('/^https?:\/\//', $relatedPost->cover) ? $relatedPost->cover : asset('storage/' . ltrim($relatedPost->cover, '/')) }}" alt="{{ $relatedPost->title }}">
                                                @endif
                                            </div>
                                            <div class="related-content">
                                                <div class="related-date">{{ optional($relatedPost->created_at)->format('Y/m/d') }}</div>
                                                <div class="related-title">{{ $relatedPost->title }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="empty-state">خبر مرتبطی برای نمایش وجود ندارد.</div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </article>

                <aside>
                    <div class="sidebar-card">
                        <h3>پربازدیدترین</h3>
                        @forelse($popularPosts as $popularPost)
                            <a class="popular-post" href="{{ route('cvc.single-news', $popularPost->slug) }}">
                                <div class="popular-thumb">
                                    @if(!empty($popularPost->cover))
                                        <img src="{{ preg_match('/^https?:\/\//', $popularPost->cover) ? $popularPost->cover : asset('storage/' . ltrim($popularPost->cover, '/')) }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <div class="popular-date">{{ optional($popularPost->created_at)->format('Y/m/d') }}</div>
                                    <div class="popular-title">{{ $popularPost->title }}</div>
                                </div>
                            </a>
                        @empty
                            <div class="empty-state">هنوز خبری ثبت نشده است.</div>
                        @endforelse
                    </div>

                    <div class="sidebar-card">
                        <h3>دسته بندی ها</h3>
                        <div class="category-list">
                            @forelse($categories as $category)
                                <a href="{{ route('cvc.news') }}" class="category-item">
                                    <span>{{ $category->category }}</span>
                                    <span class="category-count">{{ $category->total }}</span>
                                </a>
                            @empty
                                <div class="empty-state">دسته بندی ثبت نشده است.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <h3>برچسب ها</h3>
                        <div class="chips">
                            @forelse($tags as $tag)
                                <span class="chip">{{ $tag }}</span>
                            @empty
                                <span class="chip">CVC</span>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
