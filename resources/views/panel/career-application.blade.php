@extends('layouts.base')

@section('title', $thispage['title'] ?? 'درخواست‌های همکاری')

@section('style')
    <style>
        .career-detail-box {background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px;height:100%}
        .career-detail-box small {display:block;color:#64748b;margin-bottom:6px}
        .career-long-text {white-space:pre-wrap;line-height:2;color:#334155}
    </style>
@endsection

@section('content')
    @php
        $statusLabels = [
            'new' => 'جدید',
            'in_review' => 'در حال بررسی',
            'shortlisted' => 'منتخب اولیه',
            'rejected' => 'رد شده',
            'hired' => 'استخدام شده',
            'archived' => 'آرشیو',
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">{{ $thispage['list'] }}</h5>
                <span class="badge bg-label-primary">{{ $applications->total() }} درخواست</span>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>سمت</th>
                        <th>ایمیل</th>
                        <th>تلفن</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th>جزئیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $item)
                        @php($status = $item->workflow_status ?? 'new')
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                            <td>{{ $item->position }}</td>
                            <td dir="ltr">{{ $item->email }}</td>
                            <td dir="ltr">{{ $item->phone }}</td>
                            <td><span class="badge bg-label-secondary">{{ $statusLabels[$status] ?? $status }}</span></td>
                            <td>{{ optional($item->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#careerModal{{ $item->id }}">مشاهده</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-4">داده‌ای ثبت نشده است.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $applications->links() }}</div>
        </div>
    </div>

    @foreach($applications as $item)
        @php($status = $item->workflow_status ?? 'new')
        <div class="modal fade" id="careerModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title mb-1">جزئیات درخواست همکاری #{{ $item->id }}</h5>
                            <small class="text-muted">{{ optional($item->created_at)->format('Y-m-d H:i') }}</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4"><div class="career-detail-box"><small>نام</small><strong>{{ $item->first_name }} {{ $item->last_name }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>کد ملی</small><strong>{{ $item->national_code }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>وضعیت</small><strong>{{ $statusLabels[$status] ?? $status }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>ایمیل</small><a href="mailto:{{ $item->email }}" dir="ltr">{{ $item->email }}</a></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>تلفن</small><a href="tel:{{ $item->phone }}" dir="ltr">{{ $item->phone }}</a></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>شهر / استان</small><strong>{{ $item->city }} / {{ $item->province }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>سمت درخواستی</small><strong>{{ $item->position }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>حقوق مورد انتظار</small><strong>{{ $item->expected_salary }}</strong></div></div>
                            <div class="col-md-4"><div class="career-detail-box"><small>شروع همکاری</small><strong>{{ $item->availability }}</strong></div></div>
                            <div class="col-12"><div class="career-detail-box"><small>مهارت‌ها</small><div class="career-long-text">{{ $item->skills ?: '-' }}</div></div></div>
                            <div class="col-12"><div class="career-detail-box"><small>انگیزه</small><div class="career-long-text">{{ $item->motivation ?: '-' }}</div></div></div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @if($item->resume_path)
                                <a href="{{ route('career-application.resume', $item->id) }}" class="btn btn-outline-primary">دانلود رزومه</a>
                            @endif
                            @if($item->documents_path)
                                <a href="{{ route('career-application.documents', $item->id) }}" class="btn btn-outline-primary">دانلود مدارک</a>
                            @endif
                            @can('can-access', ['careerapplication', 'delete'])
                                <form action="{{ route('career-application.destroy', $item->id) }}" method="POST" onsubmit="return confirm('حذف شود؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">حذف درخواست</button>
                                </form>
                            @endcan
                        </div>

                        @can('can-access', ['careerapplication', 'edit'])
                            <form method="POST" action="{{ route('career-application.status', $item->id) }}" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <select class="form-control" name="workflow_status" required>
                                            @foreach(array_keys($statusLabels) as $key)
                                                <option value="{{ $key }}" {{ $status === $key ? 'selected' : '' }}>{{ $statusLabels[$key] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="review_note" value="{{ $item->review_note }}" placeholder="یادداشت بررسی">
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">ذخیره وضعیت</button>
                                    </div>
                                </div>
                            </form>
                        @endcan
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
