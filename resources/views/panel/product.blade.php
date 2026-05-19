@extends('layouts.base')

@section('title', 'مدیریت پورتفولیو')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/dataTables.dataTables.min.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .portfolio-upload-box {
            height: 100%;
            padding: 14px;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
        }

        .portfolio-upload-box .form-label {
            font-weight: 700;
            color: #334155;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="card-title mb-1">{{ $thispage['list'] }}</h5>
                    <p class="text-muted mb-0">این اطلاعات در صفحه پورتفولیو CVC نمایش داده می شود.</p>
                </div>
                @can('can-access', ['product', 'insert'])
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">{{ $thispage['add'] }}</a>
                @endcan
            </div>

            <div class="table-responsive">
                <table id="portfolioTable" class="table table-striped table-bordered yajra-datatable">
                    <thead>
                    <tr class="table-light">
                        <th>تصویر</th>
                        <th>نام شرکت</th>
                        <th>حوزه</th>
                        <th>برچسب ها</th>
                        <th>اولویت</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title w-100">{{ $thispage['delete'] }}</h5>
                    <button type="button" class="btn-close position-absolute start-0 mx-3" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    آیا از حذف این شرکت پورتفولیو مطمئن هستید؟
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $thispage['add'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addform" data-type="create" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="title" id="title" class="form-control" required>
                                    <label for="title">نام شرکت / استارتاپ</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="sub_title" id="sub_title" class="form-control">
                                    <label for="sub_title">حوزه فعالیت</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" name="priority" id="priority" class="form-control" min="0">
                                    <label for="priority">اولویت نمایش</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="en_title" id="en_title" class="form-control">
                                    <label for="en_title">برچسب ها (با کاما جدا شود)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="portfolio-upload-box">
                                    <label for="cover_file" class="form-label">تصویر کاور شرکت</label>
                                    <input type="file" name="cover_file" id="cover_file" class="form-control" accept="image/*">
                                    <small class="text-muted d-block mt-2">تصویر در کارت پورتفولیو و صفحه اصلی نمایش داده می‌شود. حداکثر ۵ مگابایت.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select name="status" id="status" class="form-control">
                                        <option value="4" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                    <label for="status">وضعیت نمایش</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea name="description" id="description" class="form-control" style="height:110px"></textarea>
                                    <label for="description">خلاصه نمایش در کارت پورتفولیو</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea name="full_description" id="full_description" class="form-control" style="height:160px"></textarea>
                                    <label for="full_description">توضیحات کامل شرکت</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">ذخیره شرکت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $thispage['edit'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="text-center text-muted py-5">در حال بارگذاری...</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/formhandler.js') }}"></script>
    <script>
        $(function () {
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [
                    {data: 'cover', name: 'cover', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'title', name: 'title'},
                    {data: 'sub_title', name: 'sub_title'},
                    {data: 'en_title', name: 'en_title'},
                    {data: 'priority', name: 'priority', className: 'text-center'},
                    {data: 'status', name: 'status', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],
                language: {url: "{{ asset('assets/vendor/js/fa.json') }}"}
            });
        });
    </script>
@endsection
