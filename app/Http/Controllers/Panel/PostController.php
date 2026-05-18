<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('can-access', ['post', 'view']);

        $thispage = [
            'title' => 'مدیریت اخبار',
            'list' => 'لیست اخبار',
            'add' => 'افزودن خبر',
            'edit' => 'ویرایش خبر',
            'delete' => 'حذف خبر',
        ];

        if ($request->ajax()) {
            $data = Post::query()
                ->select('id', 'title', 'sub_title', 'cover', 'file_path', 'gallery_media', 'status', 'created_at')
                ->orderByDesc('id')
                ->get();

            return DataTables::of($data)
                ->addColumn('status_label', function (Post $post) {
                    return (int) $post->status === 4 ? 'فعال' : 'غیرفعال';
                })
                ->addColumn('file_label', function (Post $post) {
                    return empty($post->file_path) ? '-' : 'پیوست دارد';
                })
                ->addColumn('gallery_label', function (Post $post) {
                    $count = count($post->gallery_media ?? []);

                    return $count > 0 ? $count . ' فایل' : '-';
                })
                ->addColumn('cover', function (Post $post) {
                    if (empty($post->cover)) {
                        return '-';
                    }

                    return '<img src="' . asset('storage/' . ltrim($post->cover, '/')) . '" alt="" style="width:72px;height:48px;object-fit:cover;border-radius:8px;">';
                })
                ->addColumn('action', function (Post $post) {
                    $buttons = '';

                    if (auth()->user()->can('can-access', ['post', 'edit'])) {
                        $buttons .= '<button type="button" class="btn btn-sm btn-outline-primary edit-btn" data-id="' . $post->id . '" data-url="' . route('post.edit', $post->id) . '"><i class="mdi mdi-pencil-outline"></i></button>';
                    }

                    if (auth()->user()->can('can-access', ['post', 'delete'])) {
                        $buttons .= '<button type="button" class="btn btn-sm btn-outline-danger mx-1 delete-btn" data-id="' . $post->id . '"><i class="mdi mdi-delete-outline"></i></button>';
                    }

                    return $buttons;
                })
                ->rawColumns(['action', 'cover'])
                ->make(true);
        }

        return view('panel.post', compact('thispage'));
    }

    public function store(Request $request)
    {
        Gate::authorize('can-access', ['post', 'insert']);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'en_title' => 'nullable',
            'en_title.*' => 'nullable|string|max:80',
            'cover' => 'nullable|string|max:500',
            'cover_file' => 'nullable|image|max:5120',
            'file_path' => 'nullable|string|max:500',
            'attachment_file' => 'nullable|file|max:51200',
            'gallery_files' => 'nullable|array|max:20',
            'gallery_files.*' => 'file|mimetypes:image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/quicktime|max:51200',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'priority' => 'nullable|integer|min:0',
            'status' => 'required|in:0,4',
        ]);

        $cover = $request->hasFile('cover_file')
            ? $request->file('cover_file')->store('posts/featured', 'public')
            : ($validated['cover'] ?? null);

        $attachment = $request->hasFile('attachment_file')
            ? $request->file('attachment_file')->store('posts/attachments', 'public')
            : ($validated['file_path'] ?? null);

        $gallery = $this->storeGalleryFiles($request);

        Post::query()->create([
            'title' => $validated['title'],
            'sub_title' => $validated['sub_title'] ?? null,
            'en_title' => $this->tagsToString($request->input('en_title')),
            'slug' => $this->uniqueSlug($validated['title']),
            'cover' => $cover,
            'file_path' => $attachment,
            'gallery_media' => $gallery,
            'description' => $validated['description'] ?? null,
            'full_description' => $validated['full_description'] ?? null,
            'priority' => $validated['priority'] ?? null,
            'status' => (int) $validated['status'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'flag' => 'success',
            'subject' => 'عملیات موفق',
            'message' => 'خبر با موفقیت ثبت شد',
        ]);
    }

    public function edit(string $id)
    {
        Gate::authorize('can-access', ['post', 'edit']);

        $post = Post::query()->findOrFail($id);

        return view('panel.partials.edit-form-post', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('can-access', ['post', 'edit']);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'en_title' => 'nullable',
            'en_title.*' => 'nullable|string|max:80',
            'cover' => 'nullable|string|max:500',
            'cover_file' => 'nullable|image|max:5120',
            'file_path' => 'nullable|string|max:500',
            'attachment_file' => 'nullable|file|max:51200',
            'gallery_files' => 'nullable|array|max:20',
            'gallery_files.*' => 'file|mimetypes:image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/quicktime|max:51200',
            'clear_gallery' => 'nullable|boolean',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'priority' => 'nullable|integer|min:0',
            'status' => 'required|in:0,4',
        ]);

        $post = Post::query()->findOrFail($id);
        $post->title = $validated['title'];
        $post->slug = $this->uniqueSlug($validated['title'], $post->id);
        $post->sub_title = $validated['sub_title'] ?? null;
        $post->en_title = $this->tagsToString($request->input('en_title'));
        $post->cover = $request->hasFile('cover_file')
            ? $request->file('cover_file')->store('posts/featured', 'public')
            : ($validated['cover'] ?? $post->cover);
        $post->file_path = $request->hasFile('attachment_file')
            ? $request->file('attachment_file')->store('posts/attachments', 'public')
            : ($validated['file_path'] ?? $post->file_path);
        $post->gallery_media = $this->mergeGalleryFiles(
            $request,
            $request->boolean('clear_gallery') ? [] : ($post->gallery_media ?? [])
        );
        $post->description = $validated['description'] ?? null;
        $post->full_description = $validated['full_description'] ?? null;
        $post->priority = $validated['priority'] ?? null;
        $post->status = (int) $validated['status'];
        $post->save();

        return response()->json([
            'success' => true,
            'flag' => 'success',
            'subject' => 'عملیات موفق',
            'message' => 'خبر با موفقیت ویرایش شد',
        ]);
    }

    public function destroy(string $id)
    {
        Gate::authorize('can-access', ['post', 'delete']);

        $post = Post::query()->findOrFail($id);
        $post->delete();

        return response()->json([
            'success' => true,
            'flag' => 'success',
            'subject' => 'عملیات موفق',
            'message' => 'خبر با موفقیت حذف شد',
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = $this->makePersianSlug($title);
        if ($baseSlug === '') {
            $baseSlug = 'news';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (Post::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    private function makePersianSlug(string $title): string
    {
        $slug = trim(mb_strtolower($title));
        $slug = preg_replace('/[^\p{Arabic}\p{L}\p{N}\s\-]+/u', '', $slug);
        $slug = preg_replace('/[\s\-]+/u', '-', $slug);

        return trim((string) $slug, '-');
    }

    private function storeGalleryFiles(Request $request): array
    {
        return $this->mergeGalleryFiles($request, []);
    }

    private function mergeGalleryFiles(Request $request, array $existing): array
    {
        if (!$request->hasFile('gallery_files')) {
            return array_values($existing);
        }

        foreach ($request->file('gallery_files') as $file) {
            $path = $file->store('posts/gallery', 'public');
            $mime = $file->getMimeType() ?: '';

            $existing[] = [
                'path' => $path,
                'type' => str_starts_with($mime, 'video/') ? 'video' : 'image',
                'name' => $file->getClientOriginalName(),
            ];
        }

        return array_values($existing);
    }

    private function tagsToString(mixed $tags): ?string
    {
        if (is_string($tags)) {
            $tags = explode(',', $tags);
        }

        if (!is_array($tags)) {
            return null;
        }

        $cleanTags = collect($tags)
            ->map(fn ($tag) => trim((string) $tag))
            ->filter()
            ->unique()
            ->values();

        return $cleanTags->isEmpty() ? null : $cleanTags->implode(',');
    }
}
