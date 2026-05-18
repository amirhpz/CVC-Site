<form data-type="update" data-id="{{ $post->id }}" class="mb-0" method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="post-form-section">
        <div class="post-form-section-title">
            <h6>اطلاعات اصلی خبر</h6>
            <span>عنوان، دسته بندی، برچسب و وضعیت انتشار</span>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="form-floating form-floating-outline">
                    <input type="text" name="title" id="title_{{ $post->id }}" class="form-control" value="{{ $post->title }}" required>
                    <label for="title_{{ $post->id }}">عنوان خبر</label>
                </div>
            </div>
            <div class="col-md-3">
                <label for="sub_title_{{ $post->id }}" class="form-label">دسته بندی</label>
                <select name="sub_title" id="sub_title_{{ $post->id }}" class="form-control js-category-select">
                    @if(!empty($post->sub_title))
                        <option value="{{ $post->sub_title }}" selected>{{ $post->sub_title }}</option>
                    @endif
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-floating form-floating-outline">
                    <input type="number" name="priority" id="priority_{{ $post->id }}" class="form-control" min="0" value="{{ $post->priority }}">
                    <label for="priority_{{ $post->id }}">اولویت</label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="en_title_{{ $post->id }}" class="form-label">برچسب‌ها</label>
                <select name="en_title[]" id="en_title_{{ $post->id }}" class="form-control js-tags-select" multiple>
                    @foreach(collect(explode(',', (string) $post->en_title))->map(fn($tag) => trim($tag))->filter() as $tag)
                        <option value="{{ $tag }}" selected>{{ $tag }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-floating form-floating-outline">
                    <select name="status" id="status_{{ $post->id }}" class="form-control">
                        <option value="4" {{ (int) $post->status === 4 ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ (int) $post->status === 0 ? 'selected' : '' }}>غیرفعال</option>
                    </select>
                    <label for="status_{{ $post->id }}">وضعیت</label>
                </div>
            </div>
        </div>
    </div>

    <div class="post-form-section">
        <div class="post-form-section-title">
            <h6>رسانه‌ها</h6>
            <span>فایل‌های جدید جایگزین/اضافه می‌شوند</span>
        </div>
        <div class="post-upload-note mb-4">
            برای اضافه کردن گالری بزرگ، فایل‌ها را در چند مرحله ذخیره کنید. محدودیت فعلی PHP در هر درخواست ۲۰ فایل و حدود ۴۰ مگابایت است.
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="post-file-field">
                    <label for="cover_file_{{ $post->id }}" class="form-label">تصویر شاخص جدید</label>
                    <input type="file" name="cover_file" id="cover_file_{{ $post->id }}" class="form-control" accept="image/*">
                    @if(!empty($post->cover))
                        <small class="text-muted d-block mt-2">تصویر فعلی: {{ $post->cover }}</small>
                    @else
                        <small class="text-muted d-block mt-2">هنوز تصویر شاخص ثبت نشده است.</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-file-field">
                    <label for="gallery_files_{{ $post->id }}" class="form-label">افزودن به گالری</label>
                    <input type="file" name="gallery_files[]" id="gallery_files_{{ $post->id }}" class="form-control" accept="image/*,video/mp4,video/webm,video/quicktime" multiple>
                    <small class="text-muted d-block mt-2">تعداد فایل‌های فعلی: {{ count($post->gallery_media ?? []) }}</small>
                    <div class="form-check mt-3">
                        <input type="checkbox" name="clear_gallery" value="1" id="clear_gallery_{{ $post->id }}" class="form-check-input">
                        <label for="clear_gallery_{{ $post->id }}" class="form-check-label">حذف گالری فعلی قبل از ذخیره</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-file-field">
                    <label for="attachment_file_{{ $post->id }}" class="form-label">فایل پیوست جدید</label>
                    <input type="file" name="attachment_file" id="attachment_file_{{ $post->id }}" class="form-control">
                    @if(!empty($post->file_path))
                        <small class="text-muted d-block mt-2">پیوست فعلی: {{ $post->file_path }}</small>
                    @else
                        <small class="text-muted d-block mt-2">هنوز فایل پیوست ثبت نشده است.</small>
                    @endif
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
                    <textarea name="description" id="description_{{ $post->id }}" class="form-control" style="height:120px">{{ $post->description }}</textarea>
                    <label for="description_{{ $post->id }}">خلاصه خبر</label>
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
                <textarea name="full_description" class="d-none js-post-html">{{ $post->full_description }}</textarea>
            </div>
        </div>
    </div>

    <div class="post-modal-footer">
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">انصراف</button>
        <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
    </div>
</form>
