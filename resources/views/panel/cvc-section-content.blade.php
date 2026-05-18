@extends('layouts.base')

@push('styles')
    <style>
        .cms-shell { max-width: 1220px; margin: 0 auto; }
        .cms-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }
        .cms-title { margin: 0; font-size: 1.15rem; font-weight: 700; }
        .cms-subtitle { margin: 6px 0 0; color: #6c757d; font-size: .9rem; line-height: 1.8; }
        .cms-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 18px;
            align-items: start;
        }
        .cms-card {
            border: 1px solid #eceef3;
            border-radius: 8px;
            background: #fff;
            padding: 18px;
        }
        .cms-card-title { margin: 0 0 14px; font-size: 1rem; font-weight: 700; }
        .cms-item {
            border: 1px solid #eceef3;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 12px;
            background: #fcfcfd;
        }
        .cms-item-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
        }
        .cms-item-title { margin: 0; font-size: .95rem; font-weight: 700; }
        .cms-danger { border-color: #f1c2c2; background: #fff7f7; }
        .cms-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #eceef3;
        }
        @media (max-width: 992px) {
            .cms-toolbar { align-items: stretch; flex-direction: column; }
            .cms-grid { grid-template-columns: 1fr; }
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
            <a href="{{ $publicUrl }}" target="_blank" class="btn btn-outline-secondary">مشاهده صفحه</a>
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

        <div class="cms-grid">
            <div class="cms-card">
                <form method="POST" action="{{ route('panel.cvc-content.update', $sectionKey) }}">
                    @csrf
                    @method('PUT')

                    <h2 class="cms-card-title">تنظیمات صفحه</h2>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">عنوان صفحه</label>
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
                            <label class="form-label">خلاصه صفحه</label>
                            <textarea name="page_description" class="form-control" rows="2">{{ old('page_description', $pageContent->description ?? '') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">توضیحات کامل صفحه</label>
                            <textarea name="page_full_description" class="form-control" rows="4">{{ old('page_full_description', $pageContent->full_description ?? '') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">آدرس تصویر صفحه</label>
                            <input name="page_image" class="form-control" value="{{ old('page_image', $pageContent->image ?? '') }}">
                        </div>
                    </div>

                    <hr class="my-4">
                    <h2 class="cms-card-title">آیتم های قابل نمایش</h2>

                    @forelse($items as $item)
                        <div class="cms-item" id="item-{{ $item->id }}">
                            <input type="hidden" name="item[{{ $loop->index }}][id]" value="{{ $item->id }}">
                            <div class="cms-item-head">
                                <h3 class="cms-item-title">آیتم {{ $loop->iteration }}</h3>
                                @can('can-access', [$permissionSlug, 'delete'])
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delete_items[]" value="{{ $item->id }}" id="del_{{ $item->id }}">
                                        <label class="form-check-label text-danger" for="del_{{ $item->id }}">حذف از صفحه</label>
                                    </div>
                                @endcan
                            </div>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">{{ $config['item_title_label'] }}</label>
                                    <input name="item[{{ $loop->index }}][title]" class="form-control" value="{{ old('item.'.$loop->index.'.title', $item->title) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">وضعیت</label>
                                    <select name="item[{{ $loop->index }}][status]" class="form-select">
                                        @foreach([4=>'فعال',1=>'غیرفعال',0=>'لغو'] as $key => $label)
                                            <option value="{{ $key }}" @selected((int) old('item.'.$loop->index.'.status', $item->status) === $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ $config['item_summary_label'] }}</label>
                                    <textarea name="item[{{ $loop->index }}][description]" class="form-control" rows="2">{{ old('item.'.$loop->index.'.description', $item->description) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ $config['item_body_label'] }}</label>
                                    <textarea name="item[{{ $loop->index }}][full_description]" class="form-control" rows="3">{{ old('item.'.$loop->index.'.full_description', $item->full_description) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">آدرس تصویر یا آیکون</label>
                                    <input name="item[{{ $loop->index }}][image]" class="form-control" value="{{ old('item.'.$loop->index.'.image', $item->image) }}">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-secondary mb-0">هنوز آیتمی برای این بخش ثبت نشده است.</div>
                    @endforelse

                    <div class="cms-actions">
                        @can('can-access', [$permissionSlug, 'edit'])
                            <button type="submit" class="btn btn-primary">ذخیره صفحه و آیتم ها</button>
                        @else
                            <span class="text-muted">شما دسترسی ویرایش این بخش را ندارید.</span>
                        @endcan
                    </div>
                </form>
            </div>

            @can('can-access', [$permissionSlug, 'insert'])
                <div class="cms-card">
                    <h2 class="cms-card-title">افزودن آیتم جدید</h2>
                    <form method="POST" action="{{ route('panel.cvc-content.store', $sectionKey) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ $config['item_title_label'] }}</label>
                            <input name="item_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ $config['item_summary_label'] }}</label>
                            <textarea name="item_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ $config['item_body_label'] }}</label>
                            <textarea name="item_full_description" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">آدرس تصویر یا آیکون</label>
                            <input name="item_image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وضعیت انتشار</label>
                            <select name="item_status" class="form-select">
                                <option value="4" selected>فعال</option>
                                <option value="1">غیرفعال</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">افزودن آیتم</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection
