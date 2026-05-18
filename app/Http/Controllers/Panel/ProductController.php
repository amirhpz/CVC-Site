<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        {
            $thispage       = [
                'title'   => 'مدیریت پورتفولیو',
                'list'    => 'شرکت های پورتفولیو',
                'add'     => 'افزودن شرکت',
                'create'  => 'ایجاد شرکت',
                'enter'   => 'ورود شرکت',
                'edit'    => 'ویرایش شرکت',
                'delete'  => 'حذف شرکت',
            ];

            if ($request->ajax()) {
                $data = Product::select('id', 'title', 'sub_title', 'en_title', 'cover', 'priority', 'status')->orderByRaw('COALESCE(priority, 999999) asc')->orderByDesc('id')->get();

                return Datatables::of($data)
                    ->addColumn('id', function ($data) {
                        return ($data->id);
                    })
                    ->addColumn('title', function ($data) {
                        return ($data->title);
                    })
                    ->addColumn('sub_title', function ($data) {
                        return $data->sub_title ?: 'عمومی';
                    })
                    ->addColumn('en_title', function ($data) {
                        return $data->en_title ?: '-';
                    })
                    ->addColumn('cover', function ($data) {
                        if (empty($data->cover)) {
                            return '-';
                        }
                        return '<img src="' . asset('storage/' . ltrim($data->cover, '/')) . '" width="72" height="48" style="object-fit:cover;border-radius:6px;" alt="">';
                    })
                    ->addColumn('priority', function ($data) {
                        return $data->priority ?? '-';
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
                    ->editColumn('action', function ($data) {

                        $actionBtn = '';
                        if (auth()->user()->can('can-access', ['product', 'edit'])) {
                            $actionBtn .= '<button type="button" class="btn btn-sm btn-outline-primary edit-btn" data-id="'.$data->id.'" data-url="'.route('product.edit', $data->id).'"><i class="mdi mdi-pencil-outline"></i></button>';
                        }
                        if (auth()->user()->can('can-access', ['product', 'delete'])) {
                            $actionBtn .= '<button type="button" class="btn btn-sm btn-icon btn-outline-danger mx-1 delete-btn" data-id="'.$data->id.'"><i class="mdi mdi-delete-outline"></i></button>';
                        }
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'cover'])
                    ->make(true);
            }
            return view('panel.product')->with(compact(['thispage']));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('can-access', ['product', 'insert']);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'en_title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:500',
            'priority' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'status' => 'required|in:0,4',
        ]);

        try {
            $baseSlug = Str::slug((string) $validated['title']);
            if (empty($baseSlug)) {
                $baseSlug = 'product';
            }

            $slug = $baseSlug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $product = new Product();
            $product->title = $validated['title'];
            $product->en_title = $validated['en_title'] ?? null;
            $product->sub_title = $validated['sub_title'] ?? null;
            $product->slug = $slug;

            $product->cover = $validated['cover'] ?? null;
            $product->priority = $validated['priority'] ?? null;
            $product->price = '0';
            $product->product_type = 'portfolio';
            $product->description = $validated['description'] ?? null;
            $product->full_description = $validated['full_description'] ?? null;
            $product->status = (int) $validated['status'];
            $product->user_id = Auth::id();

            $result = $product->save();

            if ($result === true) {
                $success = true;
                $flag = 'success';
                $subject = 'عملیات موفق';
                $message = 'اطلاعات با موفقیت ثبت شد';
            } else {
                $success = false;
                $flag = 'error';
                $subject = 'عملیات ناموفق';
                $message = 'اطلاعات ثبت نشد، لطفا مجددا تلاش نمایید';
            }
        } catch (Exception $e) {
            $success = false;
            $flag = 'error';
            $subject = 'خطا در ارتباط با سرور';
            $message = 'اطلاعات ثبت نشد، لطفا بعدا مجدد تلاش نمایید';
        }

        return response()->json([
            'success' => $success,
            'subject' => $subject,
            'flag' => $flag,
            'message' => $message
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::authorize('can-access', ['product', 'edit']);

        $product       = Product::whereId($id)->first();

        return view('panel.partials.edit-form-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('can-access', ['product', 'edit']);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'en_title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'cover' => 'nullable|string|max:500',
            'priority' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'status' => 'required|in:0,4',
        ]);

        $product = Product::query()->findOrFail($id);
        $product->title = $validated['title'];
        $product->en_title = $validated['en_title'] ?? null;
        $product->sub_title = $validated['sub_title'] ?? null;
        $product->cover = $validated['cover'] ?? null;
        $product->priority = $validated['priority'] ?? null;
        $product->description = $validated['description'] ?? null;
        $product->full_description = $validated['full_description'] ?? null;
        $product->status = (int) $validated['status'];
        $product->save();

        return response()->json([
            'success' => true,
            'subject' => 'عملیات موفق',
            'flag' => 'success',
            'message' => 'شرکت پورتفولیو با موفقیت ویرایش شد',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('can-access', ['product', 'delete']);

        Product::query()->findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'subject' => 'عملیات موفق',
            'flag' => 'success',
            'message' => 'شرکت پورتفولیو با موفقیت حذف شد',
        ]);
    }
}
