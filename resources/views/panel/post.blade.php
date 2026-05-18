@extends('layouts.base')

@section('title', 'مدیریت اخبار')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/dataTables.dataTables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/quill.snow.css') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .post-cover-preview img {
            width: 72px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
        }

        .ql-editor {
            min-height: 220px;
            direction: rtl;
            text-align: right;
        }

        .post-quill .ql-toolbar.ql-snow {
            display: flex;
            flex-wrap: wrap;
            gap: 6px 10px;
            align-items: center;
            direction: ltr;
            border-radius: 10px 10px 0 0;
            border-color: #d8d8dd;
            background: #fff;
        }

        .post-quill .ql-container.ql-snow {
            border-radius: 0 0 10px 10px;
            border-color: #d8d8dd;
        }

        .post-quill .ql-formats {
            margin: 0 !important;
        }

        .post-quill .ql-picker-options {
            z-index: 1100;
        }

        .post-upload-note {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 14px;
            color: #475569;
            font-size: 13px;
        }

        .post-modal .modal-body {
            background: #f6f8fb;
        }

        .post-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .post-form-section {
            background: #fff;
            border: 1px solid #e6edf4;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .04);
        }

        .post-form-section + .post-form-section {
            margin-top: 16px;
        }

        .post-form-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 12px;
            margin-bottom: 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .post-form-section-title h6 {
            margin: 0;
            font-weight: 700;
            color: #0f172a;
        }

        .post-form-section-title span {
            color: #64748b;
            font-size: 12px;
        }

        .post-file-field {
            height: 100%;
            padding: 14px;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #fbfdff;
        }

        .post-file-field .form-label {
            font-weight: 700;
            color: #334155;
        }

        .post-modal-footer {
            position: sticky;
            bottom: 0;
            z-index: 3;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin: 20px -16px -16px;
            padding: 14px 18px;
            background: #fff;
            border-top: 1px solid #e6edf4;
        }

        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple {
            min-height: 44px;
            border-color: #d9dee3;
            border-radius: .375rem;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="card-title mb-1">{{ $thispage['list'] }}</h5>
                    <p class="text-muted mb-0">این محتوا مستقیماً صفحه خبر و single-news را تغذیه می‌کند.</p>
                </div>
                @if(Gate::allows('can-access', ['post', 'insert']))
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">{{ $thispage['add'] }}</a>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered yajra-datatable">
                    <thead>
                    <tr class="table-light">
                        <th>کاور</th>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>دسته بندی</th>
                        <th>پیوست</th>
                        <th>گالری</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
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
                    آیا از حذف این خبر مطمئن هستید؟
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade post-modal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $thispage['add'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addform" data-type="create" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="post-form-section">
                            <div class="post-form-section-title">
                                <h6>اطلاعات اصلی خبر</h6>
                                <span>عنوان، دسته بندی، برچسب و وضعیت انتشار</span>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="title" id="title" class="form-control" required>
                                        <label for="title">عنوان خبر</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sub_title" class="form-label">دسته بندی</label>
                                    <select name="sub_title" id="sub_title" class="form-control js-category-select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="priority" id="priority" class="form-control" min="0">
                                        <label for="priority">اولویت</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="en_title" class="form-label">برچسب‌ها</label>
                                    <select name="en_title[]" id="en_title" class="form-control js-tags-select" multiple></select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating form-floating-outline">
                                        <select name="status" id="status" class="form-control">
                                            <option value="4" selected>فعال</option>
                                            <option value="0">غیرفعال</option>
                                        </select>
                                        <label for="status">وضعیت</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-form-section">
                            <div class="post-form-section-title">
                                <h6>رسانه‌ها</h6>
                                <span>تصویر شاخص، گالری و فایل پیوست</span>
                            </div>
                            <div class="post-upload-note mb-4">
                                برای گالری، در هر ذخیره حداکثر ۲۰ فایل و مجموعاً حدود ۳۵ مگابایت انتخاب کنید. برای گالری‌های بزرگ، بعد از ذخیره خبر، فایل‌ها را در چند مرحله از فرم ویرایش اضافه کنید.
                            </div>
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="post-file-field">
                                        <label for="cover_file" class="form-label">تصویر شاخص</label>
                                        <input type="file" name="cover_file" id="cover_file" class="form-control" accept="image/*">
                                        <small class="text-muted d-block mt-2">در کارت خبر و بالای صفحه جزئیات نمایش داده می‌شود.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="post-file-field">
                                        <label for="gallery_files" class="form-label">گالری تصویر و ویدئو</label>
                                        <input type="file" name="gallery_files[]" id="gallery_files" class="form-control" accept="image/*,video/mp4,video/webm,video/quicktime" multiple>
                                        <small class="text-muted d-block mt-2">تصاویر و ویدئوها در صفحه خبر نمایش داده می‌شوند.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="post-file-field">
                                        <label for="attachment_file" class="form-label">فایل پیوست</label>
                                        <input type="file" name="attachment_file" id="attachment_file" class="form-control">
                                        <small class="text-muted d-block mt-2">برای فایل PDF، گزارش یا سند مرتبط با خبر.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-form-section">
                            <div class="post-form-section-title">
                                <h6>محتوا</h6>
                                <span>خلاصه و متن کامل قابل نمایش در سایت</span>
                            </div>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea name="description" id="description" class="form-control" style="height:120px"></textarea>
                                        <label for="description">خلاصه خبر</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label mb-2">متن کامل خبر</label>
                                    <div class="quill-wrapper post-quill" data-post-editor>
                                        <div class="ql-toolbar ql-snow rounded mb-2 js-post-toolbar">
                                            <span class="ql-formats">
                                                <select class="ql-header">
                                                    <option selected></option>
                                                    <option value="1"></option>
                                                    <option value="2"></option>
                                                    <option value="3"></option>
                                                </select>
                                                <select class="ql-font"></select>
                                                <select class="ql-size"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select class="ql-color"></select>
                                                <select class="ql-background"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-indent" value="-1"></button>
                                                <button class="ql-indent" value="+1"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select class="ql-align"></select>
                                                <button class="ql-direction" value="rtl"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-link"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-video"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-clean"></button>
                                            </span>
                                        </div>
                                        <div class="js-post-editor"></div>
                                    </div>
                                    <textarea name="full_description" class="d-none js-post-html"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="post-modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade post-modal" id="editModal" tabindex="-1" aria-hidden="true">
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
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/formhandler.js') }}"></script>
    <script>
        window.initPanelPostEditors = function (scope) {
            const root = scope || document;
            const $root = $(root);

            $root.find('.js-category-select').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) return;
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal'),
                    placeholder: 'دسته بندی را انتخاب یا وارد کنید'
                });
            });

            $root.find('.js-tags-select').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) return;
                $(this).select2({
                    tags: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal'),
                    tokenSeparators: [',', '،'],
                    placeholder: 'برچسب‌ها را وارد کنید'
                });
            });

            root.querySelectorAll('[data-post-editor]').forEach(function (wrapper) {
                if (wrapper.dataset.initialized === '1') return;
                const editorEl = wrapper.querySelector('.js-post-editor');
                const hiddenEl = wrapper.parentElement.querySelector('.js-post-html');
                const toolbarEl = wrapper.querySelector('.js-post-toolbar');
                if (!editorEl || !hiddenEl || !toolbarEl || !window.Quill) return;

                const quill = new Quill(editorEl, {
                    theme: 'snow',
                    modules: {toolbar: toolbarEl}
                });

                if (hiddenEl.value) {
                    quill.root.innerHTML = hiddenEl.value;
                }

                const sync = function () {
                    hiddenEl.value = quill.root.innerHTML.trim();
                };

                quill.on('text-change', sync);
                sync();
                wrapper.dataset.initialized = '1';
            });
        };

        $(function () {
            $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('post.index') }}",
                columns: [
                    {data: 'cover', name: 'cover', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'id', name: 'id', className: 'text-center'},
                    {data: 'title', name: 'title'},
                    {data: 'sub_title', name: 'sub_title'},
                    {data: 'file_label', name: 'file_path', searchable: false, className: 'text-center'},
                    {data: 'gallery_label', name: 'gallery_media', searchable: false, className: 'text-center'},
                    {data: 'status_label', name: 'status', searchable: false, className: 'text-center'},
                    {data: 'created_at', name: 'created_at', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],
                language: {url: "{{ asset('assets/vendor/js/fa.json') }}"}
            });

            $('#addModal').on('shown.bs.modal', function () {
                window.initPanelPostEditors(this);
            });

            window.initPanelPostEditors(document.getElementById('addModal'));
        });

        document.addEventListener('submit', function (event) {
            const form = event.target;
            if (!form.matches('form[action*="/post"]')) return;

            const galleryInput = form.querySelector('input[name="gallery_files[]"]');
            if (!galleryInput || !galleryInput.files.length) return;

            const files = Array.from(galleryInput.files);
            const totalBytes = files.reduce((sum, file) => sum + file.size, 0);
            const maxFiles = 20;
            const maxBytes = 35 * 1024 * 1024;

            if (files.length > maxFiles || totalBytes > maxBytes) {
                event.preventDefault();
                event.stopPropagation();
                const totalMb = (totalBytes / 1024 / 1024).toFixed(1);
                toastr.error(`گالری انتخابی ${files.length} فایل و ${totalMb} مگابایت است. هر بار حداکثر ۲۰ فایل و حدود ۳۵ مگابایت آپلود کنید.`);
            }
        }, true);
    </script>
@endsection
