@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">{{ $thispage['list'] }}</h5>
                <a href="{{ route('career-application.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>

            <div class="row g-3">
                <div class="col-md-6"><strong>وضعیت:</strong> {{ $application->workflow_status ?? 'new' }}</div>
                <div class="col-md-6"><strong>نام:</strong> {{ $application->first_name }} {{ $application->last_name }}</div>
                <div class="col-md-6"><strong>کد ملی:</strong> {{ $application->national_code }}</div>
                <div class="col-md-6"><strong>ایمیل:</strong> {{ $application->email }}</div>
                <div class="col-md-6"><strong>تلفن:</strong> {{ $application->phone }}</div>
                <div class="col-md-6"><strong>شهر/استان:</strong> {{ $application->city }} / {{ $application->province }}</div>
                <div class="col-md-6"><strong>سمت درخواستی:</strong> {{ $application->position }}</div>
                <div class="col-md-6"><strong>حقوق مورد انتظار:</strong> {{ $application->expected_salary }}</div>
                <div class="col-md-6"><strong>زمان شروع همکاری:</strong> {{ $application->availability }}</div>
                <div class="col-12"><strong>مهارت‌ها:</strong><br>{{ $application->skills }}</div>
                <div class="col-12"><strong>انگیزه:</strong><br>{{ $application->motivation }}</div>
                <div class="col-12"><strong>یادداشت بررسی:</strong><br>{{ $application->review_note }}</div>
                <div class="col-md-6">
                    <a href="{{ route('career-application.resume', $application->id) }}" class="btn btn-outline-primary">دانلود رزومه</a>
                </div>
                <div class="col-md-6">
                    @if($application->documents_path)
                        <a href="{{ route('career-application.documents', $application->id) }}" class="btn btn-outline-primary">دانلود مدارک</a>
                    @endif
                </div>
            </div>

            @can('can-access', ['careerapplication', 'edit'])
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="mb-3">به‌روزرسانی وضعیت</h6>
                        <form method="POST" action="{{ route('career-application.status', $application->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-control" name="workflow_status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ ($application->workflow_status ?? 'new') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="review_note" value="{{ $application->review_note }}" placeholder="یادداشت بررسی">
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
