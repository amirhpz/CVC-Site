<form data-type="update" data-id="{{ $content->id }}" class="row g-4 mb-4" method="POST" action="{{ route(request()->segment(2).'.update', $content->id) }}">
    @csrf
    @method('PATCH')

    <div class="col-12">
        @include('panel.partials.cvc-meta-key-helper')
    </div>

    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input required type="text" class="form-control" id="title_{{ $content->id }}" name="title" value="{{ $content->title }}">
            <label for="title_{{ $content->id }}">عنوان محتوا</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="slug_{{ $content->id }}" name="slug" value="{{ $content->slug }}">
            <label for="slug_{{ $content->id }}">اسلاگ (اختیاری)</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="meta_title_{{ $content->id }}" name="meta_title" value="{{ $content->meta_title }}" placeholder="page:cvc-faq یا section:faq">
            <label for="meta_title_{{ $content->id }}">عنوان متا</label>
        </div>
        <small class="text-muted">کلیدهای داینامیک: <code>page:...</code> و <code>section:...</code></small>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <select name="menupanel_id" id="menupanel_id_{{ $content->id }}" class="form-control content-edit-menu" data-content-id="{{ $content->id }}">
                <option value="">انتخاب منو</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ (int)$content->menu_id === (int)$menu->id ? 'selected' : '' }}>{{ $menu->label }}</option>
                @endforeach
            </select>
            <label for="menupanel_id_{{ $content->id }}">انتخاب منو</label>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <select name="submenupanel_id" id="submenupanel_id_{{ $content->id }}" class="form-control content-edit-submenu">
                <option value="">انتخاب زیر منو</option>
                @foreach($submenus as $submenu)
                    <option value="{{ $submenu->id }}" data-menu-id="{{ $submenu->menu_id }}" {{ (int)$content->submenu_id === (int)$submenu->id ? 'selected' : '' }}>{{ $submenu->label }}</option>
                @endforeach
            </select>
            <label for="submenupanel_id_{{ $content->id }}">انتخاب زیر منو</label>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <select name="status" id="status_{{ $content->id }}" class="form-control">
                <option value="4" {{ (string)$content->status === '4' ? 'selected' : '' }}>نمایش</option>
                <option value="1" {{ (string)$content->status === '1' ? 'selected' : '' }}>غیرفعال</option>
                <option value="2" {{ (string)$content->status === '2' ? 'selected' : '' }}>تکمیل ظرفیت</option>
                <option value="3" {{ (string)$content->status === '3' ? 'selected' : '' }}>پایان یافته</option>
                <option value="0" {{ (string)$content->status === '0' ? 'selected' : '' }}>عدم نمایش</option>
            </select>
            <label for="status_{{ $content->id }}">نمایش/عدم نمایش</label>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating form-floating-outline">
            <textarea name="description" id="description_{{ $content->id }}" class="form-control" rows="5">{{ old('description', $content->description) }}</textarea>
            <label for="description_{{ $content->id }}">توضیحات کوتاه</label>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-floating form-floating-outline">
            <textarea name="meta_description" id="meta_description_{{ $content->id }}" class="form-control" rows="5">{{ old('meta_description', $content->meta_description) }}</textarea>
            <label for="meta_description_{{ $content->id }}">توضیحات متا</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="slide_{{ $content->id }}" name="slide" value="{{ $content->slide }}">
            <label for="slide_{{ $content->id }}">مسیر اسلاید</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="cover_{{ $content->id }}" name="cover" value="{{ $content->cover }}">
            <label for="cover_{{ $content->id }}">مسیر کاور</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="image_{{ $content->id }}" name="image" value="{{ $content->image }}">
            <label for="image_{{ $content->id }}">مسیر تصویر</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="video_{{ $content->id }}" name="video" value="{{ $content->video }}">
            <label for="video_{{ $content->id }}">مسیر ویدئو</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="aparat_{{ $content->id }}" name="aparat" value="{{ $content->aparat }}">
            <label for="aparat_{{ $content->id }}">آپارات (لینک/فایل)</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="file_{{ $content->id }}" name="file" value="{{ $content->file }}">
            <label for="file_{{ $content->id }}">مسیر فایل پیوست</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline">
            <textarea name="full_description" id="full_description_{{ $content->id }}" class="form-control" rows="10">{{ old('full_description', $content->full_description) }}</textarea>
            <label for="full_description_{{ $content->id }}">محتوای کامل</label>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">ذخیره اطلاعات</button>
    </div>
</form>
