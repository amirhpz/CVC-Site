<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CvcSectionContentController extends Controller
{
    private const SECTIONS = [
        'domains' => [
            'slug' => 'cvc-domains',
            'section' => 'domain',
            'permission' => 'cvcdomainscontent',
            'title' => 'مدیریت صفحه حوزه های سرمایه گذاری',
            'public_route' => 'cvc.domains',
            'item_title_label' => 'نام حوزه سرمایه گذاری',
            'item_summary_label' => 'توضیح کوتاه حوزه',
            'item_body_label' => 'جزئیات معیارهای سرمایه گذاری',
            'help' => 'هر آیتم یک حوزه سرمایه گذاری قابل نمایش در صفحه حوزه ها است.',
        ],
        'faq' => [
            'slug' => 'cvc-faq',
            'section' => 'faq',
            'permission' => 'cvcfaqcontent',
            'title' => 'مدیریت صفحه سوالات متداول',
            'public_route' => 'cvc.faq',
            'item_title_label' => 'سوال',
            'item_summary_label' => 'پاسخ کوتاه',
            'item_body_label' => 'پاسخ کامل',
            'help' => 'هر آیتم یک سوال و پاسخ است. سوال را در عنوان و پاسخ را در متن وارد کنید.',
        ],
        'investment' => [
            'slug' => 'cvc-investment',
            'section' => 'investment',
            'permission' => 'cvcinvestmentcontent',
            'title' => 'مدیریت صفحه درخواست سرمایه',
            'public_route' => 'cvc.investment',
            'item_title_label' => 'عنوان راهنما یا شرط',
            'item_summary_label' => 'توضیح کوتاه',
            'item_body_label' => 'جزئیات مورد نیاز برای متقاضی',
            'help' => 'این آیتم ها برای راهنمای متقاضیان سرمایه استفاده می شوند.',
        ],
        'investment-process' => [
            'slug' => 'cvc-investment-process',
            'section' => 'investment-process',
            'permission' => 'cvcinvestmentprocesscontent',
            'title' => 'مدیریت صفحه فرآیند سرمایه گذاری',
            'public_route' => 'cvc.investment-process',
            'item_title_label' => 'عنوان مرحله',
            'item_summary_label' => 'خلاصه مرحله',
            'item_body_label' => 'شرح کامل مرحله',
            'help' => 'هر آیتم یک مرحله یا نکته در فرآیند سرمایه گذاری است.',
        ],
    ];

    public function domains(): View
    {
        return $this->renderSection('domains', 'panel.cvc-domains-content');
    }

    public function faq(): View
    {
        return $this->renderSection('faq', 'panel.cvc-faq-content');
    }

    public function investment(): View
    {
        return $this->renderSection('investment', 'panel.cvc-investment-content');
    }

    public function investmentProcess(): View
    {
        return $this->renderSection('investment-process', 'panel.cvc-investment-process-content');
    }

    public function store(Request $request, string $sectionKey): RedirectResponse
    {
        $config = $this->resolveConfig($sectionKey);
        Gate::authorize('can-access', [$config['permission'], 'insert']);

        $validated = $request->validate([
            'item_title' => ['required', 'string', 'max:255'],
            'item_description' => ['nullable', 'string'],
            'item_full_description' => ['nullable', 'string'],
            'item_image' => ['nullable', 'string', 'max:2000'],
            'item_status' => ['nullable', 'in:0,1,2,3,4'],
        ]);

        Content::query()->create([
            'title' => $validated['item_title'],
            'description' => $validated['item_description'] ?? null,
            'full_description' => $validated['item_full_description'] ?? null,
            'image' => $validated['item_image'] ?? null,
            'meta_title' => 'section:' . $config['section'],
            'status' => $validated['item_status'] ?? 4,
            'menu_id' => 1,
            'submenu_id' => $this->submenuId($config['permission']),
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'آیتم جدید ثبت شد.');
    }

    public function update(Request $request, string $sectionKey): RedirectResponse
    {
        $config = $this->resolveConfig($sectionKey);
        Gate::authorize('can-access', [$config['permission'], 'edit']);

        $validated = $request->validate([
            'page_title' => ['required', 'string', 'max:255'],
            'page_description' => ['nullable', 'string'],
            'page_full_description' => ['nullable', 'string'],
            'page_image' => ['nullable', 'string', 'max:2000'],
            'page_status' => ['nullable', 'in:0,1,2,3,4'],
            'item.*.id' => ['nullable', 'integer', 'exists:contents,id'],
            'item.*.title' => ['required_with:item.*.id', 'string', 'max:255'],
            'item.*.description' => ['nullable', 'string'],
            'item.*.full_description' => ['nullable', 'string'],
            'item.*.image' => ['nullable', 'string', 'max:2000'],
            'item.*.status' => ['nullable', 'in:0,1,2,3,4'],
            'delete_items' => ['nullable', 'array'],
            'delete_items.*' => ['integer', 'exists:contents,id'],
        ]);

        $submenuId = $this->submenuId($config['permission']);

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
            'submenu_id' => $pageContent->submenu_id ?? $submenuId,
            'user_id' => Auth::id(),
        ]);
        $pageContent->save();

        foreach ($validated['item'] ?? [] as $row) {
            if (empty($row['id'])) {
                continue;
            }

            $item = Content::query()->where('meta_title', 'section:' . $config['section'])->find($row['id']);
            if (!$item) {
                continue;
            }

            $item->fill([
                'title' => $row['title'],
                'description' => $row['description'] ?? null,
                'full_description' => $row['full_description'] ?? null,
                'image' => $row['image'] ?? null,
                'status' => $row['status'] ?? $item->status,
                'menu_id' => $item->menu_id ?? 1,
                'submenu_id' => $item->submenu_id ?? $submenuId,
                'user_id' => Auth::id(),
            ]);
            $item->save();
        }

        if (!empty($validated['delete_items'])) {
            Content::query()
                ->where('meta_title', 'section:' . $config['section'])
                ->whereIn('id', $validated['delete_items'])
                ->delete();
        }

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    private function renderSection(string $sectionKey, string $view): View
    {
        $config = $this->resolveConfig($sectionKey);
        Gate::authorize('can-access', [$config['permission'], 'view']);

        $pageContent = Content::query()
            ->where(function ($query) use ($config) {
                $query->where('slug', $config['slug'])
                    ->orWhere('meta_title', 'page:' . $config['slug']);
            })
            ->latest('id')
            ->first();

        $items = Content::query()
            ->where('meta_title', 'section:' . $config['section'])
            ->latest('id')
            ->get();

        return view($view, [
            'thispage' => [
                'title' => $config['title'],
                'list' => 'مدیریت محتوا',
                'add' => 'افزودن',
                'edit' => 'ویرایش',
                'delete' => 'حذف',
            ],
            'sectionKey' => $sectionKey,
            'permissionSlug' => $config['permission'],
            'pageContent' => $pageContent,
            'items' => $items,
            'config' => $config,
            'publicUrl' => route($config['public_route']),
        ]);
    }

    private function resolveConfig(string $sectionKey): array
    {
        abort_unless(isset(self::SECTIONS[$sectionKey]), 404);
        return self::SECTIONS[$sectionKey];
    }

    private function submenuId(string $permissionSlug): int
    {
        return (int) \App\Models\Submenu::query()
            ->where('slug', $permissionSlug)
            ->value('id') ?: 1;
    }
}
