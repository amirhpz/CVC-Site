@if(!empty($pageContent) && ($pageContent->title || $pageContent->description || $pageContent->full_description))
    <section class="container my-4">
        <div class="p-4 rounded" style="background:#f8f9ff;border:1px solid #e6e9ff;">
            @if($pageContent->title)
                <h2 class="mb-2">{{ $pageContent->title }}</h2>
            @endif
            @if($pageContent->description)
                <p class="mb-2 text-muted">{{ $pageContent->description }}</p>
            @endif
            @if($pageContent->full_description)
                <div>{!! nl2br(e($pageContent->full_description)) !!}</div>
            @endif
        </div>
    </section>
@endif
