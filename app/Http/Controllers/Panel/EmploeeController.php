<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Emploee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EmploeeController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('can-access', ['employee', 'view']);

        $thispage       = [
            'title'   => 'مدیریت تیم',
            'list'    => 'اعضای تیم CVC',
            'add'     => 'افزودن عضو تیم',
            'create'  => 'ایجاد عضو تیم',
            'enter'   => 'ورود عضو تیم',
            'edit'    => 'ویرایش عضو تیم',
            'delete'  => 'حذف عضو تیم',
        ];

        if ($request->ajax()) {
            $data = Emploee::select('id', 'fullname', 'image', 'side', 'status', 'priority')
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderByDesc('id')
                ->get();

            return Datatables::of($data)
                ->addColumn('fullname', function ($data) {
                    return ($data->fullname);
                })
                ->addColumn('side', function ($data) {
                    return ($data->side);
                })
                ->addColumn('priority', function ($data) {
                    return ($data->priority);
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == "0") {
                        return "لغو ";
                    } elseif ($data->status == "1") {
                        return "غیر فعال";
                    } elseif ($data->status == "2") {
                        return "تکمیل ظرفیت";
                    } elseif ($data->status == "3") {
                        return "پایان یافته";
                    } elseif ($data->status == "4") {
                        return "فعال";
                    }
                })
                ->addColumn('image', function ($data) {
                    if (empty($data->image)) {
                        return '-';
                    }

                    return '<img src="' . asset('storage/' . ltrim($data->image, '/')) . '"  width="80" height="80" class="img-rounded" style="object-fit:cover" align="center" />';
                })
                ->editColumn('action', function ($data) {
                    $base = 'btn btn-sm btn-icon rounded-pill waves-effect mx-1';

                    $actionBtn = '';

                    if (auth()->user()->can('can-access', ['employee', 'edit'])) {
                        $actionBtn .= '<button type="button"
                        class="'.$base.' btn-outline-primary edit-btn"
                        data-id="'.$data->id.'"
                        data-url="'.route('employee.edit', $data->id).'">
                        <i class="mdi mdi-pencil-outline fs-5"></i>
                    </button>';
                    }

                    if (auth()->user()->can('can-access', ['employee', 'delete'])) {
                        $actionBtn .= '<button type="button"
                        class="'.$base.' btn-outline-danger delete-btn"
                        data-id="'.$data->id.'">
                        <i class="mdi mdi-delete-outline fs-5"></i>
                    </button>';
                    }
//                    $actionBtn .= '<button class="btn btn-sm btn-icon btn-image mx-1 upload-btn" data-id="'.$data->id.'" data-subject="1"><i class="mdi mdi-file-document-multiple-outline"></i></button>';
                    $subject_id = 1;
                    $title = 'تصویر کاربر';
                    $actionBtn .= '<button class="btn btn-sm btn-icon btn-image mx-1 upload-btn" data-id="'.$data->id.'" data-subject="'.$subject_id.'" data-title="'.$title.'"><i class="mdi mdi-file-document-multiple-outline"></i></button>';

                    return $actionBtn;
                })
                ->rawColumns(['action' , 'image'])
                ->make(true);
        }
        return view('panel.employee')->with(compact(['thispage']));

    }

    public function store(Request $request)
    {
        Gate::authorize('can-access', ['employee', 'insert']);

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'side' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:500',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'priority' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:0,4',
        ]);

        try{

            $emploees = new Emploee();

            $emploees->fullname    = $validated['fullname'];
            $emploees->slug        = $this->uniqueSlug($validated['fullname']);
            $emploees->side        = $validated['side'] ?? null;
            $emploees->phone       = $validated['phone'] ?? null;
            $emploees->priority    = $validated['priority'] ?? ((int) Emploee::max('priority') + 1);
            $emploees->instagram   = $validated['instagram'] ?? null;
            $emploees->image       = $request->hasFile('image_file')
                ? $request->file('image_file')->store('team', 'public')
                : ($validated['image'] ?? null);
            $emploees->status      = (int) $validated['status'];
            $emploees->description = $validated['description'] ?? null;
            $result       = $emploees->save();

            if ($result == true) {
                $success = true;
                $flag    = 'success';
                $subject = 'عملیات موفق';
                $message = 'اطلاعات با موفقیت ثبت شد';
            }
            else {
                $success = false;
                $flag    = 'error';
                $subject = 'عملیات نا موفق';
                $message = 'اطلاعات ثبت نشد، لطفا مجددا تلاش نمایید';
            }

        } catch (Exception $e) {

            $success = false;
            $flag    = 'error';
            $subject = 'خطا در ارتباط با سرور';
            //$message = strchr($e);
            $message = 'اطلاعات ثبت نشد،لطفا بعدا مجدد تلاش نمایید ';
        }

        return response()->json(['success'=>$success , 'subject' => $subject, 'flag' => $flag, 'message' => $message]);

    }

    public function create()
    {
        return redirect()->route('employee.index');
    }

    public function show($id)
    {
        return redirect()->route('employee.edit', $id);
    }

    public function edit($id)
    {
        Gate::authorize('can-access', ['employee', 'edit']);

        $emploee = Emploee::findOrFail($id);

        return view('panel.partials.edit-form-employee', compact('emploee'));

    }

    public function update(Request $request , $id)
    {
        Gate::authorize('can-access', ['employee', 'edit']);

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'side' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:500',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:5120',
            'priority' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:0,4',
        ]);

        try{
            $emploees = Emploee::findOrFail($id);
            $emploees->fullname    = $validated['fullname'];
            $emploees->slug        = $emploees->slug ?: $this->uniqueSlug($validated['fullname'], $emploees->id);
            $emploees->side        = $validated['side'] ?? null;
            $emploees->phone       = $validated['phone'] ?? null;
            $emploees->priority    = $validated['priority'] ?? null;
            $emploees->instagram   = $validated['instagram'] ?? null;
            $emploees->status      = (int) $validated['status'];
            $emploees->description = $validated['description'] ?? null;
            $emploees->image       = $request->hasFile('image_file')
                ? $request->file('image_file')->store('team', 'public')
                : ($validated['image'] ?? $emploees->image);
            $result = $emploees->update();
                if ($result == true) {
                    $success = true;
                    $flag    = 'success';
                    $subject = 'عملیات موفق';
                    $message = 'اطلاعات با موفقیت ثبت شد';
                }
                else {
                    $success = false;
                    $flag    = 'error';
                    $subject = 'عملیات نا موفق';
                    $message = 'اطلاعات ثبت نشد، لطفا مجددا تلاش نمایید';
                }

            } catch (Exception $e) {

                $success = false;
                $flag    = 'error';
                $subject = 'خطا در ارتباط با سرور';
                //$message = strchr($e);
                $message = 'اطلاعات ثبت نشد،لطفا بعدا مجدد تلاش نمایید ';
            }

            return response()->json(['success'=>$success , 'subject' => $subject, 'flag' => $flag, 'message' => $message]);
    }

    public function destroy($id)
    {
        Gate::authorize('can-access', ['employee', 'delete']);

        try{
            $emploees = Emploee::findorfail($id);
            $result = $emploees->delete();
            if ($result == true) {
                $success = true;
                $flag    = 'success';
                $subject = 'عملیات موفق';
                $message = 'اطلاعات با موفقیت پاک شد';
            }else{
                $success = false;
                $flag    = 'error';
                $subject = 'عملیات ناموفق';
                $message = 'اطلاعات پاک نشد، لطفا مجددا تلاش نمایید';
            }

        } catch (Exception $e) {

            $success = false;
            $flag    = 'error';
            $subject = 'خطا در ارتباط با سرور';
            $message = 'اطلاعات پاک نشد،لطفا بعدا مجدد تلاش نمایید ';
        }
        return response()->json(['success'=>$success , 'subject' => $subject, 'flag' => $flag, 'message' => $message]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'team-member';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (Emploee::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}


