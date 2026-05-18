@extends('layouts.base')

@section('title', $thispage['title'] ?? 'پیام‌های تماس')

@section('style')
    <style>
        .contact-message-table td {
            vertical-align: middle;
        }

        .contact-message-subject {
            max-width: 260px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .contact-detail-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            height: 100%;
        }

        .contact-detail-box small {
            display: block;
            color: #64748b;
            margin-bottom: 6px;
        }

        .contact-message-body {
            white-space: pre-wrap;
            line-height: 2;
            color: #334155;
        }
    </style>
@endsection

@section('content')
    @php
        $statusLabels = [
            'new' => 'جدید',
            'in_review' => 'در حال بررسی',
            'resolved' => 'پاسخ داده شده',
            'archived' => 'آرشیو',
        ];
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="card-title mb-1">{{ $thispage['list'] }}</h5>
                    <p class="text-muted mb-0">فرم‌های ارسال‌شده از صفحه تماس با ما.</p>
                </div>
                <span class="badge bg-label-primary">{{ $messages->total() }} پیام</span>
            </div>

            <div class="table-responsive">
                <table class="table table-striped contact-message-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>شماره تماس</th>
                        <th>موضوع</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th>جزئیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($messages as $message)
                        @php($status = $message->workflow_status ?? 'new')
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ trim($message->first_name . ' ' . $message->last_name) }}</td>
                            <td dir="ltr">{{ $message->email }}</td>
                            <td dir="ltr">{{ $message->phone }}</td>
                            <td class="contact-message-subject">{{ $message->subject }}</td>
                            <td><span class="badge bg-label-secondary">{{ $statusLabels[$status] ?? $status }}</span></td>
                            <td>{{ optional($message->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contactMessageModal{{ $message->id }}">
                                    مشاهده
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">داده‌ای ثبت نشده است.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">{{ $messages->links() }}</div>
        </div>
    </div>

    @foreach($messages as $message)
        @php($status = $message->workflow_status ?? 'new')
        <div class="modal fade" id="contactMessageModal{{ $message->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title mb-1">جزئیات پیام تماس #{{ $message->id }}</h5>
                            <small class="text-muted">{{ optional($message->created_at)->format('Y-m-d H:i') }}</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="contact-detail-box">
                                    <small>نام و نام خانوادگی</small>
                                    <strong>{{ trim($message->first_name . ' ' . $message->last_name) }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-detail-box">
                                    <small>وضعیت</small>
                                    <strong>{{ $statusLabels[$status] ?? $status }}</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-detail-box">
                                    <small>ایمیل</small>
                                    <a href="mailto:{{ $message->email }}" dir="ltr">{{ $message->email }}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-detail-box">
                                    <small>شماره تماس</small>
                                    <a href="tel:{{ $message->phone }}" dir="ltr">{{ $message->phone }}</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact-detail-box">
                                    <small>موضوع</small>
                                    <strong>{{ $message->subject }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="contact-detail-box">
                            <small>متن پیام</small>
                            <div class="contact-message-body">{{ $message->message }}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
