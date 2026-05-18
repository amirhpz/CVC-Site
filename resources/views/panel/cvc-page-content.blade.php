@extends('layouts.base')

@push('styles')
    <style>
        .cms-shell { max-width: 1180px; margin: 0 auto; }
        .cms-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }
        .cms-title { margin: 0; font-size: 1.15rem; font-weight: 700; }
        .cms-subtitle { margin: 6px 0 0; color: #6c757d; font-size: .9rem; line-height: 1.8; }
        .cms-meta {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }
        .cms-meta-item {
            border: 1px solid #eceef3;
            border-radius: 8px;
            padding: 12px 14px;
            background: #fff;
        }
        .cms-meta-label { color: #7b8190; font-size: .78rem; margin-bottom: 4px; }
        .cms-meta-value { font-weight: 600; direction: ltr; text-align: left; }
        .cms-form-card {
            border: 1px solid #eceef3;
            border-radius: 8px;
            background: #fff;
            padding: 20px;
        }
        .cms-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #eceef3;
        }
        @media (max-width: 768px) {
            .cms-toolbar { align-items: stretch; flex-direction: column; }
            .cms-meta { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
    <div class="cms-shell">
        <div class="cms-toolbar">
            <div>
                <h1 class="cms-title">{{ $thispage['title'] }}</h1>
                <p class="cms-subtitle">{{ $config['help'] }}</p>
            </div>
            <a href="{{ $publicUrl }}" target="_blank" class="btn btn-outline-secondary">
                مشاهده صفحه
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>اطلاعات فرم کامل نیست.</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cms-meta">
            <div class="cms-meta-item">
                <div class="cms-meta-label">کلید محتوا</div>
                <div class="cms-meta-value">page:{{ $config['slug'] }}</div>
            </div>
            <div class="cms-meta-item">
                <div class="cms-meta-label">وضعیت فعلی</div>
                <div>{{ (int) optional($pageContent)->status === 4 ? 'فعال' : 'نیازمند بررسی' }}</div>
            </div>
            <div class="cms-meta-item">
                <div class="cms-meta-label">آخرین ویرایش</div>
                <div>{{ optional(optional($pageContent)->updated_at)->format('Y-m-d H:i') ?? '-' }}</div>
            </div>
        </div>

        <div class="cms-form-card">
            <form method="POST" action="{{ route('panel.cvc-page-content.update', $pageKey) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">عنوان قابل نمایش</label>
                        <input name="page_title" class="form-control" value="{{ old('page_title', $pageContent->title ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">وضعیت انتشار</label>
                        <select name="page_status" class="form-select">
                            @foreach([4=>'فعال',1=>'غیرفعال',0=>'لغو'] as $key => $label)
                                <option value="{{ $key }}" @selected((int) old('page_status', $pageContent->status ?? 4) === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ $config['summary_label'] }}</label>
                        <textarea name="page_description" class="form-control" rows="3">{{ old('page_description', $pageContent->description ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ $config['body_label'] }}</label>
                        <textarea name="page_full_description" class="form-control" rows="7">{{ old('page_full_description', $pageContent->full_description ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">آدرس تصویر یا فایل مرتبط</label>
                        <input name="page_image" class="form-control" value="{{ old('page_image', $pageContent->image ?? '') }}" placeholder="مثال: uploads/cvc/cover.jpg">
                    </div>
                </div>

                <div class="cms-actions">
                    @can('can-access', [$permissionSlug, 'edit'])
                        <button type="submit" class="btn btn-primary">ذخیره محتوا</button>
                    @else
                        <span class="text-muted">شما دسترسی ویرایش این صفحه را ندارید.</span>
                    @endcan
                </div>
            </form>
        </div>
    </div>
@endsection
