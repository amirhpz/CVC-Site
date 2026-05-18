@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $thispage['list'] }}</h5>
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
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->workflow_status ?? 'new' }}</td>
                            <td>{{ optional($item->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('career-application.show', $item->id) }}" class="btn btn-sm btn-outline-primary">نمایش</a>
                                @can('can-access', ['careerapplication', 'delete'])
                                    <form action="{{ route('career-application.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted">داده‌ای ثبت نشده است.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $applications->links() }}</div>
        </div>
    </div>
@endsection
