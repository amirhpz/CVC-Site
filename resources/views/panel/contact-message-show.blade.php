@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">{{ $thispage['list'] }}</h5>
                <a href="{{ route('contact-message.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>

            <ul class="list-group">
                <li class="list-group-item"><strong>وضعیت:</strong> {{ $message->workflow_status ?? 'new' }}</li>
                <li class="list-group-item"><strong>نام:</strong> {{ $message->first_name }} {{ $message->last_name }}</li>
                <li class="list-group-item"><strong>ایمیل:</strong> {{ $message->email }}</li>
                <li class="list-group-item"><strong>تلفن:</strong> {{ $message->phone }}</li>
                <li class="list-group-item"><strong>موضوع:</strong> {{ $message->subject }}</li>
                <li class="list-group-item"><strong>پیام:</strong><br>{{ $message->message }}</li>
                <li class="list-group-item"><strong>یادداشت بررسی:</strong><br>{{ $message->review_note }}</li>
                <li class="list-group-item"><strong>تاریخ:</strong> {{ optional($message->created_at)->format('Y-m-d H:i') }}</li>
            </ul>

            @can('can-access', ['contactmessage', 'edit'])
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="mb-3">به‌روزرسانی وضعیت</h6>
                        <form method="POST" action="{{ route('contact-message.status', $message->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-control" name="workflow_status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ ($message->workflow_status ?? 'new') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="review_note" value="{{ $message->review_note }}" placeholder="یادداشت بررسی">
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">ذخیره وضعیت</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
