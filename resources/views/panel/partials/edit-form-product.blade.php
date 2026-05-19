<form data-type="update" data-id="{{ $product->id }}" class="row g-4 mb-0" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            <input type="text" name="title" id="title_{{ $product->id }}" class="form-control" value="{{ $product->title }}" required>
            <label for="title_{{ $product->id }}">نام شرکت / استارتاپ</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            <input type="text" name="sub_title" id="sub_title_{{ $product->id }}" class="form-control" value="{{ $product->sub_title }}">
            <label for="sub_title_{{ $product->id }}">حوزه فعالیت</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-floating form-floating-outline">
            <input type="number" name="priority" id="priority_{{ $product->id }}" class="form-control" min="0" value="{{ $product->priority }}">
            <label for="priority_{{ $product->id }}">اولویت نمایش</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            <input type="text" name="en_title" id="en_title_{{ $product->id }}" class="form-control" value="{{ $product->en_title }}">
            <label for="en_title_{{ $product->id }}">برچسب ها (با کاما جدا شود)</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portfolio-upload-box">
            <label for="cover_file_{{ $product->id }}" class="form-label">تصویر کاور جدید</label>
            <input type="file" name="cover_file" id="cover_file_{{ $product->id }}" class="form-control" accept="image/*">
            <input type="hidden" name="cover" value="{{ $product->cover }}">
            @if($product->cover)
                <small class="text-muted d-block mt-2">تصویر فعلی: {{ $product->cover }}</small>
            @else
                <small class="text-muted d-block mt-2">هنوز تصویری ثبت نشده است.</small>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-floating form-floating-outline">
            <select name="status" id="status_{{ $product->id }}" class="form-control">
                <option value="4" {{ (int) $product->status === 4 ? 'selected' : '' }}>فعال</option>
                <option value="0" {{ (int) $product->status === 0 ? 'selected' : '' }}>غیرفعال</option>
            </select>
            <label for="status_{{ $product->id }}">وضعیت نمایش</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline">
            <textarea name="description" id="description_{{ $product->id }}" class="form-control" style="height:110px">{{ $product->description }}</textarea>
            <label for="description_{{ $product->id }}">خلاصه نمایش در کارت پورتفولیو</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline">
            <textarea name="full_description" id="full_description_{{ $product->id }}" class="form-control" style="height:160px">{{ $product->full_description }}</textarea>
            <label for="full_description_{{ $product->id }}">توضیحات کامل شرکت</label>
        </div>
    </div>
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">ذخیره شرکت</button>
    </div>
</form>
