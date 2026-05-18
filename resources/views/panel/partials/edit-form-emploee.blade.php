<form data-type="update" data-id="{{ $emploee->id }}" class="row g-4 mb-0" method="POST" action="{{ route('emploee.update', $emploee->id) }}">
    @csrf
    @method('PATCH')

    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input required type="text" class="form-control" id="fullname_{{ $emploee->id }}" name="fullname" value="{{ $emploee->fullname }}">
            <label for="fullname_{{ $emploee->id }}">نام و نام خانوادگی</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="side_{{ $emploee->id }}" name="side" value="{{ $emploee->side }}">
            <label for="side_{{ $emploee->id }}">سمت</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="phone_{{ $emploee->id }}" name="phone" value="{{ $emploee->phone }}">
            <label for="phone_{{ $emploee->id }}">شماره تماس</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="instagram_{{ $emploee->id }}" name="instagram" value="{{ $emploee->instagram }}">
            <label for="instagram_{{ $emploee->id }}">ایمیل / لینک اجتماعی</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="text" class="form-control" id="image_{{ $emploee->id }}" name="image" value="{{ $emploee->image }}">
            <label for="image_{{ $emploee->id }}">مسیر تصویر عضو</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <input type="number" class="form-control" id="priority_{{ $emploee->id }}" name="priority" min="0" value="{{ $emploee->priority }}">
            <label for="priority_{{ $emploee->id }}">اولویت نمایش</label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-floating form-floating-outline">
            <select name="status" id="status_{{ $emploee->id }}" class="form-control">
                <option value="4" {{ (int) $emploee->status === 4 ? 'selected' : '' }}>فعال</option>
                <option value="0" {{ (int) $emploee->status === 0 ? 'selected' : '' }}>غیرفعال</option>
            </select>
            <label for="status_{{ $emploee->id }}">وضعیت نمایش</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline">
            <textarea name="description" id="description_{{ $emploee->id }}" class="form-control" style="min-height: 180px">{{ $emploee->description }}</textarea>
            <label for="description_{{ $emploee->id }}">معرفی عضو برای صفحه تیم</label>
        </div>
    </div>
    <div class="col-12 text-end">
        <button type="submit" id="editsubmit_{{ $emploee->id }}" class="btn btn-primary">ذخیره اطلاعات</button>
    </div>
</form>
