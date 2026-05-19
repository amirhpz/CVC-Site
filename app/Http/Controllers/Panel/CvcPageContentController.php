<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CvcPageContentController extends Controller
{
    private const PAGES = [
        'career' => [
            'slug' => 'cvc-career',
            'permission' => 'cvccareercontent',
            'title' => 'CMS صفحه همکاری',
            'public_route' => 'cvc.career',
            'summary_label' => 'پیام جذب نیرو',
            'body_label' => 'توضیح فرهنگ کاری یا مزایای همکاری',
            'help' => 'این محتوا بالای فرم همکاری نمایش داده می شود و باید برای متقاضی شفاف باشد.',
        ],
    ];

    public function career(): View { return $this->renderPage('career', 'panel.cvc-career-content'); }

    public function update(Request $request, string $pageKey): RedirectResponse
    {
        $config = $this->resolveConfig($pageKey);
        Gate::authorize('can-access', [$config['permission'], 'edit']);

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'page_description' => ['nullable', 'string'],
            'page_full_description' => ['nullable', 'string'],
            'page_image' => ['nullable', 'string', 'max:2000'],
            'page_status' => ['nullable', 'in:0,1,2,3,4'],
        ]);

        $pageContent = Content::query()->firstOrNew([
            'meta_title' => 'page:' . $config['slug'],
        ]);

        $pageContent->fill([
            'title' => $validated['page_title'],
            'slug' => $config['slug'],
            'description' => $validated['page_description'] ?? null,
            'full_description' => $validated['page_full_description'] ?? null,
            'image' => $validated['page_image'] ?? null,
            'status' => $validated['page_status'] ?? 4,
            'menu_id' => $pageContent->menu_id ?? 1,
            'submenu_id' => $pageContent->submenu_id ?? $this->submenuId($config['permission']),
            'user_id' => Auth::id(),
        ]);

        $pageContent->save();

        return back()->with('success', 'محتوای صفحه با موفقیت ذخیره شد.');
    }

    private function renderPage(string $pageKey, string $view): View
    {
        $config = $this->resolveConfig($pageKey);
        Gate::authorize('can-access', [$config['permission'], 'view']);

        $pageContent = Content::query()
            ->where(function ($query) use ($config) {
                $query->where('slug', $config['slug'])
                    ->orWhere('meta_title', 'page:' . $config['slug']);
            })
            ->latest('id')
            ->first();

        return view($view, [
            'thispage' => [
                'title' => $config['title'],
                'list' => 'مدیریت محتوا',
                'add' => 'افزودن',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            ],
            'pageKey' => $pageKey,
            'permissionSlug' => $config['permission'],
            'pageContent' => $pageContent,
            'config' => $config,
            'publicUrl' => route($config['public_route']),
        ]);
    }

    private function resolveConfig(string $pageKey): array
    {
        abort_unless(isset(self::PAGES[$pageKey]), 404);
        return self::PAGES[$pageKey];
    }

    private function submenuId(string $permissionSlug): int
    {
        return (int) \App\Models\Submenu::query()->where('slug', $permissionSlug)->value('id') ?: 1;
    }
}
