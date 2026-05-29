@php
    $posts = $posts ?? $listPosts ?? collect();

    $jalaliDate = $jalaliDate ?? function ($date, string $format = 'Y/m/d') {
        if (empty($date)) {
            return '---';
        }

        try {
            return jdate($date)->format($format);
        } catch (\Throwable $e) {
            return optional($date)->format('Y/m/d') ?? '---';
        }
    };

    $coverUrl = $coverUrl ?? function ($post) {
        if (empty($post->cover)) {
            return null;
        }

        return preg_match('/^https?:\/\//', $post->cover)
            ? $post->cover
            : asset('storage/' . ltrim($post->cover, '/'));
    };

    $postTags = $postTags ?? function ($post) {
        return collect(explode(',', (string) ($post->en_title ?? '')))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->take(3);
    };
@endphp

@forelse($posts as $post)
    <article class="news-card">
        <a href="{{ route('cvc.single-news', $post->slug) }}">
            <div class="news-thumb">
                @if($coverUrl($post))
                    <img src="{{ $coverUrl($post) }}" alt="{{ $post->title }}">
                @endif
            </div>
            <div class="news-card-body">
                <div class="news-card-meta">
                    <span>{{ $jalaliDate($post->created_at) }}</span>
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
