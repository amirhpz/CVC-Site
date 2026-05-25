@extends('site.layouts.base2')

@section('title', 'اخبار و مقالات - توسعه دانش بنیان سینا')

@section('meta')
    <meta name="description"
          content="آخرین اخبار، تحلیل‌ها و مقالات سرمایه‌گذاری خطرپذیر، نوآوری و اکوسیستم استارتاپی.">
@endsection

@section('styles')
    <style>
        .news-page {
            padding: 44px 0 76px;
            background: linear-gradient(180deg, var(--cvc-bg) 0%, #ffffff 38%),
            #ffffff;
        }

        .news-header {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.8fr);
            gap: 28px;
            align-items: stretch;
            margin-bottom: 30px;
        }

        .news-intro {
            padding: 28px 0;
        }

        .eyebrow {
            color: var(--cvc-primary-hover);
            font-weight: 800;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .news-intro h1 {
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.35;
            color: var(--cvc-text);
            margin-bottom: 14px;
        }

        .news-intro p {
            color: var(--cvc-muted);
            max-width: 680px;
            font-size: 17px;
            line-height: 2;
        }

        .featured-post {
            min-height: 320px;
            border-radius: 26px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, var(--cvc-text), var(--cvc-primary-hover));
            color: #fff;
            box-shadow: 0 18px 50px rgba(15, 35, 53, 0.16);
        }

        .featured-post img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-post::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(4, 13, 24, 0.78), rgba(4, 13, 24, 0.1));
        }

        .featured-content {
            position: absolute;
            inset-inline: 0;
            bottom: 0;
            z-index: 1;
            padding: 26px;
        }

        .category-pill {
            display: inline-flex;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: inherit;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .featured-content h2 {
            font-size: 24px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .featured-content a {
            color: #fff;
            text-decoration: none;
        }

        .featured-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            color: rgba(255, 255, 255, 0.84);
            font-size: 13px;
        }

        .news-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 28px;
            align-items: start;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .news-card {
            background: #fff;
            border: 1px solid var(--cvc-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 35, 53, 0.07);
        }

        .news-card a {
            color: inherit;
            text-decoration: none;
        }

        .news-thumb {
            aspect-ratio: 16 / 10;
            background: linear-gradient(135deg, var(--cvc-text), var(--cvc-primary-hover));
            overflow: hidden;
        }

        .news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .news-card-body {
            padding: 18px;
        }

        .news-card-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            color: var(--cvc-muted);
            font-size: 12px;
            margin-bottom: 10px;
        }

        .news-card h3 {
            color: var(--cvc-text);
            font-size: 19px;
            line-height: 1.65;
            margin-bottom: 10px;
        }

        .news-card p {
            color: var(--cvc-muted);
            font-size: 14px;
            line-height: 1.9;
            margin-bottom: 14px;
        }

        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            display: inline-flex;
            border-radius: 999px;
            background: var(--cvc-primary-soft);
            color: var(--cvc-primary-hover);
            border: 1px solid var(--cvc-border);
            padding: 5px 10px;
            font-size: 12px;
        }

        .read-more {
            display: inline-flex;
            color: var(--cvc-text);
            font-weight: 800;
            font-size: 14px;
            margin-top: 14px;
        }

        .sidebar-card {
            background: #fff;
            border: 1px solid var(--cvc-border);
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 18px;
            box-shadow: 0 10px 30px rgba(15, 35, 53, 0.06);
        }

        .sidebar-card h3 {
            color: var(--cvc-text);
            font-size: 18px;
            margin-bottom: 14px;
        }

        .popular-post {
            display: grid;
            grid-template-columns: 72px 1fr;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--cvc-border);
            text-decoration: none;
            color: inherit;
        }

        .popular-post:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .popular-thumb {
            width: 72px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--cvc-text), var(--cvc-primary-hover));
            overflow: hidden;
        }

        .popular-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .popular-title {
            font-size: 13px;
            line-height: 1.75;
            font-weight: 800;
            color: var(--cvc-text);
        }

        .popular-date {
            color: var(--cvc-muted);
            font-size: 12px;
            margin-bottom: 4px;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            background: var(--cvc-bg);
            border: 1px solid var(--cvc-border);
            border-radius: 12px;
            margin-bottom: 9px;
            color: #334155;
            text-decoration: none;
        }

        .category-count {
            color: var(--cvc-primary-hover);
            font-weight: 800;
        }

        .empty-state {
            background: #fff;
            border: 1px dashed #cbd5e1;
            border-radius: 18px;
            padding: 24px;
            color: var(--cvc-muted);
        }

        @media (max-width: 992px) {
            .news-header,
            .news-layout,
            .news-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $featured = $posts->first();
        $listPosts = $featured ? $posts->where('id', '!=', $featured->id) : $posts;
        $coverUrl = function ($post) {
            if (empty($post->cover)) {
                return null;
            }

            return preg_match('/^https?:\/\//', $post->cover)
                ? $post->cover
                : asset('storage/' . ltrim($post->cover, '/'));
        };
        $postTags = function ($post) {
            return collect(explode(',', (string) ($post->en_title ?? '')))
                ->map(fn ($tag) => trim($tag))
                ->filter()
                ->take(3);
        };
    @endphp

    <section class="news-page">
        <div class="container">
            <div class="news-header">
                <div class="news-intro">
                    <div class="eyebrow">اخبار و مقالات</div>
                    <h1>روایت تازه‌های سرمایه‌گذاری، نوآوری و رشد استارتاپ‌ها</h1>
                </div>

                @if($featured)
                    <article class="featured-post">
                        @if($coverUrl($featured))
                            <img src="{{ $coverUrl($featured) }}" alt="{{ $featured->title }}">
                        @endif
                        <div class="featured-content">
                            <span class="category-pill">{{ $featured->sub_title ?: 'عمومی' }}</span>
                            <h2>
                                <a href="{{ route('cvc.single-news', $featured->slug) }}">{{ $featured->title }}</a>
                            </h2>
                            <div class="featured-meta">
                                <span>{{ optional($featured->created_at)->format('Y/m/d') }}</span>
                                <span>{{ $featured->user->name ?? 'تحریریه CVC' }}</span>
                            </div>
                        </div>
                    </article>
                @endif
            </div>

            <div class="news-layout">
                <main>
                    <div class="news-grid">
                        @forelse($listPosts as $post)
                            <article class="news-card">
                                <a href="{{ route('cvc.single-news', $post->slug) }}">
                                    <div class="news-thumb">
                                        @if($coverUrl($post))
                                            <img src="{{ $coverUrl($post) }}" alt="{{ $post->title }}">
                                        @endif
                                    </div>
                                    <div class="news-card-body">
                                        <div class="news-card-meta">
                                            <span>{{ optional($post->created_at)->format('Y/m/d') }}</span>
                                            <span>{{ $post->sub_title ?: 'عمومی' }}</span>
                                        </div>
                                        <h3>{{ $post->title }}</h3>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->description ?? $post->full_description ?? ''), 150) }}</p>
                                        <div class="tag-row">
                                            @foreach($postTags($post) as $tag)
                                                <span class="tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                        <span class="read-more">مشاهده خبر</span>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <div class="empty-state">هنوز خبری ثبت نشده است.</div>
                        @endforelse
                    </div>
                </main>

                <aside>
                    <div class="sidebar-card">
                        <h3>آخرین مطالب</h3>
                        @forelse($popularPosts as $popularPost)
                            <a class="popular-post" href="{{ route('cvc.single-news', $popularPost->slug) }}">
                                <div class="popular-thumb">
                                    @if($coverUrl($popularPost))
                                        <img src="{{ $coverUrl($popularPost) }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <div
                                        class="popular-date">{{ optional($popularPost->created_at)->format('Y/m/d') }}</div>
                                    <div class="popular-title">{{ $popularPost->title }}</div>
                                </div>
                            </a>
                        @empty
                            <div class="empty-state">مطلبی برای نمایش وجود ندارد.</div>
                        @endforelse
                    </div>

                    <div class="sidebar-card">
                        <h3>دسته بندی‌ها</h3>
                        @forelse($categories as $category)
                            <a class="category-item" href="{{ route('cvc.news') }}">
                                <span>{{ $category->category }}</span>
                                <span class="category-count">{{ $category->total }}</span>
                            </a>
                        @empty
                            <div class="empty-state">دسته بندی ثبت نشده است.</div>
                        @endforelse
                    </div>

                    <div class="sidebar-card">
                        <h3>برچسب‌ها</h3>
                        <div class="tag-row">
                            @forelse($tags as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @empty
                                <span class="tag">CVC</span>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

